<?php
/**
 * mvc/views/Student/challenges.php
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
 * Student Challenge Listing.
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
                        <h1 class="h3 mb-2 text-gray-800">Let's Play</h1>

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <br /><br />
                                <h4 class="h4 mb-2 text-gray-800">All Challenges</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="challengesTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Max Command Blocks</th>
                                                <th>Map Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($state["chals"] as $challenge) { ?>
                                            <tr>
                                                <td><?php safe_echo($challenge->getName()); ?></td>
                                                <td><?php safe_echo($challenge->getPrettyMaxCommandBlocks()); ?></td>
                                                <td style="max-width: 300px;">
                                                    <img
                                                        class="product-thmb"
                                                        style="object-fit: cover; display: block; max-height: 100%; max-width: 100%;"
                                                        id="<?php safe_echo($challenge->getID()); ?>"
                                                        src="<?php safe_echo($challenge->getMapFilePath()); ?>"
                                                    />
                                                </td>
                                                <td>
                                                    <a href="/student/play?id=<?php safe_echo($challenge->getID()); ?>" class="btn btn-success btn-circle">
                                                        <i class="fas fa-play"></i>                                                      
                                                    </a>
                                                </td>sni
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Max Command Blocks</th>
                                                <th>Map Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
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


        <?php require_once(__MVC_VIEWS_TEMPLATES_DIR__ . "logoutModal.inc.php"); ?>
        <?php require_once(__MVC_VIEWS_TEMPLATES_DIR__ . "js.inc.php"); ?>

    </body>
</html>