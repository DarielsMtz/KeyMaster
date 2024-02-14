<?php
// Inciamos la sesion
session_start();
// Importamos la conexion a la base de datos
require_once 'conexion.php';

// Obtenemos la conexion a la base de datos
$conector = obtener_conexion();

// ----------------------------------------------------------------
// Verificamos que los campos de inicio de sesion esten rellenados
if (!isset($_POST['usuario'], $_POST['contrasena'])) {
    echo "Por favor ingresa el usuario y contraseña";
    exit();
}

// ----------------------------------------------------------------
// Preparamos la consltas a la base de datos
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

        // Si la cuenta existe, pasamos a su verificacion
        if ($_POST['contrasena'] === $contrasena) {
            // Verificación correcta!
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['nombre'] = $_POST['usuario'];
            $_SESSION['id_usuario'] = $id_usuario;
            header('Location: ../php/generador.php');
        } else {
            // Contraseña incorrecta
            echo "Usuario y/o Contraseña incorrecta";
        }
    } else {
        // Nombre de usuario incorrecto
        echo "Nombre de usuario y/o contraseña incorrecta";
    }
    $stmt->close();
}