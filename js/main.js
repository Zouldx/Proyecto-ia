$(document).ready(function () {
  $("#formlogin").submit(function (event) {
    event.preventDefault();

    console.log("dio click en el botòn con exito");

    var username = $.trim($('input[name="username"]').val());
    var password = $.trim($('input[name="password"]').val());

    if (!validateUsername(username)) {
      console.log("ingrese un email valido");
      return;
    }

    // Validar que la contraseña no esté vacía
    if (password === "") {
      console.log("ingrese un pasword por favor valido");
      return;
    }

    loginUser(username, password)
  });
});

function validateUsername(username) {
  // Expresión regular para validar emails y permitir solo letras, números, guiones bajos, puntos y guiones
  var emailRegex = /^[a-zA-Z0-9_.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9-.]+$/;
  return emailRegex.test(username);
}


function loginUser(username, password) {
    $.ajax({
      url: "./backend/login.php",
      method: "POST",
      data: { username: username, password: password },
      dataType: "json",
      success: function (response) {

        console.log("lo que responde" + response);
         if (response.status === "success") {
          /* alertify.success("Login successful"); */
          window.location.href = "./views/home.php";
        } else if (response.status === "error") {
          if (response.message === "El usuario está inactivo") {
            // Usuario inactivo
            alertify.error(response.message);
          } else {
            // Credenciales inválidas u otro error
            console.log("Error: " + response.message);
            alertify.error(response.message);
            $('input[name="username"]').val("");
            $('input[name="password"]').val("");
          }
        } else {
          console.log("Otro error");
          $("#result").html("<p>Error in AJAX call</p>");
        } 
      },
    });
  }