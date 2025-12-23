<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Get period dates and sort them chronologically
$periodDates = $_POST['period_dates'];
sort($periodDates);

// Convert to starts and ends format for compatibility with existing logic
$starts = [];
$ends = [];

for ($i = 0; $i < count($periodDates) - 1; $i++) {
    $starts[] = $periodDates[$i];
    $ends[] = $periodDates[$i + 1];
}

// Now continue with your exact existing logic
$cycleLengths = [];

for ($i = 0; $i < count($starts); $i++) {
    if (!empty($starts[$i])) {
        $start = new DateTime($starts[$i]);
        $end   = new DateTime($ends[$i]);

        $diff = $start->diff($end)->days;

        if ($diff >= 21 && $diff <= 35) {
            $cycleLengths[] = $diff;
        }
    }
}

if (count($cycleLengths) < 3) {
    session_start();
    $_SESSION['error'] = [
        'message' => 'Please record at least 3 Consecutive cycles for reliable prediction.',
        'cycles_provided' => count($cycleLengths)
    ];
    header('Location: error');
    exit;
}

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

$lastPeriodDate = end($ends); 

session_start();
$_SESSION['data'] = [
    'cycles' => $cycleLengths,
    'shortest' => $shortest,
    'longest' => $longest,
    'average' => $average,
    'fertile_start' => $fertileStart,
    'fertile_end' => $fertileEnd,
    'last_period_date' => $lastPeriodDate  
];

header('Location: result');