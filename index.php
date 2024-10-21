<?php
// Initialize the session
include 'layouts/session.php';
//var_dump($_SESSION);
// Check if the user is already logged in, if yes then redirect him to index page
if (isset($_SESSION["adminfb"]["LOGIN"]) && $_SESSION["adminfb"]["LOGIN"] === true) {
    header("location: main.php");
    exit;
}
?>
<?php include 'layouts/main.php'; ?>

<head>

    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Sign In')); ?>

    <?php include 'layouts/head-css.php'; ?>

</head>

<body>

<div class="auth-page-wrapper pt-5">
    <!-- auth page bg -->
    <!-- <div class="auth-one-bg-position bg-dark" id="auth-particles" style="background-color: #11d1b7 !important;">
        <div class="bg-overlay" style="background-color: #adadad !important;"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div> -->

    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
<!--            <div class="row">-->
<!--                <div class="col-lg-12">-->
<!--                    <div class="text-center mt-sm-5 mb-4 text-white-50">-->
<!--                        <div>-->
<!--                            <a href="index.php" class="d-inline-block auth-logo">-->
<!--                                <img src="assets/images/logo-light.png" alt="" height="20">-->
<!--                            </a>-->
<!--                        </div>-->
<!--                        <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Super Admin Login !</h5>
                                <p class="text-muted">Login to continue to facebook management.</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form class="needs-validation" novalidate id="FormLogIn">

                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" name="username" id="username"
                                               placeholder="Enter username" minlength="4"
                                               value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>" required>
                                        <div class="invalid-feedback">Looks Username!</div>
                                    </div>

                                    <div class="mb-3">
<!--                                        <div class="float-end">-->
<!--                                            <a href="auth-pass-reset-basic.php" class="text-muted">Forgot password?</a>-->
<!--                                        </div>-->
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input" value="" name="password" required>
                                            <span class="text-danger"></span>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            <div class="invalid-feedback">Looks Password!</div>
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="auth-remember-check" name="auth-remember-check"
                                            <?php echo isset($_COOKIE['username']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-info w-100" type="submit">Log In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <?php include 'layouts/footer-index.php'; ?>

    <!-- end Footer -->
</div>
<!-- end auth-page-wrapper -->

<?php include 'layouts/vendor-scripts.php'; ?>

<!-- particles js -->
<script src="assets/libs/particles.js/particles.js"></script>
<!-- particles app js -->
<script src="assets/js/pages/particles.app.js"></script>
<!-- password-addon init -->
<script src="assets/js/pages/password-addon.init.js"></script>
<!-- Sweet Alerts js -->
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
<!-- Custom js -->
<script src="assets/js/custom.js?d=<?=date('YmdHi');?>"></script>

<script>
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            var forms = document.getElementsByClassName('needs-validation');
            if (forms)
                var validation = Array.prototype.filter.call(forms, function (FormLogIn) {
                    FormLogIn.addEventListener('submit',async function (event) {
                        event.preventDefault();
                        event.stopPropagation();
                        if (FormLogIn.checkValidity() === true) {
                            const form = document.getElementById('FormLogIn');
                            const data = new FormData(form);
                            data.append('action', 'LogIn');
                            try {
                                const res = FetchDataJson('post/index_search.php',data);
                                const resData = await res;
                                console.log(resData)
                                if(resData.result){
                                    AlertAutoCloseTimer('Log In!','main.php');
                                }else{
                                    AlertError(resData.remark);
                                }
                            } catch (err) {
                                console.log(err.message);
                                AlertError(err.message);
                            }
                        }else{
                            FormLogIn.classList.add('was-validated');
                        }
                    }, false);
                });
        }, false);
    })();
</script>
</body>
</html>