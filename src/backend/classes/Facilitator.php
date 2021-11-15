<?php declare(strict_types=1);
/**
* backend/classes/Facilitator.php
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
* Base PHP file to be included by all frontend resources.
* -----------------------------------------------------------------------
*/

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    die();
}

require_once(__ROOT__ . "backend/functions/db.php");
require_once(__ROOT__ . "backend/functions/security.php");


class Facilitator {
    private $password;

    function __construct() {
        $this->password = db_get_config_value("facilitator_password");
    }

    function getPassword(): string {
        return $this->password;
    }

    function setPassword(string $password) {
        $this->password = pw_hash($password);
    }

    function saveFacilitator() {
        $db = db_get_conn();
        $stmt = $db->prepare("UPDATE config SET facilitator_password = :pw");
        $stmt->bindValue(":pw", $this->password, SQLITE3_TEXT);

        $res = $stmt->execute();
        if ($res === false) {
            $last_error_code = $db->lastErrorCode();
            $last_error_msg = $db->lastErrorMsg();
            $db->close();
            die("Failed to update Facilitator data in database: (" . $last_error_code . ") " . $last_error_msg);
        }

        $db->close();
    }

    function login(string $password): bool {
        return pw_verify($password, $this->getPassword());
    }
}
