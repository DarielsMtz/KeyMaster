<?php
// Datos de conexion
$bbdd_host = 'localhost';
$bbdd_user = 'admin';
$bbdd_pass = 'admin123';
$bbdd_name = 'keymaster';

// Validacion del metodo de envio del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar campos aquí (por ejemplo, longitud, formato, etc.)
    $correo = $_POST["Correo"];
    $nombre = $_POST["Nombre"];
    $contrasena = $_POST["Contrasena"];
    $confirmar = $_POST["Confirmar"];

    // ------------------------------------------------------
    // VALIDACIONES NECESARIAS  

    // Funcion de validaciones
    function validar_registro($correo, $nomnbre, $contrasena, $confirmar)
    {
        // Variable para almanecar los errores
        $errores = array();

        // Validacion si los campos esta vacios
        if (empty($correo) ||  empty($nombre) || empty($contrasena) || empty($confirmar)) {
            $errores[] = "Todos los campos son obligatorios.";
        }

        // Validacion al campo de correo 
        if (empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "El correo electrónico no es válido.";
        }

        // Validacion al campo nombre
        if (!$contrasena === $confirmar) {
            $errores[] = "Las contraseñas no coinciden.";
        }
        return $errores;
    }
    // ---------------------------------------------------------

    // Llamamos a la funcion para llevar a cabo las validaciones
    $errores = validar_registro($correo, $nombre, $contrasena, $confirmar);
    if (count($errores) > 0) {
        // Muestra los errores
        foreach ($errores as $error) {
            echo $error . "<br>";
        }
    } else {
        // Si no hay errores, procede a la inserción en la base de datos
        $mysqli = new mysqli($bbdd_host, $bbdd_user, $bbdd_pass, $bbdd_name);

        // Verificar la conexión
        if ($mysqli->connect_error) {
            die("La conexión a la base de datos falló: " . $mysqli->connect_error);
        }

        // Insertar usuario en la base de datos
        $insertar_usuario = "INSERT INTO usuarios (correo, nombre, contrasena) VALUES ('$correo', '$nombre', '$contrasena')";
        if ($mysqli->query($insertar_usuario) === TRUE) {
            echo "Usuario registrado correctamente.";
            // header("Location: ../inicio_sesion.html");
        } else {
            echo "Error al registrar el usuario: " . $mysqli->error;
        }
        // --------------------------------------------
        // Cerrar conexión
        $mysqli->close();
    }
}