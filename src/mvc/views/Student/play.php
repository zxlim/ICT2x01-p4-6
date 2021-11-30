<?php
/**
* mvc/views/Student/play.php
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
* Student Command/Play Screen.
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
    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-truck-monster"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">BOT<sup>ster</sup></div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">


                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <br>
                <center><a href="#" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-gamepad"></i>
                    </span>
                    <span class="text">PLAY!</span>
                    </a></center>

                    <a class="nav-link" href="/">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Metric Data
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                       aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Ultrasonic Sensor</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Category</h6>
                            <a class="collapse-item" href="#">Summary</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                       aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Infrared Sensor</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Category</h6>
                            <a class="collapse-item" href="#">Summary</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                       aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>WiFi Module</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Category</h6>
                            <a class="collapse-item" href="#">Summary</a>
                        </div>
                    </div>
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
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Student</span>
                                    <img class="img-profile rounded-circle"
                                         src="/static/img/undraw_profile.svg">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
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

                        <input type="hidden" name="chalID" id="chalID" value="<?php safe_echo($state["challenge"]->getID()); ?>" readonly />
                        <!-- chalMaxBlocks not yet implemented, waiting for modification to Challenge Model. -->
                        <input type="hidden" name="chalMaxBlocks" id="chalMaxBlocks" value="<?php safe_echo($state["challenge"]->getMaxCommandBlocks()); ?>" readonly />

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Challenge: <?php safe_echo($state["challenge"]->getName()); ?></h1>
                        </div>

                        <!-- Content Row -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Construct Commands</h6>
                                    </div>
                                    <div class="card-body" id="blocklyArea">
                                        <div class="row text-center">
                                            <div class="col-md-6">
                                                <i class="fas fa-satellite-dish"></i>&nbsp;
                                                Car Status: <span class="text-danger">Not Connected</span>
                                                <!-- Temporary hardcode, waiting for car to work. -->
                                            </div>
                                            <div class="col-md-6">
                                                <i class="fas fa-microchip"></i>&nbsp;
                                                Obstacle Detected: <span class="text-danger">Ultrasonic Sensor Not Found</span>
                                                <!-- Temporary hardcode, waiting for car to work. -->
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col">
                                                <div id="blocklyDiv" style="height: 550px;"></div>
                                                <xml id="toolbox" style="display: none">
                                                    <block type="botster_moveForward"></block>
                                                    <block type="botster_turnLeft"></block>
                                                    <block type="botster_turnRight"></block>
                                                    <block type="botster_ifObstacle"></block>
                                                    <block type="controls_if"></block>
                                                    <block type="controls_repeat">
                                                        <field name="TIMES">3</field>
                                                    </block>
                                                </xml>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col">
                                        <div class="card shadow mb-4">
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-primary">Challenge Map</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <img src="<?php safe_echo($state["challenge"]->getMapFilePath()); ?>" class="img-fluid" />
                                                    </div>
                                                </div>
                                                <div class="row" id="blocksLeftMsg">
                                                    <div class="col">
                                                        <h5>You have <b><u id="blocksLeftCount"></u></b> block(s) left.</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="card shadow mb-4">
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-primary">Actions</h6>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="btn btn-primary btn-block" id="cmdCodeLink">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-code"></i>
                                                    </span>
                                                    &nbsp;&nbsp;
                                                    <span class="text">See Code</span>
                                                </a>
                                                <br />
                                                <a href="#" class="btn btn-success btn-block" id="cmdIssueLink">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-satellite-dish"></i>
                                                    </span>
                                                    &nbsp;&nbsp;
                                                    <span class="text">Send Command!</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="/logout">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Code Block Modal-->
            <div class="modal fade" id="cmdCodeModal" tabindex="-1" role="dialog" aria-labelledby="cmdCodeModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cmdCodeModalLabel">Constructed Code</h5>
                        </div>
                        <div class="modal-body">
                            <p id="completeMsg" style="display: none;">
                                You have completed the challenge successfully!
                            </p>
                            <p>
                                You have constructed the following code using Command Blocks:
                            </p>
                            <figure class="codeblock">
                                <pre class=".pre-scrollable"><code id="cmdCodeBlock"></code></pre>
                            </figure>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" id="cmdCodeModalCloseBtn" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php require_once(__MVC_VIEWS_TEMPLATES_DIR__ . "js.inc.php"); ?>
            <script src="https://unpkg.com/blockly/blockly.min.js"></script>
            <script src="/static/js/botster_blocks.js"></script>
    </body>
</html>