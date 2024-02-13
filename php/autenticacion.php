<?php
// Inciamos la sesion
session_start();

// incluimos el archivo de conexion
include '../php/conexion.php';

// Recibimos los datos del formulario
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// -----------------Verificamos que los campos de inicio de sesion esten rellenados-----------------
if (!isset($_POST['usuario'], $_POST['contrasena'])) {
    echo "Por favor ingresa el usuario y contraseña";
    exit();
}

// -----------------Preparamos la consltas a la base de datos-----------------
// Instanciamos la clase Conexion
$conexion = new Conexion();

$consulta = $conexion->prepare('SELECT id_usuario, contrasena FROM usuarios WHERE nombre = ?');
$consulta->bindParam('s', $usuario);
$consulta->execute();
$consulta->setFetchMode(PDO::FETCH_ASSOC);
header("HTTP/1.1 200 OK");


$resultado = $consulta->fetch();

// Si la cuenta existe, pasamos a su verificacion
if ($resultado) {
    if (password_verify($contrasena, $resultado['contrasena'])) {
        // Verificación correcta!
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['nombre'] = $usuario;
        $_SESSION['id_usuario'] = $resultado['id_usuario'];
        header('Location: ../generador.php');
    } else {
        // Contraseña incorrecta
        echo "Usuario y/o Contraseña incorrecta";
    }
} else {
    // Nombre de usuario incorrecto
    echo "Nombre de usuario y/o contraseña incorrecta";
}