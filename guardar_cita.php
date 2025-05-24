<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Composer autoload

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "agenda");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$aP = $_POST['aP'];
$aM = $_POST['aM'];
$correo = $_POST['correo'];
$hora = $_POST['hora'];
$fecha = explode("-", $_POST['fecha']);
$anio = intval($fecha[0]);
$mes = intval($fecha[1]);
$dia = intval($fecha[2]);

// Insertar en la base de datos
$sql = "INSERT INTO citas (nombre, aP, aM, correo, hora, dia, mes, anio)
        VALUES ('$nombre', '$aP', '$aM', '$correo', '$hora', $dia, $mes, $anio)";

if ($conexion->query($sql) === TRUE) {

    // Crear instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'rczjunior27@gmail.com';  // tu correo
        $mail->Password   = 'efvy bxal bvwp mcip';               // contraseña o app password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Remitente y destinatario
        $mail->setFrom('rczjunior27@gmail.com', 'DentoSpark');
        $mail->addAddress($correo, "$nombre $aP $aM");

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = "Confirmación de cita dental";
        $mail->Body    = "
            <p>Hola <b>$nombre $aP $aM</b>,</p>
            <p>Tu cita ha sido agendada para el <b>$dia/$mes/$anio</b> a las <b>$hora</b>.</p>
            <p>Gracias por confiar en <b>DentoSpark</b>.</p>
        ";

        $mail->send();
        header("Location: agendar.php?success=1");
        exit();
    } catch (Exception $e) {
        header("Location: agendar.php?success=0");
        exit();
    }
} else {
    header("Location: agendar.php?success=0");
    exit();
}

$conexion->close();
?>
