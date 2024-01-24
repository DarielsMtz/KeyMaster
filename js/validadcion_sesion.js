b; // function validarFormulario() {
//   // Obtener referencias a los campos del formulario
//   let usuarioInput = document.getElementById("Usuario");
//   let contrasenaInput = document.getElementById("Contrasena");

//   // Restaurar estilos
//   usuarioInput.classList.remove("invalid");
//   contrasenaInput.classList.remove("invalid");

//   // Validar campos
//   let esValido = true;

//   if (usuarioInput.value.trim() === "") {
//     esValido = false;
//     usuarioInput.classList.add("invalid");
//   }

//   if (contrasenaInput.value.trim() === "") {
//     esValido = false;
//     contrasenaInput.classList.add("invalid");
//   }

//   // Enviar formulario si es válido, de lo contrario, mostrar un mensaje de error
//   if (esValido) {
//     alert("Formulario enviado correctamente");
//     // Aquí puedes agregar lógica para enviar el formulario
//   } else {
//     alert("Por favor, complete todos los campos obligatorios.");
//   }
// }
