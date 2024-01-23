// Simula el cambio en el nivel de seguridad (puede ser ajustado según tus necesidades)
let nivelDeSeguridad = 45;

// Actualiza la barra de progreso y la etiqueta
function actualizarProgreso() {
  const barra = document.getElementById("progress");
  const etiqueta = document.getElementById("label");

  barra.style.width = nivelDeSeguridad + "%";
  etiqueta.textContent = nivelDeSeguridad + "%";
}

// Llama a la función para actualizar el progreso
actualizarProgreso();
