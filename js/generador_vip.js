// ----------------------------------------------------------------
// Caracteres permitidos en la contraseña
const numeros = "0123456789";
const letras_min = "abcdefghijklmnopqrstuvwxyz";
const letras_may = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
const simbolos = "!#$%&'()*+,-./:;<=>?@[]^_`{| ~";

// Campos de las opciones
const incluir_todas = document.getElementById("todas_opciones");
const incluir_mayusculas = document.getElementById("mayusculas");
const incluir_minusculas = document.getElementById("minusculas");
const incluir_simbolos = document.getElementById("simbolos");
const incluir_numeros = document.getElementById("numeros");

// Declarar un array para almacenar el historial de contraseñas
let historialContraseñas = [];

// ----------------------------------------------------------------
// Apartado del generador VIP (Usuario Registrado)
document.getElementById("generar_vip").addEventListener("click", function () {
  // Actualizar el conjunto de caracteres según las opciones seleccionadas
  let cadena = "";

  // Validacion de los campos de opciones
  if (incluir_todas.checked) {
    cadena += numeros + letras_min + letras_may + simbolos;
  } else {
    if (incluir_numeros.checked) cadena += numeros;
    if (incluir_minusculas.checked) cadena += letras_min;
    if (incluir_mayusculas.checked) cadena += letras_may;
    if (incluir_simbolos.checked) cadena += simbolos;
  }

  // En caso de no tener una opcion selecionada
  if (cadena === "") {
    alert("Debes seleccionar al menos una opción para generar la contraseña.");
    return;
  }

  // Generar contraseña aleatoria VIP
  let contrasena_vip = "";
  const tamano_vip = obtenerTamanoContrasena();
  while (contrasena_vip.length < tamano_vip) {
    const num_aleatorio_vip = Math.floor(Math.random() * cadena.length);
    const nuevo_caracter_vip = cadena.charAt(num_aleatorio_vip);

    if (!contrasena_vip.includes(nuevo_caracter_vip)) {
      contrasena_vip += nuevo_caracter_vip;
    }
  }
  // Guardar la contraseña en el historial y en la base de datos
  historialContraseñas.push(contrasena_vip);

  // Actualizar el campo de contraseña VIP
  document.getElementById("password_vip").value = contrasena_vip;
});

// ----------------------------------------------------------------
// Función para obtener el tamaño de la contraseña
function obtenerTamanoContrasena() {
  // Puedes ajustar este rango según tus preferencias
  return Math.floor(Math.random() * (15 - 8 + 1)) + 8;
}

// ----------------------------------------------------------------
// Apartado de las longitudes de la contraseña
document.getElementById("longitud").addEventListener("input", function () {
  // Obtener el valor actual del rango
  const valorRango = this.value;

  // Actualizar la etiqueta que muestra la longitud seleccionada
  document.getElementById("label_longitud").innerText = valorRango;

  // Actualizar el valor del rango directamente
  document.getElementById("valor_rango").innerText = valorRango;
});

// Actualizamos el valor del span con el valor del input range
let valor_input = document.getElementById("longitud");
let valor_salida = document.getElementById("valor_rango");
valor_input.addEventListener("input", function () {
  valor_salida.textContent = valor_input.value + " ";
});

// ----------------------------------------------------------------
// Función para mostrarel tamaño de la contraseña
function obtenerTamanoContrasena() {
  // Obtener el valor actual de la longitud seleccionada
  const longitudSeleccionada = parseInt(
    document.getElementById("longitud").value
  );
  return longitudSeleccionada;
}

// ----------------------------------------------------------------
// Agregar evento de clic al botón de copiar
document.getElementById("copiar").addEventListener("click", function () {
  // Seleccionar el campo de contraseña VIP
  const campo_contrasena = document.getElementById("password_vip");

  // Verificar si hay una contraseña para copiar
  if (campo_contrasena.value) {
    // Seleccionar y copiar el texto al portapapeles
    campo_contrasena.select();
    document.execCommand("copy");

    // Desseleccionar el campo para evitar confusiones visuales
    campo_contrasena.blur();

    // Puedes mostrar un mensaje o realizar cualquier acción adicional aquí
    alert("Contraseña copiada al portapapeles");
  } else {
    // Aviso al no tener una contraseña que copiar
    alert("Genera una contraseña antes de intentar copiar.");
  }
});

// ---------------------------------------------------------------
// Funcion para generar un hostorial de contraseñas
document
  .getElementById("historial")
  .addEventListener("click", function (event) {
    event.preventDefault();
    alert("Historial de contraseñas:\n" + historialContraseñas.join("\n"));
  });
