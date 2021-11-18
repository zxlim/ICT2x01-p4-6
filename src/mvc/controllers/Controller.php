<?php declare(strict_types=1);
/**
* mvc/controllers/Controller.php
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
* The base Controller class. To be extended by actual controllers.
* -----------------------------------------------------------------------
*/

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    exit();
}


abstract class Controller {
    abstract public function get();
    abstract public function post();

    public function renderTemplate(string $view, string $pageTitle = "", array $state = array()) {
        if (validate_notempty($pageTitle) === TRUE) {
            define("PAGE_TITLE", $pageTitle);
        }

        if (validate_notempty($state, "array") === TRUE) {
            define("PAGE_STATE", $state);
        }

        unset($pageTitle);
        unset($state);

        require_once(__MVC_VIEWS_DIR__ . $view);
        exit();
    }

    public function redirect(string $route) {
        header("HTTP/1.1 302 Found");
        header("Location: " . $route);
        exit();
    }

    public function unauthorized() {
        http_response_code(401);
        $this->renderTemplate("Error/401.php", "Unauthorised");
    }

    public function notFound() {
        http_response_code(404);
        $this->renderTemplate("Error/404.php", "Not Found");
    }

    public function methodNotAllowed() {
        http_response_code(405);
        $this->renderTemplate("Error/405.php", "Invalid Method");
    }
}
