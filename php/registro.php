<?php
require_once '../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["Correo"];
    $nombre = $_POST["Nombre"];
    $contrasena = $_POST["Contrasena"];
    $confirmar = $_POST["Confirmar"];

    function validar_registro($correo, $nombre, $contrasena, $confirmar)
    {
        $errores = array();

        if (empty($correo) || empty($nombre) || empty($contrasena) || empty($confirmar)) {
            $errores[] = "Todos los campos son obligatorios.";
        }

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "El correo electrónico no es válido.";
        }

        if ($contrasena !== $confirmar) {
            $errores[] = "Las contraseñas no coinciden.";
        }

        if (strlen($contrasena) < 8) {
            $errores[] = "La contraseña debe tener al menos 8 caracteres.";
        }

        return $errores;
    }

    $errores = validar_registro($correo, $nombre, $contrasena, $confirmar);

    if (count($errores) > 0) {
        foreach ($errores as $error) {
            echo $error . "<br>";
        }
    } else {
        $mysqli = obtener_conexion();

        if ($mysqli->connect_error) {
            echo "La conexión a la base de datos falló: " . $mysqli->connect_error;
            exit();
        }

        $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE nombre = ? OR correo = ?");
        $stmt->bind_param("ss", $nombre, $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            echo "<script>
                    alert('¡Ya existe un usuario con esos datos!');
                    setTimeout(function() {
                        window.location.href = '../registro.html';
                    }, 1000);
                  </script>";
        } else {

            $stmt = $mysqli->prepare("INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nombre, $correo, $contrasena);

            if ($stmt->execute()) {
                echo "<script>
                        alert('Usuario registrado, ya puedes iniciar sesión.');
                        window.location.href = '../inicio_sesion.php';
                      </script>";
            } else {
                echo "Error al registrar el usuario: " . $stmt->error;
            }
        }

        $stmt->close();
        $mysqli->close();
    }
}