<?php declare(strict_types=1);
/**
* functions/utils.php
*
* @license      MIT License
* @copyright    Copyright (c) 2019 Zhao Xiang Lim.
*
* @author       ZHAO XIANG LIM  (developer@zxlim.xyz)
*
* -----------------------------------------------------------------------
* Session functions for the web application.
* -----------------------------------------------------------------------
*/

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    exit();
}


function session_isstarted(): bool {
    /**
    * A function to check if PHP session has started.
    *
    * @return   bool    $result     TRUE if session is started else FALSE.
    */
    if (session_status() === PHP_SESSION_NONE) {
        // Session not started.
        return FALSE;
    } else {
        return TRUE;
    }
}

function session_isauth(): bool {
    /**
    * A function to check if a client session is "authenticated".
    *
    * @return   bool    $result     TRUE if client is authenticated else FALSE.
    */
    if (session_isstarted() === FALSE) {
        // Session not yet started.
        return FALSE;
    } else if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] === TRUE) {
        return TRUE;
    } else {
        // Not authenticated.
        return FALSE;
    }
}

function session_end(): bool {
    /**
    * A function to end a session instance and invalidate the session cookie.
    * Usually used when a client requests a logout.
    *
    * @return   bool    $result     TRUE if operation succeeded else FALSE.
    */
    if (session_isstarted() === TRUE) {
        if (session_unset() && session_destroy() && setcookie(session_name(), "", (time() - 3600))) {
            return TRUE;
        } else {
            // Failed to end session.
            return FALSE;
        }
    } else {
        // Nothing to end. Session not started.
        return FALSE;
    }
}

function session_restart(): void {
    /**
    * A function to start a fresh session with previous session data,
    * including session cookie and session ID invalidated.
    */
    session_unset();
    session_regenerate_id(TRUE);
    $_SESSION["authenticated"] = FALSE;
}
