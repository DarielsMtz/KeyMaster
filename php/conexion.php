<?php

// Funcion para obtener la conexion a la base de datos
function obtener_conexion()
{
    // Datos de conexion
    $bbdd_host = 'bbdd.darielsmartinezedib.com';
    $bbdd_user = 'ddb219218';
    $bbdd_pass = 'vmKvQ1Iix+JXr)';
    $bbdd_name = 'ddb219218';

    // Realizamos la conexion con MySQL
    $conector = mysqli_connect($bbdd_host, $bbdd_user, $bbdd_pass, $bbdd_name);
    if (mysqli_connect_errno()) {
        exit();
    }

    return $conector;
}