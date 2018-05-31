<?php

class ReferralMailer
{

    private $receiverEmails = array();
    private $subject;
    private $message;
    private $headers;
    private $isSent = true;

    public function __construct()
    {
    }

    public function setReceiverEmails($receiverEmails)
    {
        $this->receiverEmails = $receiverEmails;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    public function isIsSent()
    {
        return $this->isSent;
    }

    public function referralMail()
    {
        for ($i = 0; $i < count($this->receiverEmails); $i++) {
            $to = $this->receiverEmails[$i];
            if (!mail($to, $this->subject, $this->message, $this->headers)) {
                $this->isSent = false;
                break;
            }
        }
    }
}