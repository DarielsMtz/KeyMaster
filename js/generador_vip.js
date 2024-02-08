// Caracteres permitidos en la contraseña
const letras_may = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
const letras_min = "abcdefghijklmnopqrstuvwxyz";
const numeros = "0123456789";
const simbolos = "c";

// Campos de las opciones
const incluir_mayusculas = document.getElementById("mayusculas");
const incluir_minusculas = document.getElementById("minusculas");
const incluir_numeros = document.getElementById("numeros");
const incluir_simbolos = document.getElementById("simbolos");
const incluir_todas = document.getElementById("todas_opciones");

// Declarar un array para almacenar el historial de contraseñas
let historialContraseñas = [];

// -------------------------------------------------------------------
// Función para generar la cadena de caracteres según las opciones seleccionadas
function generarCadena() {
  let cadena = "";

  if (incluir_todas.checked) {
    cadena += numeros + letras_min + letras_may + simbolos;
  } else {
    if (incluir_numeros.checked) cadena += numeros;
    if (incluir_minusculas.checked) cadena += letras_min;
    if (incluir_mayusculas.checked) cadena += letras_may;
    if (incluir_simbolos.checked) cadena += simbolos;
  }

  return cadena;
}

// -------------------------------------------------------------------
// Función para obtener el tamaño de la contraseña
function obtenerTamanoContrasena() {
  const longitudSeleccionada = parseInt(
    document.getElementById("longitud").value
  );
  return longitudSeleccionada;
}

// -------------------------------------------------------------------
// Función para generar una contraseña VIP
function generarContrasenaVIP() {
  const cadena = generarCadena();

  if (cadena === "") {
    alert("Debes seleccionar al menos una opción para generar la contraseña.");
    return;
  }

  let contrasena_vip = "";
  const tamano_vip = obtenerTamanoContrasena();
  let LetrasMayusculasConsecutivas = 0;
  let NumerosConsecutivos = 0;
  let LetrasMinusculasConsecutivas = 0;

  while (contrasena_vip.length < tamano_vip) {
    const num_aleatorio_vip = Math.floor(Math.random() * cadena.length);
    const nuevo_caracter_vip = cadena.charAt(num_aleatorio_vip);

    // Se verifica si hay letras mayusculas consecutivas
    if (/[A-Z]/.test(nuevo_caracter_vip)) {
      LetrasMayusculasConsecutivas++;
      if (LetrasMayusculasConsecutivas === 2) {
        continue;
      }
    } else {
      LetrasMayusculasConsecutivas = 0;
    }

    // Se verifica si hay letras minusculas consecutivas
    if (/[a-z]/.test(nuevo_caracter_vip)) {
      LetrasMinusculasConsecutivas++;
      if (LetrasMinusculasConsecutivas === 2) {
        continue;
      }
    } else {
      LetrasMinusculasConsecutivas = 0;
    }

    // Verificar si hay tres números consecutivos
    if (/[0-9]/.test(nuevo_caracter_vip)) {
      NumerosConsecutivos++;
      if (NumerosConsecutivos === 3) {
        continue;
      }
    } else {
      NumerosConsecutivos = 0;
    }

    // Verificar si hay tres letras en orden alfabético
    if (
      /[A-Za-z]/.test(nuevo_caracter_vip) &&
      /[A-Za-z]/.test(contrasena_vip.charAt(contrasena_vip.length - 1))
    ) {
      if (
        nuevo_caracter_vip.charCodeAt(0) ===
        contrasena_vip.charCodeAt(contrasena_vip.length - 1) + 1
      ) {
        continue;
      }
    }

    // Se agregael nuevo caracter a la contraseña
    contrasena_vip += nuevo_caracter_vip;
  }

  historialContraseñas.push(contrasena_vip);
  document.getElementById("password_vip").value = contrasena_vip;
}

// -------------------------------------------------------------------
// Función para mostrar el historial de contraseñas
function mostrarHistorial(event) {
  event.preventDefault();
  alert("Historial de contraseñas:\n" + historialContraseñas.join("\n"));
}

// -------------------------------------------------------------------
// Agregar eventos de clic a los botones
document
  .getElementById("generar_vip")
  .addEventListener("click", generarContrasenaVIP);
document
  .getElementById("historial")
  .addEventListener("click", mostrarHistorial);
document.getElementById("copiar").addEventListener("click", function () {
  const campo_contrasena = document.getElementById("password_vip");

  if (campo_contrasena.value) {
    campo_contrasena.select();
    document.execCommand("copy");
    campo_contrasena.blur();
    alert("Contraseña copiada al portapapeles");
  } else {
    alert("Genera una contraseña antes de intentar copiar.");
  }
});

// -------------------------------------------------------------------
// Actualizar el valor del span con el valor del input range
let valor_input = document.getElementById("longitud");
let valor_salida = document.getElementById("valor_rango");
valor_input.addEventListener("input", function () {
  valor_salida.textContent = valor_input.value + " ";
});

document
  .getElementById("guardar_contrasena")
  .addEventListener("click", function () {
    let contrasena = document.getElementById("password_vip").value;

    // Realizar la solicitud AJAX al script PHP
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "guardar_contrasenas.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        alert(xhr.responseText);
      }
    };

    xhr.send("contrasena= " + contrasena);
  });

// TODO Estila los mensajes de alerta
