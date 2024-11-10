<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';

function sendPin($target, $email, $username, $password)
{

    $mail = new PHPMailer();

    $mail->isSMTP();

    $mail->SMTPDebug = SMTP::DEBUG_OFF;

    $mail->Host = 'smtp.gmail.com';

    $mail->Port = 465;

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

    $mail->SMTPAuth = true;

    $mail->Username = 'charliezkiecharlzk@gmail.com';

    $mail->Password = 'oaqp zfcb jalg fuyy';

    $mail->setFrom('charliezkiecharlzk@gmail.com', 'Charles Henry Tinoy');

    $mail->addAddress($target, 'Charles Henry Tinoy');

    $mail->Subject = 'TheraAid OTP';

    $pin = uniqid("TheraAid");

    $mail->Body = "Your OTP Pin is: $pin";

    if (!$mail->send()) {
        return "error";
    } else {
        return $pin;
    }
}