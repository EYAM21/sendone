


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Recuperar Contraseña</title>
  <link rel="stylesheet" type="text/css" href="recovery.css">
  <link rel="shortcut icon" href="img/logo3.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
  <div class="container">
    <a href="javascript:history.back()">Volver</a>
    <img src="img/logo.png" alt="SenDone">
    <h1>Recuperar Contraseña</h1>
    <form id="form"  method="POST">
      <div class="form-group">
        <label for="correoElectronico">Correo Electrónico:</label>
        <input type="email" id="correoElectronico" name="correoElectronico" required>
        <button id="verificarCorreo" type="submit">Verificar Correo</button>
        <label for="preguntaSeguridad">Pregunta de Seguridad:</label>
        <input type="text" id="preguntaSeguridad" name="preguntaSeguridad" readonly>
      </div>
      <div class="form-group">
        <label for="respuestaSeguridad">Respuesta de Seguridad:</label>
        <input type="password" id="respuestaSeguridad" name="respuestaSeguridad">
      </div>
      <div class="form-group">
        <button id="recovery" type="submit">Recuperar Contraseña</button>
      </div>
      <h2>Contraseña Temporal</h2>
      <input type="text" id="respuestaver" name="respuestaver" readonly>
    </form>
  </div>
  <script  src="recovery.js"></script>
</body>
</html>
