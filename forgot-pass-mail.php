<?php 

require_once("config.php");
 
// Import PHPMailer classes into the global namespace

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
 
require 'PHPMailer/Exception.php'; 
require 'PHPMailer/PHPMailer.php'; 
require 'PHPMailer/SMTP.php'; 
 
$mail = new PHPMailer; 
 
$mail->isSMTP();                      // Set mailer to use SMTP 
$mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
$mail->SMTPAuth = true;               // Enable SMTP authentication 
$mail->Username = 'sender email';   // SMTP username 
$mail->Password = 'sender email password';   // SMTP password 
$mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
$mail->Port = 587;                    // TCP port to connect to 
 
// Sender info 
$mail->setFrom('sender email', 'MMMKA'); 
$mail->addReplyTo('sender email', 'MMMKA'); 
 
// Add a recipient 
$mail->addAddress($_SESSION["email_id"]); 
 
//$mail->addCC('cc@example.com'); 
//$mail->addBCC('bcc@example.com'); 
 
// Set email format to HTML 
$mail->isHTML(true); 
 
// Mail subject 
$mail->Subject = 'Password reset Email'; 
 
// Mail body content 
$bodyContent = "Your password reset link <br> http://https://absayyed.000webhostapp.com/password-reset.php?token=".$_SESSION["email_token"]." 
<br> Reset your password with this link .Click or open in new tab<br><br> <br> <br>"; 
$mail->Body    = $bodyContent; 
 
// Send email 
if(!$mail->send()) { 
    header("location:forgot-pass.php?servererr=1");
} else { 
    header("location:forgot-pass.php?sent=1");
} 
 
?>