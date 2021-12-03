<?php declare(strict_types=1);
/**
* mvc/controllers/ChallengeController.php
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
* The Challenge Controller.
* -----------------------------------------------------------------------
*/

require_once(__MVC_MODELS_DIR__ . "Challenge.php");


class ChallengeController extends Controller {
    public function get() {
        session_start();

        if (session_isauth() === FALSE) {
            $this->redirect("/login");
        }

        $state = array(
            "chals" => ChallengeManagement::GetAllChallenges()
        );

        if ($_SESSION["Facilitator"] === TRUE) {
            $this->renderTemplate("Facilitator/challenges.php", "All Challenges", $state);
        } else {
            $this->renderTemplate("Student/challenges.php", "All Challenges", $state);
        }
    }

    public function post() {
        $this->methodNotAllowed();
    }

    public function delete() {
        $this->methodNotAllowed();
    }
}