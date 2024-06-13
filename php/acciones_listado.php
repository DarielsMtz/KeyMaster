<?php
session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre'])) {
    echo "<script>alert('¡Error de espía! Las contraseñas son como secretos. Debes registrarte para obtener el permiso de \"Top Secret\".');window.location.href = '../index.html';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- SEO = Básico -->
    <!-- Cada página del sitio tiene que ser diferente el título y la descripción -->
    <title>KeyMaster - Caja Fuerte</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!-- Etiquetas Open Graph y Twitter Card, para crear el SEO de Redes Sociales -->
    <meta property="og:title" content="Título de tu página" />
    <meta property="og:description" content="Descripción de tu página" />
    <meta property="og:image" content="URL de la imagen que quieres mostrar en las redes sociales" />
    <meta property="og:url" content="URL de tu página" />
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Título de tu página" />
    <meta name="twitter:description" content="Descripción de tu página" />
    <meta name="twitter:image" content="URL de la imagen que quieres mostrar en Twitter" />
    <!-- App Web, inidicar al navegador que elementos mostrar en un JSON -->
    <link rel="manifest" href="site.webmanifest" />
    <!-- icono de acceso para IOS -->
    <link rel="apple-touch-icon" href="icon.png" />
    <!-- Recordar que favicon.ico tiene que estar en el directorio inicial -->
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
    <!-- Enlace de inconos de interfaz -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <!-- links de estilos -->
    <link rel="stylesheet" href="../css/style.css" />
    <!-- Se cambia el tema de algunos navegadores -->
    <meta name="theme-color" content="#fafafa" />
    <!-- Scripts de diseño de alertas(JS) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body id="contrasenas">
    <div class="container">
        <main>
            <!-- Apartado del saludo al usuario -->
            <section class="contrasenas__sesion">
                <p>Tú caja fuerte, <b><?php echo $_SESSION['nombre'] ?></b></p>
                <a href="./generador.php">
                    <img src="../svg/equis.svg" alt="Icono de equis">
                </a>
            </section>
            <?php
            // Importamos la conexion a la base de datos
            require_once 'conexion.php';
            // Obtenemos la conexion a la base de datos
            $conexion = obtener_conexion();

            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Conexión fallida: " . $conexion->connect_error);
            }

            // Obtener el usuario de la sesión
            $usuario = $_SESSION['nombre'];
            $id_usuario = $_SESSION['id_usuario'];
            // $id_Contrasena = $_POST['id_Contrasena'];

            // Extraer las contraseñas de la base de datos
            $mostrar_contrasena = "SELECT * FROM contrasenas WHERE id_usuario = ? ORDER BY  fecha_creacion DESC";
            $consulta_preparada = $conexion->prepare($mostrar_contrasena);
            $consulta_preparada->bind_param("i", $id_usuario);
            if ($consulta_preparada->execute()) {
                // Obtener el resultado de la consulta
                $resultado = $consulta_preparada->get_result();

                // Si no hay contraseñas guardadas por el usuario
                if ($resultado->num_rows == 0) {
                    echo "<p>¡Ups! Parece que aún no has almacenado ninguna contraseña. <br>¡Ve y crea algunas experiencias seguras!</p>";
                } else {
                    // En el caso de que el usuario tenga contraseñas guardadas
                    echo "<h2>Contraseñas Almacenadas:</h2>";
                    echo "<table>";
                    echo "<tr><th>Contraseñas</th><th style='width:50%'>Fecha y Hora de su creación</th><th>Accion </th></tr>";

                    // Obtener los resultados y mostrarlos en una tabla
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $fila['contrasena'] . "</td>";
                        echo "<td>" . $fila['fecha_creacion'] . "</td>";
                        echo "<td>
                             <section class='btn_accion'>
                                <button id='copiar' class='copiar' type='button' onclick='copiarTexto(\"" . $fila['contrasena'] . "\")'>
                                    Copiar<img  src='../svg/Boton_copiar.svg' alt='Icono de copiar' />
                                </button>
                            
                                <button id='borrar' class='borrar' type='button' onclick='borrarTexto(\"" . $fila['contrasena'] . "\")'>
                                    Borrar<img  src='../svg/Boton_borrar.svg' alt='Icono de borrar' />
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
        </main>
    </div>
</body>
<script src="../js/generador_vip.js"></script>

</html>