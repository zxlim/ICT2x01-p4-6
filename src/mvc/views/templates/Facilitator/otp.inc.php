<?php
/**
* mvc/views/templates/Facilitator/otp.js.inc.php
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
* Facilitator OTP Modal JavaScript code.
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
                <br /><br />
                <h5 class="text-center" id="generated_otp"></h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#genOTP").click(function(){
            $.ajax({
                url: "/facilitator/generateOTP",
                dataType: "json",
                method: "GET",
                success: function(response){
                    $("#generated_otp").text(response.otp);
                    $("#otpModal").modal("show");
                },
                error: function(response){
                    // console.log("HTTP Status Code: " + response.status);
                    
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
                }
            });
        });
    });
</script>
