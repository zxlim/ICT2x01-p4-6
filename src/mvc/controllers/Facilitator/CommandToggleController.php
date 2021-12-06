<?php declare(strict_types=1);
/**
* mvc/controllers/Facilitator/CommandToggleController.php
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
* The Facilitator Issue Command Status Toggle Controller.
* -----------------------------------------------------------------------
*/

require_once(__MVC_MODELS_DIR__ . "StudentManagement.php");


class CommandToggleController extends Controller {
    public function get() {
        session_start();

        if (session_isauth() === FALSE || $_SESSION["Facilitator"] !== TRUE) {
            $this->notFound();
        }

        $student = Student::Load();
        $state = array("res" => $student->getIssueCommandStatus());

        $this->returnJSON($state);
    }

    public function post() {
        session_start();

        if (session_isauth() === FALSE || $_SESSION["Facilitator"] !== TRUE) {
            $this->notFound();
        }

        $res = StudentManagement::ToggleIssueCommandStatus(Student::Load());
        $state = array("res" => $res);

        $this->returnJSON($state);
    }

    public function delete() {
        $this->methodNotAllowed();
    }
}