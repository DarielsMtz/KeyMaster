<?php
// Iniciamos la sesión
session_start();

// Destruimos todas las variables de sesión
$_SESSION = array();

// Finalmente, destruimos la sesión
session_destroy();

// Redirigimos a la página de inicio de sesión
header('Location: ../index.php');
exit();