<?php
session_start();

if (!isset($_SESSION['userId'])) {
    header('Location: login.php');
    exit;
}
require_once('loader.php');

$userId = $_SESSION['userId'];
$cycleData = $process->GetRow("SELECT * FROM cycles WHERE cycle_id = ? 
ORDER BY cycle_id DESC 
LIMIT 6 ",["$userId"]);

if (empty($cycleData)) {
    $_SESSION['error'] = [
        'message' => 'No cycle data found. Please record your cycles first.',
        'cycles_provided' => 0
    ];
    header('Location: error');
    exit;
}

$cycleLengths = [];
$starts = [];
$ends = [];

// Process database results instead of POST data
foreach ($cycleData as $cycle) {
    if (!empty($cycle['cycle_start_date']) && !empty($cycle['cycle_end_date'])) {
        $start = new DateTime($cycle['cycle_start_date']);
        $end   = new DateTime($cycle['cycle_end_date']);
        
        $diff = $start->diff($end)->days;
        
        if ($diff >= 21 && $diff <= 35) {
            $cycleLengths[] = $diff;
            $starts[] = $cycle['cycle_start_date'];
            $ends[] = $cycle['cycle_end_date'];
        }
    }
}


$cycleLengths = [];

for ($i = 0; $i < count($starts); $i++) {
    if (!empty($starts[$i]) && !empty($ends[$i])) {
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
    header('Location: error.php');
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