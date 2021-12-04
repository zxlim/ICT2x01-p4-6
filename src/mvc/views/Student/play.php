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
?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once(__MVC_VIEWS_TEMPLATES_DIR__ . "head.inc.php"); ?>
    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php require_once(__MVC_VIEWS_TEMPLATES_DIR__ . "Student/sidebar.inc.php"); ?>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <?php require_once(__MVC_VIEWS_TEMPLATES_DIR__ . "Student/nav.inc.php"); ?>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <input type="hidden" name="chalID" id="chalID" value="<?php safe_echo($state["challenge"]->getID()); ?>" readonly />
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
                                                Car Status: <span id="car-status" class="text-danger">Not Connected</span>
                                            </div>
                                            <div class="col-md-6">
                                                <i class="fas fa-microchip"></i>&nbsp;
                                                Obstacle Detected: <span id="car-obstacle" class="text-danger">Unable to Retrieve Data</span>
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

            <script>
                <?php
                    if ($state["carConnected"] === TRUE) {
                ?>
                $("#car-status").text("Connected");
                $("#car-status").removeClass("text-danger");
                $("#car-status").addClass("text-success");
                <?php
                    } else {
                ?>
                $("#car-status").text("Not Connected");
                $("#car-status").removeClass("text-success");
                $("#car-status").addClass("text-danger");
                <?php
                    }

                    if ($state["carObstacle"] === FALSE) {
                ?>
                $("#car-obstacle").text("No Obstacles Detected");
                $("#car-obstacle").removeClass("text-warning");
                $("#car-obstacle").removeClass("text-danger");
                $("#car-obstacle").addClass("text-success");
                <?php
                    } else if ($state["carObstacle"] === TRUE) {
                ?>
                $("#car-obstacle").text("Obstacle Detected!");
                $("#car-obstacle").removeClass("text-success");
                $("#car-obstacle").removeClass("text-danger");
                $("#car-obstacle").addClass("text-warning");
                <?php
                    } else {
                ?>
                $("#car-obstacle").text("Unable to Retrieve Data");
                $("#car-obstacle").removeClass("text-success");
                $("#car-obstacle").removeClass("text-warning");
                $("#car-obstacle").addClass("text-danger");
                <?php
                    }
                ?>
            </script>
    </body>
</html>