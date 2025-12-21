<?php
session_start();
$data = $_SESSION['data'];

$month = date('n'); // 1-12
$year = date('Y');


$firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
$daysInMonth = date('t', $firstDayOfMonth);
$startDayOfWeek = date('w', $firstDayOfMonth); // 0 (Sun) to 6 (Sat)


$shortest = isset($data['shortest']) ? $data['shortest'] : 21;
$longest = isset($data['longest']) ? $data['longest'] : 35;
$average = isset($data['average']) ? $data['average'] : 28;
$cycleLength = $average; 


$periodLength = 5;

$fertileStart = isset($data['fertile_start']) ? $data['fertile_start'] : 8;
$fertileEnd = isset($data['fertile_end']) ? $data['fertile_end'] : 17;

if ($fertileStart <= $periodLength) {
    $displayFertileStart = $periodLength + 2; // Day 7 (after 5-day period + 1 follicular day)
} else {
    $displayFertileStart = $fertileStart;
}

$ovulationStart = $shortest - 14;
$ovulationEnd = $longest - 14;

$ovulationDay = round(($ovulationStart + $ovulationEnd) / 2);
$ovulationDayEnd = $ovulationDay + 1;

$lastPeriodDate = isset($data['last_period_date']) ? $data['last_period_date'] : date('Y-m-d', strtotime('-' . $average . ' days'));


if ($lastPeriodDate) {
    $lastPeriodTimestamp = strtotime($lastPeriodDate);
    $lastPeriodDay = date('j', $lastPeriodTimestamp);
    $lastPeriodMonth = date('n', $lastPeriodTimestamp);
    $lastPeriodYear = date('Y', $lastPeriodTimestamp);
} else {

    $lastPeriodDay = 4;
    $lastPeriodMonth = 12;
    $lastPeriodYear = 2025;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Your Fertility Calendar - Safe Days</title>
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
<body>

<div class="container">
    <div class="header-section">
        <div class="logo-title">
            <div class="logo">🌸</div>
            <h1>Your Cycle Calendar</h1>
        </div>
        <p class="month-title"><?= date('F Y') ?></p>
    </div>

    <div class="calendar-card">
        <div class="legend">
            <div class="legend-item">
                <div class="legend-box legend-menstruation"></div>
                <span><strong>Menstruation</strong><br>Period days</span>
            </div>
            <div class="legend-item">
                <div class="legend-box legend-follicular"></div>
                <span><strong>Follicular Phase</strong><br>Pre-ovulation</span>
            </div>
            <div class="legend-item">
                <div class="legend-box legend-fertile"></div>
                <span><strong>Fertile Window</strong><br>High chance</span>
            </div>
            <div class="legend-item">
                <div class="legend-box legend-ovulation"></div>
                <span><strong>Ovulation Peak</strong><br>Highest fertility</span>
            </div>
            <div class="legend-item">
                <div class="legend-box legend-luteal"></div>
                <span><strong>Luteal Phase</strong><br>Post-ovulation</span>
            </div>
            <div class="legend-item">
                <div class="legend-box legend-safe"></div>
                <span><strong>Safe Days</strong><br>Less fertile</span>
            </div>
        </div>

        <div class="calendar">
            <!-- Weekday headers -->
            <div class="header">Sun</div>
            <div class="header">Mon</div>
            <div class="header">Tue</div>
            <div class="header">Wed</div>
            <div class="header">Thu</div>
            <div class="header">Fri</div>
            <div class="header">Sat</div>

            <!-- Empty slots for days before the first day -->
            <?php for ($i = 0; $i < $startDayOfWeek; $i++): ?>
                <div class="empty"></div>
            <?php endfor; ?>

            <!-- Days of the month -->
            <?php 
            for ($day = 1; $day <= $daysInMonth; $day++):
                // Create timestamp for current calendar day
                $currentDayTimestamp = mktime(0, 0, 0, $month, $day, $year);
                $lastPeriodFullTimestamp = mktime(0, 0, 0, $lastPeriodMonth, $lastPeriodDay, $lastPeriodYear);
                
                // Calculate days since last period started
                $daysSinceLastPeriod = floor(($currentDayTimestamp - $lastPeriodFullTimestamp) / (60 * 60 * 24));
                
                // Calculate cycle day (1-based)
                $dayOfCycle = ($daysSinceLastPeriod % $cycleLength) + 1;
                if ($daysSinceLastPeriod < 0) {
                    // Before last period - calculate from previous cycle
                    $dayOfCycle = $cycleLength + $daysSinceLastPeriod + 1;
                }
                
                // Determine phase and class based on cycle day
                if ($dayOfCycle >= 1 && $dayOfCycle <= $periodLength) {
                    $class = 'menstruation';
                    $phase = 'Period';
                } elseif ($dayOfCycle > $periodLength && $dayOfCycle < $displayFertileStart) {
                    // Follicular phase: after period but before fertile window
                    $class = 'follicular';
                    $phase = 'Follicular';
                } elseif ($dayOfCycle >= $ovulationDay && $dayOfCycle <= $ovulationDayEnd) {
                    // Peak ovulation days (2 days in middle of fertile window)
                    $class = 'ovulation';
                    $phase = 'Ovulation';
                } elseif ($dayOfCycle >= $displayFertileStart && $dayOfCycle <= $fertileEnd) {
                    // Fertile window (includes days around ovulation)
                    $class = 'fertile';
                    $phase = 'Fertile';
                } elseif ($dayOfCycle > $fertileEnd && $dayOfCycle <= $cycleLength) {
                    $class = 'luteal';
                    $phase = 'Luteal';
                } else {
                    $class = 'safe';
                    $phase = 'Safe';
                }
            ?>
                <div class="day <?= $class ?>">
                    <?= $day ?>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-box">
            <div class="stat-number"><?= $shortest ?></div>
            <div class="stat-label">Shortest Cycle</div>
        </div>
        <div class="stat-box">
            <div class="stat-number"><?= $average ?></div>
            <div class="stat-label">Average Cycle</div>
        </div>
        <div class="stat-box">
            <div class="stat-number"><?= $longest ?></div>
            <div class="stat-label">Longest Cycle</div>
        </div>
        <div class="stat-box">
            <div class="stat-number"><?= ($fertileEnd - $displayFertileStart + 1) ?></div>
            <div class="stat-label">Fertile Days</div>
        </div>
    </div>

    <div class="info-card">
        <h3><span class="warning-icon">⚠️</span> Important Information</h3>
        <p>
            This calendar shows your menstrual cycle phases for <?= date('F Y') ?> based on your cycle data.
            <br><strong>Menstruation</strong> is your period (days 1-<?= $periodLength ?>). 
            <br><strong>Follicular Phase</strong> is when your body prepares for ovulation. 
            <br><strong>Fertile Window</strong> (light pink) is when pregnancy is possible (days <?= $displayFertileStart ?>-<?= $fertileEnd ?>). 
            <br><strong>Ovulation Peak</strong> (dark pink) is when you're MOST fertile - typically days <?= $ovulationDay ?>-<?= $ovulationDayEnd ?>. 
            <br><strong>Luteal Phase</strong> is after ovulation. 
            <strong>Safe Days</strong> have lower fertility. 
            
        </p>
    </div>
</div>

</body>
</html>