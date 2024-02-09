<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>

    <style>

    </style>
</head>

<body id="contrasenas">
    <div class="container">
        <!-- Apartado del saludo al usuario -->
        <section class="contrasenas__sesion">
            <p>Tú caja fuerte, <b><?php echo $_SESSION['nombre'] ?></b></p>
            <a href="../generador.php">
                <img src="../svg/equis.svg" alt="Icono de equis">
            </a>
        </section>
        <?php


        // Verificar si el usuario ha iniciado sesión
        if (!isset($_SESSION['nombre'])) {
            die("Usuario no autenticado");
        }

        // Conexión a la base de datos
        $conexion = new mysqli("localhost", "admin", "admin123", "keymaster");

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        // Obtener el usuario de la sesión
        $usuario = $_SESSION['nombre'];
        $id_usuario = $_SESSION['id_usuario'];

        // Extraer las contraseñas de la base de datos
        $mostrar_contrasena = "SELECT * FROM contrasenas WHERE id_usuario = ?";
        $consulta_preparada = $conexion->prepare($mostrar_contrasena);
        $consulta_preparada->bind_param("i", $id_usuario);

        if ($consulta_preparada->execute()) {
            // Obtener el resultado de la consulta
            $resultado = $consulta_preparada->get_result();

            // Si no hay contraseñas guardadas por el usuario
            if ($resultado->num_rows == 0) {
                echo "<p>No se han encontrado contraseñas</p>";
            } else {
                // En el caso de que el usuario tenga contraseñas guardadas
                echo "<h2>Contraseñas Almacenadas:</h2>";
                echo "<table>";
                echo "<tr><th>Contraseñas</th><th style='width:60%'>Fecha y Hora de su creación</th><th>Accion </th></tr>";

                // Obtener los resultados y mostrarlos en una tabla
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila['contrasena'] . "</td>";
                    echo "<td>" . $fila['fecha_creacion'] . "</td>";
                    echo "<td>
                             <section class='btn_accion'>
                                <button id='copiar' class='copiar' type='button' onclick='copiarTexto(\"" . $fila['contrasena'] . "\")'>
                                    <img  src='../svg/Boton_copiar.svg' alt='Icono de copiar' />
                                </button>
                                <button id='borrar' class='borrar' type='button' onclick='borrarTexto(\"" . $fila['contrasena'] . "\")'>
                                    <img  src='../svg/Boton_borrar.svg' alt='Icono de borrar' />
                                </button>
                            </section>
                        </td>";
                    echo "</tr>";
                }
                echo "</table>";



                // Liberar el resultado
                $resultado->free_result();
            }

            // Cerrar la conexión
            $conexion->close();
        } else {
            // Mostrar un mensaje de error si la consulta falla
            echo "Error en la consulta: " . $conexion->error;
        }
        ?>
    </div>
</body>
<script src="../js/generador_vip.js"></script>


</html>