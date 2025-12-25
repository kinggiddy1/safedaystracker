<?php
require_once('loader.php');
require_once('redirect.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST["login"]) && !empty($_POST["email"]) && !empty($_POST["password"])){
    $email   = $_POST["email"];
    $password   = $_POST["password"];

        loginUser($email,$password);  
}

function loginUser($email,$password){
    global $process;
    $password = hash("sha256",$password);
    if($user = $process->GetRow("SELECT * FROM users WHERE users.email = ? AND users.password = ? AND status='active'",["$email","$password"])){
        $_SESSION['type'] = $user['role'];
        $_SESSION['userPhone'] = $user['phone'];
        $_SESSION['userEmail'] = $user['email'];
        $_SESSION['username'] = $user['names'];
        $_SESSION['userId'] = $user['id'];
        $User_ID = $_SESSION['userId'];
        $_SESSION['userType'] = $user['role'];
        $_SESSION['user_password'] = "true";

        redirect($email,"true",$user['role']);
    }
        if($user = $process->GetRow("SELECT * FROM users WHERE users.email = ? AND users.password = ? AND status ='Not active'",["$email","$password"]))
            {
            echo "<script>alert('First verify your email with verification codes sent to your email');document.location='verification.php'</script>";
             }
        else if($user = $process->GetRow("SELECT * FROM users WHERE users.email = ? AND users.password = ? AND status ='deleted'",["$email","$password"]))
            {
                echo "<script>alert('Your account has been suspended please contact The Focal Media');document.location='login.php'</script>";
             }
        else  echo "<script>alert('Invalid username or password');document.location='login.php'</script>";
}



if(isset($_GET["id"])){
    $userId = $_GET["id"];

    $result = $process->DeletingData("DELETE FROM users WHERE id = ?",["$userId"]);
    if($result){
        echo "<script>alert('User deleted successfully');document.location='users.php'</script>";
}  
 else echo "<script>alert('Error deleting user');document.location='users.php'</script>";
}



if(isset($_POST["save_cycles"])){
    $cycle_dates = $_POST["period_dates"];
    $userId = $_SESSION['userId'];

    foreach($cycle_dates as $date) {
        $process->InsertData("INSERT INTO cycles (user_id, period_start_date) VALUES (?, ?)", ["$userId", "$date"]);
    }
if($process){
        echo "<script>alert('Cycles saved successfully');document.location='cycles'</script>";
}  
 else echo "<script>alert('Error saving cycles');document.location='add-cycle.php'</script>";
}


?>
