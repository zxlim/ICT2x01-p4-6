<?php declare(strict_types=1);
/**
* mvc/models/Facilitator.php
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
* Facilitator Model.
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


/**
* Facilitator Entity Class.
*/
class Facilitator {
    private $password;

    function __construct() {
        $this->password = db_get_config_value("facilitator_password");
    }

    /**
    * Getters and Setters.
    */
    function getPassword(): string {
        return $this->password;
    }

    function setPassword(string $password) {
        $this->password = pw_hash($password);
    }

    /**
    * Database CRUD operations.
    */
    function dbUpdate() {
        $db = db_get_conn();
        $stmt = $db->prepare("UPDATE config SET value = :pw WHERE key = 'facilitator_password'");
        $stmt->bindValue(":pw", $this->password, SQLITE3_TEXT);

        $res = $stmt->execute();
        if ($res === false) {
            $last_error_code = $db->lastErrorCode();
            $last_error_msg = $db->lastErrorMsg();
            $db->close();
            exit("Failed to update Facilitator data in database: (" . $last_error_code . ") " . $last_error_msg);
        }

        $db->close();
    }
}


/**
* Control Classes.
*/
class FacilitatorAccess {
    private $facilitator;

    function __construct(Facilitator $facilitator) {
        $this->facilitator = $facilitator;
    }

    public function login(string $password): bool {
        return pw_verify($password, $this->facilitator->getPassword());
    }
}
