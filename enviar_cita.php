<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Composer autoload

$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Cambia por tu servidor SMTP
    $mail->SMTPAuth   = true;
    $mail->Username   = 'rczjunior27@gmail.com'; // Tu correo
    $mail->Password   = 'jajasalu2';  // Tu contraseña o clave de aplicación
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Remitente y destinatario
    $mail->setFrom('rczjunior27@gmail.com', 'DentoSpark');
    $mail->addAddress('rx52700@gmail.com', 'Paciente');

    // Contenido
    $mail->isHTML(true);
    $mail->Subject = 'Confirmación de cita';
    $mail->Body    = 'Tu cita ha sido agendada con éxito. Gracias por usar DentoSpark.';

    $mail->send();
    echo 'El mensaje ha sido enviado.';
} catch (Exception $e) {
    echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
}
?>
