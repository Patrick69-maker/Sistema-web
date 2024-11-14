<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 'administrador') {
    header('Location: login.html');
    exit();
}

include 'db.php';

// Consultar todas las actividades
$sql = "SELECT id, nombre_actividad FROM actividades";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Actividades</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Gestionar Actividades</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre de Actividad</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($actividad = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $actividad['id']; ?></td>
                        <td><?php echo $actividad['nombre_actividad']; ?></td>
                        <td>
                            <a href="eliminar_actividad.php?id=<?php echo $actividad['id']; ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <p><a href="agregar_actividad.php">Agregar Nueva Actividad</a></p>
        <p><a href="panel_administrador.php">Volver al Panel de Administración</a></p>
    </div>
</body>
</html>

<?php
$conexion->close();
?>
