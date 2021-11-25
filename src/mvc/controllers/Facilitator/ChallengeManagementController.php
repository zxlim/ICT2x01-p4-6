<?php declare(strict_types=1);
/**
* mvc/controllers/Facilitator/ChallengeManagementController.php
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
* The Facilitator Challenge Management Controller.
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


class ChallengeManagementController extends Controller {
    public function get() {
        session_start();

        if (session_isauth() === FALSE || $_SESSION["Facilitator"] !== TRUE) {
            $this->notFound();
        }

        $state = array(
            "countMin" => 0,
            "countMax" => CHALLENGE_COMMANDBLOCK_MAX - 1
        );

        $this->renderTemplate("Facilitator/challenges_add.php", "Add Challenge", $state);
    }

    public function post() {
        session_start();

        if (session_isauth() === FALSE || $_SESSION["Facilitator"] !== TRUE) {
            $this->notFound();
        }

        $state = array(
            "httpStatusCode" => 400,
            "msg" => "OK"
        );

        if (validate_notempty($_POST["name"]) !== TRUE) {
            $state["msg"] = "Challenge name is required.";
        } else if (file_exists($_FILES["mapImg"]["tmp_name"]) !== TRUE) {
            $state["msg"] = "Challenge map is required.";
        } else if (ChallengeManagement::ValidateName($_POST["name"]) !== TRUE) {
            $state["msg"] = "Please choose another challenge name.";
        } else if (ChallengeManagement::ValidateMaxCommandBlocks($_POST["maxCommandBlocks"]) !== TRUE) {
            $state["msg"] = "Invalid maximum Command Block value.";
        } else if (ChallengeManagement::ValidateMapFilePath($_FILES["mapImg"]) !== TRUE) {
            $state["msg"] = "Invalid file type. Only JPG/JPEG and PNG images are supported.";
        } else {
            $mapFileExt = strtolower(pathinfo($_FILES["mapImg"]["name"], PATHINFO_EXTENSION));
            $mapFilePath = sprintf("%s/%s.%s", UPLOAD_DIR, generate_token(8), $mapFileExt);
            $mapFileDest = sprintf("%s%s", __ROOT__, $mapFilePath);

            if (move_uploaded_file($_FILES["mapImg"]["tmp_name"], $mapFileDest) !== TRUE) {
                $state["httpStatusCode"] = 500;
                $state["msg"] = "Sorry, an error has occured when processing the challenge map.";
            } else {
                $state["httpStatusCode"] = 200;
                $challenge = new Challenge(-1, $_POST["name"], $mapFilePath, (int)($_POST["maxCommandBlocks"]));
                $chalManagement = new ChallengeManagement($challenge);
                $chalManagement->createChallenge();
            }
        }

        $this->returnJSON($state);
    }

    public function delete() {
        session_start();

        if (session_isauth() === FALSE || $_SESSION["Facilitator"] !== TRUE) {
            $this->notFound();
        }

        $state = array(
            "httpStatusCode" => 400,
            "msg" => "OK"
        );

        if (validate_notempty($_GET["id"]) !== TRUE) {
            $state["msg"] = "Please specify the Challenge to delete.";
        } else if (validate_int($_GET["id"]) !== TRUE) {
            $state["msg"] = "Invalid Challenge ID specified.";
        } else {
            try {
                $id = (int)($_GET["id"]);
                $chalManagement = new ChallengeManagement(Challenge::Load($id));
                $chalManagement->deleteChallenge();
                $state["httpStatusCode"] = 200;
            } catch (ChallengeException $e) {
                $state["msg"] = "Challenge not found.";
            }
        }

        $this->returnJSON($state);
    }
}