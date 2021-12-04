<?php
/**
* index.php
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
* The Web Application Router.
* -----------------------------------------------------------------------
*/

require_once("../constants.php");
require_once(__FUNCTIONS_DIR__ . "security.php");
require_once(__FUNCTIONS_DIR__ . "session.php");
require_once(__FUNCTIONS_DIR__ . "utils.php");
require_once(__FUNCTIONS_DIR__ . "validation.php");
require_once(__FUNCTIONS_DIR__ . "db.php");


$router = strtok($_SERVER["REQUEST_URI"], "?");

if (isset($_GET["route"]) === TRUE) {
    // Alternative method to obtain route using the `route` GET parameter.
    $router = (string)(trim($_GET["route"]));
}

// Application Router.
switch ($router) {
    case "/":
        $controllerName = DashboardController::class;
        break;

    case "/login":
        $controllerName = LoginController::class;
        break;

    case "/logout":
        $controllerName = LogoutController::class;
        break;

    case "/challenges":
        $controllerName = ChallengeController::class;
        break;

    case "/facilitator/generateOTP":
        $controllerName = OTPController::class;
        $controllerFilePath = "Facilitator/" . $controllerName;
        break;

    case "/facilitator/challenges":
        $controllerName = ChallengeManagementController::class;
        $controllerFilePath = "Facilitator/" . $controllerName;
        break;

    case "/student/play":
        $controllerName = CommandController::class;
        $controllerFilePath = "Student/" . $controllerName;
        break;

    case "/student/tutorial":
        $controllerName = TutorialController::class;
        $controllerFilePath = "Student/" . $controllerName;
        break;
    
    default:
        $controllerName = UnhandledRouteController::class;
        break;
}

if (isset($controllerFilePath) !== TRUE) {
    $controllerFilePath = $controllerName;
}

require_once(__MVC_CONTROLLERS_DIR__ . "Controller.php");
require_once(__MVC_CONTROLLERS_DIR__ . $controllerFilePath . ".php");

$requestMethod = strtolower($_SERVER["REQUEST_METHOD"]);

$controller = new $controllerName();
$controller->{$requestMethod}();
