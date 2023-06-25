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
  <title>Actualización de Contraseña</title>
  <meta charset="UTF-8">
  <style>
    body {
      background-color: #8B0000; /* Color de fondo burdeo */
      color: black; /* Letras negras */
      overflow-y: hidden;
    }
    
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .password-container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      background-color: #FFFFFF; /* Color de fondo blanco */
      padding: 20px;
      border-radius: 10px; /* Bordes redondeados */
      max-width: 400px;
    }

    input[type="password"] {
      text-align: center;
      font-size: 16px;
      border: none;
      border-radius: 5px; /* Bordes redondeados */
      padding: 10px;
      width: 100%;
      margin-bottom: 10px;
      box-shadow: 0 0 5px rgba(255, 255, 255, 0.5); /* Brillo blanco */
    }

    .submit-button {
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 5px; /* Bordes redondeados */
      background-color: #FFFFFF; /* Color de fondo blanco */
      color: black; /* Letras negras */
      cursor: pointer;
    }

    .submit-button:hover {
      background-color: black; /* Color de fondo negro al pasar el cursor */
      color: white; /* Letras blancas al pasar el cursor */
    }

    .error-message{
        position: absolute;
        margin-top:20%;
        color: white;
    
    }

    .error{
        position: absolute;
        margin-top:25%;
        color: white;
    
    }
    
    


  </style>
  <link rel="shortcut icon" href="img/logo3.png" type="image/x-icon">
</head>
<body>
  
  <div class="container">
    <h1 style="font-size: 24px; text-align: center;   color: white; font-family: Arial, sans-serif; padding: 20px; border-radius: 10px; margin-top: -390px; position: absolute; ">Por favor actualiza tu contraseña para continuar.</h1>
    <div class="password-container">
     
      <h2>Actualización de Contraseña</h2>
        <input id="contraseña" type="password" placeholder="Nueva contraseña" />
        <input id="confirmacion" type="password" placeholder="Confirmar contraseña" />
        <button id= "botonRegistro" class="submit-button">Actualizar</button>
    </div>
    <p id="mensajeContraseña" class="error-message"></p>
    <p id="confirmarContrasenaError" class="error"></p>
  </div>
  <script  src="update.js"></script>
</body>
</html>
