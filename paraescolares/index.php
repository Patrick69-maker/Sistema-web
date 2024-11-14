<!-- index.php -->
<?php
// Aquí podrías tener lógica PHP si la necesitas
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Tema</title>
    <style>
        /* Tema claro */
        body {
            background-color: white;
            color: black;
        }

        /* Tema oscuro */
        body.dark-theme {
            background-color: #121212;
            color: white;
        }
    </style>
</head>
<body>
    <button onclick="toggleTheme()">Cambiar Tema</button>

    <script>
        function toggleTheme() {
            document.body.classList.toggle('dark-theme');
        }
    </script>
</body>
</html>
