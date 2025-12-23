<?php
require_once('loader.php');

// DEBUG: Let's see what's in the session
echo "<pre style='background: #f0f0f0; padding: 10px; margin: 10px;'>";
echo "DEBUG INFO:\n";
echo "Session userId: " . (isset($_SESSION['userId']) ? $_SESSION['userId'] : 'NOT SET') . "\n";
echo "Session user_id: " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'NOT SET') . "\n";
echo "All Session Keys: " . print_r(array_keys($_SESSION), true) . "\n";
echo "</pre>";

$userId = $_SESSION['userId'];

$userData = $process->GetRow("SELECT names, email FROM users WHERE id = ?",["$userId"]);

// DEBUG: Check if we're fetching cycles
echo "<pre style='background: #fff3cd; padding: 10px; margin: 10px;'>";
echo "Fetching cycles for user_id: $userId\n";

$cycleData = $process->GetRows("SELECT * FROM cycles WHERE user_id = ? 
ORDER BY cycle_id DESC 
LIMIT 6 ",["$userId"]);

echo "Number of cycles found: " . count($cycleData) . "\n";
echo "Cycle Data:\n";
print_r($cycleData);
echo "</pre>";