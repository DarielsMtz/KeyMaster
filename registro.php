<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>KeyMaster - Registro</title>
    <meta name="description" content="Página de registro de KeyMaster." />
    <meta name="keywords" content="KeyMaster, registro, crear cuenta, formulario de registro" />

    <meta property="og:title" content="KeyMaster - Registro" />
    <meta property="og:description" content="Página de registro de KeyMaster." />
    <meta property="og:image" content="URL de la imagen que quieres mostrar en las redes sociales" />
    <meta property="og:url" content="URL de tu página" />
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="KeyMaster - Registro" />
    <meta name="twitter:description" content="Página de registro de KeyMaster." />
    <meta name="twitter:image" content="URL de la imagen que quieres mostrar en Twitter" />

    <link rel="manifest" href="site.webmanifest" />
    <link rel="apple-touch-icon" href="icon.png" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/style.css" />

    <meta name="theme-color" content="#fafafa" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>


<body id="body__registro">

    <div id="registro">
        <main class="registro__main">
            <h1>Crear cuenta</h1>
            <section class="registro__main-form">
                <form id="form_registro" action="php/controlador.php" method="post" novalidate>
                    <section>
                        <label for="Correo">Correo electrónico
                            <span class="requerido">(requerido)</span></label>
                        <input type="email" name="Correo" id="Correo" required aria-describedby="email-help" />
                        <small id="email-help">Utilizarás tu correo electrónico para acceder.</small>
                    </section>

                    <section>
                        <label for="Nombre">Nombre</label>
                        <input type="text" name="Nombre" id="Nombre" pattern="[A-Za-z]{2,20}" aria-describedby="name-help" />
                        <small id="name-help">¿Cómo deberíamos llamarte?</small>
                    </section>

                    <section>
                        <label for="Contrasena">Contraseña
                            <span class="requerido">(requerido)</span></label>
                        <input type="password" name="Contrasena" id="Contrasena" required minlength="8" aria-describedby="password-help" />
                        <small id="password-help">
                            <b>Importante:</b> ¡Las contraseñas no pueden ser recuperadas si
                            las olvidas! <i>8 caracteres mínimo</i>
                        </small>
                    </section>

                    <section>
                        <label for="Confirmar">Vuelve a escribir tu Contraseña
                            <span class="requerido">(requerido)</span></label>
                        <input type="password" name="Confirmar" id="Confirmar" required aria-describedby="confirm-help" />
                        <small id="confirm-help">Repite tu contraseña para confirmarla.</small>
                    </section>

                    <section class="registro__main-form-checkbox">
                        <label>
                            <input type="checkbox" name="politicas" required />
                            <p>
                                Al seleccionar esta casilla, acepta lo siguiente: <br />
                                <a href="terminos.html">Términos y Condiciones del servicio</a>,
                                <a href="privacidad.html">Política de privacidad</a>.
                            </p>
                        </label>
                    </section>

                    <section>
                        <button type="submit">Enviar</button>
                    </section>

                    <!-- Mensaje de errores -->
                    <div id="errores" style="color:red; font-size:12px;">
                        <?php
                        if (isset($_SESSION['errores'])) {
                            echo '<ul>';
                            foreach ($_SESSION['errores'] as $error) {
                                echo '<li>' . htmlspecialchars($error) . '</li>';
                            }
                            echo '</ul>';
                            unset($_SESSION['errores']);
                        }
                        ?>
                    </div>

                    <section>
                        <article class="registro__main-form-enlaces">
                            ¿Ya tienes una cuenta?
                            <a href="inicio_sesion.php">Identifícate</a>
                        </article>
                        <article class="registro__main-form-enlaces">
                            <a href="index.php" style="text-decoration: underline;">Volver al Inicio</a>
                        </article>
                    </section>
                </form>
            </section>
        </main>

        <footer>
            <h5>
                <a href="privacidad.html">Politica de Privacidad</a> |
                <a href="cookies.html">Politica de Cookies</a>
            </h5>
            <h6>&copy;Copyright - KeyMaster</h6>
        </footer>
    </div>
    <script src="js/validar_registro.js"></script>
</body>

</html>