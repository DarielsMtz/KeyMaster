// ************************************************
// --------- Generador de contraseñas Pro ---------
// ************************************************

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
  let LetrasMayusculasConsecutivas = 0;
  let NumerosConsecutivos = 0;
  let LetrasMinusculasConsecutivas = 0;
  let SimbolosConsecutivos = 0;

  // Generar la contraseña aleatoria con los caracteres permitidos
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

    // Se verifica si hay simbolos consecutivos
    if (/[!#$%&/*+-_?@]/.test(nuevo_caracter_vip)) {
      SimbolosConsecutivos++;
      if (SimbolosConsecutivos === 2) {
        continue;
      } else {
        SimbolosConsecutivos = 0;
      }
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
  document.getElementById("password_vip").value = contrasena_vip;
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
      // alert("Contraseña copiada al portapapeles");
      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
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
    xhr.open("POST", "../php/guardar_contrasenas.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        alert(xhr.responseText);
      }
    };
    xhr.send("contrasena= " + contrasena);
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
