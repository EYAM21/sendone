<?php

session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: index.html"); // Redirige a la página de inicio de sesión
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Verificación de Doble Factor</title>
  <meta charset="UTF-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<link rel="shortcut icon" href="img/logo3.png" type="image/x-icon">
  <style>
    body {
      background-color: #8B0000; /* Color de fondo burdeo */
    }
    
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .verification-container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      background-color: #FFFFFF; /* Color de fondo blanco */
      padding: 20px;
      border: 2px solid #000000; /* Bordes negros */
      border-radius: 10px;
      max-width: 400px;
    }

    .logo {
      margin-bottom: -50px; /* Separación inferior reducida */
      width: 60%; /* Tamaño reducido */
    }

    .code-input {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
      margin-bottom: 20px; /* Separación inferior aumentada */
    }

    .code-input input {
      text-align: center;
      font-size: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 10px;
      width: 40px; /* Ancho reducido */
      height: 40px; /* Altura aumentada */
    }

    .instructions {
      text-align: center;
      margin-bottom: 20px;
    }

    .buttons {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 20px; /* Separación aumentada */
      margin-bottom: 15px;
    }

    .cancel-button,
    .submit-button {
      padding: 10px 20px;
      font-size: 16px;
    }
    button {

  border-radius: 5px;

  color: black;
  background-color: white;
  cursor: pointer;
}

button:hover {
  background-color: black;
  color: white;
}

button:active {
  background-color: black;
}

  </style>
</head>
<body>
  <div class="container">
    <div class="verification-container">
      <img src="img/recovery.png" alt="Logo" class="logo" /> <!-- Reemplaza "logo.png" con la ruta de tu logo -->
      <p class="instructions">Por favor, introduce el código generado por la aplicación Google Authenticator:</p>
      <div class="code-input">
        <input type="text" maxlength="1" id="digit1" onkeyup="moveToNext(this, 'digit2')" />
        <input type="text" maxlength="1" id="digit2" onkeyup="moveToNext(this, 'digit3')" />
        <input type="text" maxlength="1" id="digit3" onkeyup="moveToNext(this, 'digit4')" />
        <input type="text" maxlength="1" id="digit4" onkeyup="moveToNext(this, 'digit5')" />
        <input type="text" maxlength="1" id="digit5" onkeyup="moveToNext(this, 'digit6')" />
        <input type="text" maxlength="1" id="digit6" />
      </div>
      <form id="two">
        <div class="buttons">
          <button class="cancel-button">Cancelar</button>
          <button id="enviar" class="submit-button">Enviar</button>
        </div>
        <span id="error-mensaje"></span>
      </form>
    </div>
  </div>
  <script  src="two.js"></script>
</body>
</html>
