<?php
/**
* backend/constants.php
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
* Global constant declaration for the web application.
* -----------------------------------------------------------------------
*/

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    die();
}

define("APP_DOMAIN", trim($_SERVER["SERVER_NAME"]));
define("APP_ROOT", trim(dirname($_SERVER["REQUEST_URI"])));

# Application Name
define("APP_TITLE", "BOTster");

# Timezone to use for datetime.
define("APP_TZ", "Asia/Singapore");

# Relative location of SQLite database file on disk.
define("SQLITE_DB_FILE", __ROOT__ . "backend/private/botster.db");
