<?php
define("FRONTEND", TRUE);
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
 * Facilitator dashboard.
 * -----------------------------------------------------------------------
 */
define("WEBPAGE_TITLE", "Facilitator Dashboard");
define("REQUIRE_AUTH", TRUE);

require_once("base.php");
require_once(__ROOT__ . "/backend/session_management.php");
require_once(__ROOT__ . "/backend/functions/db.php");

if ($session_is_facilitator === FALSE) {
// Student cannot access Facilitator dashboard.
    header("HTTP/1.1 403 Forbidden");
    header("Location: index.php");
    die("You are not allowed to access the requested resource.");
}

?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once(__ROOT__ . "/templates/head.inc.php"); ?>
    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-truck-monster"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">BOT<sup>ster</sup></div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">


                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <br />
                <center>
                    <button class="btn btn-success btn-icon-split" id="genOTP">
                        <span class="icon text-white-50"><i class="fas fa-key"></i></span><span class="text">Generate OTP</span>
                    </button>
                </center>
                <br />
                <a class="nav-link" href="facilitator.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a class="nav-link" href="facilitator_challenges.php">
                    <i class="fas fa-fw fa-bullseye"></i>
                    <span>View All Challenges</span>
                </a>
                </li>
            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Facilitator</span>
                                    <img class="img-profile rounded-circle"
                                         src="/static/img/undraw_profile.svg">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                     aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Settings
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Add New Challenge</h1>

                        <form class="user" method="post" action="facilitator_doAddChal.php" enctype="multipart/form-data">
                            <label class="control-label">Challenge Name</label>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user"
                                       id="Challenge Name" aria-describedby="Challenge Name" name="chalName"
                                       placeholder="Enter Challenge Name..." maxlength="45" required>
                            </div>
                            <label class="control-label">Checkpoint Number</label>
                            <div class="form-group">
                                <input type="number" class="form-control form-control-user"
                                       id="Challenge Checkpoint" aria-describedby="Challenge Checkpoint" name="chalCheckNo"
                                       placeholder="Enter Checkpoint Number..." required>
                            </div>
                            <label class="control-label">Map Image</label>
                            <div class="form-group">
                                <input type="file"   id="map_img" name="map_img" 
                                       style="width: 200px;" accept=".png,.PNG,.jpg,.JPG,.jpeg,.JPEG" required>
                            </div>
                            
                            <br><br>

                            <div class="form-group">
                                <button  class="btn btn-success btn-icon-split" name="add" type="submit"> 
                                    <span class="icon text-white-50">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="text">Submit!</span></button>
                            </div>
                            </form>

                                </div>
                                <!-- /.container-fluid -->

                                </div>
                                <!-- End of Main Content -->

                                <!-- Footer -->
                                <footer class="sticky-footer bg-white">
                                    <div class="container my-auto">
                                        <div class="copyright text-center my-auto">
                                            <span>Copyright &copy; 2021 BOTster, Team P4-6.</span>
                                        </div>
                                    </div>
                                </footer>
                                <!-- End of Footer -->

                                </div>
                                <!-- End of Content Wrapper -->

                                </div>
                                <!-- End of Page Wrapper -->

                                <!-- Scroll to Top Button-->
                                <a class="scroll-to-top rounded" href="#page-top">
                                    <i class="fas fa-angle-up"></i>
                                </a>

                                <!-- Logout Modal-->
                                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <a class="btn btn-primary" href="logout.php">Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- OTP Modal-->
                                <div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="otpModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="otpModalLabel">Student One-Time Password</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                Provide the following One-Time Password to your student for them to login.
                                                <br />
                                                <h5 class="text-center" id="generated_otp"></h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php require_once(__ROOT__ . "/templates/js.inc.php"); ?>

                                <!-- Page level plugins -->
                                <script src="/static/vendor/chart.js/Chart.min.js"></script>

                                <!-- Page level custom scripts -->
                                <script src="/static/js/demo/chart-area-demo.js"></script>
                                <script src="/static/js/demo/chart-pie-demo.js"></script>

                                <script>
                                    $(document).ready(function () {
                                        $("#genOTP").click(function () {
                                            $.ajax({
                                                url: "facilitator_genotp.php",
                                                dataType: "json",
                                                method: "GET",
                                                success: function (response) {
                                                    $("#generated_otp").text(response[0]["otp"]);
                                                    $("#otpModal").modal("show");
                                                },
                                                error: function (response) {
                                                    console.log(response);
                                                    console.log(response.responseText);
                                                    $.notify({
                                                        message: "Failed to generate One-Time Password."
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
                                                    console.log("HTTP Status Code: " + response.status);
                                                }
                                            });
                                        });
                                    });
                                </script>
                                </body>
                                </html><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

