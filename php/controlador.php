<?php
session_start();
require_once '../php/conexion.php';

$errores = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = filter_input(INPUT_POST, 'Correo', FILTER_SANITIZE_EMAIL);
    $nombre = filter_input(INPUT_POST, 'Nombre', FILTER_SANITIZE_STRING);
    $contrasena = $_POST["Contrasena"];
    $confirmar = $_POST["Confirmar"];

    function validar_registro($correo, $nombre, $contrasena, $confirmar)
    {
        $errores = [];

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

    if (empty($errores)) {
        $mysqli = obtener_conexion();

        if ($mysqli->connect_error) {
            $errores[] = "La conexión a la base de datos falló: " . htmlspecialchars($mysqli->connect_error);
        } else {
            $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE nombre = ? OR correo = ?");
            $stmt->bind_param("ss", $nombre, $correo);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                $errores[] = "¡Ya existe un usuario con esos datos!";
            } else {
                $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

                $stmt = $mysqli->prepare("INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $nombre, $correo, $hashed_password);

                if ($stmt->execute()) {
                    echo "<script>
                            alert('Usuario registrado, ya puedes iniciar sesión.');
                            window.location.href = '../inicio_sesion.php';
                          </script>";
                    exit();
                } else {
                    $errores[] = "Error al registrar el usuario: " . htmlspecialchars($stmt->error);
                }
            }

            $stmt->close();
        }

        $mysqli->close();
    }

    if (!empty($errores)) {
        $_SESSION['errores'] = $errores;
        header('Location: ../registro.php');
        exit();
    }
}
