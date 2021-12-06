<?php
/**
* mvc/views/templates/Facilitator/cmdToggle.inc.php
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
* Facilitator Command Issuance Toggle Modal code.
* -----------------------------------------------------------------------
*/
?>
<!-- Command Issuance Toggle Modal-->
<div class="modal fade" id="cmdStatusModal" tabindex="-1" role="dialog" aria-labelledby="cmdStatusLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cmdStatusLabel">Student Command Issuance Status</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>
                    The Student <span id="cmdStatus">can</span> issue commands now.
                </p>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="cmdToggleSwitch">
                    <label class="custom-control-label" for="cmdToggleSwitch">Toggle Student Command Issuance Status</label>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#cmdToggleTrigger").click(function(){
            $.ajax({
                url: "/facilitator/toggleCmd",
                dataType: "json",
                method: "GET",
                success: function(response){
                    if (response.res === true) {
                        $("#cmdStatus").text("can");
                    } else {
                        $("#cmdStatus").text("cannot");
                    }

                    $("#cmdToggleSwitch").prop("checked", response.res);
                    $("#cmdStatusModal").modal("show");
                },
                error: function(response){
                    $.notify({
                        message: "Failed to retrieve Command Issuance status."
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


        $("#cmdToggleSwitch").change(function(){
            let switchState = this.checked;

            $.ajax({
                url: "/facilitator/toggleCmd",
                dataType: "json",
                method: "POST",
                success: function(response){
                    if (response.res === true) {
                        $("#cmdStatus").text("can");
                    } else {
                        $("#cmdStatus").text("cannot");
                    }
                },
                error: function(response){
                    $("#cmdToggleSwitch").prop("checked", !switchState);

                    $.notify({
                        message: "Failed to toggle Command Issuance status."
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
    });
</script>
