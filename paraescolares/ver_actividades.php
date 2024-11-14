<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.html');
    exit();
}

include 'db.php';

// Consultar todas las actividades disponibles
$sql = "SELECT id, nombre_actividad FROM actividades";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividades Disponibles</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Actividades Disponibles</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre de Actividad</th>
                    <th>Seleccionar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($resultado->num_rows > 0) {
                    // Mostrar las actividades disponibles
                    while ($actividad = $resultado->fetch_assoc()) { 
                ?>
                    <tr>
                        <td><?php echo $actividad['id']; ?></td>
                        <td><?php echo $actividad['nombre_actividad']; ?></td>
                        <td>
                            <a href="seleccionar_actividad.php?id=<?php echo $actividad['id']; ?>">Seleccionar</a>
                        </td>
                    </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='3'>No hay actividades disponibles.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conexion->close();
?>
