document.addEventListener("DOMContentLoaded", function () {
  var form = document.querySelector("form");

  form.addEventListener("submit", function (event) {
    if (!validateForm()) {
      event.preventDefault(); // Evita que el formulario se envíe si la validación no pasa
    }
  });

  // Función para validar el formulario de registro
  function validateForm() {
    let correo = document.getElementById("Correo");
    let nombre = document.getElementById("Usuario");
    let contrasena = document.getElementById("Contrasena");
    let confirmar = document.getElementById("Confirmar");
    let politicasCheckbox = document.querySelector('input[name="politicas"]');

    // Validar campos vacios
    if (
      nombre.value === "" ||
      correo.value === "" ||
      contrasena.value === "" ||
      confirmar.value === ""
    ) {
      // alert("Debes rellenar todos los campos.");
      Swal.fire("Debes rellenar todos los campos.");
      return false;
    }

    // Validación del correo electrónico
    let emailRegex = /^[a-zA-Z_]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (emailRegex.test(correo)) {
      alert("El correo electrónico no es válido.");
      return false;
    }

    // Validación de la contraseña
    if (contrasena.value.length < 8) {
      alert("La contraseña debe tener al menos 8 caracteres.");
      return false;
    }

    // Validación de la confirmación de la contraseña
    if (confirmar.value !== contrasena.value) {
      alert("Las contraseñas no coinciden.");
      return false;
    }

    // Validación del checkbox de políticas
    if (!politicasCheckbox.checked) {
      alert("Debes aceptar los Términos y Condiciones para continuar");
      return false;
    }
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
      title: "Signed in successfully",
    });
    return true;
  }
});
