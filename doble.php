<?php
session_start();


$nombre = $_SESSION['correo'];

$conexion = new mysqli("localhost", "root", "singara133", "sendone");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}


$codigo = $_POST["cod"];




require 'vendor/autoload.php';


// Preparar consulta SQL para validar el correo
$consulta = "SELECT * FROM usuarios WHERE Correo = '$nombre'";
$resultado = mysqli_query($conexion, $consulta);
$cont = mysqli_num_rows($resultado);

// Verificar si la consulta arrojó un resultado
if ($resultado->num_rows == 1) {
    // Obtener los datos del usuario
    $fila = $resultado->fetch_assoc();
    $doblefactor = $fila["doblefactor"];


}

use PragmaRX\Google2FA\Google2FA;


$google2fa = new Google2FA();


$valid = $google2fa->verifyKey($doblefactor, $codigo);



if ($valid) {
    
    $_SESSION['autenticacion_2fa_completada'] = true;
    echo "Código de autenticación válido";
} else {
    echo "Código de autenticación inválido";
}

?>
