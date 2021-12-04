<?php declare(strict_types=1);
/**
* mvc/models/ChallengeManagement.php
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
* ChallengeManagement Control Class.
* -----------------------------------------------------------------------
*/

require_once(__MVC_MODELS_DIR__ . "Challenge.php"); // @codeCoverageIgnore


class ChallengeManagement {
    public static function CreateChallenge(string $name, string $mapFilePath, int $maxCommandBlocks): int {
        /**
        * Creates a new Challenge Entity. Parameters are assumed to be validated before calling
        * this function.
        *
        * @param    string      $name               Name of Challenge. Must be unique.
        * @param    string      $mapFilePath        Absolute file path to map image file on disk.
        * @param    int         $maxCommandBlocks   Maximum Command Blocks allowed. Set to 0 for Infinity.
        *
        * @return   int         $id                 The ID of the newly created Challenge.
        */
        $db = db_get_conn();
        $stmt = $db->prepare("INSERT INTO challenge (name, mapFilePath, maxCommandBlocks) VALUES (:name, :mapFilePath, :maxCommandBlocks)");
        $stmt->bindValue(":name", $name, SQLITE3_TEXT);
        $stmt->bindValue(":mapFilePath", $mapFilePath, SQLITE3_TEXT);
        $stmt->bindValue(":maxCommandBlocks", $maxCommandBlocks, SQLITE3_INTEGER);
        $stmt->execute();

        $id = $db->lastInsertRowID();
        $db->close();

        return $id;
    }

    public static function DeleteChallenge(Challenge $challenge) {
        /**
        * Deletes a Challenge entity from the database as well as its associated map image
        * file from the file system.
        *
        * @param    Challenge  $challenge   The Challenge entity object.
        */
        // Delete the Challenge map from the file system.
        unlink(sprintf("%s%s", PUBLIC_DIR, $challenge->getMapFilePath()));
        
        // Delete Challenge from database.
        $db = db_get_conn();
        $stmt = $db->prepare("DELETE FROM challenge WHERE id = :id");
        $stmt->bindValue(":id", $challenge->getID(), SQLITE3_INTEGER);
        $stmt->execute();
        $db->close();
    }

    public static function GetAllChallenges(): array {
        /**
        * Retrieve all Challenges from the database.
        *
        * @return   array      $challenges  An array of all Challenge entities.
        */
        $db = db_get_conn();
        $stmt = $db->prepare("SELECT id FROM challenge");
        $res = $stmt->execute();

        $challenges = array();

        while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
            array_push(
                $challenges,
                Challenge::Load($row["id"])
            );
        }

        $db->close();

        return $challenges;
    }

    public static function ValidateName(string $name): bool {
        /**
        * Checks whether a given name is valid for use in a new Challenge.
        *
        * @param    string     $name        The new Challenge name to validate.
        *
        * @return   bool       $res         The result of the validation.
        */
        if (validate_notempty($name) === TRUE) {
            $db = db_get_conn();
            $stmt = $db->prepare("SELECT id FROM challenge WHERE name = :name");
            $stmt->bindValue(":name", $name, SQLITE3_TEXT);
            $res = $stmt->execute();

            // If $res->fetchArray() is FALSE, means no Challenge with specified name was found.
            $validationResult = ($res->fetchArray(SQLITE3_ASSOC) === FALSE);
            $db->close();

            return $validationResult;
        }

        return FALSE;
    }

    public static function ValidateMap(string $mapFileName, string $mapFilePath): bool {
        /**
        * Checks whether a given map file is valid for use in a new Challenge.
        *
        * @param    string     $mapFileName The name of the Map file to validate.
        * @param    string     $mapFilePath The path to the Map file to validate.
        *
        * @return   bool       $res         The result of the validation.
        */
        $allowedMimeTypes = array("image/jpeg", "image/png");
        $allowedExtensions = array("jpeg", "png");

        $fileMimeType = mime_content_type($mapFilePath);
        $fileExtension = strtolower(pathinfo($mapFileName, PATHINFO_EXTENSION));

        if (in_array($fileMimeType, $allowedMimeTypes) === TRUE) {
            return (in_array($fileExtension, $allowedExtensions) === TRUE);
        }

        return FALSE;
    }

    public static function ValidateMaxCommandBlocks($maxCommandBlocks): bool {
        /**
        * Checks whether a given maximum Command Block vlaue is valid for use in a new Challenge.
        *
        * @param    int        $maxCommandBlocks    The value to validate.
        *
        * @return   bool       $res                 The result of the validation.
        */
        if (validate_int($maxCommandBlocks) === TRUE) {
            $val = (int)($maxCommandBlocks);
            return ($val > -1 && $val < CHALLENGE_COMMANDBLOCK_MAX);
        }

        return FALSE;
    }
}
