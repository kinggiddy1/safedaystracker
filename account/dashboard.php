<?php
require_once('loader.php');

$userId = $_SESSION['userId'];

$userData = $process->GetRow("SELECT names, email FROM users WHERE id = ?",["$userId"]);

$currentMonthYear = date('F Y');
$pastMonthYear = date('F Y', strtotime('-6 months'));

// Fetch cycle data from database
$cycleData = $process->GetRows("SELECT * FROM cycles WHERE user_id = ? 
ORDER BY cycle_id DESC 
LIMIT 6 ",["$userId"]);

// Initialize variables - NO DEFAULT VALUES THAT COULD MISLEAD
$cycleLengths = [];
$starts = [];
$ends = [];
$totalCycles = 0;
$hasData = false;

// These will only be set if we have valid data
$shortest = null;
$longest = null;
$average = null;
$fertileStart = null;
$fertileEnd = null;
$ovulationDay = null;
$ovulationDayEnd = null;
$displayFertileStart = null;
$periodLength = 5; // This is reasonable - typical period length
$lastPeriodDate = null;
$cycleLength = null;

// Variables for calendar - only set when we have data
$lastPeriodDay = null;
$lastPeriodMonth = null;
$lastPeriodYear = null;
$year = null;
$month = null;
$daysInMonth = null;
$startDayOfWeek = null;

// Check if we have data
if (!empty($cycleData)) {
    // Process database results - USING CORRECT COLUMN NAMES
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
        $ovulationDay = $ovulationStart;
        $ovulationDayEnd = $ovulationEnd;
        
        // IMPORTANT: Use the PERIOD START date (not next period start)
        $lastPeriodDate = $starts[0]; // Most recent period START date
        
        // Calculate cycle length for calendar display
        $cycleLength = $average;
        
        // Parse last period date for calendar
        $lastPeriodTimestamp = strtotime($lastPeriodDate);
        $lastPeriodDay = date('d', $lastPeriodTimestamp);
        $lastPeriodMonth = date('m', $lastPeriodTimestamp);
        $lastPeriodYear = date('Y', $lastPeriodTimestamp);
        
        // Get current month details for calendar
        $year = date('Y');
        $month = date('m');
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $startDayOfWeek = date('w', mktime(0, 0, 0, $month, 1, $year));
        
        // Store in session for other pages if needed
        $_SESSION['data'] = [
            'cycles' => $cycleLengths,
            'shortest' => $shortest,
            'longest' => $longest,
            'average' => $average,
            'fertile_start' => $fertileStart,
            'fertile_end' => $fertileEnd,
            'last_period_date' => $lastPeriodDate  
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
                                <div class="small fw-500"><?= $userData['names'] ?></div>
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
    </body>
</html>