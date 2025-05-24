<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'rczjunior27@gmail.com';
    $mail->Password   = 'efvy bxal bvwp mcip';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('rczjunior27@gmail.com', 'DentoSpark');
    $mail->addAddress('rczjunior27@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body    = 'Esto es un correo de prueba con PHPMailer y Gmail SMTP';

    $mail->send();
    echo 'Correo enviado correctamente';
} catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
}
