<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Exitoso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #06021b;
            color: #fff;
            text-align: center;
            padding: 50px;
            box-sizing: border-box;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
        }

        a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #630DAB;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #8629d3;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        include ("db.php");

        // Verificar si se recibieron datos por POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recuperar los datos del formulario
            $nombre = $_POST["Nombre"];
            $apellido = $_POST["Apellido"];
            $email = $_POST["Email"];
            $telefono = $_POST["Telefono"];
            $contraseña = $_POST["Contraseña"];

            // Generar hash seguro de la contraseña
            $hashClave = password_hash($contraseña, PASSWORD_DEFAULT);

            // Consulta preparada para INSERT en la tabla Usuarios
            $consulta = $conexion->prepare("INSERT INTO Usuarios (Nombre, Apellido, Correo, Telefono, HashClave, FechaRegistro) VALUES (:nombre, :apellido, :email, :telefono, :Clave, NOW())");

            // Asignar valores a los parámetros de la consulta
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':apellido', $apellido);
            $consulta->bindParam(':email', $email);
            $consulta->bindParam(':telefono', $telefono);
            $consulta->bindParam(':Clave', $hashClave);

            try {
                // Ejecutar la consulta
                $consulta->execute();
                echo '<h1>¡Registro Exitoso!</h1>';
                echo '<p>Gracias <b>' . $nombre . ' ' . $apellido . '</b> por registrarte en nuestro sitio web. Tu cuenta ha sido creada satisfactoriamente.</p>';
                echo '<p>Para iniciar sesión, puedes dirigirte a nuestra <a href="login.html">página de inicio de sesión</a>.</p>';
            } catch (PDOException $e) {
                die("Error al ejecutar la consulta: " . $e->getMessage());
            }
        }
        ?>
        <a href="../login.html" class="btn">Volver al inicio de sesión</a>
    </div>
</body>

</html>