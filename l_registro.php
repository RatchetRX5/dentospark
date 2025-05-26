<?php
include 'conexion.php';

$usuario = $_POST['usuario'] ?? '';
$correo = $_POST['correo'] ?? '';
$password = $_POST['password'] ?? '';
$tipo = $_POST['tipo'] ?? '';

if ($usuario && $correo && $password && $tipo !== '') {
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (usuario, correo, contrasena, tipo) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $usuario, $correo, $password_hashed, $tipo);

    if ($stmt->execute()) {
        echo "Registro exitoso. <a href='index.html'>Iniciar sesión</a>";
    } else {
        echo "Error al registrar: " . $stmt->error;
    }
} else {
    echo "Faltan datos";
}
?>
