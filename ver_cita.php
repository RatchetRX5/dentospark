<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.html");
    exit();
}

include 'conexion.php';
$usuario = $_SESSION['usuario'] ?? '';
$tipo = $_SESSION['tipo'] ?? '';
$id_doctor = $_SESSION['id'] ?? null;

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM citas WHERE doctor_id = ? ORDER BY anio, mes, dia, hora";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_doctor);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Citas | DentoSpark</title>
    <link rel="stylesheet" href="1_estilos.css">
</head>
<body>
    <div id="display1">
        <h1>DentoSpark</h1>
        <h3>Citas agendadas para el Dr. <?php echo htmlspecialchars($usuario); ?></h3>

        <table style="width:90%; margin-top: 20px; border-collapse: collapse; background:white;">
            <thead>
                <tr style="background-color:#963c00; color:white;">
                    <th style="padding: 10px; border: 1px solid #ccc;">Nombre</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Correo</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Fecha</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Hora</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ccc;">
                            <?php echo htmlspecialchars($fila['nombre'] . ' ' . $fila['aP'] . ' ' . $fila['aM']); ?>
                        </td>
                        <td style="padding: 10px; border: 1px solid #ccc;">
                            <?php echo htmlspecialchars($fila['correo']); ?>
                        </td>
                        <td style="padding: 10px; border: 1px solid #ccc;">
                            <?php echo $fila['dia'] . '/' . $fila['mes'] . '/' . $fila['anio']; ?>
                        </td>
                        <td style="padding: 10px; border: 1px solid #ccc;">
                            <?php echo htmlspecialchars($fila['hora']); ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <form action="logout.php" method="post" style="margin-top: 20px;">
            <button type="submit">
                <img src="imagenes/cerrar-sesion.png" alt="Cerrar sesión" style="width: 40px; height: 40px;">
                Cerrar Sesión
            </button>
        </form>
         <form action="inicio.php" method="get" class="formulario">
          <button type="submit" >← Regresar</button>
      </form>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
