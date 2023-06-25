document.querySelector(".cancel-button").addEventListener("click", function(e) {
  e.preventDefault();

  // Realizar una solicitud AJAX a un archivo PHP que destruya la sesión
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "cerrar_sesion.php", true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Redirigir al usuario a la página de inicio de sesión
      window.location.href = "index.html";
    }
  };
  xhr.send();
});

const form_two = document.getElementById("two");
const enviar_two = document.getElementById("enviar");
const errorMensaje = document.getElementById("error-mensaje");

enviar_two.addEventListener("click", (event) => {
  event.preventDefault(); // Evitar el envío del formulario predeterminado

  let cod = "";
  const inputs = document.getElementsByClassName("code-input")[0].getElementsByTagName("input");

  for (let i = 0; i < inputs.length; i++) {
    cod += inputs[i].value.trim();
  }

  // Realizar solicitud AJAX al servidor
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "two.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      let respuesta = xhr.responseText;
      if (respuesta == "Código de autenticación válido") {
        // Redirigir al usuario al sistema
        window.location.href = "up.php";
      } else {
        // Redirigir al usuario a la página de doble autenticación
        errorMensaje.textContent = "Código incorrecto. Inténtalo nuevamente."; // Mostrar mensaje de error
      }
    }
  };

  let parametros = "cod=" + encodeURIComponent(cod);
  xhr.send(parametros);
});

function moveToNext(currentInput, nextInputId) {
  const maxLength = parseInt(currentInput.getAttribute('maxlength'));
  const currentLength = currentInput.value.length;
  const inputValue = currentInput.value;

  if (/^\d+$/.test(inputValue)) {
    if (currentLength === maxLength) {
      document.getElementById(nextInputId).focus();
    }
  } else {
    currentInput.value = inputValue.replace(/[^\d]/g, '');
  }
}