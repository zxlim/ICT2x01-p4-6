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
* Utility functions for the web application.
* -----------------------------------------------------------------------
*/

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    exit();
}


function html_safe(string $string_raw, bool $trim = TRUE): string {
    /**
    * A function to encode some predefined characters into HTML entities.
    *
    * @param    string  $string_raw The string to encode and echo.
    * @param    bool    $trim       Whether to trim the string.
    *
    * @return   string  $str        The encoded string.
    */
    if (strlen(trim($string_raw)) !== 0) {
        $string = htmlspecialchars($string_raw);
        
        if ($trim === TRUE) {
            return trim($string);
        } else {
            return $string;
        }
    }
    return "";
}


function safe_echo($string, bool $trim = TRUE): void {
    /**
    * A function to safely echo a string into an HTML template.
    * Makes use of `html_safe` function.
    *
    * @param    mixed   $string     The string to echo.
    * @param    bool    $trim       Whether to trim the string.
    */
    if ($string !== NULL) {
        $str = (string)($string);
        echo(html_safe($str, $trim));
    }
}
