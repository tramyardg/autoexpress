<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';


$mail = new PHPMailer(true);
try { 
	
	$mail->SMTPDebug = 2;
	$mail->IsSMTP();
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 25; // or 465
	$mail->SMTPSecure = "tls"; // or 'tls'
	$mail->SMTPAuth = true;
	$mail->Username = "raymart54@gmail.com";
	$mail->Password = "9d?]NQr<";

	if (!empty($_POST['submit_referral'])) {
		$senderName = $_POST['sender-name'];
		$senderEmail = $_POST['sender-email'];
		$receiverEmail = $_POST['receiver-email'];
		$message = $_POST['message'];
		
		$inputs = array(
			"senderName" => $senderName,
			"senderEmail" => $senderEmail,
			"receiverEmail" => $receiverEmail,
			"message" => $message
		);
		
		//print_r($inputs);
		
		
		//Recipients
		$mail->setFrom($inputs['senderEmail']);
		$mail->addAddress($inputs['receiverEmail']);     
		//$mail->addReplyTo($senderEmail, 'Information');
		//$mail->addCC($senderEmail);
		//$mail->addBCC($mail->Username);

		//Content
		$mail->isHTML(true);                                  
		$mail->Subject = 'Here is the subject';
		$mail->Body = '<b>' . $inputs['message'] . '</b>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
		echo 'Message has been sent';
	}
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}


