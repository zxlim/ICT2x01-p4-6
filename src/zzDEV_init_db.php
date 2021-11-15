<?php define("FRONTEND", TRUE);
/**
* zzDEV_init_db.php
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
* Initialises the SQLite database file with the required tables and
* default content.
*
* This resource is for internal development use only.
* REMOVE BEFORE OFFICIAL RELEASE!
* -----------------------------------------------------------------------
*/

require_once("base.php");
require_once(__ROOT__ . "backend/functions/db.php");

define("WEBPAGE_TITLE", "Initialise Database");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <title>
        <?php
        if (defined("WEBPAGE_TITLE") === TRUE) {
            safe_echo(sprintf("%s | %s", APP_TITLE, WEBPAGE_TITLE));
        } else {
            safe_echo(APP_TITLE);
        }
        ?>
    </title>
</head>
<body>
    <h1><?php safe_echo(WEBPAGE_TITLE); ?></h1>
    <hr />
    <?php db_initial_setup(); ?>
    <p>
        Database initialised successfully.
    </p>
</body>