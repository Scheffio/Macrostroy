<?php


namespace inc\artemy\v1\email_sender;

use Delight\Auth\InvalidEmailException;
use Delight\Base64\Throwable\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class MailSender
{
    public static function sendAccountCreatedByAdmin($mail_receiver, $link): bool
    {
        return self::send(
            $mail_receiver,
            "Ваш аккаунт был создан администратором",
            "  <h1>Здравствуйте!</h1>
                    <p>Ваш аккаунт был создан администратором. Перейдите по ссылке и придумайте пароль. Ссылка действует только 24 часа.</p>
                    <br>
                    <a href='$link'>Изменить пароль</a>
                    <br>
                    <pre>Не работает кнопка? Скопируйте ссылку и вставьте в окно браузера: $link</pre>",
            "Ваш аккаунт был создан администратором. Перейдите по ссылке и придумайте пароль. Ссылка действует только 24 часа. \n$link"
        );
    }

    public static function sendPasswordChange($mail_receiver, $link_to_change_password): bool
    {
        return self::send(
            $mail_receiver,
            "Вы запросили восстановление пароля",
            "  <h1>Здравствуйте!</h1>
                    <p>Забыли пароль? Перейдите по ссылке и придумайте новый пароль. Ссылка действует только 24 часа. Если вы не отправляли запрос на восстановление пароля, то не обращайте внимания на это письмо.</p>
                    <br>
                    <a href='$link_to_change_password'>Изменить пароль</a>
                    <br>
                    <pre>Не работает кнопка? Скопируйте ссылку и вставьте в окно браузера: $link_to_change_password</pre>",
            "Забыли пароль? Перейдите по ссылке и придумайте новый пароль. Ссылка действует только 24 часа. Если вы не отправляли запрос на восстановление пароля, то не обращайте внимания на это письмо. \n$link_to_change_password"
        );
    }

    /**
     * @throws \PHPMailer\PHPMailer\Exception
     */
    private static function instance(): PHPMailer
    {

        //Server settings
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();                                                    //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                             //Enable SMTP authentication
        $mail->Username = 'mailfortestsend@gmail.com';                      //SMTP username
        $mail->Password = 'jeyypzvkfsncddqh';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                    //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = 465;                                                  //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->setFrom('admin@ithelpdeskdemo.xyz');
        $mail->isHTML(true);                                                //Set email format to HTML

        return $mail;
    }

    public static function send($mail_receiver, string $subject, string $body, string $alt_body): bool
    {
        try {
            $mail = self::instance();
            $mail->addAddress($mail_receiver);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = $alt_body;
            return $mail->send();
        } catch (\PHPMailer\PHPMailer\Exception) {
            return false;
        }
    }
}