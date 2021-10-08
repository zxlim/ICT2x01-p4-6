<?php define("FRONTEND", TRUE);
/**
* zzDEV_init_db.php
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

require_once("base.php");

define("WEBPAGE_TITLE", "Login");
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
                                        <form class="user">
                                            <div class="form-group">
                                                <h6>Login as</h6>
                                                <select class="custom-select custom-select-sm form-control form-control-sm" name="user">
                                                    <option value="student">Student</option>
                                                    <option value="admin">Facilitator</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" placeholder="Password" />
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
    </body>
</html>