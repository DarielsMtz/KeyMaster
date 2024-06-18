// Caracteres permitidos en la contraseña
const letras_may = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
const letras_min = "abcdefghijklmnopqrstuvwxyz";
const numeros = "0123456789";
const simbolos = "!#$%&/*+-_?@";

// Campos de las opciones
const incluir_mayusculas = document.getElementById("mayusculas");
const incluir_minusculas = document.getElementById("minusculas");
const incluir_numeros = document.getElementById("numeros");
const incluir_simbolos = document.getElementById("simbolos");
const incluir_todas = document.getElementById("todas_opciones");

// ------------ ACCIONES DE LA PAGINA DEL GENERADOR V.I.P --------------------
// Función para generar la cadena de caracteres según las opciones seleccionadas
function generarCadena() {
  let cadena = "";

  // Verificar las opciones seleccionadas
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

  // Verificar si se seleccionó al menos una opción
  if (cadena === "") {
    // Mostrar mensaje de error con SweetAlert2
    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 2800,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
      },
    });
    Toast.fire({
      background: "#61738f",
      color: "#dae0e6",
      icon: "error",
      title:
        "Debes seleccionar al menos una opción para generar la contraseña.",
    });
    return;
  }

  let contrasena_vip = "";
  const tamano_vip = obtenerTamanoContrasena();

  // Variables para contar tipos de caracteres
  let tieneMayuscula = false;
  let tieneMinuscula = false;
  let tieneNumero = false;
  let tieneSimbolo = false;

  // Generar la contraseña aleatoria con los caracteres permitidos
  while (contrasena_vip.length < tamano_vip) {
    const num_aleatorio_vip = Math.floor(Math.random() * cadena.length);
    const nuevo_caracter_vip = cadena.charAt(num_aleatorio_vip);

    // Verificar tipo de caracter y contar
    if (/[A-Z]/.test(nuevo_caracter_vip)) {
      tieneMayuscula = true;
    } else if (/[a-z]/.test(nuevo_caracter_vip)) {
      tieneMinuscula = true;
    } else if (/[0-9]/.test(nuevo_caracter_vip)) {
      tieneNumero = true;
    } else if (/[!#$%&/*+-_?@]/.test(nuevo_caracter_vip)) {
      tieneSimbolo = true;
    }

    // Agregar el nuevo caracter a la contraseña
    contrasena_vip += nuevo_caracter_vip;
  }

  // Verificar cumplimiento mínimo y aplicar bonificaciones y penalizaciones
  const cumpleRequisitos =
    (tieneMayuscula ? 1 : 0) +
    (tieneMinuscula ? 1 : 0) +
    (tieneNumero ? 1 : 0) +
    (tieneSimbolo ? 1 : 0);

  let resultadoFinal = 0;

  // Tamaño mínimo de 8 caracteres
  if (contrasena_vip.length >= 8) {
    resultadoFinal += contrasena_vip.length * 4;
  } else {
    // Penalización por tamaño insuficiente
    resultadoFinal -= 16;
  }

  // Bonificaciones y penalizaciones adicionales
  if (tieneMayuscula) {
    resultadoFinal += (contrasena_vip.length - 1) * 2;
  }
  if (tieneMinuscula) {
    resultadoFinal += (contrasena_vip.length - 1) * 2;
  }
  if (tieneNumero) {
    resultadoFinal += contrasena_vip.length * 4;
  }
  if (tieneSimbolo) {
    resultadoFinal += contrasena_vip.length * 6;
  }

  // Penalización por caracteres repetidos
  const caracteresRepetidos = contarCaracteresRepetidos(contrasena_vip);
  if (caracteresRepetidos > 0) {
    resultadoFinal -= caracteresRepetidos * (caracteresRepetidos - 1);
  }

  // Mostrar la contraseña generada si cumple con los requisitos mínimos
  if (cumpleRequisitos >= 3 && contrasena_vip.length >= 8) {
    document.getElementById("password_vip").value = contrasena_vip;
  } else {
    // Mostrar mensaje de error con SweetAlert2
    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 2800,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
      },
    });
    Toast.fire({
      background: "#61738f",
      color: "#dae0e6",
      icon: "error",
      title:
        "La contraseña generada no cumple con los requisitos mínimos de seguridad.",
    });
  }

  // Función auxiliar para contar caracteres repetidos
  function contarCaracteresRepetidos(contrasena) {
    let contador = {};
    contrasena.split("").forEach(function (caracter) {
      contador[caracter] = (contador[caracter] || 0) + 1;
    });
    let caracteresRepetidos = 0;
    for (let key in contador) {
      if (contador[key] > 1) {
        caracteresRepetidos += contador[key] - 1;
      }
    }
    return caracteresRepetidos;
  }
}

