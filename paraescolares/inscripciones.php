<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.html');
    exit();
}

include 'db.php';

if (isset($_GET['id'])) {
    $actividad_id = $_GET['id'];
    $usuario_id = $_SESSION['id']; // ID del usuario que está logueado

    // Verificar si ya está inscrito en esta actividad
    $sql_check = "SELECT * FROM inscripciones WHERE usuario_id = ? AND actividad_id = ?";
    $stmt_check = $conexion->prepare($sql_check);
    $stmt_check->bind_param("ii", $usuario_id, $actividad_id);
    $stmt_check->execute();
    $resultado_check = $stmt_check->get_result();

    if ($resultado_check->num_rows > 0) {
        echo "<p>Ya estás inscrito en esta actividad.</p>";
    } else {
        // Insertar el registro de inscripción
        $sql = "INSERT INTO inscripciones (usuario_id, actividad_id) VALUES (?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ii", $usuario_id, $actividad_id);

        if ($stmt->execute()) {
            echo "<p>Te has inscrito exitosamente en la actividad.</p>";
            // Redirigir a otra página después de la inscripción
            header("Location: ver_actividades.php");
            exit();
        } else {
            echo "<p>Error al inscribirse en la actividad. Intenta nuevamente.</p>";
        }

        $stmt->close();
    }

    $stmt_check->close();
} else {
    echo "No se ha recibido el ID de la actividad.";
}

$conexion->close();
?>
