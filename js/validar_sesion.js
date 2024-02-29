document.addEventListener("DOMContentLoaded", function () {
  let formulario = document.getElementById("formulario_sesion");

  // Evento para validar el formulario de inicio de sesión
  formulario.addEventListener("submit", function (event) {
    let usuario = document.getElementById("usuario").value.trim();
    let contrasena = document.getElementById("contrasena").value.trim();

    // Validación de Usuario y Contraseña en caso de estar vacíos
    if (usuario === "" || contrasena === "") {
      alert("Por favor, es necesario rellenar todos los campos.");
      event.preventDefault(); // Evita que el formulario se envíe
      return false;
    }
  });
});
