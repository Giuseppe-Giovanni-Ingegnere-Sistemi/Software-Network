<?php
// Incluir el archivo de conexión a la base de datos
include("db.php");

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
            header("Location: ../coockies.html  ");
            exit;
        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta. Por favor, intenta nuevamente.";
        }
    } else {
        // Usuario no encontrado
        echo "Usuario no encontrado. Por favor, verifica tu correo.";
    }
}
?>
