// Apartado de la seccion de invitado
document
  .getElementById("invitado__generar")
  .addEventListener("click", function () {
    // Longitud de la contraseña
    const tam_min = 8;
    const tam_max = 15;

    // Intervalo del tamaño
    const tamano =
      Math.floor(Math.random() * (tam_max - tam_min + 1)) + tam_min;

    // Caracteres permitidos en la contraseña
    const numeros = "0123456789";
    const letras_min = "abcdefghijklmnopqrstuvwxyz";
    const letras_may = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

    // Arreglo con los caracteres de las contraseña
    let charset = numeros + letras_min + letras_may;
    // Generar contraseña aleatoria
    let contrasena = "";
    while (contrasena.length < tamano) {
      const num_aleatorio = Math.floor(Math.random() * charset.length);
      const nuevo_caracter = charset.charAt(num_aleatorio);
      if (!contrasena.includes(nuevo_caracter)) {
        contrasena += nuevo_caracter;
      }
    }

    // Actualizar el campo de contraseña
    document.getElementById("contrasena").value = contrasena;
  });

// Evento para copiar la contraseña generada
document
  .getElementById("invitado__copiar")
  .addEventListener("click", function () {
    const contrasena = document.getElementById("contrasena");

    if (contrasena.value) {
      contrasena.select();
      document.execCommand("copy");
      contrasena.blur();
      alert("Contraseña copiada al portapapeles");
    } else {
      alert("Genera una contraseña antes de intentar copiar.");
    }
  });
