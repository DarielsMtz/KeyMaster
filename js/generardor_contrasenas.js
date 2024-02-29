// ********************************************
// --------- Generador de contraseñas ---------
// ********************************************

// ---- Evento para generar la contraseña ----
document
  .getElementById("invitado__generar")
  .addEventListener("click", function () {
    // Caracteres permitidos en la contraseña
    const numeros = "0123456789"; // Caracteres numéricos
    const letras_min = "abcdefghijklmnopqrstuvwxyz"; // Letras minúsculas
    const letras_may = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; // Letras mayúsculas

    // Arreglo con los caracteres de las contraseña
    let charset = numeros + letras_min + letras_may;
    // Generar contraseña aleatoria
    let contrasena = "";

    // Generar la contraseña aleatoria con los caracteres permitidos
    while (contrasena.length < 8) {
      const num_aleatorio = Math.floor(Math.random() * charset.length);
      const nuevo_caracter = charset.charAt(num_aleatorio);
      if (!contrasena.includes(nuevo_caracter)) {
        contrasena += nuevo_caracter; // Agregar el nuevo caracter
      }
    }
    // Actualizar el campo de contraseña
    document.getElementById("contrasena").value = contrasena;
  });

// ---- Evento para copiar la contraseña al portapapeles ----
document
  .getElementById("invitado__copiar")
  .addEventListener("click", function () {
    const contrasena = document.getElementById("contrasena");
    // Copiar la contraseña al portapapeles
    if (contrasena.value) {
      contrasena.select(); // Seleccionar el texto
      document.execCommand("copy");
      contrasena.blur(); // Quitar el foco del input
      alert("Contraseña copiada al portapapeles"); // Mostrar mensaje de copiado
    } else {
      // Mostrar mensaje si no hay contraseña generada
      alert("Genera una contraseña antes de intentar copiar.");
    }
  });
