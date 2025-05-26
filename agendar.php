  <?php
    session_start();
    if (!isset($_SESSION['id'])) {
      die("Error: No se ha iniciado sesión correctamente.");
    }
  ?>
  <!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="UTF-8">
    <title>Agendar Cita | Dentospark</title>
    <link rel="stylesheet" href="2_estilos.css"> <!-- Agrega este -->
  </head>
  <body>

    <div class="form-container">
      <h1>Agendar Cita</h1>
     
      <form action="guardar_cita.php" method="POST" class="formulario">
          <label>Nombre:</label>
          <input type="text" name="nombre" required>

          <label>Apellido paterno:</label>
          <input type="text" name="aP" required>

          <label>Apellido materno:</label>
          <input type="text" name="aM" required>

          <label>Correo:</label>
          <input type="email" name="correo" required>

          <label>Fecha:</label>
          <input type="date" name="fecha" required>

          <label>Hora:</label>
          <input type="time" name="hora" required>

          <input type="submit" value="Agendar Cita">
          <input type="hidden" name="doctor_id" value="<?php echo $_SESSION['id']; ?>">
      </form>
      <form action="inicio.php" method="get" class="formulario">
          <button type="submit" >← Regresar</button>
      </form>
    </div>

  </body>
  </html>
