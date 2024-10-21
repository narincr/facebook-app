<?php include 'layouts/session.php'; ?>
<?php
if (!isset($_SESSION["adminfb"]["LOGIN"]) || $_SESSION["adminfb"]["LOGIN"] !== true) {
    header("location: index.php");
    exit;
}
?>
<?php include 'layouts/main.php'; ?>
<?php include 'include/ConnectGo.php'; ?>
<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Facebook System')); ?>
    <link href="assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" />
    <?php include 'layouts/head-css.php'; ?>
</head>
<body>
<!-- Begin page -->
<div id="layout-wrapper">
    <?php include 'layouts/menu.php'; ?>
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
<!--                --><?php //includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'Dashboards', 'title' => 'Crypto')); ?>
                <?php
                if(!empty($_GET["page"])){
                    if(file_exists("pages/".$_GET["page"].".php")){
                        include  "pages/".$_GET["page"].".php";
                    }else{
                        include  "404.php";
                    }
                }else{
                    if(file_exists("pages/dashboard.php")){
                        include  "pages/dashboard.php";
                    }else{
                        include  "404.php";
                    }
                }
                ?>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?php include 'layouts/footer.php'; ?>
    </div>
    <!-- end main content-->

    <div id="StatusApp"></div>

</div>
<!-- END layout-wrapper -->
<?php include 'modal/modal.php';?>
<?php include 'layouts/customizer.php'; ?>
<?php include 'layouts/vendor-scripts.php'; ?>

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>
<!-- Swiper Js -->
<script src="assets/libs/swiper/swiper-bundle.min.js"></script>
<!-- CRM js -->
<script src="assets/js/pages/dashboard-crypto.init.js"></script>
<!-- App js -->
<script src="assets/js/app.js"></script>

<!-- Sweet Alerts js -->
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
<!--<script type='text/javascript' src='assets/libs/cleave.js/cleave.min.js'></script>-->
<!--<script type='text/javascript' src='assets/libs/flatpickr/flatpickr.min.js'></script>-->
<!--<script type='text/javascript' src='assets/libs/flatpickr/l10n/th.js'></script>-->

<!-- Custom js -->
<script src="assets/js/custom.js?d=<?=date('YmdHi');?>"></script>
</body>

</html>