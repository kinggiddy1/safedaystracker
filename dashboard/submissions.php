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



if(isset($_POST["addproducts"])){
    $pname   = $_POST["pname"];
    $pcategory   = $_POST["pcategory"];


    $pic_status = 1;

    if (!file_exists('productimage')) {
        mkdir('productimage', 0777, true); // Create productimage directory if it doesn’t exist
    }

    $fileCount = count($_FILES["image"]['name']);
    for ($i = 0; $i < $fileCount; $i++) {
        $RandomNum = time();
        $ImageName = str_replace(' ', '-', strtolower($_FILES['image']['name'][$i]));
        $ImageExt = pathinfo($ImageName, PATHINFO_EXTENSION);
        $NewImageName = uniqid() . '.' . $ImageExt;
        $output_path = "productimage/" . $NewImageName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"][$i], $output_path)) {

            $result = $process->InsertingData("INSERT INTO products (name, category, image) VALUES (?, ?, ?)",["$pname","$pcategory","$output_path"]);
            if($result) {
                 echo "<script>alert('Image uploaded successfully');document.location='dashboard.php'</script>";

            } else {
                echo "Failed to upload " . $_FILES['image']['name'][$i];
            }
        }
    }
}


?>
