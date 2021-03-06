<?php declare(strict_types=1);
/**
* mvc/controllers/LogoutController.php
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
* The Logout Controller.
* -----------------------------------------------------------------------
*/


class LogoutController extends Controller {
    public function get() {
        session_start();

        $_SESSION["authenticated"] = FALSE;
        session_end();

        $this->redirect("/login");
    }

    public function post() {
        $this->methodNotAllowed();
    }

    public function delete() {
        $this->methodNotAllowed();
    }
}