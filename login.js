const abrirLogin = document.getElementById("abrirLogin");
const cerrarLogin = document.getElementById("cerrarLogin");
const formlogin = document.getElementById("formlogin");
const fondoLogin = document.querySelector(".fondo_login");
const iniciar_sesion = document.getElementById("iniciar_sesion");

abrirLogin.addEventListener("click", () => {
  formlogin.classList.add("mostrar");
  fondoLogin.classList.add("mostrar-fondo");
});

cerrarLogin.addEventListener("click", () => {
  formlogin.classList.remove("mostrar");
  fondoLogin.classList.remove("mostrar-fondo");
});

iniciar_sesion.addEventListener("click", () => {
  let correo = document.getElementById("username").value;
  let contraseña = document.getElementById("password").value;
  let mensajeError = document.getElementById("mensaje-error");

  // Realizar solicitud AJAX al servidor
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "login.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log(xhr.responseText);
      // Respuesta recibida del servidor
      let respuesta = xhr.responseText;
      if (respuesta === "success") {
        // Inicio de sesión exitoso, realizar acciones necesarias
        // Verificar la doble autenticación
        let xhr2 = new XMLHttpRequest();
        xhr2.open("POST", "verificar_2fa.php", true);
        xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr2.onreadystatechange = function() {
          if (xhr2.readyState === 4 && xhr2.status === 200) {
            let respuesta2 = xhr2.responseText;
            if (respuesta2 == "habilitada") {
              // Redirigir al usuario al sistema
              window.location.href = "verificar.php";
            } else {
              // Redirigir al usuario a la página de doble autenticación
              window.location.href = "2fa.php";
            }
          }
        };
        xhr2.send("usuario=" + encodeURIComponent(correo));
      } else {
        // Error en la autenticación, mostrar mensaje de error específico
        if (respuesta === "correo") {
          mensajeError.textContent = "El correo ingresado no se encuentra registrado.";
        } else if (respuesta === "contraseña") {
          mensajeError.textContent = "La contraseña ingresada no es válida.";
        } else {
          mensajeError.textContent = "Correo y contraseña incorrectos.";
        }
      }
    }
  };

  let parametros = "correo=" + encodeURIComponent(correo) + "&contraseña=" + encodeURIComponent(contraseña);
  xhr.send(parametros);
});
