document.addEventListener("DOMContentLoaded", () => {
  const formulario = document.getElementById("formulario_sesion");

  // Evento para validar el formulario de inicio de sesión
  formulario.addEventListener("submit", (event) => {
    const usuario = formulario.usuario.value.trim();
    const contrasena = formulario.contrasena.value.trim();

    // Validación de Usuario y Contraseña en caso de estar vacíos
    if (!usuario || !contrasena) {
      alert("Por favor, es necesario rellenar todos los campos.");
      event.preventDefault(); // Evita que el formulario se envíe
    }
  });
});
