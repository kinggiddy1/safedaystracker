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



if(isset($_POST["update_cycle"])){
    $cycleID = $_POST["cycle_id"];
    $period_start_date = $_POST["period_start_date"];
    $userId = $_SESSION['userId'];

    $process->UpdateData("UPDATE cycles SET period_start_date = ? WHERE cycle_id = ? AND user_id = ?", ["$period_start_date", "$cycleID", "$userId"]);
if($process){
        echo "<script>alert('Cycles updated successfully');document.location='cycles'</script>";
}  
 else echo "<script>alert('Error updating cycles');document.location='add-cycle.php'</script>";
}

if (isset($_GET["cycle_id"])) {
    $cycleID = $_GET["cycle_id"];
    $userId = $_SESSION['userId'];

    $process->DeletingData(
        "DELETE FROM cycles WHERE cycle_id = ? AND user_id = ?",
        [$cycleID, $userId]
    );

    if ($process) {
        echo "<script>alert('Cycle deleted successfully');document.location='cycles'</script>";
    } else {
        echo "<script>alert('Error deleting cycle');document.location='cycles'</script>";
    }
}



if(isset($_POST['register'])){
    $guid = md5(rand(1000000,1));
    $names = htmlspecialchars($_POST['names']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    if (isDisposableEmail($email)) {
    echo "<script>alert('Temporary or disposable emails are not allowed.'); document.location='register'</script>";
    exit();
    }
    $role = $_POST['role'];
    $currency = $_POST['currency'];
    $password = $_POST['password'];
    $verification = substr(number_format(time()*rand(),0,'',''),0,6);

    if (!preg_match('/^[0-9]{10,15}$/', $role)) {
        echo "<script>alert('Please enter a valid phone number'); document.location='register'</script>";
        exit();
    }

    if(session_status() !== PHP_SESSION_ACTIVE){
		session_start();
	}
    $_SESSION['userPhone'] = $role;
    $_SESSION['userEmail'] = $email;
    $_SESSION['username'] = $names;
    $_SESSION['password'] = hash("sha256",$password);
    $_SESSION['userType'] = $role;

    if($_SERVER['REQUEST_METHOD'] == 'POST')

    {
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = '6LcIE5wpAAAAADhVGynk7vBygaAw510SyWTIN03W';
        $recaptcha_response = $_POST['g-recaptcha-response'];
        $recaptcha = file_get_contents($recaptcha_url.'?secret='.$recaptcha_secret.'&response='.$recaptcha_response);

    $recaptcha = json_decode($recaptcha,true);

    if($recaptcha['success'] == 1 && $recaptcha['hostname'] =='thefocalmedia.com')

    if ($process->Check("SELECT * FROM users WHERE email like  ?",["$email"])){
        echo "<script>alert('The user already exists');document.location='register'</script>";
       }
       else{
   
    if($process->UpdateData("INSERT INTO `users` ( `user_guid`,`names`,`email`,`phone`,`password`,`verification_codes`,`currency`) VALUES (?,?,?,?,?,?,?)",["$guid","$names","$email","$role",hash("sha256","$password"),"$verification","$currency"])){
        $update = $process->UpdateData("INSERT INTO notify (notifications) VALUES (-5)");
        require "vendor/autoload.php";

        $mail = new PHPMailer(true);
        try {
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
            $mail->isSMTP();                                          
            $mail->Host       = "smtp.gmail.com";                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = "thefocalmedia2022@gmail.com";                    
            $mail->Password   = "wlvsustsfmxtrnqv";                              
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            
            $mail->Port       = 587;                                   
        
            // $mail->setFrom($email, 'The Focal Media'); 
            $mail->setFrom('thefocalmedia2022@gmail.com', 'The Focal Media');
            $mail->addAddress($email, $names);     

            $mail->isHTML(true);                            
            $mail->Subject = 'Email verification code';
            $mail->Body = '<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #0D3069;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 26px;
        }
        .content {
            padding: 30px;
            color: #333333;
            line-height: 1.5;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .verification-box {
            background-color: #f2f9ff;
            border: 1px solid #d0e6fb;
            border-radius: 5px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }
        .verification-code {
            font-size: 28px;
            font-weight: bold;
            color: #0D3069;
            margin: 10px 0;
            letter-spacing: 2px;
        }
        .verification-label {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333333;
        }
        .button {
            display: inline-block;
            background-color: #0D3069;
            color: #ffffff;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .button:hover {
            background-color: #0D3069;
            color: #ffffff;
        }
        .footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666666;
            background-color: #f9f9f9;
            border-top: 1px solid #eeeeee;
        }
        .warning {
            font-style: italic;
            text-align: center;
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #eeeeee;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Email Verification</h1>
        </div>
        <div class="content">
            <p class="greeting">Hello, '.$names.'!</p>
            
            <p>We are so excited to see you getting started!<br>
            Please verify your email address to continue.</p>
            
            <div class="verification-box">
                <p class="verification-label">Here is your Verification Code:</p>
                <p class="verification-code">'.$verification.'</p>
            </div>
            
            <div style="text-align: center;">
                <a href="https://thefocalmedia.com/verification?v='.$verification.'" class="button" style="color: white;">Click here to verify</a>
            </div>
            
            <p class="warning"><b>If it is not you creating an account, just ignore this message!</b></p>
        </div>
        <div class="footer">
            <p>&copy; ' . date("Y") . ' The Focal Media. All rights reserved.</p>
        </div>
    </div>
</body>
</html>';
            $mail->send();
           
        } catch (Exception $e) {
            echo "Message could not be sent... : {$mail->ErrorInfo}";
        }
        
        echo "<script>alert('We sent a verification code on your email, or Check in Spam');document.location='verification.php'</script>";

         }else{
             echo "failed to save";
         }}
         echo "<script>alert('registration Failed resolve reCAPTCHA first !');document.location='register'</script>";
        }
}

?>
