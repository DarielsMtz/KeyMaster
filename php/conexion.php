<?php

// Función para obtener la conexión a la base de datos
function obtener_conexion()
{

    $bbdd_host = 'localhost';
    $bbdd_user = 'admin';
    $bbdd_pass = 'admin123';
    $bbdd_name = 'keymaster';

    // Activar la generación de informes de errores (opcional, para depuración)
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Realizamos la conexión con MySQL
    $conector = mysqli_connect($bbdd_host, $bbdd_user, $bbdd_pass, $bbdd_name);

    // Verificamos si la conexión fue exitosa
    if (!$conector) {
        // Mostrar el error y detener la ejecución
        die('Error al conectar a la base de datos: ' . mysqli_connect_error());
    }

    return $conector;
}

// Función para cerrar la conexión a la base de datos (opcional)
function cerrar_conexion($conector)
{
    mysqli_close($conector);
}
