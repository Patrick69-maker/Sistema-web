<?php
session_start();

// Verificar que el usuario haya iniciado sesión
if (!isset($_SESSION['id'])) {
    header('Location: login.html');
    exit();
}

include 'db.php';

if (isset($_GET['id'])) {
    $actividad_id = $_GET['id'];
    $usuario_id = $_SESSION['id']; // Obtener el ID del usuario desde la sesión

    // Consultar el nombre de la actividad
    $sql = "SELECT nombre_actividad FROM actividades WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $actividad_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $actividad = $resultado->fetch_assoc();

        // Aquí comienza el HTML
        echo "<!DOCTYPE html>";
        echo "<html lang='es'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Inscripción a Actividad</title>";
        // Estilos en línea para personalizar la apariencia
        echo "<style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f0f8ff;
                    color: #333;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                }
                .container {
                    background: #fff;
                    padding: 20px 40px;
                    border-radius: 10px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    text-align: center;
                    max-width: 500px;
                    width: 90%;
                }
                h2 {
                    color: #3f51b5;
                }
                p {
                    font-size: 1.1em;
                    color: #555;
                }
            </style>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container'>";
        echo "<h2>Has seleccionado: " . htmlspecialchars($actividad['nombre_actividad']) . "</h2>";

        // Verificar si el usuario ya está inscrito en la actividad
        $sql_verificar = "SELECT * FROM inscripciones WHERE usuario_id = ? AND actividad_id = ?";
        $stmt_verificar = $conexion->prepare($sql_verificar);
        $stmt_verificar->bind_param("ii", $usuario_id, $actividad_id);
        $stmt_verificar->execute();
        $resultado_verificar = $stmt_verificar->get_result();

        if ($resultado_verificar->num_rows > 0) {
            echo "<p>Ya estás inscrito en esta actividad.</p>";
        } else {
            // Insertar la inscripción del usuario en la actividad
            $sql_insertar = "INSERT INTO inscripciones (usuario_id, actividad_id) VALUES (?, ?)";
            $stmt_insertar = $conexion->prepare($sql_insertar);
            $stmt_insertar->bind_param("ii", $usuario_id, $actividad_id);

            if ($stmt_insertar->execute()) {
                echo "<p>Inscripción exitosa en la actividad: " . htmlspecialchars($actividad['nombre_actividad']) . "</p>";
            } else {
                echo "<p>Error al inscribirse: " . htmlspecialchars($stmt_insertar->error) . "</p>";
            }

            $stmt_insertar->close();
        }

        $stmt_verificar->close();
        echo "</div>";
        echo "</body>";
        echo "</html>";

    } else {
        echo "Actividad no encontrada.";
    }

    $stmt->close();
} else {
    echo "No se ha recibido el ID de la actividad.";
}

$conexion->close();
?>
