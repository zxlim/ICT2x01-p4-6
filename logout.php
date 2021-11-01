<?php define("FRONTEND", TRUE);
/**
* login.php
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
* Logout page.
* -----------------------------------------------------------------------
*/

define("WEBPAGE_TITLE", "Logout");
define("REQUIRE_AUTH", TRUE);

require_once("base.php");
require_once(__ROOT__ . "backend/session_management.php");

$_SESSION["is_authenticated"] = FALSE;
$session_is_authenticated = FALSE;
$session_is_facilitator = FALSE;

session_end();

header("HTTP/1.1 302 Found");
header("Location: login.php");
