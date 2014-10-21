<?php

require_once 'src/lib/php_mailer/PHPMailerAutoload.php';

$Mail = new PHPMailer();
$Mail->IsSMTP(); // Use SMTP
$Mail->Host = "smtp.gmail.com"; // Sets SMTP server
$Mail->SMTPDebug = 2; // 2 to enable SMTP debug information
$Mail->SMTPAuth = TRUE; // enable SMTP authentication
$Mail->SMTPSecure = "tls"; //Secure conection
$Mail->Port = 587; // set the SMTP port
//$Mail->Username = 'germannparisi@gmail.com'; // SMTP account username
$Mail->Username = 'germanparisi@bbs.frc.utn.edu.ar'; 
$Mail->Password = '*******'; // SMTP account password
$Mail->Priority = 1; // Highest priority - Email priority (1 = High, 3 = Normal, 5 = low)
$Mail->CharSet = 'UTF-8';
$Mail->Encoding = '8bit';
$Mail->Subject = 'Asunto';
$Mail->ContentType = 'text/html; charset=utf-8\r\n';
$Mail->From = 'germanparisi@bbs.frc.utn.edu.ar';
$Mail->FromName = 'TITULO MAS COPADO - ALERTAAAAAA!';
$Mail->WordWrap = 900; // RFC 2822 Compliant for Max 998 characters per line

$Mail->AddAddress('santosdiegob@gmail.com'); // To:
$Mail->isHTML(TRUE);
$Mail->Body = '<h2>Hola Diego. Andá a programar.</h2>';
$Mail->AltBody = 'Programar';
$Mail->Send();
$Mail->SmtpClose();

if ($Mail->IsError()) {
    echo "ERROR<br /><br />";
} else {
    echo "OK<br /><br />";
}