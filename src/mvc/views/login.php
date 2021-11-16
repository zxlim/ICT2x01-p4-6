<?php
/**
* mvc/views/login.php
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

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once(__MVC_VIEWS_TEMPLATES_DIR__ . "head.inc.php"); ?>
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
                                        <form class="loginForm" action="/login" method="POST">
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
        <?php require_once(__MVC_VIEWS_TEMPLATES_DIR__ . "js.inc.php"); ?>

        <script>
            let userSelect = document.getElementById("user");
            let pwField = document.getElementById("password");
            
            userSelect.onchange = (event) => {
                let content = event.target.value;

                if (content === "facilitator") {
                    pwField.placeholder = "Enter Password";
                } else {
                    pwField.placeholder = "Enter One-Time Password";
                }
            }

            <?php if (PAGE_STATE["loginAsFacilitator"] === TRUE) { ?>
            userSelect.value = "facilitator";
            pwField.placeholder = "Enter Password";
            <?php } ?>
        </script>

        <?php if (PAGE_STATE["errorLogin"] === TRUE) { ?>
        <script>
            $(document).ready(function() {
                $.notify({
                    message: "<?php safe_echo(PAGE_STATE["errorMessage"]); ?>"
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