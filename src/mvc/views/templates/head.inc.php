<?php
/**
* mvc/views/templates/head.inc.php
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
* Reusable frontend template for for the HTML HEAD element.
* -----------------------------------------------------------------------
*/


$viewHtmlTitle = APP_TITLE;

if (defined("PAGE_TITLE") === TRUE) {
    $viewHtmlTitle = sprintf("%s | %s", APP_TITLE, PAGE_TITLE);
}
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php safe_echo(APP_TITLE); ?>">
    <meta name="author" content="P4-6">

    <title><?php safe_echo($viewHtmlTitle); ?></title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" type="text/css" href="/static/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="/static/css/sb-admin-2.min.css">
    <link rel="stylesheet" type="text/css" href="/static/css/botster.css">
</head>