<?php declare(strict_types=1);
/**
* mvc/controller/LoginController.php
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

require_once(__ROOT__ . "mvc/model/Facilitator.php");
require_once(__ROOT__ . "mvc/model/Student.php");

define("WEBPAGE_TITLE", "Login");


class LoginController extends Controller {
    public function get() {
        session_start();

        if (session_isauth() === TRUE) {
            $this->redirect("/");
        }

        $page_vars = array(
            "errorLogin" => FALSE,
            "loginAsFacilitator" => FALSE
        );

        $this->renderTemplate("login.php", $page_vars);
    }

    public function post() {
        session_start();

        if (session_isauth() === TRUE) {
            $this->unauthorized();
        }

        $page_vars = array(
            "errorLogin" => TRUE,
            "errorMessage" => "Invalid credentials.",
            "loginAsFacilitator" => FALSE
        );

        if (validate_notempty($_POST["user"]) === FALSE) {
            $page_vars["errorMessage"] = "Please specify the user to login as.";
        } else if (validate_notempty($_POST["password"]) === FALSE) {
            $page_vars["errorMessage"] = "Please enter your password.";
        } else {
            switch ($_POST["user"]) {
                case "facilitator":
                    $facilitatorAccess = new FacilitatorAccess(new Facilitator());
                    $page_vars["loginAsFacilitator"] = TRUE;
                    $page_vars["errorMessage"] = "Invalid Password.";

                    if ($facilitatorAccess->login($_POST["password"]) === TRUE) {
                        $page_vars["errorLogin"] = FALSE;
                        $_SESSION["authenticated"] = TRUE;
                        $_SESSION["Facilitator"] = TRUE;
                    }
                    break;

                case "student":
                    $studentAccess = new StudentAccess(new Student());
                    $page_vars["errorMessage"] = "Invalid One-Time Password.";

                    if ($studentAccess->login($_POST["password"]) === TRUE) {
                        $page_vars["errorLogin"] = FALSE;
                        $_SESSION["authenticated"] = TRUE;
                        $_SESSION["Facilitator"] = FALSE;
                    }
                    break;

                default:
                    $page_vars["errorMessage"] = "User specified is not recognised.";
                    break;
            }
        }

        if ($page_vars["errorLogin"] === FALSE) {
            // Login successful.
            $this->redirect("/");
        }

        $this->renderTemplate("login.php", $page_vars);
    }
}