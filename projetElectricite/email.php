<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$mail = new PHPMailer;

$mail->isSMTP(); // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com'; // Specify SMTP server
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->Username = ''; // SMTP username
$mail->Password = ''; // SMTP password
$mail->SMTPSecure = 'tls'; // Enable TLS encryption
$mail->Port = 587; // TCP port to connect to


$mail->setFrom('', 'Gestion_Electricite');


?>