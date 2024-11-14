<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.html');
    exit();
}

include 'db.php';

$usuario_id = $_SESSION['id']; // ID del usuario logueado

// Consultar las actividades en las que el usuario está inscrito
$sql = "SELECT a.nombre_actividad 
        FROM actividades a 
        INNER JOIN inscripciones i ON a.id = i.actividad_id 
        WHERE i.usuario_id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Actividades</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Actividades en las que estás inscrito</h2>
        <ul>
            <?php 
            if ($result->num_rows > 0) {
                while ($actividad = $result->fetch_assoc()) {
                    echo "<li>" . $actividad['nombre_actividad'] . "</li>";
                }
            } else {
                echo "<p>No estás inscrito en ninguna actividad.</p>";
            }
            ?>
        </ul>
    </div>
</body>
</html>

<?php
$stmt->close();  // Cerrar la declaración correctamente
$conexion->close();  // Cerrar la conexión a la base de datos
?>
