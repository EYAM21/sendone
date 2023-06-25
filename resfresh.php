<?php

session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: index.html"); // Redirige a la página de inicio de sesión
    exit();
}

// Establecer conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "singara133", "sendone");

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$correo = $_SESSION['correo'];

$contrasena = $_POST['contrasena'];

$up = 1;

// Encriptar la contraseña usando el algoritmo bcrypt
$contraseña_encriptada = password_hash($contrasena, PASSWORD_BCRYPT);

// Guardar el código de recuperación en la base de datos
$consultaUpdate = "UPDATE usuarios SET Contrasena = '$contraseña_encriptada', up = '$up' WHERE Correo = '$correo'";
mysqli_query($conexion, $consultaUpdate);

if(password_verify($contrasena, $contraseña_encriptada)){
    echo "Actualización exitosa";


}else{

    echo "Actualzacion fallida";
}


?>
