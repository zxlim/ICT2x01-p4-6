<?php declare(strict_types=1);
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
* If sessions are used on a page, please include this file first at
* the top.
* -----------------------------------------------------------------------
*/

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    die();
}


session_start();

$session_is_authenticated = FALSE;
$session_is_facilitator = FALSE;

// Check if client session is authenticated (Logged in).
if (session_isauth() === TRUE) {
    // Client is authenticated.
    $session_is_authenticated = TRUE;
    $session_is_facilitator = $_SESSION["is_facilitator"];
} else {
    // Client is not authenticated.
    if (defined("REQUIRE_SESSION") === FALSE || REQUIRE_SESSION === FALSE) {
        // Page does not require session.
        // Unset and destroy session instance.
        //session_end();
    }
    
    if (defined("REQUIRE_AUTH") === TRUE && REQUIRE_AUTH === TRUE) {
        // Page requires authentication.
        header("HTTP/1.1 401 Unauthorised");
        header("Location: login.php");
        die("Please login to access the requested resource.");
    }
}