<?php
// Iniciamos la sesión
session_start();
// Importamos la conexión a la base de datos
require_once './conexion.php';

// Obtenemos la conexión a la base de datos
$conector = obtener_conexion();

// ----------------------------------------------------------------
// Verificamos que los campos de inicio de sesión estén rellenados
if (!isset($_POST['usuario'], $_POST['contrasena'])) {
    $_SESSION['error'] = "Por favor ingresa el usuario y contraseña";
    header('Location: ../inicio_sesion.php');
    exit();
}

// ----------------------------------------------------------------
// Preparamos la consulta a la base de datos
if ($stmt = $conector->prepare('SELECT id_usuario, contrasena FROM usuarios WHERE nombre = ?')) {
    // Vincular parámetros (s = String, i = int, b = blob, etc.), en nuestro caso el nombre de usuario es una cadena, por lo que usamos "s".
    $stmt->bind_param('s', $_POST['usuario']);
    $stmt->execute();
    // Almacenar el resultado para que podamos verificar si la cuenta existe en la base de datos.
    $stmt->store_result();

    // ----------------------------------------------------------------
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_usuario, $contrasena);
        $stmt->fetch();

        // Si la cuenta existe, pasamos a su verificación
        if ($_POST['contrasena'] === $contrasena) {
            // Verificación correcta!
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['nombre'] = $_POST['usuario'];
            $_SESSION['id_usuario'] = $id_usuario;
            header('Location: ../index.php');
            exit();
        } else {
            // Contraseña incorrecta
            $_SESSION['error'] = "Usuario y/o Contraseña incorrecta";
            header('Location: ../inicio_sesion.php');
            exit();
        }
    } else {
        // Nombre de usuario incorrecto
        $_SESSION['error'] = "Usuario y/o Contraseña incorrecta";
        header('Location: ../inicio_sesion.php');
        exit();
    }
    $stmt->close();
} else {
    // Error al preparar la consulta
    $_SESSION['error'] = "Error en la base de datos, por favor intenta más tarde.";
    header('Location: ../inicio_sesion.php');
    exit();
}
$conector->close();