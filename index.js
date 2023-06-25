


const abrirRegistro = document.getElementById("abrirRegistro");
const cerrarRegistro = document.getElementById("cerrarRegistro");
const formularioRegistro = document.getElementById("formularioRegistro");
const fondo = document.querySelector(".fondo");
const contrasenaInput = document.getElementById("contraseña");
const passwordError = document.getElementById("passwordError");
const mensajeContraseña = document.getElementById("mensajeContraseña");
const correoInput = document.getElementById("correo");
const correoError = document.getElementById("correoError");
const confirmarContrasenaInput = document.getElementById("confirmacion");
const confirmarContrasenaError = document.getElementById("confirmarContrasenaError");
const botonRegistro = document.getElementById("botonRegistro");
const mensajeError = document.getElementById("mensajeError");
const nombreInput = document.getElementById("nombre");
const segundo_nombreInput = document.getElementById("segundo_nombre");
const apellido_paternoInput = document.getElementById("apellido_paterno");
const apellido_maternoInput = document.getElementById("apellido_materno");
const cargoInput = document.getElementById("cargo");
const aceptaTerminos = document.getElementById('acepta_terminos');
const aceptarError = document.getElementById("aceptar");
const preguntaInput = document.getElementById("preguntaSeguridad");
const respuestaInput = document.getElementById("respuestaSeguridad");


// Variables globales para controlar la sección actual del formulario
var seccionActual = "seccionPersonal";
var secciones = ["seccionPersonal", "seccionContacto", "seccionContraseña"];

// Función para mostrar la siguiente sección del formulario
function siguienteSeccion(seccion) {
  var seccionActualElemento = document.getElementById(seccionActual);
  var seccionSiguienteElemento = document.getElementById(seccion);



  // Ocultar sección actual y mostrar la siguiente
  seccionActualElemento.style.display = "none";
  seccionSiguienteElemento.style.display = "block";

  // Actualizar la sección actual
  seccionActual = seccion;
}

// Función para mostrar la sección anterior del formulario
function anteriorSeccion(seccion) {
  var seccionActualElemento = document.getElementById(seccionActual);
  var seccionAnteriorElemento = document.getElementById(seccion);

  // Ocultar sección actual y mostrar la anterior
  seccionActualElemento.style.display = "none";
  seccionAnteriorElemento.style.display = "block";

  // Actualizar la sección actual
  seccionActual = seccion;
}







abrirRegistro.addEventListener("click", () => {
  formularioRegistro.classList.add("mostrar");
  fondo.classList.add("mostrar-fondo");
  nombreInput.focus();
  segundo_nombreInput.focus();
  apellido_paternoInput.focus();
  apellido_maternoInput.focus();
  correoInput.focus();
  contrasenaInput.focus();
  confirmarContrasenaInput.focus();

});





cerrarRegistro.addEventListener("click", () => {
  formularioRegistro.classList.remove("mostrar");
  fondo.classList.remove("mostrar-fondo");
});

contrasenaInput.addEventListener("input", () => {
  const contrasena = contrasenaInput.value;

  if (contrasena.length < 8) {
    mensajeContraseña.innerText = "La contraseña debe tener al menos 8 caracteres";
    botonRegistro.disabled = true;
  } else if (!/[A-Z]/.test(contrasena)) {
    mensajeContraseña.innerText = "La contraseña debe incluir al menos una letra mayúscula";
    botonRegistro.disabled = true;
  } else if (!/[a-z]/.test(contrasena)) {
    mensajeContraseña.innerText = "La contraseña debe incluir al menos una letra minúscula";
    botonRegistro.disabled = true;
  } else if (!/[0-9]/.test(contrasena)) {
    mensajeContraseña.innerText = "La contraseña debe incluir al menos un número";
    botonRegistro.disabled = true;
  } else if (!/[^A-Za-z0-9]/.test(contrasena)) {
    mensajeContraseña.innerText = "La contraseña debe incluir al menos un carácter especial";
    botonRegistro.disabled = true;
  } else {
    mensajeContraseña.innerText = "";
    botonRegistro.disabled = false;
  }
});

