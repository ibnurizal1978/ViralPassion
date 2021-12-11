<?php
ini_set('display_errors',1);  error_reporting(E_ALL);
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '/vendor/PHPMailer/src/Exception.php';
require '/vendor/PHPMailer/src/PHPMailer.php';
require '/vendor/plugins/PHPMailer/src/SMTP.php';

    
$mail = new PHPMailer(true);
$mail->isSMTP();    
$mail->Mailer     = "smtp";   
$mail->Host       = 'mail.viralpassion.net';                      //'smtp.office365.com'
$mail->SMTPAuth   = true;       
$mail->Username   = 'support@viralpassion.net';                     //afd@assisihospice.org.sg
$mail->Password   = 'PengenViral@888';                               //Muc36340
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  
$mail->Port       = 465;            
$mail->SMTPSecure = 'tls';
$mail->SMTPAutoTLS = false;
$mail->SMTPKeepAlive = true;
$mail->setFrom('support@viralpassion.net', 'VP (no reply)'); //'afd@assisihospice.org.sg', 'Assisi Funday (no reply)'
$mail->addAddress('ibnurizal@gmail.com', 'hhh');
// if($ada == 1) { $mail->addAttachment($file); }
$mail->isHTML(true); 
$mail->Subject = 'godeg';
$mail->Body    = 'ta best';

if(!$mail->send()) {
    echo 'Message was not sent.';
    echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent:';
} 
?>