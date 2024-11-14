<?php
include 'db.php';

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT); // Encriptar la contraseña

// Preparar y ejecutar la consulta SQL para insertar datos
$sql = "INSERT INTO usuarios (nombre, correo, contraseña) VALUES (?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sss", $nombre, $correo, $contraseña);

if ($stmt->execute()) {
    echo "Registro exitoso. <a href='login.html'>Iniciar sesión</a>";
} else {
    echo "Error en el registro: " . $conexion->error;
}

$stmt->close();
$conexion->close();
?>
