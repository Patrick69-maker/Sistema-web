<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 'administrador') {
    header('Location: login.html');
    exit();
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_actividad = $_POST['nombre_actividad'];

    // Insertar la nueva actividad en la base de datos
    $sql = "INSERT INTO actividades (nombre_actividad) VALUES (?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $nombre_actividad);

    if ($stmt->execute()) {
        echo "Actividad agregada con éxito. <a href='gestionar_actividades.php'>Ver Actividades</a>";
    } else {
        echo "Error al agregar actividad. <a href='gestionar_actividades.php'>Volver</a>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Actividad</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Agregar Nueva Actividad</h2>
        <form method="POST" action="">
            <label for="nombre_actividad">Nombre de la Actividad</label>
            <input type="text" name="nombre_actividad" id="nombre_actividad" required>
            <button type="submit">Agregar Actividad</button>
        </form>
        <p><a href="gestionar_actividades.php">Volver a Gestionar Actividades</a></p>
    </div>
</body>
</html>

<?php
$conexion->close();
?>
