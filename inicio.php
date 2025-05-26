<?php
session_start();
$usuario = $_SESSION['usuario'] ?? 'Invitado';
$tipo = $_SESSION['tipo'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="1_estilos.css">
    <title>Citas Dentales</title>
</head>
<body>
    <div id="display1">
        <h1>DentoSpark</h1>
        <h3>Bienvenido, Dr/a. <?php echo htmlspecialchars($usuario); ?>!</h3>

        <nav>
            <button onclick="window.location.href='agendar.php'">
                <img src="imagenes/calendario.png" alt="Agendar">
                Agendar Cita
            </button>
            <button onclick="window.location.href='ver_cita.php'">
                <img src="imagenes/lupa.png" alt="Cita">
                Ver Cita
            </button>
            <form action="logout.php" method="post">
                <button type="submit">
                    <img src="imagenes/cerrar-sesion.png" alt="Cerrar sesión">
                    Cerrar Sesión
                </button>
            </form>
        </nav>
    </div> 
</body>
</html>
