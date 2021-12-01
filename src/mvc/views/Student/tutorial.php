<?php
/**
* mvc/views/Student/tutorial.php
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
* Student Tutorial Page.
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

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Tutorial</h1>
                        </div>

                        <div class="d-flex justify-content-center">
                            <h2><b>To Take Note Before Playing!</b></h2>
                        </div>
                        <div class="d-flex justify-content-center">
                            <p>1. Ensure that the game is played under supervision of an adult<br> 
                            2. Ensure that you stand outside the playing area<br>
                            3. Avoid using the laptop too far from the playing area to have good connection
                            </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-center">
                            <h2>How to start?</h2>
                        </div>
                        <div class="d-flex justify-content-center">
                            <p>1. Click on the play button<br>
                                2. A list of challenges will be displayed<br>
                                3. Select a challenge to play<br>
                                4. Enjoy the game!
                            </p>                   
                        </div>                         
                        <hr>
                        <div class="d-flex justify-content-center">
                            <h2>How to play?</h2>
                        </div>
                        <div class="d-flex justify-content-center">
                            <p style="text-align:center">
                                There is a box on the right side of the challenge page to drag and drop commands, the goal of the game will be<br> 
                                to make use of the drag and drop to manuever the vechicle to the finish line while avoiding the obstacles set in<br> 
                                the given map. The available drag and drop commands are move forward, turn left, turn right, if condition and loop.<br> 
                                You will need to plan your steps ahead well to complete the challenge with minimum number of steps. 
                            </p>
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

            <?php require_once(__MVC_VIEWS_TEMPLATES_DIR__ . "js.inc.php"); ?>

            <!-- Page level plugins -->
            <script src="/static/vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="/static/js/demo/chart-area-demo.js"></script>
            <script src="/static/js/demo/chart-pie-demo.js"></script>

    </body>

</html>