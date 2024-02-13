<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre'])) {
    die("Usuario no autenticado");
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "admin", "admin123", "keymaster");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener el usuario de la sesión
$usuario = $_SESSION['nombre'];
$id_usuario = $_SESSION['id_usuario'];

// Obtener la contraseña de la sesión
$contrasena = $_POST['contrasena'];

// Insertar la contraseña en la base de datos vinculada al usuario
$sql = "INSERT INTO contrasenas (contrasena, id_usuario, usuario) VALUES ('$contrasena', '$id_usuario','$usuario')";
if ($conexion->query($sql) === TRUE) {
    echo "Contraseña almacenada correctamente en la base de datos";
} else {
    echo "Error al almacenar la contraseña: " . $conexion->error;
}

// Cerrar la conexión
$conexion->close();