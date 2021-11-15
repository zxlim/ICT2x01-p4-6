<?php declare(strict_types=1);

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    exit();
}

abstract class Controller
{
    abstract public function get($request);
    abstract public function post($request);

    public function renderTemplate($page, $page_vars = NULL)
    {
        require_once(__ROOT__ . "mvc/view/" . $page);
    }

    public function redirect($route)
    {
        header("HTTP/1.1 302 Found");
        header("Location: " . $route);
        exit();
    }

    public function unauthorized()
    {
        http_response_code(401);
        exit();
    }

    public function notFound()
    {
        http_response_code(404);
        exit();
    }

    public function methodNotAllowed()
    {
        http_response_code(405);
        exit();
    }
}
