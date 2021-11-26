/**
* js/botster_blocks.css
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
* Custom JavaScript code for BOTster Blockly Command UI.
* -----------------------------------------------------------------------
*/

"use strict";

// Constant Declaration.
const BOTSTER_MOVEFORWARD = "botster_moveForward";
const BOTSTER_TURNLEFT = "botster_turnLeft";
const BOTSTER_TURNRIGHT = "botster_turnRight";
const BOTSTER_IFOBSTACLE = "botster_ifObstacle";
const BOTSTER_BLOCKS = [
    {
        "type": BOTSTER_MOVEFORWARD,
        "message0": "Move forward",
        "colour": 290,
        "previousStatement": null,
        "nextStatement": null,
        "tooltip": "Moves the Robotic Car forward.",
        "helpUrl": "",
    },
    {
        "type": BOTSTER_TURNLEFT,
        "message0": "Turn left",
        "colour": 290,
        "previousStatement": null,
        "nextStatement": null,
        "tooltip": "Turns the Robotic Car left.",
        "helpUrl": ""
    },
    {
        "type": BOTSTER_TURNRIGHT,
        "message0": "Turn right",
        "colour": 290,
        "previousStatement": null,
        "nextStatement": null,
        "tooltip": "Turns the Robotic Car right.",
        "helpUrl": ""
    },
    {
        "type": BOTSTER_IFOBSTACLE,
        "message0": "Obstacle %1 detected",
        "args0": [
            {
                "type": "field_dropdown",
                "name": "obstacle",
                "options": [
                    ["is", "true"],
                    [ "is not", "false"]
                ]
            }
        ],
        "output": "Boolean",
        "style": "logic_blocks",
        "tooltip": "Ultrasonic sensor detects an obstacle in front.",
        "helpUrl": ""
    }
];


function initBOTsterBlockCode() {
    Blockly.JavaScript[BOTSTER_MOVEFORWARD] = function(block){
        return "moveForward();\n";
    };

    Blockly.JavaScript[BOTSTER_TURNLEFT] = function(block){
        return "turnLeft();\n";
    };

    Blockly.JavaScript[BOTSTER_TURNRIGHT] = function(block){
        return "turnRight();\n";
    };

    Blockly.JavaScript[BOTSTER_IFOBSTACLE] = function(block){
        let cmd = "obstacleDetected() == " + block.getFieldValue("obstacle");
        return [cmd, Blockly.JavaScript.ORDER_NONE];
    };
}


$(document).ready(function() {
    const chalID = parseInt($("#chalID").val());
    let chalMaxBlocks = parseInt($("#chalMaxBlocks").val());

    if (chalMaxBlocks === -1) {
        chalMaxBlocks = Infinity;
    }

    Blockly.defineBlocksWithJsonArray(BOTSTER_BLOCKS);
    initBOTsterBlockCode();

    const blocklyDiv = document.getElementById("blocklyDiv");
    const workspace = Blockly.inject(
        blocklyDiv, {
            maxBlocks: chalMaxBlocks,
            scrollbars: false,
            trashcan: true,
            toolbox: document.getElementById("toolbox")
        }
    );

    function updateBlockCount(event) {
        let remainingCount = workspace.remainingCapacity();

        if (remainingCount !== Infinity) {
            $("#blocksLeftMsg").css("display", "block");
            $("#blocksLeftCount").text(remainingCount);
            $("#blocksLeftCount").removeClass("text-warning");
            $("#blocksLeftCount").removeClass("text-danger");

            switch (remainingCount) {
                case 0:
                    $("#blocksLeftCount").addClass("text-danger");
                    break;
                case 1:
                    $("#blocksLeftCount").addClass("text-warning");
                    break;
            }
        } else {
            $("#blocksLeftMsg").css("display", "none");
        }
    }

    workspace.addChangeListener(updateBlockCount);
    updateBlockCount();


    $("#cmdCodeLink").click(function(event){
        event.preventDefault();

        let generatedCode = Blockly.JavaScript.workspaceToCode(workspace);
        $("#cmdCodeBlock").text(generatedCode);
        $("#cmdCodeModal").modal({
            backdrop: "static",
            keyboard: false
        }, "show");
    });

    $("#cmdIssueLink").click(function(event){
        event.preventDefault();

        $.notify({
            message: "Sorry! Feature is still under development."
        }, {
            type: "warning",
            animate: {
                enter: "animated fadeInDown",
                exit: "animated fadeOutUp"
            },
            placement: {
                from: "top",
                align: "center"
            },
            width: "384px"
        });

        // let generatedCode = Blockly.JavaScript.workspaceToCode(workspace);
        // let formData = null;

        // $.ajax({
        //     url: "/student/play",
        //     data: formData,
        //     cache: false,
        //     dataType: "json",
        //     method: "POST",
        //     success: function(response){
        //         $("#cmdCodeModalLabel").text("Good Job!");
        //         $("#cmdCodeBlock").text(generatedCode);
        //         $("#cmdCodeModal").modal({
        //             backdrop: "static",
        //             keyboard: false
        //         }, "show");

        //         $("#cmdCodeModalCloseBtn").click(function(event){
        //             event.preventDefault();
        //             window.location.replace("/");
        //         });
        //     },
        //     error: function(response){
        //         // console.log("HTTP Status Code: " + response.status);

        //         let errorMsg = "Oops, the Car did not reach the end point!";
        //         if (response.responseJSON !== undefined) {
        //             errorMsg = response.responseJSON.msg;
        //         }
                
        //         $.notify({
        //             message: errorMsg
        //         }, {
        //             type: "danger",
        //             animate: {
        //                 enter: "animated fadeInDown",
        //                 exit: "animated fadeOutUp"
        //             },
        //             placement: {
        //                 from: "top",
        //                 align: "center"
        //             },
        //             width: "384px"
        //         });
        //     }
        // });
    });
});