// -------------------------------------------------------------------
// Evento para generar la contraseña
document
  .getElementById("generar_vip")
  .addEventListener("click", generarContrasenaVIP);

// -------------------------------------------------------------------
// evento para copiar la contraseña generada
document
  .getElementById("copiar_contrasena")
  .addEventListener("click", function () {
    const campo_contrasena = document.getElementById("password_vip");
    if (campo_contrasena.value) {
      campo_contrasena.select();
      document.execCommand("copy");
      campo_contrasena.blur();
      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
        },
      });
      Toast.fire({
        icon: "success",
        title: "Contraseña copiada al portapapeles",
      });
    } else {
      alert("Genera una contraseña antes de intentar copiar.");
    }
  });

// -------------------------------------------------------------------
// Actualizar el valor del span con el valor del input range
let valor_input = document.getElementById("longitud");
let valor_salida = document.getElementById("valor_rango");
valor_input.addEventListener("input", function () {
  valor_salida.textContent = valor_input.value + "";
});

// -------------------------------------------------------------------
// Evento para el momento de guardar una contraseña
document
  .getElementById("guardar_contrasena")
  .addEventListener("click", function () {
    let contrasena = document.getElementById("password_vip").value;
    if (contrasena === "") {
      alert("Genera una contraseña antes de intentar guardarla.");
      return;
    }
    // Realizar la solicitud AJAX al script PHP
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/guardar_contrasenas.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        alert(xhr.responseText);
        // Simular un clic fuera del campo de contraseña para que pierda el foco
        document.body.click();
      }
    };
    xhr.send("contrasena=" + encodeURIComponent(contrasena));
  });

// ------------- ACCIONES DE LA PAGINA DEL LISTADO DE CONTRASEÑAS ----------------
// Funcion para copiar el texto al portapapeles
function copiarTexto(texto) {
  var copiar_contrasena = document.createElement("textarea");
  copiar_contrasena.value = texto;
  document.body.appendChild(copiar_contrasena);
  copiar_contrasena.select();
  document.execCommand("copy");
  document.body.removeChild(copiar_contrasena);
  // alert("Contraseña copia en el portapapel");
  // Componente de alerta de SweetAlert2
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 2800,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.onmouseenter = Swal.stopTimer;
      toast.onmouseleave = Swal.resumeTimer;
    },
  });
  Toast.fire({
    icon: "success",
    title: "Contraseña copiada al portapapeles", // Mostrar mensaje de copiado
  });
}

// Funcion para borrar una contraseña
function borrarTexto(contrasena) {
  // Pregunta al usuario si realmente desea borrar la contraseña
  Swal.fire({
    title: "¿Estas seguro de borrar la contraseña?",
    text: "No podrás recuperar la contraseña borrada!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    confirmButtonText: "Si, borrar!",
    cancelButtonText: "Cancelar",
    cancelButtonColor: "tomato",
  }).then((result) => {
    if (result.isConfirmed) {
      // Si el usuario confirma, se realiza la solicitud AJAX para borrar la contraseña
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          // Actualiza la página después de borrar la contraseña
          setTimeout(() => {
            location.reload();
          }, 1000);
        }
      };
      xhr.open("POST", "../php/borrar_contrasena.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send("contrasena=" + contrasena);

      Swal.fire({
        title: "Eliminada!",
        text: "Tu contraseña ha sido eliminada.",
        icon: "success",
        confirmButtonText: "Vale",
      });
    }
  });
}
