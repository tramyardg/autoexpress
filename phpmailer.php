<?php

require_once 'vendor/autoload.php';

$mail = new PHPMailer;

//Server settings
$mail->SMTPDebug = 1;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls'; // or 'tls'
$mail->Port = 587; // or 465
$mail->Username = "raymart54@gmail.com";
$mail->Password = "password";

//Recipients
$mail->setFrom("example@gmail.com");
$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('info@example.com', 'Information');
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');

//Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message has been sent successfully.";
}

// todo make a function for multiple email to be send


