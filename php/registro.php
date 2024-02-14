<?php
// Importamos la conexion a la base de datos
require_once 'conexion.php';

// Validacion del metodo de envio del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar campos aquí (por ejemplo, longitud, formato, etc.)
    $correo = $_POST["Correo"];
    $nombre = $_POST["Nombre"];
    $contrasena = $_POST["Contrasena"];
    $confirmar = $_POST["Confirmar"];

    // ------------------------------------------------------
    // VALIDACIONES NECESARIAS  PARA EL REGISTRO DE USUARIOS
    // Funcion de validaciones
    function validar_registro($correo, $nombre, $contrasena, $confirmar)
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
        $mysqli = obtener_conexion();

        // Verificar la conexión
        if ($mysqli->connect_error) {
            echo "La conexión a la base de datos falló: " . $mysqli->connect_error;
        }

        // Verificamos que el usuario no exite ya!
        $sql = "SELECT * FROM usuarios WHERE nombre = '$nombre' OR correo = '$correo'";
        $resultado = $mysqli->query($sql);
        if ($resultado->num_rows > 0) {
            echo "<script>
            alert('¡Ya existe un usuario con esos datos!');
            setTimeout(function() {
                window.location.href = '../registro.html';
            }, 1000); 
          </script>";
        } else {
            // Insertar usuario en la base de datos
            $sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES ('$nombre', '$correo', '$contrasena')";
            if ($mysqli->query($sql) === TRUE) {
                // echo "Usuario registrado correctamente en la base de datos";
                echo "<script>
                alert('Usuario registrado, ya puedes iniciar sesión.');
                window.location.href = '../inicio_sesion.html';
                </script>";
            } else {
                echo "Error al registrar el usuario: " . $mysqli->error;
            }
        }

        // Cerrar conexión
        $mysqli->close();
    }
}