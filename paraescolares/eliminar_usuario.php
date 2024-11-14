<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 'administrador') {
    header('Location: login.html');
    exit();
}

include 'db.php';

// Obtener el ID del usuario a eliminar
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // Eliminar usuario de la base de datos
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_usuario);

    if ($stmt->execute()) {
        echo "Usuario eliminado con éxito. <a href='gestionar_usuarios.php'>Volver</a>";
    } else {
        echo "Error al eliminar el usuario. <a href='gestionar_usuarios.php'>Volver</a>";
    }

    $stmt->close();
} else {
    echo "No se ha especificado un usuario para eliminar.";
}

$conexion->close();
?>
