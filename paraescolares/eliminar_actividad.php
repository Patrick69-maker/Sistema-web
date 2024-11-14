<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 'administrador') {
    header('Location: login.html');
    exit();
}

include 'db.php';

// Obtener el ID de la actividad a eliminar
if (isset($_GET['id'])) {
    $id_actividad = $_GET['id'];

    // Eliminar actividad de la base de datos
    $sql = "DELETE FROM actividades WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_actividad);

    if ($stmt->execute()) {
        echo "Actividad eliminada con éxito. <a href='gestionar_actividades.php'>Volver</a>";
    } else {
        echo "Error al eliminar la actividad. <a href='gestionar_actividades.php'>Volver</a>";
    }

    $stmt->close();
} else {
    echo "No se ha especificado una actividad para eliminar.";
}

$conexion->close();
?>
