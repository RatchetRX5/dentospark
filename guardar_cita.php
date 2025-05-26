<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
include 'conexion.php';
$configs = include 'config_mail.php';

// Conexión a la base de datos
$conn = mysqli_connect($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Datos del formulario
$nombre = $_POST['nombre'];
$aP = $_POST['aP'];
$aM = $_POST['aM'];
$correo = $_POST['correo'];
$hora = trim($_POST['hora']);
$fecha = explode("-", $_POST['fecha']);
$anio = intval($fecha[0]);
$mes = intval($fecha[1]);
$dia = intval($fecha[2]);
$doctor_id = intval($_POST['doctor_id']);

// Validar disponibilidad
$check = $conn->prepare("SELECT id FROM citas WHERE doctor_id = ? AND dia = ? AND mes = ? AND anio = ? AND hora = ?");
$check->bind_param("iiiss", $doctor_id, $dia, $mes, $anio, $hora);
$check->execute();
$check_result = $check->get_result();

if ($check_result->num_rows > 0) {
    header("Location: agendar.php?success=2");
    exit();
}

// Insertar cita
$sql = "INSERT INTO citas (nombre, aP, aM, correo, hora, dia, mes, anio, doctor_id)
        VALUES ('$nombre', '$aP', '$aM', '$correo', '$hora', $dia, $mes, $anio, $doctor_id)";

if ($conn->query($sql) === TRUE) {
    // === Detectar proveedor en base al dominio del correo ===
    $proveedor = 'gmail'; // por defecto
    if (preg_match('/@(hotmail|outlook|live)\.com$/i', $correo)) {
        $proveedor = 'outlook';
    }

    $c = $configs[$proveedor];
    $mail = new PHPMailer(true);

    try {
        // Configuración SMTP
        $mail->isSMTP();
        $mail->Host       = $c['host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $c['user'];
        $mail->Password   = $c['pass'];
        $mail->SMTPSecure = $c['secure'];
        $mail->Port       = $c['port'];

        // Remitente y destinatario
        $mail->setFrom($c['from_email'], $c['from_name']);
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
        error_log("Error de PHPMailer: " . $mail->ErrorInfo);
        header("Location: agendar.php?success=0");
        exit();
    }
} else {
    header("Location: agendar.php?success=0");
    exit();
}

$conn->close();
?>
