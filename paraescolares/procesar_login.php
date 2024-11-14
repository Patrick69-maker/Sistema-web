<?php
session_start();
include 'db.php'; // Incluir la conexión a la base de datos

// Verificar si se enviaron los datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Consultar el usuario en la base de datos
    $sql = "SELECT id, correo, contraseña, tipo_usuario FROM usuarios WHERE correo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        // Verificar si la contraseña es correcta
        if (password_verify($contraseña, $usuario['contraseña'])) {
            // Crear las variables de sesión
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['correo'] = $usuario['correo'];
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

            // Crear una cookie para recordar la sesión durante 7 días, si se selecciona la opción "recordar"
            if (isset($_POST['recordar'])) {
                setcookie("usuario", $usuario['correo'], time() + (7 * 24 * 60 * 60), "/"); // 7 días de duración
                var_dump($_COOKIE);  // Para verificar si la cookie se ha establecido correctamente
            }

            // Redirigir según el tipo de usuario
            if ($usuario['tipo_usuario'] == 'administrador') {
                header('Location: gestionar_actividades.php');
            } elseif ($usuario['tipo_usuario'] == 'estudiante') {
                header('Location: ver_actividades.php');
            }
            exit();
        } else {
            echo "Contraseña incorrecta. <a href='login.html'>Intentar de nuevo</a>";
        }
    } else {
        echo "Correo no registrado. <a href='login.html'>Intentar de nuevo</a>";
    }

    // Cerrar la consulta y la conexión
    $stmt->close();
    $conexion->close();
}
?>
