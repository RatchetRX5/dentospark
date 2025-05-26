<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - DentoSpark</title>
    <link rel="stylesheet" href="1_estilos.css">
</head>
<body>
    <div id="display1">
        <h1>DentoSpark</h1>
         <?php
        if (isset($_GET['error'])) {
            $mensaje = "";
            switch ($_GET['error']) {
                case 'correo':
                    $mensaje = "El correo no está registrado o es incorrecto.";
                    break;
                case 'contrasena':
                    $mensaje = "La contraseña es incorrecta.";
                    break;
                case 'datos':
                    $mensaje = "Por favor completa todos los campos.";
                    break;
            }
            echo "<p style='color:red;'>$mensaje</p>";
        }
      ?>
        <!-- Formulario de Login -->
        <form id="loginForm" method="POST" action="l_login.php">
            <input type="email" name="correo" placeholder="Correo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar sesión</button>
        </form>

        <!-- Formulario de Registro (oculto por defecto) -->
        <form id="registroForm" method="POST" action="l_registro.php" style="display: none;">
            <input type="text" name="usuario" placeholder="Nombre de usuario" required><br>
            <input type="email" name="correo" placeholder="Correo" required><br>
            <input type="password" name="password" placeholder="Contraseña" required><br>
            <label>Seleccione un tipo de usuario</label><br>
            <select name="tipo" required>
                <option value="1">Doctor</option>
                <option value="2">Secretaria</option>
            </select><br>
            <button type="submit">Registrarse</button>
        </form>

        <!-- Opción para cambiar entre login y registro -->
        <div class="alt-option">
            <span id="mostrarRegistro"><a onclick="mostrarFormulario()">¿No tienes cuenta? Regístrate</a></span>
            <span id="mostrarLogin" style="display: none;"><a onclick="mostrarFormulario()">¿Ya tienes cuenta? Inicia sesión</a></span>
        </div>
    </div>

    <script>
        function mostrarFormulario() {
            const login = document.getElementById("loginForm");
            const registro = document.getElementById("registroForm");
            const mostrarRegistro = document.getElementById("mostrarRegistro");
            const mostrarLogin = document.getElementById("mostrarLogin");

            if (registro.style.display === "none") {
                registro.style.display = "flex";
                login.style.display = "none";
                mostrarRegistro.style.display = "none";
                mostrarLogin.style.display = "inline";
            } else {
                registro.style.display = "none";
                login.style.display = "flex";
                mostrarRegistro.style.display = "inline";
                mostrarLogin.style.display = "none";
            }
        }
    </script>

        
    <script>
        // Limpiar URL después de mostrar el mensaje
        if (window.location.search.includes('error=')) {
            history.replaceState(null, '', window.location.pathname);
        }
</script>
</body>
</html>
