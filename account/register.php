<?php
require_once('../perlConfig.php');
    session_start();
if (isset($_SESSION['userId'])) {
    header("location:dashboard");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register - SAFE DAYS TRACKER</title>
        <!-- Load Favicon-->
        <link href="assets/img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <!-- Load Material Icons from Google Fonts-->
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />
        <!-- Roboto and Roboto Mono fonts from Google Fonts-->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:400,500" rel="stylesheet" />
        <!-- Load main stylesheet-->
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
    <body class="" style="background: linear-gradient(135deg, #fef5f8 0%, #fff0f5 100%);">
        <!-- Layout wrapper-->
        <div id="layoutAuthentication">
            <!-- Layout content-->
            <div id="layoutAuthentication_content">
                <!-- Main page content-->
                <main>
                    <!-- Main content container-->
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
                                <div class="card card-raised shadow-10 mt-5 mt-xl-10 mb-4">
                                    <div class="card-body p-5">
                                        <!-- Auth header with logo image-->
                                        <div class="text-center">
                                            <a href="<?php echo URLROOT;?>"><img class="mb-3" src="assets/img/icons/background.svg" alt="..." style="height: 48px" /></a>
                                            <h1 class="display-5 mb-0 mb-3">Create an account</h1>
                                        </div>
                                        <!-- Login submission form-->
                                        <form method="post" action="submissions">
                                            <div class="mb-4"><mwc-textfield class="w-100" label="Names" outlined="" name="names"></mwc-textfield></div>
                                            <div class="mb-4"><mwc-textfield class="w-100" label="Email" outlined="" name="email"></mwc-textfield></div>
                                            <div class="mb-4"><mwc-textfield class="w-100" label="Password" outlined="" icontrailing="visibility_off" type="password" name="password"></mwc-textfield></div>
                                            <div class="d-flex align-items-center" required>
                                                <mwc-formfield label="I agree to the Terms and Conditions"><mwc-checkbox></mwc-checkbox></mwc-formfield>
                                            </div>
                                            <div class="g-recaptcha" data-sitekey="6Ld_sTgsAAAAAJD3MtoAlEhCMPKsCsGX4ZpUJr9s"></div>
                                            <br>
                                        
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small fw-500 text-decoration-none" href="app-auth-password-basic.html"></a>
                                                <button class="btn btn-primary" style="background-color: #EC407A;" name="register" type="submit">Register</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- Auth card message-->
                                <div class="text-center mb-5"><a class="small fw-500 text-decoration-none link-primary" href="<?php echo URLROOT;?>account/login">already have an account? Login</a></div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <!-- Layout footer-->
            
        </div>
        <!-- Load Bootstrap JS bundle-->
        <script src="../cdn.jsdelivr.net/npm/bootstrap%405.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <!-- Load global scripts-->
        <script type="module" src="js/material.js"></script>
        <script src="js/scripts.js"></script>

        <script src="../assets.startbootstrap.com/js/sb-customizer.js"></script>
        <sb-customizer project="material-admin-pro"></sb-customizer>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"version":"2024.11.0","token":"6e2c2575ac8f44ed824cef7899ba8463","server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}' crossorigin="anonymous"></script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'997993152c2b73be',t:'MTc2MTk4MTA0OQ=='};var a=document.createElement('script');a.src='cdn-cgi/challenge-platform/h/g/scripts/jsd/b5237f8e6aad/maind41d.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>

<!-- Mirrored from material-admin-pro.startbootstrap.com/app-auth-login-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 01 Nov 2025 07:12:09 GMT -->
</html>
