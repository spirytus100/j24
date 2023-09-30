<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "/home/jovhmax/www/includes/PHPMailer.php";
require "/home/jovhmax/www/includes/Exception.php";
require "/home/jovhmax/www/includes/SMTP.php";


class MyMailer {
    public $mail_host;
    public $mail;

    function __construct($mail_host) {
        $this->mail_host = $mail_host;
        $this->mail = new PHPMailer(true);
    }

    function default_settings() {
        $this->mail->CharSet = "UTF-8";
        #$this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port = 465;
    }

    function html_content() {
        $this->mail->isHTML(true);
    }

    function clear_target_email() {
        $this->mail->clearAllRecipients();
    }

    function send_mail($login, $password, $to, $subject, $body) {
        try {
            $this->mail->Host = $this->mail_host;
            $this->mail->Username = $login;
            $this->mail->Password = $password;
        
            $this->mail->SetFrom($login, "j24 app");
            $this->mail->addAddress($to);
        
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            $this->mail->send();

        } catch (Exception $e) {
            return $this->mail->ErrorInfo; 
        }
        return true;
    }
}

?>