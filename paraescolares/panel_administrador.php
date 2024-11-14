<?php
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 'administrador') {
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Panel de Administración</h2>
        <p>Bienvenido, <?php echo $_SESSION['nombre']; ?> (Administrador)</p>
        <nav>
            <ul>
                <li><a href="gestionar_usuarios.php">Gestionar Usuarios</a></li>
                <li><a href="gestionar_actividades.php">Gestionar Actividades</a></li>
                <li><a href="logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>
