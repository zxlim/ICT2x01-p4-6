<?php declare(strict_types=1);
/**
* mvc/models/Challenge.php
*
* @copyright    Copyright (c) P4-6 2021. For the
*               partial fulfillment of the module
*               ICT2101/2201 Introduction to
*               Software Engineering.
*
* @author       LIM ZHAO XIANG         (1802976@sit.singaporetech.edu.sg)
* @author       IRFAN BIN FAIRUZ NIAN  (2000937@sit.singaporetech.edu.sg)
* @author       JEROME LIEW HAN RONG   (2001546@sit.singaporetech.edu.sg)
* @author       LIM ZHENG JIE          (2000627@sit.singaporetech.edu.sg)
* @author       WHITNEY TAN WEN HUI    (2002738@sit.singaporetech.edu.sg)
*
* -----------------------------------------------------------------------
* Challenge Model.
* -----------------------------------------------------------------------
*/

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    exit();
}

require_once(__FUNCTIONS_DIR__ . "db.php");
require_once(__FUNCTIONS_DIR__ . "security.php");


class ChallengeException extends Exception {
    public function getError(): string {
        $msg = "ChallengeException on line " . $this->getLine() . ": " . $this->getMessage();
        return $msg;
    }
}


/**
* Challenge Entity Class.
*/
class Challenge {
    private $id;
    private $name;
    private $mapFilePath;
    private $checkpointCount;

    function __construct(int $id, string $name, string $mapFilePath, int $checkpointCount) {
        $this->id = $id;
        $this->name = $name;
        $this->mapFilePath = $mapFilePath;
        $this->checkpointCount = $checkpointCount;
    }

    public static function Load(int $id): Challenge {
        /**
        * Returns a new instance of Challenge based on the specified ID.
        * This function mimics the factory design pattern.
        *
        * @param    int        $id         The ID of the Challenge to load.
        *
        * @return   Challenge  $challenge  The Challenge entity object.
        */
        $db = db_get_conn();
        $stmt = $db->prepare("SELECT name, mapFilePath, checkpointCount FROM challenge WHERE id = :id");
        $stmt->bindValue(":id", $id, SQLITE3_INTEGER);

        $res = $stmt->execute();
        if ($res === false) {
            $errorMessage = sprintf("Failed to load Challenge [%d] %s", $db->lastErrorCode(), $db->lastErrorMsg());
            $db->close();
            throw new DBException($errorMessage);
        }

        $row = $res->fetchArray(SQLITE3_ASSOC);

        if ($row === FALSE) {
            $db->close();
            throw new ChallengeException(sprintf("No Challenge was found with with ID %d.", $id));
        }

        $challenge = new Challenge($id, $row["name"], $row["mapFilePath"], $row["checkpointCount"]);
        $db->close();

        return $challenge;
    }

    /**
    * Getters and Setters.
    */
    public function getID(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function getMapFilePath(): string {
        return $this->mapFilePath;
    }

    public function setMapFilePath(string $mapFilePath) {
        $this->mapFilePath = $mapFilePath;
    }

    public function getCheckpointCount(): int {
        return $this->checkpointCount;
    }

    public function setCheckpointCount(int $name) {
        $this->checkpointCount = $checkpointCount;
    }

    /**
    * Database CRUD operations.
    */
    public function dbCreate() {
        $db = db_get_conn();
        $stmt = $db->prepare("INSERT INTO challenge (name, mapFilePath, checkpointCount) VALUES (:name, :mapFilePath, :checkpointCount)");
        $stmt->bindValue(":name", $this->name, SQLITE3_TEXT);
        $stmt->bindValue(":mapFilePath", $this->mapFilePath, SQLITE3_TEXT);
        $stmt->bindValue(":checkpointCount", $this->checkpointCount, SQLITE3_INTEGER);

        $res = $stmt->execute();
        if ($res === false) {
            $errorMessage = sprintf("Failed to create Challenge [%d] %s", $db->lastErrorCode(), $db->lastErrorMsg());
            $db->close();
            throw new DBException($errorMessage);
        }

        $db->close();
    }

    public function dbUpdate() {
        $db = db_get_conn();
        $stmt = $db->prepare("UPDATE challenge SET name = :name, mapFilePath = :mapFilePath, checkpointCount = :checkpointCount WHERE id = :id");
        $stmt->bindValue(":id", $this->id, SQLITE3_INTEGER);

        $res = $stmt->execute();
        if ($res === false) {
            $errorMessage = sprintf("Failed to update Challenge [%d] %s", $db->lastErrorCode(), $db->lastErrorMsg());
            $db->close();
            throw new DBException($errorMessage);
        }

        $db->close();
    }

    public function dbDelete() {
        $db = db_get_conn();
        $stmt = $db->prepare("DELETE FROM challenge WHERE id = :id");
        $stmt->bindValue(":id", $this->id, SQLITE3_INTEGER);

        $res = $stmt->execute();
        if ($res === false) {
            $errorMessage = sprintf("Failed to delete Challenge [%d] %s", $db->lastErrorCode(), $db->lastErrorMsg());
            $db->close();
            throw new DBException($errorMessage);
        }

        $db->close();
    }
}


/**
* Control Classes.
*/
class ChallengeManagement {
    private $challenge;

