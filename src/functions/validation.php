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


function validate_notempty($input, string $type = "string"): bool {
    /**
    * A function to check whether a variable is empty or not yet set.
    * Used for input validation.
    *
    * @param    mixed   $input  The input to check.
    * @param    string  $type   The input type (String or Array).
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
    } else if (is_numeric($input) !== TRUE) {
        return FALSE;
    } else {
        return TRUE;
    }
}
