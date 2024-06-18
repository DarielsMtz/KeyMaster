<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- SEO = Básico -->
  <!-- Cada página del sitio tiene que ser diferente el título y la descripción -->
  <title>KeyMaster - Inicio de Sesion</title>
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
  <!-- links de estilos -->
  <link rel="stylesheet" href="css/style.css" />
  <!-- Se cambia el tema de algunos navegadores -->
  <meta name="theme-color" content="#fafafa" />
</head>

<body>
  <div id="container">
    <main class="container__main">
      <section class="container__main-header">
        <img src="svg/Logotipo_negativo.svg" alt="Imagen del Logotipo" />
        <p>Identifícate o crea una nueva cuenta.</p>
      </section>

      <!-- Apartado del formulario de inicio de sesion -->
      <section class="container__main-form">
        <!-- Formulario -->
        <form id="formulario_sesion" action="php/autenticacion.php" method="POST" novalidate>
          <!-- Usuario -->
          <label>Nombre Usuario</label>
          <input type="text" name="usuario" id="usuario" placeholder="" />

          <!-- Contraseña -->
          <label>Contraseña</label>
          <input type="password" name="contrasena" id="contrasena" placeholder="" />

          <!-- Boton -->
          <button class="container__main-form-boton" type="submit" value="Login">
            Continuar
          </button>

          <?php
          if (isset($_SESSION['error'])) {
            echo '<p style="color:red;">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
          }
          ?>
          <!-- Respuesta -->
          <div id="resp" class="form_msj"></div>

          <!-- Linear divisora -->
          <span class="container__main-form-divisor"></span>

          <!-- Enlaces externos -->
          <article class="container__main-form-enlaces">
            <a href="registro.html">¿Nuevo por aquí? <b> Crear cuenta</b></a>
            <a href="index.html"><b> Continuar como invitado</b></a>
          </article>
        </form>
      </section>
    </main>

    <footer class="container__main-footer">
      <h5>
        <a href="#">Politica de Privacidad</a> |
        <a href="#l">Politica de Cookies</a>
      </h5>
      <h6>&copy;Copyright - KeyMaster</h6>
    </footer>
  </div>
</body>
<script src="js/validar_sesion.js"></script>

</html>