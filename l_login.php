<?php
session_start();
include 'conexion.php';

$correo = $_POST['correo'] ?? '';
$password = $_POST['password'] ?? '';

if ($correo && $password) {
    // Corregimos el uso del campo correcto en el WHERE
    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // Usamos el nombre correcto del campo de la contraseña
        if (password_verify($password, $usuario['contrasena'])) {
            $_SESSION['usuario'] = $usuario['usuario'];
            $_SESSION['tipo'] = $usuario['tipo'];
            $_SESSION['id'] = $usuario['id']; 

            // Redirigir según tipo de usuario
            if ($usuario['tipo'] == 1) {
                header("Location: inicio.php ");
            } else {
                header("Location: inicio.php");
            }
            exit;
        } else {
            header("Location: index.php?error=contrasena");
            exit;
        }
    } else {
        header("Location: index.php?error=correo");
        exit;
    }
} else {
   header("Location: index.php ?error=datos");
    exit;
}
?>
