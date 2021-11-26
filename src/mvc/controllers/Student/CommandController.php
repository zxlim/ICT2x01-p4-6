<?php declare(strict_types=1);
/**
* mvc/controllers/Student/CommandController.php
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
* The Student Command Controller
* -----------------------------------------------------------------------
*/

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    exit();
}

require_once(__MVC_MODELS_DIR__ . "Challenge.php");


class CommandController extends Controller {
    public function get() {
        session_start();

        if (session_isauth() === FALSE || $_SESSION["Facilitator"] === TRUE) {
            $this->notFound();
        }

        if (validate_int($_GET["id"]) !== TRUE) {
            // Challenge ID not provided.
            // Temporary redirect to Dashboard as Student Challenge listing page not ready.
            $this->redirect("/");
        }

        $state = array(
            "challenge" => NULL
        );

        try {
            $state["challenge"] = Challenge::Load((int)($_GET["id"]));
        } catch (ChallengeException $e) {
            // Challenge with specified ID does not exist.
            // Temporary redirect to Dashboard as Student Challenge listing page not ready.
            $this->redirect("/");
        }

        $this->renderTemplate("Student/play.php", "Play", $state);
    }

    public function post() {
        $this->methodNotAllowed();
    }

    public function delete() {
        $this->methodNotAllowed();
    }
}