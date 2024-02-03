<?php

session_start();

// Datos de acceso a Mysql
$host = "localhost";
$user = "admin";
$pass = "admin123";
$bd = "";

// Realización de la conexion 
$conexion = mysqli_connect($host, $user, $pass, $bd);
if ($conexion) {
    echo "Conexion exitosa";

    // Creacion de la base de datos keymaster
    $sql = "CREATE DATABASE IF NOT EXISTS keymaster";
    $resultado = mysqli_query($conexion, $sql);
    if ($resultado) {
        echo "<br>Base de datos '<b>keymaster</b>' creada";

        // Creacion de las tablas de la base de datos
        $sql = "CREATE TABLE IF NOT EXISTS keymaster.usuarios (
                id_usuario INT NOT NULL AUTO_INCREMENT,
                nombre VARCHAR(255) NOT NULL,
                correo VARCHAR(255) NOT NULL,
                contraseña VARCHAR(255) NOT NULL,
                PRIMARY KEY (id_usuario))";
        $resultado = mysqli_query($conexion, $sql);
        if ($resultado) {
            echo "<br>Tabla '<b>usuarios</b>' creada";
        } else {
            echo "<br>Tabla '<b>usuarios</b>' no creada";
        }
    } else {
        echo "Error al crear la base de datos keymaster";
    }
} else {
    echo "Error al conectar a la base de datos";
}