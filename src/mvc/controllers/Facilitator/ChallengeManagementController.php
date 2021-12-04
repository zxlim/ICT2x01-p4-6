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

require_once(__MVC_MODELS_DIR__ . "ChallengeManagement.php");


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

        $name = $_POST["name"] ?? NULL;
        $maxBlock = $_POST["maxCommandBlocks"] ?? NULL;
        $mapTmpName = $_FILES["mapImg"]["name"] ?? NULL;
        $mapTmpPath = $_FILES["mapImg"]["tmp_name"] ?? "/tmp/nonexistent/path/invalidupload";

        if (validate_notempty($name) !== TRUE) {
            $state["msg"] = "Challenge name is required.";
        } else if (validate_int($maxBlock) !== TRUE) {
            $state["msg"] = "Please enter a number for maximum Challenge Blocks.";
        } else if (file_exists($mapTmpPath) !== TRUE) {
            $state["msg"] = "Challenge map is required.";
        } else if (ChallengeManagement::ValidateName($name) !== TRUE) {
            $state["msg"] = "Please choose another challenge name.";
        } else if (ChallengeManagement::ValidateMaxCommandBlocks($maxBlock) !== TRUE) {
            $state["msg"] = "Invalid maximum Command Block value.";
        } else if (ChallengeManagement::ValidateMap($mapTmpName, $mapTmpPath) !== TRUE) {
            $state["msg"] = "Invalid file type. Only JPG/JPEG and PNG images are supported.";
        } else {
            $mapFileName = sprintf("%s.%s", generate_token(8), strtolower(pathinfo($mapTmpName, PATHINFO_EXTENSION)));
            $mapFilePath = sprintf("%s%s", UPLOAD_DIR, $mapFileName);
            $saveLocation = sprintf("%s%s", PUBLIC_DIR, $mapFilePath);

            if (move_uploaded_file($mapTmpPath, $saveLocation) !== TRUE) {
                $state["httpStatusCode"] = 500;
                $state["msg"] = "Sorry, an error has occured when processing the challenge map. ";
            } else {
                ChallengeManagement::CreateChallenge($name, $mapFilePath, (int)($maxBlock));
                $state["httpStatusCode"] = 200;
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
            $chalID = (int)($_GET["id"]);

            try {
                ChallengeManagement::DeleteChallenge(Challenge::Load($chalID));
                $state["httpStatusCode"] = 200;
            } catch (ChallengeException $e) {
                $state["msg"] = "Challenge not found.";
            }
        }

        $this->returnJSON($state);
    }
}