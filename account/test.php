<?php
require_once('loader.php');

$userId = $_SESSION['userId'];

$userData = $process->GetRow("SELECT names, email FROM users WHERE id = ?",["$userId"]);

$currentMonthYear = date('F Y');
$pastMonthYear = date('F Y', strtotime('-6 months'));


$cycleData = $process->GetRows("SELECT * FROM cycles WHERE user_id = ? 
ORDER BY cycle_id DESC 
LIMIT 6 ",["$userId"]);


$cycleLengths = [];
$starts = [];
$ends = [];
$totalCycles = 0;
$hasData = false;


$shortest = null;
$longest = null;
$average = null;
$fertileStart = null;
$fertileEnd = null;
$displayFertileStart = null;

if (!empty($cycleData)) {
    foreach ($cycleData as $cycle) {
        if (!empty($cycle['period_start_date']) && !empty($cycle['next_period_start_date'])) {
            $start = new DateTime($cycle['period_start_date']);
            $end   = new DateTime($cycle['next_period_start_date']);

            $diff = $start->diff($end)->days;
            
            if ($diff >= 21 && $diff <= 35) {
                $cycleLengths[] = $diff;
                $starts[] = $cycle['period_start_date'];
                $ends[] = $cycle['next_period_start_date'];
            }
        }
    }
    
    // Only calculate if we have at least 3 valid cycles
    if (count($cycleLengths) >= 3) {
        $hasData = true;
        $totalCycles = count($cycleLengths);
        
        // Core values
        $shortest = min($cycleLengths);
        $longest  = max($cycleLengths);
        $average  = round(array_sum($cycleLengths) / count($cycleLengths));
        
        // Ovulation range
        $ovulationStart = $shortest - 14;
        $ovulationEnd   = $longest - 14;
        
        // Fertile window
        $fertileStart = $ovulationStart - 5;
        $fertileEnd   = $ovulationEnd + 1;
        
        // For display
        $displayFertileStart = max(1, $fertileStart);
        
        // Store in session for other pages if needed
        $_SESSION['data'] = [
            'cycles' => $cycleLengths,
            'shortest' => $shortest,
            'longest' => $longest,
            'average' => $average,
            'fertile_start' => $fertileStart,
            'fertile_end' => $fertileEnd,
            'last_period_date' => $ends[0]  
        ];
    }
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
                                <div class="small fw-500"><?= $userData['names'] ?></div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- Layout content-->
            <div id="layoutDrawer_content">
                <main>
                    <div class="container-xl p-5">
                        <?php if (!$hasData): ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <h4 class="alert-heading">Hi <strong><?= htmlspecialchars($userData['names']) ?></strong>, Welcome to Safe Days Tracker!</h4>
                                <p>
                                    To get personalized cycle predictions, you need at least <strong>3 consecutive valid menstrual cycles</strong>.
                                    <br><br>
                                    Currently, you have recorded <strong><?= count($cycleLengths) ?></strong> valid cycle(s).
                                    <br>
                                    Please add <?= max(0, 3 - count($cycleLengths)) ?> more cycle(s) to unlock your personalized predictions!
                                </p>
                                <hr>
                                <a href="add-cycle" class="btn btn-primary">Add New Cycle</a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="row gx-3">
                            <div class="col-xxl-3 col-md-6 mb-5">
                                <div class="card card-raised border-start border-primary border-4">
                                    <div class="card-body px-4">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="me-2">
                                                <div class="display-5">
                                                    <h1><?= $hasData ? $totalCycles : count($cycleLengths) ?></h1>
                                                </div>
                                                <div class="card-text">Total Cycles Recorded</div>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6 mb-5">
                                <div class="card card-raised border-start border-primary border-4">
                                    <div class="card-body px-4">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="me-2">
                                                <div class="display-5">
                                                    <h1><?= $hasData ? $average . ' days' : 'N/A' ?></h1>
                                                </div>
                                                <div class="card-text">Average Cycle Length</div>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6 mb-5">
                                <div class="card card-raised border-start border-primary border-4">
                                    <div class="card-body px-4">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="me-2">
                                                <div class="display-5">
                                                    <h1><?= $hasData ? $shortest . '-' . $longest : 'N/A' ?></h1>
                                                </div>
                                                <div class="card-text">Cycle Range (days)</div>
                                            </div>                  
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6 mb-5">
                                <div class="card card-raised border-start border-primary border-4">
                                    <div class="card-body px-4">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="me-2">
                                                <div class="display-5">
                                                    <h1><?= $hasData ? 'Day ' . $displayFertileStart . '-' . $fertileEnd : 'N/A' ?></h1>
                                                </div>
                                                <div class="card-text">Fertile Window</div>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if (!$hasData): ?>
                        <!-- Show when not enough cycles -->
                        <div class="row gx-5">
                            <div class="col-lg-12">
                                <div class="card card-raised">
                                    <div class="card-body text-center p-5">
                                        <i class="material-icons text-muted mb-3" style="font-size: 72px;">event_busy</i>
                                        <h3 class="text-muted mb-3">📅 Start Tracking Your Cycles</h3>
                                        <p class="text-muted">Your personalized fertility insights will appear here once you've recorded at least 3 valid menstrual cycles.</p>
                                        <a href="add-cycle" class="btn btn-primary btn-lg mt-3">
                                            <i class="material-icons me-2">add_circle</i>
                                            Add Your First Cycle
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <!-- Quick Actions when user has data -->
                        <div class="row gx-5">
                            <div class="col-lg-6 mb-4">
                                <div class="card card-raised h-100">
                                    <div class="card-body text-center p-4">
                                        <i class="material-icons text-primary mb-3" style="font-size: 48px;">calendar_today</i>
                                        <h4 class="mb-3">View Calendar</h4>
                                        <p class="text-muted">See your complete cycle calendar with fertile days, ovulation, and safe periods.</p>
                                        <a href="calendar" class="btn btn-primary mt-2">
                                            <i class="material-icons me-2">visibility</i>
                                            View Calendar
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <div class="card card-raised h-100">
                                    <div class="card-body text-center p-4">
                                        <i class="material-icons text-success mb-3" style="font-size: 48px;">add_circle</i>
                                        <h4 class="mb-3">Add New Cycle</h4>
                                        <p class="text-muted">Keep your predictions accurate by recording new menstrual cycles as they occur.</p>
                                        <a href="add-cycle" class="btn btn-success mt-2">
                                            <i class="material-icons me-2">add</i>
                                            Add Cycle
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
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