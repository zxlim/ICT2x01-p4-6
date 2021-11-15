<?php declare(strict_types=1);

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    exit();
}

define("WEBPAGE_TITLE", "Logout");


class LogoutController extends Controller {
    public function get($request) {
        session_start();

        $_SESSION["authenticated"] = FALSE;
        session_end();

        $this->redirect("login");
    }

    public function post($request) {
        // Send to GET.
        $this->get($request);
    }

}