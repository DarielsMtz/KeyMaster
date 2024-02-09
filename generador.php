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
                <p>Bienvenido, <b> <?php echo $_SESSION['nombre'] ?></b></p>
                <a href="php/cierre_sesion.php"><i class="fas fa-sign-out-alt"></i>Cerrar Sesion</a>
            </section>

            <!-- Apartado del encabezado de main -->
            <section class="generador__main-header">
                <h1>Generador de contraseñas v1.0</h1>
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
            <h5>Las contraseñas generadas estan compuestas entre 8 a 15 caracteres*</h5>

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
                    <a href="php/mostrar_contrasena.php" id="historial">
                        <img src="svg/reloj.svg" alt="Icono de reloj" />
                    </a>
                    <div class="generador__main-botones-tooltiptext">Caja Fuerte</div>
                </article>
            </section>

            <!-- Apartado de informacion -->
            <section class="generador__main-info">
                <h2 class="generador__main-info-titulo">Información</h2>
                <article>
                    <h3>¿Qué es un generador de contraseñas y para qué sirve?</h3>
                    <p>
                        Un generador de contraseñas es una herramienta que crea contraseñas seguras y únicas para cada
                        cuenta que tengas. En lugar de usar la misma contraseña para todo, o de crear contraseñas
                        fáciles de adivinar como "123456" o tu fecha de nacimiento, un generador de contraseñas crea una
                        combinación aleatoria de letras, números y símbolos que es muy difícil de hackear.
                    </p>
                </article>
                <article>
                    <h3>¿Es importante usar contraseñas seguras?</h3>
                    <p>
                        Sí, es fundamental usar contraseñas seguras para proteger tus accesos online. Las contraseñas
                        débiles son la puerta de entrada para los piratas informáticos que pueden acceder a tus cuentas,
                        robar tus datos personales y financieros, e incluso suplantar tu identidad.
                    </p>
                </article>
                <article>
                    <h3>Características de una contraseñas segura</h3>
                    <p>
                        Las características más comunes de una buena contraseña con alto
                        nivel de seguridad encontramos:
                    <ul>
                        <li>Longitud: Debe tener al menos 12 caracteres. Cuanto más larga sea la contraseña, más difícil
                            será de adivinar..</li>
                        <li>Complejidad: Debe incluir una combinación de letras mayúsculas y minúsculas, números y
                            símbolos.</li>
                        <li>Unicidad: Debe ser única para cada cuenta. No uses la misma contraseña en diferentes sitios
                            web o servicios.</li>
                        <li>Memorización: Aunque las contraseñas seguras son complejas, es importante que puedas
                            recordarlas sin necesidad de apuntarlas en un lugar inseguro.</li>
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
                        <li> Contraseñas simples: 12345, contraseña, qwerty, etc.</li>
                        <li> Información personal: Fecha de nacimiento, nombre de tu mascota, etc.</li>
                        <li> Palabras comunes: Amor, fútbol, Barcelona, etc.</li>
                    </ul>
                    </p>
                </article>
                <article>
                    <h3>Consejos para crear y usar contraseñas seguras:</h3>
                    <ul>
                        <li>Utiliza un generador de contraseñas para crear contraseñas seguras y únicas.</li>
                        <li>No compartas tus contraseñas con nadie, ni siquiera con amigos o familiares.</li>
                        <li>Cambia tus contraseñas regularmente, especialmente si sospechas que han sido comprometidas.
                        </li>
                        <li>Utiliza un gestor de contraseñas para almacenar tus contraseñas de forma segura</li>
                    </ul>
                </article>
                <article>
                    <h3>Seguridad en Internet</h3>
                    <p>
                        Usar contraseñas seguras es solo una parte de la seguridad en Internet. También es importante:
                    </p>
                    <ul>
                        <li>Mantener tu software actualizado.</li>
                        <li>Tener cuidado con los correos electrónicos y sitios web sospechosos.</li>
                        <li>Utilizar una conexión a internet segura.</li>
                        <li>Ser consciente de las últimas amenazas de seguridad.</li>
                    </ul>

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