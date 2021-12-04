<?php
/**
* mvc/views/templates/Facilitator/sidebar.inc.php
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
* Facilitator Sidebar HTML code.
* -----------------------------------------------------------------------
*/
?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
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
        <a id="facilitator-dashboard-navlink" class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
        <a id="facilitator-dashboard-navlink" class="nav-link" href="/challenges">
            <i class="fas fa-fw fa-bullseye"></i>
            <span>Challenge Management</span>
        </a>
    </li>
</ul>