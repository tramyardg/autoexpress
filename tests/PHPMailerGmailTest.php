<?php

class PHPMailerGmailTest extends PHPUnit_Framework_TestCase
{
    public function testMailer()
    {
        $emails = 'storagelenovo001@gmail.com, leo@gmail.com';
        $emailsArray = explode(', ', $emails);
        echo $emailsArray[0];
    }
}
