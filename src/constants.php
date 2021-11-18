<?php
/**
* config.php
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
* Global constant and config keys declaration for the web application.
* -----------------------------------------------------------------------
*/

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    exit();
}

# The absolute path to the base directory of this application on the web server.
define("__ROOT__", $_SERVER["DOCUMENT_ROOT"]);


# Application constants.
// define("APP_DOMAIN", trim($_SERVER["SERVER_NAME"]));
// define("APP_ROOT", trim(dirname($_SERVER["REQUEST_URI"])));
define("APP_TITLE", "BOTster");
define("APP_TZ", "Asia/Singapore");


define("UPLOAD_DIR", "/static/uploads");
define("__FUNCTIONS_DIR__", __ROOT__ . "/functions/");


# Constants used for MVC.
define("__MVC_MODELS_DIR__", __ROOT__ . "/mvc/models/");
define("__MVC_VIEWS_DIR__", __ROOT__ . "/mvc/views/");
define("__MVC_VIEWS_TEMPLATES_DIR__", __MVC_VIEWS_DIR__ . "/templates/");
define("__MVC_CONTROLLERS_DIR__", __ROOT__ . "/mvc/controllers/");


# Relative location of SQLite database file on disk.
define("SQLITE_DB_FILE", __MVC_MODELS_DIR__ . "botster.db");


# BOTSter constants.
define("CHALLENGE_CHECKPOINT_MAX", 6);
