<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "admin", "admin123", "keymaster");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Obtener el usuario de la sesión
    $usuario = $_SESSION['nombre'];
    $id_usuario = $_SESSION['id_usuario'];
    $contrasena_a_borrar = $_POST['contrasena'];

    // Consulta para borrar la contraseña específica
    $borrar_contrasena = "DELETE FROM contrasenas WHERE id_usuario = ? AND contrasena = ?";
    $consulta_preparada = $conexion->prepare($borrar_contrasena);
    $consulta_preparada->bind_param("is", $id_usuario, $contrasena_a_borrar);

    if ($consulta_preparada->execute()) {
        // Borrado exitoso
        echo "Contraseña borrada con éxito";
    } else {
        // Error en la consulta de borrado
        echo "Error al intentar borrar la contraseña: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}