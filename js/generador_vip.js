// ----------------------------------------------------------------
// Apartado del generador VIP (Usuario Registrado)
// Apartado del campo de la contraseña VIP
document.getElementById("generar_vip").addEventListener("click", function () {
  // Longitud de la contraseña
  const tam_min = 8;
  const tam_max = 15;

  // Intervalo del tamaño
  const tamano = Math.floor(Math.random() * (tam_max - tam_min + 1)) + tam_min;

  // Caracteres permitidos en la contraseña
  const numeros = "0123456789";
  const letras_min = "abcdefghijklmnopqrstuvwxyz";
  const letras_may = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  const simbolos = " !#$%&'()*+,-./:;<=>?@[]^_`{| ~";

  // Arreglo con los caracteres de las contraseña
  let charset = numeros + letras_min + letras_may + simbolos;
  // Generar contraseña aleatoria VIP
  let contrasena_vip = "";
  const tamano_vip = obtenerTamanoContrasena(); // Agrega esta línea para obtener el tamaño de la contraseña
  while (contrasena_vip.length < tamano_vip) {
    const num_aleatorio_vip = Math.floor(Math.random() * charset.length);
    const nuevo_caracter_vip = charset.charAt(num_aleatorio_vip);
    if (!contrasena_vip.includes(nuevo_caracter_vip)) {
      contrasena_vip += nuevo_caracter_vip;
    }
  }

  // Actualizar el campo de contraseña VIP
  document.getElementById("password_vip").value = contrasena_vip;

  // Calcular y actualizar la fortaleza de la contraseña VIP
  const nivel_seguridad_vip = calculo_nivel_seguridad(contrasena_vip);
  actualizar_barra_progreso_vip(nivel_seguridad_vip);
});

// Función para obtener el tamaño de la contraseña
function obtenerTamanoContrasena() {
  // Puedes ajustar este rango según tus preferencias
  return Math.floor(Math.random() * (15 - 8 + 1)) + 8;
}
