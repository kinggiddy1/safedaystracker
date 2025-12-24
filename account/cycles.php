<?php
require_once('loader.php');
require_once('perlConfig.php');

if (!isset($_SESSION['userId'])) {
    header("location:login");
    exit();
}
$userId = $_SESSION['userId'];

$userData = $process->GetRow("SELECT names, email FROM users WHERE id = ?",["$userId"]);
$cycles = $process->GetRows("SELECT * FROM cycles WHERE user_id = ?",["$userId"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Cycles - SAFE DAYS TRACKER</title>
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
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

    <style>
        .card-header {
            background: linear-gradient(135deg, #EC407A 0%, #ff6b9d 100%);
            color: white;
        }
        
        .card-header h5 {
            color: white;
            font-weight: 600;
        }
        
        .btn-dark {
            background: linear-gradient(135deg, #333 0%, #555 100%);
            border: none;
        }
        
        .btn-dark:hover {
            background: linear-gradient(135deg, #555 0%, #777 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        
        .table thead th {
            background-color: #fef5f8;
            color: #EC407A;
            font-weight: 600;
            border-bottom: 2px solid #EC407A;
        }
        
        .table tbody tr:hover {
            background-color: #fff5f8;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #64b5f6 0%, #42a5f5 100%);
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #42a5f5 0%, #2196f3 100%);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #ef5350 0%, #e53935 100%);
            border: none;
        }
        
        .btn-danger:hover {
            background: linear-gradient(135deg, #e53935 0%, #d32f2f 100%);
        }
        
        /* DataTables styling */
        .dataTables_wrapper .dataTables_filter input {
            border: 2px solid #ffe0eb;
            border-radius: 20px;
            padding: 5px 15px;
        }
        
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #EC407A;
            outline: none;
            box-shadow: 0 0 0 3px rgba(236, 64, 122, 0.1);
        }
        
        .dataTables_wrapper .dataTables_length select {
            border: 2px solid #ffe0eb;
            border-radius: 5px;
            padding: 3px 10px;
        }
        
        .page-item.active .page-link {
            background-color: #EC407A;
            border-color: #EC407A;
        }
        
        .page-link {
            color: #EC407A;
        }
        
        .page-link:hover {
            color: #ff6b9d;
            background-color: #fff5f8;
            border-color: #ffe0eb;
        }
        
        .dataTables_info {
            color: #666;
        }
        
        /* Export buttons */
        .dt-buttons .btn {
            background: linear-gradient(135deg, #a8e6cf 0%, #7bd3b0 100%);
            border: none;
            color: white;
            margin-right: 5px;
            border-radius: 5px;
        }
        
        .dt-buttons .btn:hover {
            background: linear-gradient(135deg, #7bd3b0 0%, #5cc99c 100%);
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
                     <?php require_once ('footer.php'); ?>
                </nav>
            </div>
            <!-- Layout content-->
            <?php require_once ('cycle-table.php'); ?>
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
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<!-- Export buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"version":"2024.11.0","token":"6e2c2575ac8f44ed824cef7899ba8463","server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}' crossorigin="anonymous"></script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'997992e86cc473be',t:'MTc2MTk4MTA0MQ=='};var a=document.createElement('script');a.src='cdn-cgi/challenge-platform/h/g/scripts/jsd/b5237f8e6aad/maind41d.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
<script>
$(document).ready(function() {
    $('#cyclesTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        order: [[0, 'desc']], 
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>Brtip',
        buttons: [
            {
                extend: 'excel',
                text: '<i class="bi bi-file-earmark-excel"></i> Excel',
                className: 'btn-sm',
                title: 'Safe Days Cycles Export'
            },
            {
                extend: 'pdf',
                text: '<i class="bi bi-file-earmark-pdf"></i> PDF',
                className: 'btn-sm',
                title: 'Safe Days Cycles Export'
            },
            {
                extend: 'print',
                text: '<i class="bi bi-printer"></i> Print',
                className: 'btn-sm'
            }
        ],
        language: {
            search: "Search cycles:",
            lengthMenu: "Show _MENU_ cycles per page",
            info: "Showing _START_ to _END_ of _TOTAL_ cycles",
            infoEmpty: "No cycles available",
            infoFiltered: "(filtered from _MAX_ total cycles)",
            zeroRecords: "No matching cycles found",
            emptyTable: "No cycles recorded yet. Click 'Add New Cycle' to get started!"
        }
    });
});
</script>
<!-- Mirrored from material-admin-pro.startbootstrap.com/app-dashboard-minimal.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 01 Nov 2025 07:12:03 GMT -->
</html>
