<?php

$servidor = "62.72.26.42";  // Servidor de la base de datos
$usuario = "Desarrollador";   // Nombre de usuario de la base de datos
$contrasena = "S1zk*24*"; // Contraseña de la base de datos
$base_datos = "señaconversaBD"; // Nombre de la base de datos


// Crear una conexión a la base de datos
try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$base_datos", $usuario, $contrasena);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}
