<?php declare(strict_types=1);
/**
* mvc/controllers/SampleController.php
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
* A sample Controller class to be used as a template. Created by ZX.
* Change this portion to something that describes this file.
* -----------------------------------------------------------------------
*/

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    exit();
}


// Change the name of the Controller Class.
class SampleController extends Controller {
    public function get() {
        // Change the below line.
        $this->renderTemplate("somePage.php", "Page Title");
    }

    public function post() {
        // If POST is allowed, remove the next line.
        $this->methodNotAllowed();
    }

}