<?php declare(strict_types=1);
/**
* mvc/models/FacilitatorAccess.php
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
* FacilitatorAccess Control Class.
* -----------------------------------------------------------------------
*/

require_once(__MVC_MODELS_DIR__ . "Facilitator.php");


class FacilitatorAccess {
    public static function login(Facilitator $facilitator, string $password): bool {
        /**
        * Checks if a given plaintext password is valid to authenticate as a Facilitator.
        *
        * @param    Facilitator $facilitator        The Facilitator entity object.
        * @param    string      $password           Plaintext password submitted.
        *
        * @return   bool        $res                Whether the password is correct.
        */
        return pw_verify($password, $facilitator->getPassword());
    }
}
