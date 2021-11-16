<?php declare(strict_types=1);
/**
* mvc/controllers/DashboardController.php
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
* The Dashboard Controller.
* -----------------------------------------------------------------------
*/

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    exit();
}

define("WEBPAGE_TITLE", "Dashboard");


class DashboardController extends Controller {
    public function get() {
        session_start();

        if (session_isauth() === FALSE) {
            $this->redirect("/login");
        }

        if ($_SESSION["Facilitator"] === TRUE) {
            $this->renderTemplate("Facilitator/dashboard.php");
        } else {
            $this->renderTemplate("Student/dashboard.php");
        }
    }

    public function post() {
        $this->methodNotAllowed();
    }

}