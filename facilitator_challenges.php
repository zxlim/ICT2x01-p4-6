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

$db = db_get_conn();

$stmt = $db->prepare("SELECT ch_name, ch_imgdir, ch_checkpoint FROM challenge");
$res = $stmt->execute();

if ($res === false) {
    $last_error_code = $db->lastErrorCode();
    $last_error_msg = $db->lastErrorMsg();
    $db->close();
    die("Failed to initialise database: (" . $last_error_code . ") " . $last_error_msg);
}

$row = array();
while ($rows = $res->fetchArray()) {
    $row[] = $rows;
}


$db->close();


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
                        <h1 class="h3 mb-2 text-gray-800">List of Challenges</h1>
                        <a href="facilitator_addChal.php" class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-puzzle-piece"></i>
                            </span>
                            <span class="text">Add New Challange</span>
                        </a><br><br>


                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary"></h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Checkpoint No.</th>
                                                <th>Map Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Checkpoint No.</th>
                                                <th>Map Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            #db_get_challenges();
                                            foreach ($row as $rows) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $rows["ch_name"] ?></td>
                                                    <td><?php echo $rows["ch_checkpoint"] ?></td>
                                                    <td style="width: 400px"><img class="product-thmb" id="<?php echo $rows["ch_name"]; ?>" src="<?php echo $rows["ch_imgdir"]; ?>" alt="product-image" style="object-fit: cover; display: block; max-height: 100%; max-width: 100%;" ></td>
                                                    <td><a href="#" class="btn btn-danger btn-circle">
                                                            <i class="fas fa-trash"></i>
                                                        </a></td>
                                                </tr>

                                                <?php
                                            }
                                            ?>
                                        </tbody>
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
</html>
