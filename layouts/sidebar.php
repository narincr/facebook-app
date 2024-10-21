<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.php" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.php" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-light.png" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu"></div>
            <?
            !isset($_GET['page']) ? $_GET['page']='':'';
            ?>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Main Menu</span></li>

                <!-- <?php $arr_bankacc = array("acc_with","acc_dept","acc_match","acc_bank");?>
                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo (in_array(trim($_GET["page"]),$arr_bankacc) ? "active" : ""); ?>" href="#sidebarbankacc"
                       data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarbankacc">
                        <i class="bx bx-trending-up"></i> <span data-key="t-bankacc">B. จัดการบัญชี</span>
                    </a>
                    <div class="collapse menu-dropdown <?php echo (in_array(trim($_GET["page"]),$arr_bankacc) ? "show" : ""); ?>" id="sidebarbankacc">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="main.php?page=acc_bank" class="nav-link <?php echo (trim($_GET["page"] == "acc_bank") ? "active" : ""); ?>" data-key="t-bankacc">
                                    จัดการธนาคาร Agent
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="main.php?page=acc_match"
                                   class="nav-link <?php echo (trim($_GET["page"] == "acc_match") ? "active" : ""); ?>"
                                   data-key="t-dashboard">ข้อมูลการจับคู่สมาชิก</a>
                            </li>
                        </ul>
                    </div>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo ($_GET["page"] == "acc_supadmin" ? "active" : ""); ?>" href="main.php?page=acc_supadmin">
                        <i class="mdi mdi-account-cog"></i> <span data-key="t-dashboard">จักการ SuperAdmin</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo ($_GET["page"] == "logout" ? "active" : ""); ?>" href="javascript:void(0);" onclick="onLogOut()">
                        <i class="mdi mdi-logout"></i> <span data-key="t-dashboard">ออกจากระบบ</span>
                    </a>
                </li>

            </ul>

        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>