<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5; /* Color de fondo */
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Toma el 100% del alto de la ventana */
        }

        .login-container {
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            color: #1877f2; /* Color azul similar a Facebook */
        }

        .form-control {
            margin-bottom: 15px;
            border-color: #dcdcdc; /* Color del borde */
        }

        .btn-primary {
            background-color: #1877f2; /* Color azul similar a Facebook */
            border-color: #1877f2;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #166fe5; /* Cambio de color al pasar el cursor */
        }

        .error-message {
            margin-top: 10px;
            padding: 10px;
            background-color: #f8d7da; /* Color de fondo rojo */
            color: #721c24; /* Color de texto rojo oscuro */
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <input type="text" name="correo" class="form-control" placeholder="Correo Electrónico" required>
            </div>
            <div class="mb-3">
                <input type="password" name="clave" class="form-control" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary">Ingresar</button>
        </form>

        <?php
        // Incluir el archivo de conexión a la base de datos
        include("connection.php");

        // Verificar si se recibieron datos por POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $correo = $_POST["correo"];
            $clave = $_POST["clave"];

            // Consulta preparada para seleccionar el usuario por correo
            $consulta = $conexion->prepare("SELECT * FROM Usuarios WHERE Correo = :correo");
            $consulta->bindParam(':correo', $correo);
            $consulta->execute();

            // Obtener el resultado de la consulta
            $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

            // Verificar si se encontró un usuario con el correo proporcionado
            if ($usuario) {
                // Verificar la contraseña utilizando password_verify
                if (password_verify($clave, $usuario['HashClave'])) {
                    // Inicio de sesión exitoso
                    session_start();
                    $_SESSION['usuario_id'] = $usuario['ID_Usuario']; // Guardar el ID de usuario en la sesión

                    // Redirigir a la página de inicio (Home)
                    header("Location: ../Interfaz.html");
                    exit;
                } else {
                    // Contraseña incorrecta
                    echo '<div class="error-message">Contraseña incorrecta. Por favor, intenta nuevamente.</div>';
                }
            } else {
                // Usuario no encontrado
                echo '<div class="error-message">Usuario no encontrado. Por favor, verifica tu correo.</div>';
            }
        }
        ?>
    </div>

    <!-- Enlace a los scripts de Bootstrap (jQuery y Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
