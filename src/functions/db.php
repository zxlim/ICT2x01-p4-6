<?php declare(strict_types=1);
/**
* functions/db.php
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
* Database connectivity and interaction functions.
* -----------------------------------------------------------------------
*/

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    exit();
}

require_once(__FUNCTIONS_DIR__ . "security.php");


class DBException extends Exception {
    public function getError(): string {
        $msg = "DBException on line " . $this->getLine() . ": " . $this->getMessage();
        return $msg;
    }
}


function db_get_conn(): SQLite3 {
    /**
    * A function to create a connection to a SQLite database.
    *
    * @return   SQLite3  $db   The SQLite database object.
    */
    $db = new SQLite3(SQLITE_DB_FILE);

    if (!$db || $db->lastErrorCode() !== 0) {
        $errorMessage = sprintf("Failed to connect to Database [%d] %s", $db->lastErrorCode(), $db->lastErrorMsg());
        exit($errorMessage);
    }

    return $db;
}

function db_get_config_value(string $key) {
    /**
    * A function to retrieve config values from the database using a key.
    */

    $db = db_get_conn();

    $stmt = $db->prepare("SELECT type, value FROM config WHERE key = :key");
    $stmt->bindValue(":key", $key, SQLITE3_TEXT);
    $res = $stmt->execute();

    if ($res === false) {
        $errorMessage = sprintf("Failed to retrieve Config [%d] %s", $db->lastErrorCode(), $db->lastErrorMsg());
        $db->close();
        throw new DBException($errorMessage);
    }

    $row = $res->fetchArray(SQLITE3_ASSOC);
    $value = NULL;

    switch ($row["type"]) {
        case 1:
            $value = (int)($row["value"]);
            break;
        case 2:
            $value = (float)($row["value"]);
            break;
        case 3:
            $value = (bool)($row["value"]);
            break;
        default:
            $value = (string)($row["value"]);
    }

    $db->close();

    return $value;
}
