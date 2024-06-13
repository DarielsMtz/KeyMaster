<?php
// Inicialisamos la sesion
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre'])) {
    header("location: ../index.html");
    die();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- SEO = Básico -->
    <!-- Cada página del sitio tiene que ser diferente el título y la descripción -->
    <title>KeyMaster - Generador-Pro</title>
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

<body id="body__generador">
    <div id="generador">
        <!-- Apartado del encabezado -->
        <header class="container__main-header">
            <nav class="container__main-nav">
                <a href="#" class="container__main-nav-logo">
                    <img src="../svg/Logotipo.svg" alt="Logo de KeyMaster" />
                </a>
                <ul class="container__main-nav-menu">
                    <li class="menu_item">
                        <a href="#generador_app" class="active">Generador</a>
                    </li>
                    <li class="menu_item">
                        <a href="#conjeso_info">Consejos</a>
                    </li>
                    <li class="generador__main-sesion">
                        Hola, <b> <?php echo $_SESSION['nombre'] ?></b><i class="fa-regular fa-user"></i>
                        <ul class="submenu">
                            <li><a href="./acciones_listado.php"><i class="fa-solid fa-vault"></i> Caja Fuerte</a></li>
                            <li><a href="./cierre_sesion.php"><i class="fa-solid fa-right-from-bracket"></i> Cerrar
                                    Sesion</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>

        <!-- Apartado de la cabecera -->
        <section class="generador__cabecera">
            <article class="generador__cabecera-titulo">
                <section>
                    <h1>Generador de contraseñas seguras</h1>
                    <p class="generador__cabecera-titulo-btn">
                        <a href="../registro.html" class="crear_cuenta">Crea una cuenta de KeyMaster</a>
                        <a href="#generador_app" class="comenzar">Comenzar la experiencia</a>
                    </p>
                </section>
                <!-- Imagen de la cabecera -->
                <picture class="generador__cabecera-img">
                    <source srcset="../img/desktop/img_encabrzado.webp 320w" sizes="(max-width: 320px)"
                        type="image/webp">
                    <source srcset="../img/desktop/img_encabrzado@2x.webp 800w" sizes="(max-width: 800px)"
                        type="image/webp">
                    <source srcset="../img/desktop/img_encabrzado@3x.webp 1280w" sizes="(max-width: 1280px)"
                        type="image/webp">
                    <!-- Cantidad de source dependiendo su necesidad -->
                    <img src="casa-roja-enorme.jpg" title="Ilustracion"
                        alt="Ilustracion de la seguridad de una contraseña" loading="lazy">
                </picture>
            </article>
        </section>
        <!-- Apartado del main -->
        <main class="generador__main">
            <!-- Apartado de la carta principal -->
            <section class="generador__main-carta">
                <!-- Apartado del encabezado de main -->
                <section class="generador__main-header">
                    <h1>Generador de contraseñas gratuito</h1>
                    <h5>¿Necesitas una contraseña segura? Pruebe el generador de contraseñas de Bitwarden para crear
                        contraseñas complejas que mantendrán su información segura.</h5>
                </section>

                <section class="generador__main-app" id="generador_app">

                    <!-- Apartado del campo de la contraseña -->
                    <section class="generador__main-contrasena">
                        <article class="generador__main-contrasena-texto">
                            <input type="text" id="password_vip" placeholder="1QW3780$%$(mXASD" readonly />
                        </article>

                        <!-- Boton de copiar -->
                        <!-- <button id="copiar" type="button" class="genarador__main-contrasena-btn_copiar">
                            <img src="../svg/Boton_copiar.svg" alt="Icono de copiar" />
                        </button> -->
                    </section>

                    <!-- Apartado de botones -->
                    <section class="generador__main-botones">

                        <!-- Boton de guardar contraseñas -->
                        <button type="button" id="copiar_contrasena" class="guardar">
                            Copiar en el portapapeles
                        </button>

                        <!-- Boton de generar -->
                        <button type="button" id="generar_vip" class="generar">
                            Regenerar
                        </button>
                    </section>

                    <!-- Apartado de las longitudes de la contraseña -->
                    <section class="generador__main-longitudes">
                        <article>
                            <label>
                                <h4>Caracteres: </h4>
                                <span id="valor_rango">10</span>
                            </label>
                            <input type="range" name="Longitud" id="longitud" class="slider" value="10" min="8"
                                max="16" />
                        </article>
                    </section>

                    <!-- Apartado de opciones -->
                    <section class="generador__main-opciones">
                        <h4>Opciones adicionales</h4>

                        <article class="generador__main-opciones-lista">
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
                            <label class="generador__main__opciones-simbolos">
                                <input type="checkbox" name="simbolos" id="simbolos" />
                                <span>
                                    !@#$*%^&
                                </span>
                            </label>
                        </article>
                    </section>

                    <p class="generador__main_subtitulo">¿Quieres probar la seguridad de tu contraseña? <a
                            href="">Prueba esta herramienta de
                            seguridad</a></p>
                </section>
            </section>

            <!-- Apartado de la carta secundaria -->
            <section class="generador__main-informacion" id="conjeso_info">
                <!-- Imagen de la cabecera -->
                <picture class="generador__main-informacion-img">
                    <source srcset="../img/desktop/mockup_movil.webp 320w" sizes="(max-width: 320px)" type="image/webp">
                    <source srcset="../img/desktop/mockup_movil@2x.webp 800w" sizes="(max-width: 800px)"
                        type="image/webp">
                    <source srcset="../img/desktop/mockup_movil@3x.webp 1280w" sizes="(max-width: 1280px)"
                        type="image/webp">
                    <!-- Cantidad de source dependiendo su necesidad -->
                    <img src="casa-roja-enorme.jpg" title="Ilustracion"
                        alt="Ilustracion de la seguridad de una contraseña" loading="lazy">
                </picture>

                <!-- Texto de la carta secundaria -->
                <article class="generador__main-informacion-texto">
                    <h2>Principios para Generar una Contraseña Segura</h2>
                    <h3>Hazla Única</h3>
                    <p>Las contraseñas deben ser diferentes para cada cuenta. Esto disminuye la probabilidad de que
                        múltiples cuentas sean comprometidas si una de tus contraseñas se expone en una filtración de
                        datos.</p>

                    <h3>Hazla Aleatoria</h3>
                    <p>La contraseña debe incluir una combinación de letras mayúsculas y minúsculas, números, caracteres
                        especiales y palabras sin un patrón discernible. No debe estar relacionada con tu información
                        personal.</p>

                    <h3>Hazla Larga</h3>
                    <p>La contraseña debe tener al menos 14 caracteres. Un hacker puede tardar 39 minutos en descifrar
                        una contraseña de 8 caracteres, mientras que una de 16 caracteres podría tardar mil millones de
                        años en descifrarla.</p>
                </article>
            </section>

            <section class="generador__main_texto">
                <article class="generador__main_texto-caja">
                    <h2>¿Qué es un generador de contraseñas?</h2>
                    <p>Un generador de contraseñas es una herramienta que crea contraseñas seguras y aleatorias. Al usar
                        un
                        generador de contraseñas, puedes elegir la longitud y complejidad que deseas para tu nueva
                        contraseña. El generador producirá una contraseña segura que cumpla con tus especificaciones.
                    </p>
                    <p>Consejo Profesional: Con el generador de contraseñas gratuito de Bitwarden, puedes ajustar la
                        opción
                        "Tipo" para crear una frase de contraseña en lugar de una contraseña tradicional. Las frases de
                        contraseña combinan palabras generadas aleatoriamente a partir de un diccionario estandarizado,
                        como
                        panda-lunchroom-uplifting-resisting. Estas frases son seguras y más fáciles de recordar.</p>

                    <h2>¿Por qué necesitas un generador de contraseñas?</h2>
                    <p>Todos hemos pasado por el proceso de configurar una cuenta en un nuevo sitio web: se nos pide
                        crear
                        una contraseña que incluya letras mayúsculas y minúsculas, números y uno o dos caracteres
                        especiales
                        (o incluso tres o cuatro). Reflexionas un momento y escribes una contraseña que cumple con estas
                        reglas. Te sientes bien contigo mismo, pensando que nadie podría adivinar esa contraseña. Pero,
                        ¿estás seguro de que es lo suficientemente segura como para proteger tu información privada?
                    </p>
                    <p>El problema es que, incluso si diseñas tu contraseña para que sea larga y compleja, la mayoría de
                        las
                        personas tienden a usar caracteres o patrones fáciles de recordar, como tu cumpleaños o el
                        nombre de
                        tu mascota. Esto es arriesgado porque los hackers pueden utilizar la información pública sobre
                        ti en
                        redes sociales u otros sitios para intentar acceder a tus cuentas privadas mediante ataques de
                        fuerza bruta. Por eso, es crucial asegurarte de que tus contraseñas no contengan información
                        personal.</p>

                    <p>La buena noticia es que un generador de contraseñas seguras puede hacer el trabajo por ti,
                        creando
                        automáticamente contraseñas seguras, únicas y difíciles de descifrar.</p>
                </article>
            </section>

            <section class="generador__main_call">
                <h2>KeyMaster es la forma más segura de generar nuevas contraseñas</h2>
                <a href="../registro.html">Crear una cuenta</a>


            </section>

        </main>

        <!-- Apartado del pie de pagina -->
        <footer class="generador__footer">
            <section class="generador__footer-main">
                <nav class="generador__footer-nav">
                    <h4>®️ 2024 KeyMaster</h4>
                    <a href="../privacidad.html">Terminos</a>
                    <a href="../privacidad.html">Privacidad</a>
                    <a href="../cookies.html"> Uso de Cookies</a>
                </nav>
                <section class="generador__footer-redes">
                    <a href=""><img src="../svg/instagram.svg" alt=""></a>
                    <a href=""><img src="../svg/linkedin.svg" alt=""></a>
                    <a href=""><img src="../svg/github.svg" alt=""></a>
                    <a href=""><img src="../svg/x.svg" alt=""></a>
                </section>
            </section>
        </footer>
    </div>
</body>
<script src="../js/generador_vip.js"></script>

</html>