<?php
require_once("loader.php");
// session_start();
$User_ID = $_SESSION['userId'];

session_destroy(); 
unset($_SESSION["email"]);
unset($_SESSION["password"]);
header("location:login.php");
?>