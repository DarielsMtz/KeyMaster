<?php
// Inciamos la sesion
session_start();

// Datos de conexion
$bbdd_host = 'localhost';
$bbdd_user = 'admin';
$bbdd_pass = 'admin123';
$bbdd_name = 'keymaster';

// ----------------------------------------------------------------
// Realizamos la conexion con MySQL
$conector = mysqli_connect($bbdd_host, $bbdd_user, $bbdd_pass, $bbdd_name);
if (mysqli_connect_errno()) {
    echo "No se pudo conectar a la base de datos";
    exit();
}

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