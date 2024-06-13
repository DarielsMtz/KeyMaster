function registro() {
  //ajax
  var datos = new FormData($("#form_registro")[0]);
  datos.append("action", "registro");
  $.ajax({
    url: "./controlador/controladorLogin.php",
    method: "POST",
    timeout: 10000,
    data: datos,
    dataType: "json",
    processData: false,
    contentType: false,
    success: function (data) {
      if (data.codErr != 0) {
        $("#resp").html(data.msgErr);
      } else {
        $("#resp").html(data.msg);
      }
    },
  });
}