contrasenaInput.addEventListener("change", () => {
  const contrasena = contrasenaInput.value;
  const confirmarContrasena = confirmarContrasenaInput.value;

  if (confirmarContrasena.length > 0 && contrasena !== confirmarContrasena) {
    confirmarContrasenaError.innerText = "Las contraseñas no coinciden";
    botonRegistro.disabled = true;
  } else {
    confirmarContrasenaError.innerText = "";
    botonRegistro.disabled = false;
  }
});


correoInput.addEventListener("input", () => {
  const correo = correoInput.value;

  // Verificar si el correo electrónico ya existe en la base de datos
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "validar_correo.php");
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function() {

    if (xhr.status === 200) {
      if (xhr.responseText === "existe") {
        correoError.innerText = "El correo electrónico ya está registrado";
        botonRegistro.disabled = true;
      } else {
        // Validar formato del correo electrónico
        const correoRegExp = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!correoRegExp.test(correo)) {
          correoError.innerText = "El formato del correo electrónico es inválido";
          botonRegistro.disabled = true;
        } else {
          correoError.innerText = "";
          botonRegistro.disabled = false;
        }
      }
    }
  };
  xhr.send("correo=" + correo);
});

confirmarContrasenaInput.addEventListener('input', () => {
const contrasena = contrasenaInput.value;
const confirmarContrasena = confirmarContrasenaInput.value;

if (confirmarContrasena.length > 0 && contrasena !== confirmarContrasena) {
confirmarContrasenaError.innerText = 'Las contraseñas no coinciden';
botonRegistro.disabled = true;
} else if (confirmarContrasena.length > 0 && contrasena === confirmarContrasena) {
confirmarContrasenaError.innerText = '';
botonRegistro.disabled = false;
}
});

botonRegistro.addEventListener("click", (event) => {
event.preventDefault();

  if (
    nombreInput.value === "" ||
    segundo_nombreInput.value === "" ||
    apellido_paternoInput.value === "" ||
    apellido_maternoInput.value === "" ||
    correoInput.value === "" ||
    contrasenaInput.value === "" ||
    confirmarContrasenaInput.value === "" ||
    cargoInput.value === "" ||
    preguntaInput.value === "" ||
    respuestaInput.value === ""
    
  ) {
    mensajeError.innerText = "Por favor, completa todos los campos.";
    return;
  }

const correo = correoInput.value;
const contrasena = contrasenaInput.value;
const nombre = nombreInput.value;
const segundo_nombre = segundo_nombreInput.value;
const apellido_paterno = apellido_paternoInput.value;
const apellido_materno = apellido_maternoInput.value;
const cargo = cargoInput.value;
const pregunta = preguntaInput.selectedOptions[0].text;
const respuesta = respuestaInput.value;

// Verificar si hay mensajes de error antes de enviar la solicitud al servidor
if (mensajeContraseña.innerText !== "" || correoError.innerText !== "" || confirmarContrasenaError.innerText !== "") {
mensajeError.innerText = "Debe corregir los errores antes de registrar su cuenta.";
return;
}

// Verificar si el botón de registro está habilitado antes de enviar la solicitud al servidor
if (botonRegistro.disabled) {
mensajeError.innerText = "El botón de registro está deshabilitado. Por favor, revise los campos del formulario.";
return;
}

if (!aceptaTerminos.checked) {
  //alert('Debe aceptar los términos y condiciones para registrarse');
  aceptarError.innerText = "Debe aceptar los términos y condiciones para registrarse";
  event.preventDefault();
  return;
}

// Realizar solicitud POST al servidor para registrar al usuario en la base de datos
const xhr = new XMLHttpRequest();
xhr.open("POST", "registro.php");
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhr.onload = function() {
  console.log(xhr.responseText);
  if (xhr.status === 200) {
    // Registro exitoso
    formularioRegistro.classList.remove("mostrar");
    fondo.classList.remove("mostrar-fondo");
    document.getElementById("mensajeRegistroExitoso").style.display = "block";

    // Recargar la página después de un breve retraso
    setTimeout(function() {
      location.reload();
    }, 4000);

} else {
//alert("Ha ocurrido un error en el registro");
}
};
xhr.send("correo=" + correo + "&contrasena=" + contrasena + "&nombre=" + nombre + "&segundo_nombre=" + segundo_nombre + "&apellido_paterno=" + apellido_paterno + "&apellido_materno=" + apellido_materno + "&cargo=" + cargo + "&pregunta=" + pregunta + "&respuesta=" + respuesta);
});


