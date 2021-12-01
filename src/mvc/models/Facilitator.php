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
    public function getPassword(): string {
        return $this->password;
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
