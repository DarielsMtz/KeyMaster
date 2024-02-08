<?php
// Inicialisamos la sesion
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- SEO = Básico -->
    <!-- Cada página del sitio tiene que ser diferente el título y la descripción -->
    <title>KeyMaster - Generador</title>
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
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <!-- Enlace de inconos de interfaz -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- links de estilos -->
    <link rel="stylesheet" href="css/style.css" />

    <!-- Se cambia el tema de algunos navegadores -->
    <meta name="theme-color" content="#fafafa" />
    <!-- Código de las plataformas de Análisis -->
    <script></script>
    <!-- Scripts a cargar antes de la renderización -->
    <!-- <script src="preloader.js"></script> -->
</head>

<body id="body__generador">
    <div id="generador">
        <main class="generador__main">
            <!-- Apartado del saludo al usuario -->
            <section class="generador__main-sesion">
                <p>Bienvenido, <b> <?php echo $_SESSION['nombre'] ?></b>!</p>
                <a href="php/cierre_sesion.php"><i class="fas fa-sign-out-alt"></i>Cerrar Sesion</a>
            </section>

            <!-- Apartado del encabezado de main -->
            <section class="generador__main-header">
                <h1>Generador de contraseñas</h1>
            </section>

            <!-- Apartado del campo de la contraseña -->
            <section class="generador__main-contrasena">
                <article class="generador__main-contrasena-texto">
                    <input type="text" id="password_vip" placeholder="1QW3780$%$(mXASD" readonly />
                </article>

                <!-- Boton de copiar -->
                <button id="copiar" type="button" class="genarador__main-contrasena-btn_copiar">
                    <img src="svg/Boton_copiar.svg" alt="Icono de copiar" />
                </button>

            </section>
            <h6>Las contraseñas generadas estan compuestas entre 8 a 15 caracteres*</h6>

            <!-- Apartado de opciones -->
            <section class="generador__main-opciones">
                <!-- Todas la opciones -->
                <label>
                    <input type="checkbox" name="todas_opciones" id="todas_opciones" checked />
                    Todas
                </label>

                <!-- Mayusculas -->
                <label>
                    <input type="checkbox" name="mayusculas" id="mayusculas" />
                    A-Z
                </label>

                <!-- Minusculas -->
                <label>
                    <input type="checkbox" name="minusculas" id="minusculas" />
                    a-z
                </label>

                <!-- Numeros -->
                <label>
                    <input type="checkbox" name="numeros" id="numeros" />
                    0-9
                </label>

                <!-- Simbolos -->
                <label>
                    <input type="checkbox" name="simbolos" id="simbolos" />
                    !@#$*%^&
                </label>
            </section>

            <!-- Apartado de las longitudes de la contraseña -->
            <section class="generador__main-longitudes">
                <article>
                    <label>
                        <h3>Longitud</h3>
                        <span id="valor_rango">8</span>
                    </label>
                    <input type="range" name="Longitud" id="longitud" value="8" min="8" max="15" />
                </article>
            </section>

            <!-- Apartado de botones -->
            <section class="generador__main-botones">
                <article>
                    <!-- Boton de generar -->
                    <button type="button" id="generar_vip" class="generar">
                        Generar
                    </button>

                    <!-- Boton de guardar contraseñas -->
                    <button type="button" id="guardar_contrasena" class="guardar">
                        Guardar
                    </button>
                </article>

                <!-- Boton de historial -->
                <article class="generador__main-botones-tooltip">
                    <a href="" id="historial">
                        <img src="svg/reloj.svg" alt="Icono de reloj" />
                    </a>
                    <div class="generador__main-botones-tooltiptext">Historial</div>
                </article>

            </section>

            <!-- Apartado de informacion -->
            <section class="generador__main-info">
                <article>
                    <h3>¿Qué es un generador de contraseñas y para qué sirve?</h3>
                    <p>
                        Un generador de contraseñas segura permite crear contraseñas en
                        función de unos parámetros como longitud y caracteres de forma
                        aleatoria. Gracias a esta funcionalidad podremos usar contraseñas
                        seguras y alejarnos de las contraseñas que son más obvias y por lo
                        tanto hackeables.
                    </p>
                </article>
                <article>
                    <h3>¿Es importante usar contraseñas seguras?</h3>
                    <p>
                        Si queremos proteger nuestros accesos a nuestras cuentas usar
                        contraseñas segura es una buena manera de empezar. Es cierto que
                        podemos tomar medidas complementarias para aumentar nuestras
                        medidas de seguridad como puede ser el utilizar un 2fa (segundo
                        factor de autenticación).
                    </p>
                </article>
                <article>
                    <h3>Características de una contraseñas segura</h3>
                    <p>
                        Las características más comunes de una buena contraseña con alto
                        nivel de seguridad encontramos:
                    <ul>
                        <li>Más de 12 caracteres de longitud.</li>
                        <li>Combinación de letras, números, mayúsculas, minúsculas y
                            caracteres.</li>
                        <li>Únicas, no debes usar la misma contraseña en más de un
                            sitio.</li>
                    </ul>
                    </p>
                </article>
                <article>
                    <h3>Contraseña más usadas?</h3>
                    <p>
                        Es muy común que muchos usuarios usen contraseñas sencillas de
                        recordar pero a su vez es la forma más fácil de que accedan a
                        nuestra información, entre las contraseñas más comunes podemos
                        encontrar:
                    <ul>
                        <li> 12345</li>
                        <li> Fecha de nacimiento</li>
                        <li> Contraseña</li>
                        <li> qwert</li>
                    </ul>
                    </p>
                </article>
            </section>
        </main>

        <!-- Apartado del pie de pagina -->
        <footer class="container__main-footer">
            <h5>
                <a href="privacidad.html">Politica de Privacidad</a> |
                <a href="cookies.html">Politica de Cookies</a>
            </h5>
            <h6>&copy;Copyright - KeyMaster</h6>
        </footer>
    </div>
</body>
<script src="js/generador_vip.js"></script>

</html>