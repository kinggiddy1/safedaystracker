<?php
require_once('loader.php');

$userId = $_SESSION['userId'];

$userData = $process->GetRow("SELECT names, email FROM users WHERE id = ?",["$userId"]);

$currentMonthYear = date('F Y');
$pastMonthYear = date('F Y', strtotime('-6 months'));


?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SAFE DAYS TRACKER</title>
        <!-- Load Favicon-->
        <link href="assets/img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <!-- Load Material Icons from Google Fonts-->
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />
        <!-- Load Simple DataTables Stylesheet-->
        <link href="../cdn.jsdelivr.net/npm/simple-datatables%407.1.2/dist/style.min.css" rel="stylesheet" />
        <!-- Roboto and Roboto Mono fonts from Google Fonts-->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:400,500" rel="stylesheet" />
        <!-- Load main stylesheet-->
        <link href="css/styles.css" rel="stylesheet" />

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #fef5f8 0%, #fff0f5 100%);
        min-height: 100vh;
        padding: 40px 20px;
    }

    .container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .header-section {
        text-align: center;
        margin-bottom: 40px;
    }

    .logo-title {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .logo {
        width: 50px;
        height: 50px;
        background: #EC407A;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        font-weight: bold;
    }

    h1 {
        color: #EC407A;
        font-size: 2.5em;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .month-title {
        color: #666;
        font-size: 1.2em;
        font-weight: 400;
        margin-bottom: 30px;
    }

    .calendar-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(236, 64, 122, 0.1);
        margin-bottom: 30px;
    }

    .legend {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 15px;
        margin-bottom: 30px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: #666;
        padding: 8px;
        background: #fafafa;
        border-radius: 8px;
    }

    .legend-box {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        flex-shrink: 0;
    }

    .legend-menstruation {
        background: linear-gradient(135deg, #ef5350 0%, #e53935 100%);
    }

    .legend-follicular {
        background: linear-gradient(135deg, #a8e6cf 0%, #7bd3b0 100%);
    }

    .legend-ovulation {
        background: linear-gradient(135deg, #ff4081 0%, #f50057 100%);
    }

    .legend-fertile {
        background: linear-gradient(135deg, #ff9999 0%, #ff6b9d 100%);
    }

    .legend-luteal {
        background: linear-gradient(135deg, #90caf9 0%, #64b5f6 100%);
    }

    .legend-safe {
        background: linear-gradient(135deg, #dcedc8 0%, #c5e1a5 100%);
    }

    .calendar {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
    }

    .header {
        padding: 15px;
        text-align: center;
        font-weight: 600;
        color: #EC407A;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .day {
        padding: 20px;
        text-align: center;
        border-radius: 12px;
        font-weight: 500;
        font-size: 16px;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
    }

    .day:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .menstruation {
        background: linear-gradient(135deg, #ef5350 0%, #e53935 100%);
        color: white;
        font-weight: 600;
    }

    .follicular {
        background: linear-gradient(135deg, #a8e6cf 0%, #7bd3b0 100%);
        color: #2a7a2a;
        font-weight: 600;
    }

    .ovulation {
        background: linear-gradient(135deg, #ff4081 0%, #f50057 100%);
        color: white;
        font-weight: 700;
        border: 3px solid #c51162;
    }

    .fertile {
        background: linear-gradient(135deg, #ff9999 0%, #ff6b9d 100%);
        color: white;
        font-weight: 600;
    }

    .luteal {
        background: linear-gradient(135deg, #90caf9 0%, #64b5f6 100%);
        color: #1565c0;
        font-weight: 600;
    }

    .safe {
        background: linear-gradient(135deg, #dcedc8 0%, #c5e1a5 100%);
        color: #558b2f;
        font-weight: 600;
    }

    .empty {
        background: transparent;
    }

    .info-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 40px rgba(236, 64, 122, 0.1);
        margin-bottom: 20px;
    }

    .info-card h3 {
        color: #EC407A;
        font-size: 1.3em;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-card p {
        color: #666;
        line-height: 1.8;
        font-size: 14px;
    }

    .warning-icon {
        font-size: 24px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-bottom: 30px;
    }

    .stat-box {
        background: linear-gradient(135deg, #fef5f8 0%, #fff0f5 100%);
        padding: 20px;
        border-radius: 12px;
        text-align: center;
    }

    .stat-number {
        font-size: 2em;
        font-weight: 700;
        color: #EC407A;
    }

    .stat-label {
        color: #666;
        font-size: 13px;
        margin-top: 5px;
    }

    @media (max-width: 768px) {
        .calendar-card {
            padding: 20px;
        }

        h1 {
            font-size: 2em;
        }

        .day {
            padding: 15px 10px;
            font-size: 14px;
        }

        .header {
            padding: 10px 5px;
            font-size: 12px;
        }

        .legend {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .day {
            padding: 12px 5px;
            font-size: 13px;
        }

        .header {
            font-size: 10px;
        }
    }
</style>
    </head>
    <body class="nav-fixed bg-light">
        <!-- Top app bar navigation menu-->
        <?php require_once ('header.php'); ?>
        <!-- Layout wrapper-->
        <div id="layoutDrawer">
            <!-- Layout navigation-->
            <div id="layoutDrawer_nav">
                <!-- Drawer navigation-->
                <nav class="drawer accordion drawer-light bg-white" id="drawerAccordion">
                    <div class="drawer-menu">
                     <?php require_once ('nav.php'); ?>   
                    </div>
                    <!-- Drawer footer        -->
                    <div class="drawer-footer border-top">
                        <div class="d-flex align-items-center">
                            <i class="material-icons text-muted">account_circle</i>
                            <div class="ms-3">
                                <div class="caption">Logged in as:</div>
                                <div class="small fw-500">Start Bootstrap</div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- Layout content-->
            <?php require_once ('admin-home.php'); ?>
        </div>
        <!-- Load Bootstrap JS bundle-->
        <script src="../cdn.jsdelivr.net/npm/bootstrap%405.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <!-- Load global scripts-->
        <script type="module" src="js/material.js"></script>
        <script src="js/scripts.js"></script>
        <!--  Load Chart.js via CDN-->
        <script src="../cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.2/chart.min.js" crossorigin="anonymous"></script>
        <!--  Load Chart.js customized defaults-->
        <script src="js/charts/chart-defaults.js"></script>
        <!--  Load chart demos for this page-->
        <script src="js/charts/demos/chart-pie-demo.js"></script>
        <script src="js/charts/demos/dashboard-chart-bar-grouped-demo.js"></script>
        <!-- Load Simple DataTables Scripts-->
        <script src="../cdn.jsdelivr.net/npm/simple-datatables%407.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables/datatables-simple-demo.js"></script>

        <script src="../assets.startbootstrap.com/js/sb-customizer.js"></script>
        <sb-customizer project="material-admin-pro"></sb-customizer>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"version":"2024.11.0","token":"6e2c2575ac8f44ed824cef7899ba8463","server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}' crossorigin="anonymous"></script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'997992e86cc473be',t:'MTc2MTk4MTA0MQ=='};var a=document.createElement('script');a.src='cdn-cgi/challenge-platform/h/g/scripts/jsd/b5237f8e6aad/maind41d.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>

<!-- Mirrored from material-admin-pro.startbootstrap.com/app-dashboard-minimal.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 01 Nov 2025 07:12:03 GMT -->
</html>
