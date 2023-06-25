function toggleMenu() {
    var menu = document.getElementById("config");
    if (menu.style.display === "block") {
      menu.style.display = "none";
    } else {
      menu.style.display = "block";
    }
  }


  // JavaScript para cerrar sesión al hacer clic en "Cerrar sesión"
document.querySelector(".dropdown-content a[href='cerrar_sesion.php']").addEventListener("click", function(e) {
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
  
  

  


    // Función para redirigir a la página de cierre de sesión después de un tiempo de inactividad
    function redirectToLogout() {
        window.location.href = 'expired.html'; // Redirigir a la página de cierre de sesión
    }

    // Establecer el tiempo de inactividad en milisegundos (2 minutos = 120000 ms)
    var inactivityTime = 1800000;

    // Esperar el tiempo de inactividad y luego redirigir a la página de cierre de sesión
    var inactivityTimeout = setTimeout(redirectToLogout, inactivityTime);

    // Reiniciar el temporizador de inactividad cuando se detecte actividad del usuario
    function resetInactivityTimeout() {
        clearTimeout(inactivityTimeout);
        inactivityTimeout = setTimeout(redirectToLogout, inactivityTime);
    }

    // Agregar eventos de actividad del usuario para reiniciar el temporizador de inactividad
    document.addEventListener("mousemove", resetInactivityTimeout);
    document.addEventListener("keypress", resetInactivityTimeout);
    document.addEventListener("scroll", resetInactivityTimeout);
