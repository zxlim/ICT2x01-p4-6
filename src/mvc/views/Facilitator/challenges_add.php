<?php
/**
 * mvc/views/Facilitator/challenges_add.php
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
 * Facilitator Challenge Add page.
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
                        <h1 class="h3 mb-2 text-gray-800">Add New Challenge</h1>
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <form class="user" id="addChalForm" method="POST" enctype="multipart/form-data">
                                            <label class="control-label">Challenge Name</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" aria-describedby="name"
                                                    id="name" name="name" placeholder="Enter Challenge Name" maxlength="48" required
                                                />
                                            </div>
                                            <label class="control-label">Maximum Number of Command Blocks</label>
                                            <div class="form-group">
                                                <input type="number" class="form-control form-control-user" aria-describedby="maxCommandBlocks"
                                                    id="maxCommandBlocks" name="maxCommandBlocks"
                                                    placeholder="Minimum <?php safe_echo($state["countMin"]); ?> (Unlimited Blocks), Maximum <?php safe_echo($state["countMax"]); ?>"
                                                    min="<?php safe_echo($state["countMin"]); ?>" max="<?php safe_echo($state["countMax"]); ?>"
                                                    required
                                                />
                                            </div>
                                            <label class="control-label">Challenge Map Image</label>
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-file"></i></span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="mapImg" name="mapImg" accept=".jpg,.JPG,.jpeg,.JPEG,.png,.PNG" required />
                                                        <label class="custom-file-label" for="mapImg">Choose an image (Supports ".jpg", ".jpeg" and ".png" files)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <br />
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-8">
                                                        <button class="btn btn-block btn-success btn-icon-split" type="submit">
                                                            <span class="text">Submit</span>
                                                        </button>
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-2"></div>
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
                        <a class="btn btn-primary" href="/logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Challenge Deletion Modal-->
        <div class="modal fade" id="addChalModal" tabindex="-1" role="dialog" aria-labelledby="addChalModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addChalModalLabel">Challenge Added</h5>
                    </div>
                    <div class="modal-body text-center">
                        Challenge added successfully!
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" id="addChalModalClose">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once(__MVC_VIEWS_TEMPLATES_DIR__ . "js.inc.php"); ?>
        <?php require_once(__MVC_VIEWS_TEMPLATES_DIR__ . "Facilitator/otp.inc.php"); ?>

        <script>
            $(document).ready(function() {
                $("#mapImg").change(function(event){
                    let mapFileName = event.target.files[0].name;
                    $(".custom-file-label").text(mapFileName);
                });

                $("#addChalForm").submit(function(event){
                    event.preventDefault();

                    let formData = new FormData(this);

                    $.ajax({
                        url: "/facilitator/challenges",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        method: "POST",
                        success: function(response){
                            $("#addChalModal").modal({
                                backdrop: "static",
                                keyboard: false
                            }, "show");
                        },
                        error: function(response){
                            // console.log("HTTP Status Code: " + response.status);
                            let errorMsg = "Failed to add Challenge.";

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

                $("#addChalModalClose").click(function(){
                    window.location.replace("/challenges");
                });
            });
        </script>
    </body>
</html>