<?php
/**
 * mvc/views/Facilitator/challenges.php
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
 * Facilitator Challenge Listing.
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
            <?php require_once(__MVC_VIEWS_TEMPLATES_DIR__ . "Facilitator/sidebar.inc.php"); ?>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <?php require_once(__MVC_VIEWS_TEMPLATES_DIR__ . "Facilitator/nav.inc.php"); ?>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Challenge Management</h1>

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <a id="addChalBtn" href="/facilitator/challenges" class="btn btn-info btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-puzzle-piece"></i>
                                    </span>
                                    <span class="text">Add New Challange</span>
                                </a>
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
                                                    <button class="btn btn-danger btn-circle delChalBtn" chalID="<?php safe_echo($challenge->getID()); ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
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

        <!-- Challenge Deletion Modal-->
        <div class="modal fade" id="delChalModal" tabindex="-1" role="dialog" aria-labelledby="delChalModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delChalModalLabel">Challenge Deleted</h5>
                    </div>
                    <div class="modal-body text-center">
                        Challenge deleted successfully!
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" id="delChalModalClose">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once(__MVC_VIEWS_TEMPLATES_DIR__ . "js.inc.php"); ?>
        <?php require_once(__MVC_VIEWS_TEMPLATES_DIR__ . "logoutModal.inc.php"); ?>
        <?php require_once(__MVC_VIEWS_TEMPLATES_DIR__ . "Facilitator/cmdToggle.inc.php"); ?>
        <?php require_once(__MVC_VIEWS_TEMPLATES_DIR__ . "Facilitator/otp.inc.php"); ?>

        <script>
            $(document).ready(function() {
                $(".delChalBtn").click(function(){
                    let formData = "?id=" + $(this).attr("chalID");
                    $.ajax({
                        url: "/facilitator/challenges" + formData,
                        dataType: "json",
                        method: "DELETE",
                        success: function(response){
                            $("#delChalModal").modal({
                                backdrop: "static",
                                keyboard: false
                            }, "show");
                        },
                        error: function(response){
                            // console.log("HTTP Status Code: " + response.status);
                            let errorMsg = "Failed to delete Challenge.";

                            if (response.responseJSON !== undefined) {
                                errorMsg = response.responseJSON.msg;
                            }

                            $.notify({
                                message: errorMsg
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
                        }
                    });
                });

                $("#delChalModalClose").click(function(){
                    window.location.reload();
                });
            });
        </script>
    </body>
</html>