<?php declare(strict_types=1);
/**
* mvc/controller/Facilitator/OTPController.php
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
* The Facilitator OTP Controller.
* -----------------------------------------------------------------------
*/

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    exit();
}

require_once(__ROOT__ . "mvc/model/Student.php");

define("WEBPAGE_TITLE", "Generate OTP");


class OTPController extends Controller {
    public function get($request) {
        session_start();

        if (session_isauth() === FALSE || $_SESSION["Facilitator"] !== TRUE) {
            $this->notFound();
        }

        $studentMgnt = new StudentManagement(new Student());
        $otp = $studentMgnt->generateOTP();
        $res = json_encode(array("otp" => $otp));

        echo("[" . $res . "]");
    }

    public function post($request) {
        $this->methodNotAllowed();
    }

}