<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.html');
    exit();
}

echo "<h1>Bienvenido, " . $_SESSION['nombre'] . "</h1>";
echo "<p>Tipo de usuario: " . $_SESSION['tipo_usuario'] . "</p>";

if ($_SESSION['tipo_usuario'] == 'administrador') {
    echo "<p><a href='panel_administrador.php'>Ir al panel de administración</a></p>";
}

echo "<p><a href='logout.php'>Cerrar sesión</a></p>";
?>

<!-- Aquí puedes agregar más información o funciones del usuario -->
