document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");

  form.addEventListener("submit", (event) => {
    if (!validateForm()) {
      event.preventDefault(); // Evita que el formulario se envíe si la validación no pasa
    }
  });

  // Función para validar el formulario de registro
  function validateForm() {
    const correo = document.getElementById("Correo").value.trim();
    const nombre = document.getElementById("Usuario").value.trim();
    const contrasena = document.getElementById("Contrasena").value.trim();
    const confirmar = document.getElementById("Confirmar").value.trim();
    const politicasCheckbox = document.querySelector('input[name="politicas"]');

    // Validar campos vacíos
    if (!nombre || !correo || !contrasena || !confirmar) {
      Swal.fire("Debes rellenar todos los campos.");
      return false;
    }

    // Validación del correo electrónico
    const emailRegex = /^[a-zA-Z_]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailRegex.test(correo)) {
      Swal.fire("El correo electrónico no es válido.");
      return false;
    }

    // Validación de la contraseña
    if (contrasena.length < 8) {
      Swal.fire("La contraseña debe tener al menos 8 caracteres.");
      return false;
    }

    // Validación de la confirmación de la contraseña
    if (confirmar !== contrasena) {
      Swal.fire("Las contraseñas no coinciden.");
      return false;
    }

    // Validación del checkbox de políticas
    if (!politicasCheckbox.checked) {
      Swal.fire("Debes aceptar los Términos y Condiciones para continuar");
      return false;
    }

    Swal.fire({
      toast: true,
      position: "top-end",
      icon: "success",
      title: "Registro exitoso",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
      },
    });

    return true;
  }
});
