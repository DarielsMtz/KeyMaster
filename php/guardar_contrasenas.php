<?php
session_start();

// Incluimos el archivo de conexión 
include 'conexion.php';


// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre'])) {
    die("Usuario no autenticado");
}

// Conexión a la base de datos
// $conexion = new mysqli("localhost", "admin", "admin123", "keymaster");


// Obtener el usuario de la sesión
$usuario = $_SESSION['nombre'];
$id_usuario = $_SESSION['id_usuario'];
$contrasena = $_POST['contrasena']; // Obtener la contraseña de la sesión

// Insertar la contraseña en la base de datos vinculada al usuario
$pdo = new Conexion();
$sql = $pdo->prepare("INSERT INTO contrasenas (contrasena, id_usuario, usuario) VALUES ('$contrasena', '$id_usuario','$usuario')");
$sql->execute();
$sql->setFetchMode(PDO::FETCH_ASSOC);
header("HTTP/1.1 200 OK");

$resultado = $sql->fetchAll();

// Verificar si la consulta fue exitosa
if ($resultado) {
    echo "Contraseña guardada con éxito";
} else {
    echo "Error al intentar guardar la contraseña: ";
}