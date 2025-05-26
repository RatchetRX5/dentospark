<?php
$host = "localhost";
$user = "root";
$pass = ""; // tu contraseña si tienes
$db = "agenda";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>