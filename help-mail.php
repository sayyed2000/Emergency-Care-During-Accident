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
$mail->addAddress($_SESSION["hospital_mail"]);
$mail->addBCC($_SESSION["police_mail"]);
$mail->addBCC($_SESSION["firebrigade_mail"]);
//$mail->addBCC('bcc@example.com'); 
 
// Set email format to HTML 
$mail->isHTML(true); 
 
// Mail subject 
$mail->Subject = 'Help Email'; 
 
// Mail body content 
$bodyContent = "Victim Name = ".$_SESSION["fname"]." ".$_SESSION["lname"]."<br>"."Mobile Number : ".$_SESSION["pnumber"]."<br>"."Coordinates :".$_SESSION["lat"]."<br>".$_SESSION["lon"]; 
$mail->Body    = $bodyContent;


//TRY
if($_SESSION["hospital_mail"] && $_SESSION["police_mail"] && $_SESSION["firebrigade_mail"])
{
    $_SESSION["pref"] = "Hospital Police and Firebrigade";
}

if($_SESSION["hospital_mail"] )
{
    $_SESSION["pref"] = "Hospital Only";
}

if($_SESSION["police_mail"] )
{
    $_SESSION["pref"] = "Police Only";
}

if($_SESSION["firebrigade_mail"])
{
    $_SESSION["pref"] = "Firebrigade Only";
}

if($_SESSION["hospital_mail"] && $_SESSION["police_mail"] )
{
    $_SESSION["pref"] = "Hospital and Police";
}

if($_SESSION["hospital_mail"] && $_SESSION["firebrigade_mail"])
{
    $_SESSION["pref"] = "Hospital and Firebrigade";
}

if($_SESSION["police_mail"] && $_SESSION["firebrigade_mail"])
{
    $_SESSION["pref"] = "Police and Firebrigade";
}
 
// Send email 
if(!$mail->send())
{ 
    header("location:account.php?servererr=1");
}
else
{ 
    header("location:account.php?sent=1");
} 

?>