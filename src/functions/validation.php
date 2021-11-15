<?php declare(strict_types=1);
/**
* functions/validation.php
*
* @license      MIT License
* @copyright    Copyright (c) 2019 Zhao Xiang Lim.
*
* @author       ZHAO XIANG LIM  (developer@zxlim.xyz)
*
* -----------------------------------------------------------------------
* Validation functions for the web application.
* -----------------------------------------------------------------------
*/

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    exit();
}


function validate_notempty($input, string $type = "string"): bool {
    /**
    * A function to check whether a variable is empty or not yet set.
    * Used for input validation.
    *
    * @param    mixed   $input  The input to check.
    * @param    string  $type   The input type (String or Array.
    *
    * @return   bool    $result TRUE if variable is not empty else FALSE.
    */
    if (isset($input) === FALSE || $input === NULL) {
        return FALSE;
    } else if ($type === "string" && (strlen(trim($input)) === 0 || empty($input))) {
        return FALSE;
    } else if ($type === "array" && count($input) === 0) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function validate_numeric($input): bool {
    /**
    * A function to check whether a variable is a valid number.
    * Used for input validation.
    *
    * @param    mixed   $input  The variable to check.
    *
    * @return   bool    $result TRUE if variable is a number else FALSE.
    */
    if (isset($input) === FALSE || $input === NULL) {
        return FALSE;
    } else {
        return is_numeric($input);
    }
}

function validate_int($input): bool {
    /**
    * A function to check whether a variable is a valid integer.
    * Used for input validation.
    *
    * @param    mixed   $input  The variable to check.
    *
    * @return   bool    $result TRUE if variable is an integer else FALSE.
    */
    if (isset($input) === FALSE || $input === NULL) {
        return FALSE;
    } else if (filter_var($input, FILTER_VALIDATE_INT) !== 0 && filter_var($input, FILTER_VALIDATE_INT) === FALSE) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function validate_float($input): bool {
    /**
    * A function to check whether a variable is a valid float.
    * Used for input validation.
    *
    * @param    mixed   $input  The variable to check.
    *
    * @return   bool    $result TRUE if variable is a float else FALSE.
    */
    if (isset($input) === FALSE || $input === NULL) {
        return FALSE;
    } else {
        return is_float($input);
    }
}

function validate_email($input): bool {
    /**
    * A function to check whether a variable is a valid email address.
    * Used for input validation.
    *
    * @param    mixed   $input  The variable to check.
    *
    * @return   bool    $result TRUE if variable is an email address else FALSE.
    */
    if (isset($input) === FALSE || $input === NULL) {
        return FALSE;
    } else if (filter_var($input, FILTER_VALIDATE_EMAIL) === FALSE) {
        return FALSE;
    } else {
        return TRUE;
    }
}
