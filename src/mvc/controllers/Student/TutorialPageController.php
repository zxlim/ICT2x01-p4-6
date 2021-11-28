<?php declare(strict_types=1);
/**
* mvc/controllers/Student/ChallengeController.php
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
* The Tutorial Page Controller.
* -----------------------------------------------------------------------
*/

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    exit();
}


class TutorialPageController extends Controller {
    public function get() {
        session_start();

        if ($_SESSION["Facilitator"] === FALSE && $_SESSION["authenticated"] === TRUE) {
            $this->renderTemplate("Student/tutorialpage.php", "Tutorial Page");
        }

        else {
            $this->notFound();
        }
    }

    public function post() {
        // If POST is allowed, remove the next line.
        $this->methodNotAllowed();
    }

    public function delete() {
        $this->methodNotAllowed();
    }
}