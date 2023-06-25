Dropzone.autoDiscover = false; // Desactiva la autoinicialización de Dropzone

// Configuración de Dropzone
var myDropzone = new Dropzone("#miDropzone", {
  url: "procesar.php", // URL a la que se enviarán los archivos
  autoProcessQueue: false, // Desactiva el procesamiento automático de los archivos
  maxFilesize: 4000, // Tamaño máximo del archivo en MB
  parallelUploads: 1, // Número máximo de archivos que se subirán simultáneamente
  uploadMultiple: false, // Subida de archivos de manera individual
  acceptedFiles: ".jpg, .jpeg, .png, .pdf, .docx, .mp4", // Tipos de archivos permitidos
  dictDefaultMessage: "Arrastra y suelta los archivos aquí para subirlos", // Mensaje predeterminado

  // Evento al seleccionar archivos
  init: function() {
    this.on("addedfile", function(file) {
      // Actualizar el nombre del archivo y el tamaño en el DOM
      document.getElementById("nombre_file").innerHTML = file.name;
      document.getElementById("tamaño").innerHTML = "Tamaño: " + (file.size / (1024 * 1024)).toFixed(2) + " MB";
      document.getElementById("mensaje-archivo").innerHTML = "Archivo Seleccionado";

 

    });

    // Evento al hacer clic en el botón "Enviar"
    document.getElementById("pr_env").addEventListener("click", function() {
      myDropzone.processQueue(); // Procesar la cola de archivos
    });

    // Evento al hacer clic en el botón "Cancelar"
    document.getElementById("pr_cn").addEventListener("click", function() {
      myDropzone.removeAllFiles(); // Eliminar todos los archivos de la cola
    });

    // Evento al completar la subida de un archivo
    this.on("success", function(file, response) {
      // Manejar la respuesta del servidor
      var respuesta = JSON.parse(response);
      if (respuesta.estado === "success") {
        document.getElementById("estadoArchivo").innerHTML = "Subida completada";
        document.getElementById("mensaje-archivo").innerHTML = respuesta.mensaje;
      } else {
        document.getElementById("estadoArchivo").innerHTML = "Enviando";
        document.getElementById("mensaje-archivo").innerHTML = respuesta.mensaje;
      }
    });
  }
});

// Evento al hacer clic en el botón "Pausa"
document.getElementById("pr_pausa").addEventListener("click", function() {
  myDropzone.pause();
  document.getElementById("estadoArchivo").innerHTML = "Pausado";
});

// Evento al hacer clic en el botón "Reanudar"
document.getElementById("pr_reanudar").addEventListener("click", function() {
  myDropzone.resume();
  document.getElementById("estadoArchivo").innerHTML = "Reanudando";
  // Cambiar el estado a "Enviando" después de 3 segundos
  setTimeout(function() {
    document.getElementById("estadoArchivo").innerHTML = "Enviando";
  }, 3000);
});

// Evento al hacer clic en el botón "Detener"
document.getElementById("pr_detener").addEventListener("click", function() {
  myDropzone.removeAllFiles();
  document.getElementById("estadoArchivo").innerHTML = "Subida detenida";
});
