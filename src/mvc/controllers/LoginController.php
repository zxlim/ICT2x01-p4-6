<?php declare(strict_types=1);
/**
* mvc/controllers/LoginController.php
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
* The Login Controller.
* -----------------------------------------------------------------------
*/

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    exit();
}

require_once(__MVC_MODELS_DIR__ . "Facilitator.php");
require_once(__MVC_MODELS_DIR__ . "Student.php");


class LoginController extends Controller {
    public function get() {
        session_start();

        if (session_isauth() === TRUE) {
            // Client is already logged in.
            $this->redirect("/");
        }

        $state = array(
            "errorLogin" => FALSE,
            "loginAsFacilitator" => FALSE
        );

        $this->renderTemplate("login.php", "Login", $state);
    }

    public function post() {
        session_start();

        if (session_isauth() === TRUE) {
            // Client is already logged in.
            $this->unauthorized();
        }

        $state = array(
            "errorLogin" => TRUE,
            "errorMessage" => "Invalid credentials.",
            "loginAsFacilitator" => FALSE
        );

        if (validate_notempty($_POST["user"]) === FALSE) {
            $state["errorMessage"] = "Please specify the user to login as.";
        } else if (validate_notempty($_POST["password"]) === FALSE) {
            $state["errorMessage"] = "Please enter your password.";
        } else {
            switch ($_POST["user"]) {
                case "facilitator":
                    // Facilitator Authentication Flow.
                    $facilitatorAccess = new FacilitatorAccess(new Facilitator());
                    $state["loginAsFacilitator"] = TRUE;
                    $state["errorMessage"] = "Invalid Password.";

                    if ($facilitatorAccess->login($_POST["password"]) === TRUE) {
                        $state["errorLogin"] = FALSE;
                        $_SESSION["authenticated"] = TRUE;
                        $_SESSION["Facilitator"] = TRUE;
                    }
                    break;

                case "student":
                    // Student Authentication Flow.
                    $studentAccess = new StudentAccess(new Student());
                    $state["errorMessage"] = "Invalid One-Time Password.";

                    if ($studentAccess->login($_POST["password"]) === TRUE) {
                        $state["errorLogin"] = FALSE;
                        $_SESSION["authenticated"] = TRUE;
                        $_SESSION["Facilitator"] = FALSE;
                    }
                    break;

                default:
                    $state["errorMessage"] = "User specified is not recognised.";
                    break;
            }
        }

        if ($state["errorLogin"] === FALSE) {
            // Login successful. Redirect to Dashboard.
            $this->redirect("/");
        }

        $this->renderTemplate("login.php", "Login", $state);
    }
}