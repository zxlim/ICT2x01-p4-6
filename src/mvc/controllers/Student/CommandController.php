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
        } catch (BOTsterChallengeException $e) {
            // Challenge with specified ID does not exist.
            // Temporary redirect to Dashboard as Student Challenge listing page not ready.
            $this->redirect("/");
        }

        $this->renderTemplate("Student/play.php", "Play", $state);
    }

    public function post() {
        session_start();

        if (session_isauth() === FALSE || $_SESSION["Facilitator"] === TRUE) {
            $this->notFound();
        }

        $state = array(
            "httpStatusCode" => 200,
            "msg" => "OK",
            "result" => FALSE
        );

        $validCommands = array("forward", "left", "right", "obstacleDetected", "endCheck");

        if (validate_notempty($_POST["cmd"]) === FALSE) {
            $state["httpStatusCode"] = 400;
            $state["msg"] = "No command specified!";
        } else if (in_array($_POST["cmd"], $validCommands, TRUE) !== TRUE) {
            $state["httpStatusCode"] = 400;
            $state["msg"] = "Invalid command received.";
        } else {
            // Temporary hardcode, still waiting for car communication to work.
            switch ($_POST["cmd"]) {
                case "forward":
                    $state["result"] = TRUE;
                    break;
                case "left":
                    $state["result"] = TRUE;
                    break;
                case "right":
                    $state["result"] = TRUE;
                    break;
                case "obstacleDetected":
                    $state["result"] = TRUE;
                    break;
                case "endCheck":
                    $state["result"] = TRUE;
                    break;
            }
        }

        $this->returnJSON($state);
    }

    public function delete() {
        $this->methodNotAllowed();
    }
}