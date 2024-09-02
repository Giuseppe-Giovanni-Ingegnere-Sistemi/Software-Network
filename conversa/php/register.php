<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Exitoso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            /* Color de fondo similar a Facebook */
            color: #3b5998;
            /* Color de texto azul similar a Facebook */
            text-align: center;
            padding: 50px;
            box-sizing: border-box;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            /* Fondo blanco similar a los formularios de Facebook */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #3b5998;
            /* Color azul similar a Facebook */
        }

        p {
            font-size: 18px;
            line-height: 1.6;
        }

        a {
            color: #3b5998;
            /* Color azul similar a Facebook */
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3b5998;
            /* Azul similar a Facebook */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #4267B2;
            /* Cambio de color al pasar el cursor similar a Facebook */
        }
    </style>
</head>

<body>
    <div class="container">
        <?php

        include ("connection.php");

        // Verificar si se recibieron datos por POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recuperar los datos del formulario
            $email = $_POST["Email"];
            $nombre = $_POST["Nombre"];
            $apellido = $_POST["Apellido"];
            $contraseña = $_POST["Contraseña"];
            $fechaNacimiento = $_POST["FechaNacimiento"];
            $telefono = $_POST["Telefono"];
            $edad = $_POST["Edad"];
            $genero = $_POST["Genero"];
            $pais = $_POST["Pais"];
            $ciudad = $_POST["Ciudad"];

            // Generar hash seguro de la contraseña
            $hashClave = password_hash($contraseña, PASSWORD_DEFAULT);

            try {
                // Consulta preparada para INSERT en la tabla Usuarios usando PDO
                $consulta = $conexion->prepare("INSERT INTO Usuarios (Correo, Nombre, Apellido, HashClave, FechaNacimiento, Telefono, Edad, Genero, Pais, Ciudad, FechaRegistro) 
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

                // Asignar valores a los parámetros de la consulta y ejecutarla
                $consulta->execute([$email, $nombre, $apellido, $hashClave, $fechaNacimiento, $telefono, $edad, $genero, $pais, $ciudad]);

                echo '<h1>¡Tu cuenta ha sido creada exitosamente!</h1>';
                echo '<p>Gracias <b>' . $nombre . ' ' . $apellido . '</b> por registrarte en nuestro sitio web. Tu cuenta se ha creado satisfactoriamente.</p>';
                echo '<p>Para iniciar sesión, puedes visitar nuestra <a href="../index.html">página de inicio de sesión</a>.</p>';

            } catch (PDOException $e) {
                die("Error al ejecutar la consulta: " . $e->getMessage());
            }
        }

        // Cerrar conexión
        $conexion = null;
        ?>
        <a href="../index.html" class="btn">Volver al inicio de sesión</a>
    </div>
</body>

</html>