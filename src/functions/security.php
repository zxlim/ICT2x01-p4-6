<?php declare(strict_types=1);
/**
* backend/functions/security.php
*
* @license      MIT License
* @copyright    Copyright (c) 2019 Zhao Xiang Lim.
*
* @author       ZHAO XIANG LIM  (developer@zxlim.xyz)
*
* -----------------------------------------------------------------------
* Security functions for the web application.
* -----------------------------------------------------------------------
*/

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    exit();
}

require_once(__ROOT__ . "functions/validation.php");


function generate_token(int $len = 16): string {
    /**
    * A function to generate a cryptographically secure random token.
    *
    * @param    int     $len        The length of random bytes to generate.
    *
    * @return   string  $token      The random token.
    */
    return bin2hex(random_bytes($len));
}

function generate_pin_code(): string {
    /**
    * A function to generate a random 6 digit code.
    *
    * @return   string  $code      The random code.
    */
    return str_pad((string)(mt_rand(0, 999999)), 6, "0", STR_PAD_LEFT);
}

function sha256(string $input): string {
    /**
    * A function to generate a SHA256 hash.
    *
    * @param    string  $input      The input to hash.
    *
    * @return   string  $hash       The resultant hash.
    */
    return hash("sha256", $input, FALSE);
}

function pw_hash(string $password): string {
    /**
    * A function to hash a plaintext password using bcrypt.
    *
    * @param    string  $password   The password string to hash.
    *
    * @return   string  $hash       The resultant hash.
    */
    $hash = password_hash($password, PASSWORD_BCRYPT, ["cost" => 14]);

    if ($hash === FALSE) {
        // Something went wrong when hashing.
        return "";
    }

    return $hash;
}


function pw_verify(string $password, string $hash): bool {
    /**
    * A function to validate whether a plaintext password
    * matches the hash stored on the server-side.
    *
    * @param    string  $password   The plaintext password.
    * @param    string  $hash       The hashed password.
    *
    * @return   bool    $result     TRUE if password is validated else FALSE.
    */
    return password_verify($password, $hash);
}
