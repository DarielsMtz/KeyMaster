<?php

$host = "http://localhost";
$user = "admin";
$pass = "admin123";
$bbdd = "keymaster";

// Realisamos la conexcion con la base de datos

$conexion = mysqli_connect($host, $user, $pass, $bbdd);

if (!$conexion) {
    die("No se pudo conectar a la base de datos");
}