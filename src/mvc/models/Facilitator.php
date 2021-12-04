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
* Facilitator Entity Class.
* -----------------------------------------------------------------------
*/


class Facilitator {
    private $password;

    private function __construct(string $password) {
        /**
        * Constructor for the Facilitator entity. Called by Load() only.
        *
        * @param    string      $password           Facilitator Password.
        */
        $this->password = $password;
    }

    public static function Load(): Facilitator {
        /**
        * Returns a new instance of Facilitator.
        * This function mimics the factory design pattern.
        *
        * @return   Facilitator $facilitator        The Facilitator entity object.
        */
        $password = db_get_config_value("facilitator_password");

        return new Facilitator($password);
    }

    /**
    * Accessors.
    */
    public function getPassword(): string {
        return $this->password;
    }
}
