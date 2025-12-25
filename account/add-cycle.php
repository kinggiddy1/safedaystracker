<?php
require_once('loader.php');
require_once('perlConfig.php');

if (!isset($_SESSION['userId'])) {
    header("location:login");
    exit();
}
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
        <title>Calendar - SAFE DAYS TRACKER</title>
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
                    <?php require_once ('footer.php'); ?>
                </nav>
            </div>
            <!-- Layout content-->
            <div id="layoutDrawer_content">
                <main>
                    <div class="container-xl p-5">
                    <?php require_once ('save-cycles.php'); ?> 
                    </div>
                </main>
                <footer class="py-4 mt-auto border-top" style="min-height: 74px">
                    <div class="container-xl px-5">
                        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between small">
                            <div class="me-sm-2 align-items-center justify-content-sm-center">Copyright © safedaystracker.com <?php echo date("Y"); ?></div>
                        </div>
                    </div>
                </footer>
            </div>
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
    </body>
</html>