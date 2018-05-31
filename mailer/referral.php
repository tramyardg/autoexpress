<?php

require 'ReferralMailer.php';

if (isset($_POST)) {
    if (!empty($_POST)) {
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "Cc: raymart54@gmail.ca";

        $referralEmailsArray = explode(', ', $_POST['receiverEmail']);

        $referralMailer = new ReferralMailer();
        $referralMailer->setReceiverEmails($referralEmailsArray);
        $referralMailer->setSubject('Your friend ' . $_POST['senderName'] . ' refers a vehicle to you.');
        $referralMailer->setMessage('With the message that is: ' . $_POST['message']);
        $referralMailer->setHeaders($headers);
        $referralMailer->referralMail();

        if ($referralMailer->isIsSent()) {
            echo 1;
        }
    }
}