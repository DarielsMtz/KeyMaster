<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['loggedin'])) {
    die("Usuario no autenticado");
}

// Importar la conexión a la base de datos
require_once 'conexion.php';

// Obtener la conexión a la base de datos
$conexion = obtener_conexion();

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener el usuario de la sesión y otros datos
$usuario = $_SESSION['nombre'];
$id_usuario = $_SESSION['id_usuario'];
$contrasena = $_POST['contrasena']; // Obtener la contraseña desde el formulario

// Verificar si la contraseña ya existe para este usuario
$sql_verificar = "SELECT id FROM contrasenas WHERE contrasena = ? AND id_usuario = ?";
$stmt_verificar = $conexion->prepare($sql_verificar);
$stmt_verificar->bind_param("si", $contrasena, $id_usuario);
$stmt_verificar->execute();
$stmt_verificar->store_result();
$num_rows = $stmt_verificar->num_rows;

if ($num_rows > 0) {
    // La contraseña ya existe para este usuario, no se guarda nuevamente
    echo "La contraseña ya existe para este usuario.";
} else {
    // Preparar la consulta SQL para insertar la contraseña
    $sql_insertar = "INSERT INTO contrasenas (contrasena, id_usuario, usuario) VALUES (?, ?, ?)";
    $stmt_insertar = $conexion->prepare($sql_insertar);

    if ($stmt_insertar) {
        // Vincular los parámetros y ejecutar la consulta de inserción
        $stmt_insertar->bind_param("sis", $contrasena, $id_usuario, $usuario);
        if ($stmt_insertar->execute()) {
            echo "Contraseña almacenada correctamente en la base de datos";
        } else {
            echo "Error al almacenar la contraseña: " . $stmt_insertar->error;
        }
        // Cerrar la consulta preparada de inserción
        $stmt_insertar->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conexion->error;
    }
}

// Cerrar la consulta preparada de verificación
$stmt_verificar->close();

// Cerrar la conexión
$conexion->close();