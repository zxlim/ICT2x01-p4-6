<?php
/**
* mvc/views/templates/facilitator.otp.js.inc.php
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
<script>
    $(document).ready(function() {
        $("#genOTP").click(function(){
            $.ajax({
                url: "/facilitator/generateOTP",
                dataType: "json",
                method: "GET",
                success: function(response){
                    $("#generated_otp").text(response[0]["otp"]);
                    $("#otpModal").modal("show");
                },
                error: function(response){
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