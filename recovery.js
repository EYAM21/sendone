// Obtener el formulario y los elementos necesarios
const form = document.getElementById('form');
const correoElectronicoInput = document.getElementById('correoElectronico');
const preguntaSeguridadInput = document.getElementById('preguntaSeguridad');
const verificarCorreoBtn = document.getElementById('verificarCorreo');
const recuperarContraseñaBtn = document.getElementById('recovery');
const respuestaSeguridadInput = document.getElementById('respuestaSeguridad');
const respuestaVerInput = document.getElementById('respuestaver');

// Agregar un evento de escucha al envío del formulario para verificar el correo
verificarCorreoBtn.addEventListener('click', (event) => {
  event.preventDefault(); // Prevenir el envío del formulario

  // Obtener el valor del correo electrónico
  const correoElectronico = correoElectronicoInput.value;

  // Crear una solicitud XMLHttpRequest para verificar el correo electrónico en el archivo PHP
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'recovery.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  // Enviar los datos del formulario al archivo PHP
  xhr.send('correoElectronico=' + encodeURIComponent(correoElectronico));

  // Escuchar el evento 'load' para manejar la respuesta del archivo PHP
  xhr.addEventListener('load', () => {
    if (xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      const correoVerificado = response.correoVerificado;

      if (correoVerificado) {
        // Habilitar el botón de recuperar contraseña
        recuperarContraseñaBtn.disabled = false;

        // Obtener la pregunta correspondiente al correo electrónico
        const pregunta = response.pregunta;

        // Mostrar la pregunta en el campo de entrada de texto
        preguntaSeguridadInput.value = pregunta;
        
        // Habilitar el campo de respuesta de seguridad
        respuestaSeguridadInput.disabled = false;
      } else {
        // Deshabilitar el botón de recuperar contraseña
        recuperarContraseñaBtn.disabled = true;

        preguntaSeguridadInput.value = 'El correo ingresado no es válido.';
        respuestaSeguridadInput.value = '';

        // Deshabilitar el campo de respuesta de seguridad
        respuestaSeguridadInput.disabled = true;
      }
    }
  });
});

// Agregar un evento de escucha al botón de recuperar contraseña
recuperarContraseñaBtn.addEventListener('click', (event) => {
  event.preventDefault(); // Prevenir el envío del formulario

  // Obtener la respuesta de seguridad ingresada por el usuario
  const respuestaSeguridad = respuestaSeguridadInput.value;
  const correoElectronico = correoElectronicoInput.value;

  // Crear una solicitud XMLHttpRequest para comprobar la respuesta en el archivo PHP
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'cod.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  // Enviar los datos del formulario al archivo PHP
  xhr.send('respuestaSeguridad=' + encodeURIComponent(respuestaSeguridad) + '&correoElectronico=' + encodeURIComponent(correoElectronico) );

  // Escuchar el evento 'load' para manejar la respuesta del archivo PHP
  xhr.addEventListener('load', () => {
    if (xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      const respuestaCorrecta = response.respuestaCorrecta;

      if (respuestaCorrecta) {
        // Obtener el código generado aleatoriamente
        const codigoRecuperacion = response.codigoRecuperacion;

        // Mostrar el código de recuperación en el campo de entrada de texto
        respuestaVerInput.value = codigoRecuperacion;
      } else {
        respuestaVerInput.value = 'La respuesta ingresada es incorrecta.';
      }
    }
  });
});