    function __construct(Challenge $challenge) {
        $this->challenge = $challenge;
    }

    public function createChallenge(): bool {
        try {
            $this->challenge->dbCreate();
        } catch (DBException $e) {
            return FALSE;
        }

        return TRUE;
    }

    public function deleteChallenge(): bool {
        try {
            $this->challenge->dbDelete();
            unlink(sprintf("%s%s", __ROOT__, $this->challenge->getMapFilePath()));
        } catch (DBException $e) {
            return FALSE;
        }

        return TRUE;
    }

    public function checkCompletion(int $checkpointCount): bool {
        return ($this->challenge->getCheckpointCount === $checkpointCount);
    }

    public static function GetAllChallenges(): array {
        $db = db_get_conn();
        $stmt = $db->prepare("SELECT id, name, mapFilePath, checkpointCount FROM challenge");

        $res = $stmt->execute();
        if ($res === false) {
            $errorMessage = sprintf("Failed to retrieve Challenge [%d] %s", $db->lastErrorCode(), $db->lastErrorMsg());
            $db->close();
            throw new DBException($errorMessage);
        }

        $challenges = array();

        while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
            array_push($challenges, new Challenge($row["id"], $row["name"], $row["mapFilePath"], $row["checkpointCount"]));
        }

        $db->close();

        return $challenges;
    }

    public static function ValidateName(string $name): bool {
        $db = db_get_conn();
        $stmt = $db->prepare("SELECT id FROM challenge WHERE name = :name");
        $stmt->bindValue(":name", $name, SQLITE3_TEXT);

        $res = $stmt->execute();
        if ($res === false) {
            $errorMessage = sprintf("Failed to retrieve Challenge [%d] %s", $db->lastErrorCode(), $db->lastErrorMsg());
            $db->close();
            throw new DBException($errorMessage);
        }

        $row = $res->fetchArray(SQLITE3_ASSOC);
        // If $row is FALSE, means no Challenge with specified name was found.
        $validationResult = ($row === FALSE);

        $db->close();

        return $validationResult;
    }

    public static function ValidateMapFilePath(array $mapFileObject): bool {
        $allowedMimeTypes = array("image/jpeg", "image/png");
        $allowedExtensions = array("jpeg", "png");

        $fileMimeType = mime_content_type($mapFileObject["tmp_name"]);
        $fileExtension = strtolower(pathinfo($mapFileObject["name"], PATHINFO_EXTENSION));

        if (in_array($fileMimeType, $allowedMimeTypes) === TRUE) {
            return (in_array($fileExtension, $allowedExtensions) === TRUE);
        }

        return FALSE;
    }

    public static function ValidateCheckpointCount($checkpointCount): bool {
        if (validate_int($checkpointCount) === TRUE) {
            return ($checkpointCount > 0 && $checkpointCount < CHALLENGE_CHECKPOINT_MAX);
        }

        return FALSE;
    }
}
