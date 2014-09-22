<?php
//$uWeb_mailto = "marhazk@yahoo.com"; //receiver


$to      = $uWeb_mailto;

$headers = 'From: '.$uWeb_mailhead . "\r\n" .
//$headers = 'From: $uWeb_mailfrom' . "\r\n" .
    'Reply-To: '.$uWeb_mailto . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
ini_set ( "SMTP", "mail.perfectworld.my" );
date_default_timezone_set('Asia/Kuching');

mail($to, $subject, $message, $headers);
?>
