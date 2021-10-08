<?php declare(strict_types=1);
/**
* backend/functions/db.php
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
    die();
}

require_once(__ROOT__ . "backend/constants.php");

function db_get_conn(): SQLite3 {
    /**
    * A function to create a connection to a SQLite database.
    *
    * @return   SQLite3  $db   The SQLite database object.
    */
    $db = new SQLite3(SQLITE_DB_FILE);

    if (!$db || $db->lastErrorCode() !== 0) {
        die("Failed to connect to database: " . $db->lastErrorMsg());
    }

    return $db;
}

function db_initial_setup() {
    $db = db_get_conn();

    $res = $db->exec("CREATE TABLE config (id INTEGER, type INTEGER, key STRING, value STRING)");

    if ($res === false) {
        die("Failed to initialise database: (" . $db->lastErrorCode() . ") " . $db->lastErrorMsg());
    }
}
