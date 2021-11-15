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

require_once(__ROOT__ . "config.php");
require_once(__ROOT__ . "functions/security.php");

function db_get_conn(): SQLite3 {
    /**
    * A function to create a connection to a SQLite database.
    *
    * @return   SQLite3  $db   The SQLite database object.
    */
    $db = new SQLite3(SQLITE_DB_FILE);

    if (!$db || $db->lastErrorCode() !== 0) {
        exit("Failed to connect to database: " . $db->lastErrorMsg());
    }

    return $db;
}

function db_get_config_value(string $key) {
    /**
    * A function to retrieve config values from the database using a key.
    */

    $db = db_get_conn();

    $stmt = $db->prepare("SELECT type, value FROM config WHERE key=:key");
    $stmt->bindValue(":key", $key, SQLITE3_TEXT);
    $res = $stmt->execute();

    if ($res === false) {
        $last_error_code = $db->lastErrorCode();
        $last_error_msg = $db->lastErrorMsg();
        $db->close();
        exit("Failed to initialise database: (" . $last_error_code . ") " . $last_error_msg);
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

function db_initial_setup() {
    $db = db_get_conn();

    $res = $db->exec("CREATE TABLE config (id INTEGER PRIMARY KEY AUTOINCREMENT, type INTEGER, key TEXT, value TEXT)");
    if ($res === false) {
        $last_error_code = $db->lastErrorCode();
        $last_error_msg = $db->lastErrorMsg();
        $db->close();
        die("Failed to initialise database: (" . $last_error_code . ") " . $last_error_msg);
    }

    $rows = array(
        "INSERT INTO config (type, key, value) VALUES (0, 'facilitator_password', '" . pw_hash("P@ssw0rd") . "')",
        "INSERT INTO config (type, key, value) VALUES (3, 'student_issue_cmd', 'TRUE')",
        "INSERT INTO config (type, key, value) VALUES (3, 'student_tutorial', 'FALSE')",
        "INSERT INTO config (type, key, value) VALUES (0, 'student_otp_code', '')"
        // "INSERT INTO config (type, key, value) VALUES (0, 'student_otp_time', '')"
    );

    foreach($rows as $row) {
        $res = $db->exec($row);
        if ($res === false) {
            $last_error_code = $db->lastErrorCode();
            $last_error_msg = $db->lastErrorMsg();
            $db->close();
            die("Failed to initialise database: (" . $last_error_code . ") " . $last_error_msg);
        }
    }

    $db->close();
}
