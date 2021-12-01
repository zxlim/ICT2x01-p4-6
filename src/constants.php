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

# The absolute path to the base directory of this application on the web server.
define("__ROOT__", __DIR__);


# Constants used for MVC.
define("__MVC_MODELS_DIR__", __ROOT__ . "/mvc/models/");
define("__MVC_VIEWS_DIR__", __ROOT__ . "/mvc/views/");
define("__MVC_VIEWS_TEMPLATES_DIR__", __MVC_VIEWS_DIR__ . "/templates/");
define("__MVC_CONTROLLERS_DIR__", __ROOT__ . "/mvc/controllers/");
define("__FUNCTIONS_DIR__", __ROOT__ . "/functions/");


# Application constants.
define("APP_TITLE", "BOTster");
define("CHALLENGE_COMMANDBLOCK_MAX", 128);
define("SQLITE_DB_FILE", __MVC_MODELS_DIR__ . "botster.db");
define("PUBLIC_DIR", __ROOT__ . "/public");
define("UPLOAD_DIR", "/static/uploads");
define("SERVER_UPLOAD_DIR", PUBLIC_DIR . UPLOAD_DIR);
