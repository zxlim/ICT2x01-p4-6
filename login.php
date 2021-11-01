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
* Login page.
* -----------------------------------------------------------------------
*/

define("WEBPAGE_TITLE", "Login");

require_once("base.php");
require_once(__ROOT__ . "backend/session_management.php");

if ($session_is_authenticated === TRUE) {
    header("HTTP/1.1 403 Forbidden");
    header("Location: index.php");
    die("You are not allowed to access the requested resource.");
}

$login_as_facil = FALSE;
$error_login = FALSE;
$error_message = "Invalid credentials.";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once(__ROOT__ . "backend/functions/validation.php");
    require_once(__ROOT__ . "backend/functions/security.php");

    if (validate_notempty($_POST["user"]) === FALSE) {
        $error_login = TRUE;
        $error_message = "Please specify the user to login as.";
    } else if (validate_notempty($_POST["password"]) === FALSE) {
        $error_login = TRUE;
        $error_message = "Please enter your password.";
    } else {
        if ($_POST["user"] === "student") {
            // Student login flow.
            require_once(__ROOT__ . "backend/classes/Student.php");
            $stud = new Student();

            if ($stud->login($_POST["password"]) === TRUE) {
                $_SESSION["is_authenticated"] = TRUE;
                $_SESSION["is_facilitator"] = FALSE;

                header("HTTP/1.1 302 Found");
                header("Location: index.php");
            } else {
                $error_login = TRUE;
                $error_message = "Invalid One-Time Password.";
            }

            unset($stud);
        } elseif ($_POST["user"] === "facilitator") {
            // Facilitator login flow.
            require_once(__ROOT__ . "backend/classes/Facilitator.php");
            $facil = new Facilitator();
            $login_as_facil = TRUE;

            if ($facil->login($_POST["password"]) === TRUE) {
                $_SESSION["is_authenticated"] = TRUE;
                $_SESSION["is_facilitator"] = TRUE;

                header("HTTP/1.1 302 Found");
                header("Location: facilitator.php");
            } else {
                $error_login = TRUE;
                $error_message = "Invalid Password.";
            }

            unset($facil);
        } else {
            $error_login = TRUE;
            $error_message = "User specified is not recognised.";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] !== "GET" && $_SERVER["REQUEST_METHOD"] !== "HEAD") {
    http_response_code(405);
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once(__ROOT__ . "templates/head.inc.php"); ?>
    <body class="bg-gradient-primary">
        <br /><br /><br />
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome to <?php safe_echo(APP_TITLE); ?>!</h1>
                                        </div>
                                        <form class="user" action="/login.php" method="POST">
                                            <div class="form-group">
                                                <h6>Login as</h6>
                                                <select class="custom-select custom-select-sm form-control form-control-sm" id="user" name="user">
                                                    <option value="student">Student</option>
                                                    <option value="facilitator">Facilitator</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Enter One-Time Password" required />
                                            </div>
                                            <input type="submit" class="btn btn-primary btn-user btn-block" value="Login" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once(__ROOT__ . "templates/js.inc.php"); ?>

        <script>
            var userSelect = document.getElementById("user");
            userSelect.onchange = (event) => {
                let content = event.target.value;

                if (content === "facilitator") {
                    document.getElementById("password").placeholder = "Enter Password";
                } else {
                    document.getElementById("password").placeholder = "Enter One-Time Password";
                }
            }

            <?php if ($login_as_facil === TRUE) { ?>
            userSelect.value = "facilitator";
            document.getElementById("password").placeholder = "Enter Password";
            <?php } ?>
        </script>

        <?php if ($error_login === TRUE) { ?>
        <script>
            $(document).ready(function() {
                $.notify({
                    message: "<?php safe_echo($error_message); ?>"
                }, {
                    type: "danger",
                    animate: {
                        enter: "animated fadeInDown",
                        exit: "animated fadeOutUp"
                    },
                    placement: {
                        from: "top",
                        align: "center"
                    },
                });
            });
        </script>
        <?php } ?>
    </body>
</html>