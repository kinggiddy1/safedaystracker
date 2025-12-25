<?php
require_once('loader.php');
require_once('perlConfig.php');

if (!isset($_SESSION['userId'])) {
    header("location:login");
    exit();
}
$userId = $_SESSION['userId'];

$userData = $process->GetRow("SELECT names, email FROM users WHERE id = ?",["$userId"]);

// Get the cycle ID from URL
$cycleId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the specific cycle data for this user
$cycleData = $process->GetRow("SELECT cycle_id, period_start_date FROM cycles WHERE cycle_id = ? AND user_id = ?", [$cycleId, $userId]);

// If no cycle found, redirect back
if (!$cycleData) {
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
        <title>Edit Cycle - SAFE DAYS TRACKER</title>
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
                    
                                <section id="record-cycles" style="padding: 40px 20px; background: linear-gradient(135deg, #fef5f8 0%, #fff0f5 100%);">
                                <div style="max-width: 850px; margin: 0 auto;">
                                    
                                <!-- Section Header -->
                                <div style="text-align: center; margin-bottom: 20px;">
                                <h2 style="color: #EC407A; font-size: 1.8em; font-weight: 700; margin-bottom: 5px; font-family: 'Poppins', sans-serif;">
                                    Edit Cycle
                                </h2>
                                <p style="color: #999; font-size: 0.9em;">Update your period start date</p>
                                </div>
                                    <!-- Form Card -->
                                    <div style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 8px 30px rgba(236, 64, 122, 0.1);">
                                    
                                    <form method="post" action="submissions.php" id="cycleForm">
                                        
                                        <!-- Hidden field for cycle ID -->
                                        <input type="hidden" name="cycle_id" value="<?php echo $cycleData['cycle_id']; ?>">
                                        
                                        <!-- Cycles Container -->
                                        <div id="cyclesContainer" style="overflow-x: auto;">
                                        <table style="width: 100%; border-collapse: separate; border-spacing: 0 8px;">
                                            <thead>
                                            <tr>
                                                <th style="text-align: center; color: #EC407A; font-weight: 600; padding: 8px; font-size: 0.9em; width: 50px;">#</th>
                                                <th style="text-align: left; color: #EC407A; font-weight: 600; padding: 8px; font-size: 0.9em;">Period Start Date</th>
                                            </tr>
                                            </thead>
                                            <tbody id="cycleRows">
                                                <tr class="cycle-row">
                                                    <td style="padding: 10px; text-align: center; border-radius: 8px 0 0 8px;">
                                                        <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #EC407A 0%, #ff6b9d 100%); border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 0.9em;">
                                                            1
                                                        </div>
                                                    </td>
                                                    <td style="padding: 10px; border-radius: 0 8px 8px 0;">
                                                        <input 
                                                            type="date" 
                                                            name="period_start_date" 
                                                            value="<?php echo htmlspecialchars($cycleData['period_start_date']); ?>"
                                                            style="width: 100%; padding: 8px 12px; border: 2px solid #ffe0eb; border-radius: 6px; font-family: 'Poppins', sans-serif; font-size: 0.85em; outline: none;"
                                                            onfocus="this.style.borderColor='#EC407A'"
                                                            onblur="this.style.borderColor='#ffe0eb'"
                                                            required
                                                        >
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>

                                        <!-- Submit Buttons -->
                                        <div style="text-align: center; margin-top: 20px; display: flex; gap: 10px; justify-content: center; flex-wrap: wrap;">
                                        <button 
                                            type="submit" 
                                            name="update_cycle"
                                            style="background: linear-gradient(135deg, #EC407A 0%, #ff6b9d 100%); color: white; border: none; padding: 12px 40px; font-size: 0.95em; font-weight: 600; border-radius: 50px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(236, 64, 122, 0.3); font-family: 'Poppins', sans-serif;"
                                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(236, 64, 122, 0.4)'"
                                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(236, 64, 122, 0.3)'"
                                        >
                                            Update Cycle
                                        </button>
                                        
                                        <a 
                                            href="dashboard"
                                            style="background: linear-gradient(135deg, #9e9e9e 0%, #757575 100%); color: white; border: none; padding: 12px 40px; font-size: 0.95em; font-weight: 600; border-radius: 50px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(158, 158, 158, 0.3); font-family: 'Poppins', sans-serif; text-decoration: none; display: inline-block;"
                                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(158, 158, 158, 0.4)'"
                                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(158, 158, 158, 0.3)'"
                                        >
                                            Cancel
                                        </a>
                                        </div>

                                    </form>

                                    </div>

                                </div>
                                </section>

                                <style>
                                .cycle-row {
                                    background: #fff5f8;
                                    transition: all 0.3s ease;
                                }

                                @media (max-width: 768px) {
                                    section table thead {
                                    display: none;
                                    }
                                    
                                    section table tbody tr {
                                    display: block;
                                    margin-bottom: 15px;
                                    border-radius: 8px !important;
                                    }
                                    
                                    section table tbody tr td {
                                    display: block;
                                    width: 100% !important;
                                    border-radius: 0 !important;
                                    padding: 8px 12px !important;
                                    }
                                    
                                    section table tbody tr td:first-child {
                                    border-radius: 8px 8px 0 0 !important;
                                    }
                                    
                                    section table tbody tr td:last-child {
                                    border-radius: 0 0 8px 8px !important;
                                    text-align: center !important;
                                    }
                                    
                                    section h2 {
                                    font-size: 1.5em !important;
                                    }
                                }
                                </style>


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