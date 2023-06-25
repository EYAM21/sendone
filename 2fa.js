const form = document.getElementById("formulario2FA");
const enviar = document.getElementById("enviar");
const errorMensaje = document.getElementById("error-mensaje");




enviar.addEventListener("click", (event) => {
  event.preventDefault(); // Evitar el envío del formulario predeterminado

  let cod = document.getElementById("codigoTemporal").value;

  // Realizar solicitud AJAX al servidor
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "doble.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      let respuesta = xhr.responseText;
      if (respuesta == "Código de autenticación válido") {
        // Redirigir al usuario al sistema
        window.location.href = "sistema.php";
      } else {
        // Redirigir al usuario a la página de doble autenticación
        errorMensaje.textContent = "Código incorrecto. Inténtalo nuevamente."; // Mostrar mensaje de error;
      }

    }
  };

  let parametros = "cod=" + encodeURIComponent(cod);
  xhr.send(parametros);
});


