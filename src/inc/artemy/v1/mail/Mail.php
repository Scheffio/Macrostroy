<?php

namespace inc\artemy\v1\mail;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mail
{
    public static function send(string $recipient_email, string $subject, string $body, string $alt_body): bool
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->CharSet = "utf-8";
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.gmail.com';                           //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                     //Enable SMTP authentication
            $mail->Username = 'mailfortestsend@gmail.com';                       //SMTP username
            $mail->Password = 'jeyypzvkfsncddqh';                                 //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port = 465;                                          //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('mailfortestsend@gmail.com', 'Macrostroy');
            $mail->addAddress($recipient_email);               //Name is optional

            //Content
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = $alt_body;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}