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
            '<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title>Estimin</title>
    <!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]-->
    <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
    <!--[if gte mso 9]>
    <xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG></o:AllowPNG>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <link rel="stylesheet" href="/static/create-password-email/style.css">
    <style type="text/css">
    @import url("https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
    #outlook a {
            padding: 0;
        }

        .es-button {
            mso-style-priority: 100 !important;
            text-decoration: none !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        .es-desk-hidden {
            display: none;
            float: left;
            overflow: hidden;
            width: 0;
            max-height: 0;
            line-height: 0;
            mso-hide: all;
        }

        [data-ogsb] .es-button {
            border-width: 0 !important;
            padding: 10px 20px 10px 20px !important;
        }

        @media only screen and (max-width:600px) {

            p,
            ul li,
            ol li {
                line-height: 150%
            }

            h1,
            h2,
            h3 {
                line-height: 120%
            }

            h1 {
                font-size: 30px;
                text-align: left
            }

            h2 {
                font-size: 24px;
                text-align: left
            }

            h3 {
                font-size: 20px;
                text-align: left
            }

            .es-header-body p,
            .es-header-body ul li,
            .es-header-body ol li{
                font-size: 14px
            }

            .es-content-body p,
            .es-content-body ul li,
            .es-content-body ol li{
                font-size: 14px
            }

            .es-footer-body p,
            .es-footer-body ul li,
            .es-footer-body ol li{
                font-size: 14px
            }

            .es-infoblock p,
            .es-infoblock ul li,
            .es-infoblock ol li{
                font-size: 12px
            }

            *[class="gmail-fix"] {
                display: none !important
            }

            .es-m-txt-c,
            .es-m-txt-c h1,
            .es-m-txt-c h2,
            .es-m-txt-c h3 {
                text-align: center !important
            }

            .es-m-txt-r,
            .es-m-txt-r h1,
            .es-m-txt-r h2,
            .es-m-txt-r h3 {
                text-align: right !important
            }

            .es-m-txt-l,
            .es-m-txt-l h1,
            .es-m-txt-l h2,
            .es-m-txt-l h3 {
                text-align: left !important
            }

            .es-m-txt-r img,
            .es-m-txt-c img,
            .es-m-txt-l img {
                display: inline !important
            }

            .es-button-border {
                display: inline-block !important
            }

            a.es-button,
            button.es-button {
                font-size: 18px !important;
                display: inline-block !important
            }

            .es-adaptive table,
            .es-left,
            .es-right {
                width: 100% !important
            }

            .es-content table,
            .es-header table,
            .es-footer table,
            .es-content,
            .es-footer,
            .es-header {
                width: 100% !important;
                max-width: 600px !important
            }

            .es-adapt-td {
                display: block !important;
                width: 100% !important
            }

            .adapt-img {
                width: 100% !important;
                height: auto !important
            }

            .es-m-p0 {
                padding: 0px !important
            }

            .es-m-p0r {
                padding-right: 0px !important
            }

            .es-m-p0l {
                padding-left: 0px !important
            }

            .es-m-p0t {
                padding-top: 0px !important
            }

            .es-m-p0b {
                padding-bottom: 0 !important
            }

            .es-m-p20b {
                padding-bottom: 20px !important
            }

            .es-mobile-hidden,
            .es-hidden {
                display: none !important
            }

            tr.es-desk-hidden,
            td.es-desk-hidden,
            table.es-desk-hidden {
                width: auto !important;
                overflow: visible !important;
                float: none !important;
                max-height: inherit !important;
                line-height: inherit !important
            }

            tr.es-desk-hidden {
                display: table-row !important
            }

            table.es-desk-hidden {
                display: table !important
            }

            td.es-desk-menu-hidden {
                display: table-cell !important
            }

            .es-menu td {
                width: 1% !important
            }

            table.es-table-not-adapt,
            .esd-block-html table {
                width: auto !important
            }

            table.es-social {
                display: inline-block !important
            }

            table.es-social td {
                display: inline-block !important
            }

            * {
                box-sizing: border-box;
                -webkit-user-drag: none;
              }
              
              a,
              button {
                cursor: pointer;
              }
              
              body,
              html {
                margin: 0;
                padding: 0;
              }
              
              body.fixated {
                overflow: hidden;
              }
              
              *::-webkit-scrollbar {
                width: 6px;
              }
              
              *::-webkit-scrollbar-track {
                border-radius: 0px;
                background-color: #F4F4F4;
              }
              
              *::-webkit-scrollbar-track:hover {
                background-color: #F4F4F4;
              }
              
              *::-webkit-scrollbar-track:active {
                background-color: #EBE9E9;
              }
              
              *::-webkit-scrollbar-thumb {
                border-radius: 0px;
                background-color: #36393E;
              }
              
              *::-webkit-scrollbar-thumb:hover {
                background-color: #36393E;
              }
              
              *::-webkit-scrollbar-thumb:active {
                background-color: #282B30;
              }
              
              .user-avatar {
                width: 50px;
                height: 50px;
                border-radius: 100%;
                background: url("../auth/icons/avatar.jpg") no-repeat center/200%;
              }
              
              .title {
                font-family: "Jost", sans-serif;
                font-size: 24px;
                font-weight: 500;
                text-align: center;
                margin: 0;
              }
              
              .about, .link-time {
                font-family: "Jost", sans-serif;
                font-size: 16px;
                font-weight: 400;
                margin: 0;
              }
              
              .link, .link-btn {
                font-family: "Jost", sans-serif;
                font-size: 16px;
                font-weight: 400;
                color: #435969;
              }
              
              .link-btn {
                border: 2px solid #7E99AD;
                border-radius: 10px;
                text-decoration: none;
                background-color: #7E99AD;
                color: white;
                padding: 5px 10px;
              }
              
              .link-time {
                font-size: 12px;
              }
        }
    </style>
</head>

<body>
    <div class="es-wrapper-color" style="background-color:#F6F6F6">
        <!--[if gte mso 9]>
			<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
				<v:fill type="tile" color="#f6f6f6"></v:fill>
			</v:background>
		<![endif]-->
        <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0"
            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top">
            <tr>
                <td valign="top" style="padding:0;Margin:0">
                    <table class="es-header" cellspacing="0" cellpadding="0" align="center"
                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
                        <tr>
                            <td align="center" style="padding:0;Margin:0">
                                <table class="es-header-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff"
                                    align="center"
                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                                    <tr>
                                        <td align="left"
                                            style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px">
                                            <table cellspacing="0" cellpadding="0" width="100%"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:560px">
                                                        <table width="100%" cellspacing="0" cellpadding="0"
                                                            role="presentation"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="center"
                                                                    style="padding:0;Margin:0;font-size:0px"><img
                                                                        class="adapt-img"
                                                                        src="https://vyknoa.stripocdn.email/content/guids/4f0ada92-0bdc-47f0-95d7-930fce236f21/images/group_433.png"
                                                                        alt
                                                                        style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"
                                                                        width="560"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table class="es-content" cellspacing="0" cellpadding="0" align="center"
                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                        <tr>
                            <td align="center" style="padding:0;Margin:0">
                                <table class="es-content-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff"
                                    align="center"
                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                                    <tr>
                                        <td align="left"
                                            style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px">
                                            <table width="100%" cellspacing="0" cellpadding="0"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr>
                                                    <td valign="top" align="center"
                                                        style="padding:0;Margin:0;width:560px">
                                                        <table width="100%" cellspacing="0" cellpadding="0"
                                                            role="presentation"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td style="padding:0;Margin:0">
                                                                    <h1 class="title">
                                                                        Здравствуйте!</h1>
                                                                    <p class="about">
                                                                    Чтобы закончить регистрацию, придумайте, а затем введите Ваш пароль, нажав на кнопку ниже.</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding: 20px 0px 10px 0px; text-align: center;" >
                                                                    <a href="' . $link . '" class="link-btn">Создать пароль</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center"
                                                                    style="padding:20px;Margin:0;font-size:0">
                                                                    <table border="0" width="100%" height="100%"
                                                                        cellpadding="0" cellspacing="0"
                                                                        role="presentation"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr>
                                                                            <td
                                                                                style="padding:0;Margin:0;border-bottom:1px solid #cccccc;background:unset;height:1px;width:100%;margin:0px">
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:0;Margin:0; text-align:center">
                                                                    <p class="link-time">
                                                                        Помните, ссылка действует лишь 24 часа.</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-style: italic; padding-top: 20px;">
                                                                    <p class="about">Не работает кнопка? Скопируйте ссылку и вставьте в окно браузера:</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a class="link">' . $link . '</a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table class="es-footer" cellspacing="0" cellpadding="0" align="center"
                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
                        <tr>
                            <td align="center" style="padding:0;Margin:0">
                                <table class="es-footer-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff"
                                    align="center"
                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                                    <tr>
                                        <td align="left"
                                            style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px">
                                            <table cellpadding="0" cellspacing="0" width="100%"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr>
                                                    <td align="center" valign="top"
                                                        style="padding:0;Margin:0;width:560px">
                                                        <table cellpadding="0" cellspacing="0" width="100%"
                                                            role="presentation"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td style="padding:0;Margin:0">
                                                                    <p class="about">
                                                                        Внимание! Если вы не запрашивали это письмо,
                                                                        пожалуйста, не переходите по ссылке и не
                                                                        отвечайте на это письмо. Спасибо!</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center"
                                                                    style="padding:0;Margin:0;font-size:0px"><img
                                                                        class="adapt-img"
                                                                        src="https://vyknoa.stripocdn.email/content/guids/CABINET_178360a27f573d2f39290607640eb447/images/group_435.png"
                                                                        alt
                                                                        style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"
                                                                        width="560"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>',
            "Ваш аккаунт был создан администратором. Перейдите по ссылке и придумайте пароль. Ссылка действует только 24 часа. \n$link"
        );
    }

    public static function sendPasswordChange($mail_receiver, $link_to_change_password): bool
    {
        return self::send(
            $mail_receiver,
            "Вы запросили восстановление пароля",
            '<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title>Estimin</title>
    <!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]-->
    <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
    <!--[if gte mso 9]>
<xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG></o:AllowPNG>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
</xml>
<![endif]-->
    <link rel="stylesheet" href="style.css">
    <style type="text/css">
        #outlook a {
            padding: 0;
        }

        .es-button {
            mso-style-priority: 100 !important;
            text-decoration: none !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        .es-desk-hidden {
            display: none;
            float: left;
            overflow: hidden;
            width: 0;
            max-height: 0;
            line-height: 0;
            mso-hide: all;
        }

        [data-ogsb] .es-button {
            border-width: 0 !important;
            padding: 10px 20px 10px 20px !important;
        }
        @import url("https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

        @media only screen and (max-width:600px) {

            p,
            ul li,
            ol li {
                line-height: 150%
            }

            h1,
            h2,
            h3 {
                line-height: 120%
            }

            h1 {
                font-size: 30px;
                text-align: left
            }

            h2 {
                font-size: 24px;
                text-align: left
            }

            h3 {
                font-size: 20px;
                text-align: left
            }

            .es-header-body p,
            .es-header-body ul li,
            .es-header-body ol li{
                font-size: 14px
            }

            .es-content-body p,
            .es-content-body ul li,
            .es-content-body ol li{
                font-size: 14px
            }

            .es-footer-body p,
            .es-footer-body ul li,
            .es-footer-body ol li{
                font-size: 14px
            }

            .es-infoblock p,
            .es-infoblock ul li,
            .es-infoblock ol li{
                font-size: 12px
            }

            *[class="gmail-fix"] {
                display: none !important
            }

            .es-m-txt-c,
            .es-m-txt-c h1,
            .es-m-txt-c h2,
            .es-m-txt-c h3 {
                text-align: center !important
            }

            .es-m-txt-r,
            .es-m-txt-r h1,
            .es-m-txt-r h2,
            .es-m-txt-r h3 {
                text-align: right !important
            }

            .es-m-txt-l,
            .es-m-txt-l h1,
            .es-m-txt-l h2,
            .es-m-txt-l h3 {
                text-align: left !important
            }

            .es-m-txt-r img,
            .es-m-txt-c img,
            .es-m-txt-l img {
                display: inline !important
            }

            .es-button-border {
                display: inline-block !important
            }

            a.es-button,
            button.es-button {
                font-size: 18px !important;
                display: inline-block !important
            }

            .es-adaptive table,
            .es-left,
            .es-right {
                width: 100% !important
            }

            .es-content table,
            .es-header table,
            .es-footer table,
            .es-content,
            .es-footer,
            .es-header {
                width: 100% !important;
                max-width: 600px !important
            }

            .es-adapt-td {
                display: block !important;
                width: 100% !important
            }

            .adapt-img {
                width: 100% !important;
                height: auto !important
            }

            .es-m-p0 {
                padding: 0px !important
            }

            .es-m-p0r {
                padding-right: 0px !important
            }

            .es-m-p0l {
                padding-left: 0px !important
            }

            .es-m-p0t {
                padding-top: 0px !important
            }

            .es-m-p0b {
                padding-bottom: 0 !important
            }

            .es-m-p20b {
                padding-bottom: 20px !important
            }

            .es-mobile-hidden,
            .es-hidden {
                display: none !important
            }

            tr.es-desk-hidden,
            td.es-desk-hidden,
            table.es-desk-hidden {
                width: auto !important;
                overflow: visible !important;
                float: none !important;
                max-height: inherit !important;
                line-height: inherit !important
            }

            tr.es-desk-hidden {
                display: table-row !important
            }

            table.es-desk-hidden {
                display: table !important
            }

            td.es-desk-menu-hidden {
                display: table-cell !important
            }

            .es-menu td {
                width: 1% !important
            }

            table.es-table-not-adapt,
            .esd-block-html table {
                width: auto !important
            }

            table.es-social {
                display: inline-block !important
            }

            table.es-social td {
                display: inline-block !important
            }
            

            * {
                box-sizing: border-box;
                -webkit-user-drag: none;
              }
              
              a,
              button {
                cursor: pointer;
              }
              
              body,
              html {
                margin: 0;
                padding: 0;
              }
              
              body.fixated {
                overflow: hidden;
              }
              
              *::-webkit-scrollbar {
                width: 6px;
              }
              
              *::-webkit-scrollbar-track {
                border-radius: 0px;
                background-color: #F4F4F4;
              }
              
              *::-webkit-scrollbar-track:hover {
                background-color: #F4F4F4;
              }
              
              *::-webkit-scrollbar-track:active {
                background-color: #EBE9E9;
              }
              
              *::-webkit-scrollbar-thumb {
                border-radius: 0px;
                background-color: #36393E;
              }
              
              *::-webkit-scrollbar-thumb:hover {
                background-color: #36393E;
              }
              
              *::-webkit-scrollbar-thumb:active {
                background-color: #282B30;
              }
              
              .user-avatar {
                width: 50px;
                height: 50px;
                border-radius: 100%;
                background: url("../auth/icons/avatar.jpg") no-repeat center/200%;
              }
              
              .title {
                font-family: "Jost", sans-serif;
                font-size: 24px;
                font-weight: 500;
                text-align: center;
                margin: 0;
              }
              
              .about, .link-time {
                font-family: "Jost", sans-serif;
                font-size: 16px;
                font-weight: 400;
                margin: 0;
              }
              
              .link, .link-btn {
                font-family: "Jost", sans-serif;
                font-size: 16px;
                font-weight: 400;
                color: #435969;
              }
              
              .link-btn {
                border: 2px solid #7E99AD;
                border-radius: 10px;
                text-decoration: none;
                background-color: #7E99AD;
                color: white;
                padding: 5px 10px;
              }
              
              .link-time {
                font-size: 12px;
              }
        }
    </style>
</head>

<body>
    <div class="es-wrapper-color" style="background-color:#F6F6F6">
        <!--[if gte mso 9]>
			<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
				<v:fill type="tile" color="#f6f6f6"></v:fill>
			</v:background>
		<![endif]-->
        <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0"
            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top">
            <tr>
                <td valign="top" style="padding:0;Margin:0">
                    <table class="es-header" cellspacing="0" cellpadding="0" align="center"
                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
                        <tr>
                            <td align="center" style="padding:0;Margin:0">
                                <table class="es-header-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff"
                                    align="center"
                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                                    <tr>
                                        <td align="left"
                                            style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px">
                                            <table cellspacing="0" cellpadding="0" width="100%"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:560px">
                                                        <table width="100%" cellspacing="0" cellpadding="0"
                                                            role="presentation"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="center"
                                                                    style="padding:0;Margin:0;font-size:0px"><img
                                                                        class="adapt-img"
                                                                        src="https://vyknoa.stripocdn.email/content/guids/4f0ada92-0bdc-47f0-95d7-930fce236f21/images/group_433.png"
                                                                        alt
                                                                        style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"
                                                                        width="560"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table class="es-content" cellspacing="0" cellpadding="0" align="center"
                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                        <tr>
                            <td align="center" style="padding:0;Margin:0">
                                <table class="es-content-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff"
                                    align="center"
                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                                    <tr>
                                        <td align="left"
                                            style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px">
                                            <table width="100%" cellspacing="0" cellpadding="0"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr>
                                                    <td valign="top" align="center"
                                                        style="padding:0;Margin:0;width:560px">
                                                        <table width="100%" cellspacing="0" cellpadding="0"
                                                            role="presentation"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td style="padding:0;Margin:0">
                                                                    <h1 class="title" style="text-align:center; font-family:"Jost", sans-serif;">
                                                                        Здравствуйте!</h1>
                                                                    <p class="about">
                                                                    Забыли пароль? Нажмите на кнопку ниже, чтобы перейти на страницу ввода нового пароля.</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding: 20px 0px 10px 0px; text-align: center;" >
                                                                    <a href="' . $link_to_change_password . '" class="link-btn">Изменить пароль</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center"
                                                                    style="padding:20px;Margin:0;font-size:0">
                                                                    <table border="0" width="100%" height="100%"
                                                                        cellpadding="0" cellspacing="0"
                                                                        role="presentation"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr>
                                                                            <td
                                                                                style="padding:0;Margin:0;border-bottom:1px solid #cccccc;background:unset;height:1px;width:100%;margin:0px">
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:0;Margin:0; text-align:center">
                                                                    <p class="link-time" style="font-size: 12px">
                                                                        Помните, ссылка действует лишь 24 часа.</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-style: italic; padding-top: 20px;">
                                                                    <p class="about">Не работает кнопка? Скопируйте ссылку и вставьте в окно браузера:</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a class="link">' . $link_to_change_password . '</a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table class="es-footer" cellspacing="0" cellpadding="0" align="center"
                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
                        <tr>
                            <td align="center" style="padding:0;Margin:0">
                                <table class="es-footer-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff"
                                    align="center"
                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                                    <tr>
                                        <td align="left"
                                            style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px">
                                            <table cellpadding="0" cellspacing="0" width="100%"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr>
                                                    <td align="center" valign="top"
                                                        style="padding:0;Margin:0;width:560px">
                                                        <table cellpadding="0" cellspacing="0" width="100%"
                                                            role="presentation"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td style="padding:0;Margin:0">
                                                                    <p class="about">
                                                                        Внимание! Если вы не запрашивали это письмо,
                                                                        пожалуйста, не переходите по ссылке и не
                                                                        отвечайте на это письмо. Спасибо!</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center"
                                                                    style="padding:0;Margin:0;font-size:0px"><img
                                                                        class="adapt-img"
                                                                        src="https://vyknoa.stripocdn.email/content/guids/CABINET_178360a27f573d2f39290607640eb447/images/group_435.png"
                                                                        alt
                                                                        style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"
                                                                        width="560"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>',
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