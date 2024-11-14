<?php
$host = "localhost";
$usuario = "root";
$contraseña = "";
$base_datos = "paraescolares";

// Crear conexión
$conexion = new mysqli($host, $usuario, $contraseña, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
