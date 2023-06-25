const contrasenaInput = document.getElementById("contraseña");
const mensajeContraseña = document.getElementById("mensajeContraseña");
const confirmarContrasenaInput = document.getElementById("confirmacion");
const confirmarContrasenaError = document.getElementById("confirmarContrasenaError");
const botonRegistro = document.getElementById("botonRegistro");
const mensajeError = document.getElementById("mensajeError");


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
        
  
        

        const contrasena = contrasenaInput.value;

        


        
        // Realizar solicitud POST al servidor para registrar al usuario en la base de datos
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "resfresh.php");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
          console.log(xhr.responseText);
          if (xhr.status === 200) {
            let respuesta = xhr.responseText;
            if (respuesta == "Actualización exitosa") {
              // Redirigir al usuario al sistema
              window.location.href = "sistema.php";
            } else {
              // Redirigir al usuario a la página de doble autenticación
              confirmarContrasenaError.innerText = 'ha ocurrido un error al actualizar su contraseña';// Mostrar mensaje de error;
            }
   
 
        
        } 
        };
        xhr.send("contrasena=" + contrasena);
        });