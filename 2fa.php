<!DOCTYPE html>
<html>
<head>
    <title>Activar Autenticación de Dos Factores</title>
    <meta charset="UTF-8">
    <link rel="icon" href="img/logo3.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="2fa.css">

<?php



session_start();



if (!isset($_SESSION['correo'])) {
    header("Location: index.html"); // Redirige a la página de inicio de sesión
    exit();
}

require 'vendor/autoload.php';
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Writer;

//segundo factor

$nombre = $_SESSION['nombre'];
$correo = $_SESSION['correo'];
$apellido = $_SESSION['apellido'];


// Establecer conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "singara133", "sendone");

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}


// Preparar consulta SQL para validar el correo
$consulta = "SELECT * FROM usuarios WHERE Correo = '$correo'";
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
$secretKey = $google2fa->generateSecretKey();
$company = "SenDone";




if ($doblefactor == ""){

    $sql = "UPDATE usuarios SET doblefactor = '$secretKey' WHERE Correo = '$correo'";
    $actualizacion = mysqli_query($conexion, $sql);



}

$qrCodeUrl = $google2fa->getQRCodeUrl($company, $nombre, $secretKey);






$renderer = new Png();
$renderer->setWidth(250);
$renderer->setHeight(250);
$writer = new Writer($renderer);
$qrCode = $writer->writeString($qrCodeUrl);






?>


</head>
    <body style="background-color: #800000;">

    <div class="box" style="text-align: center;   color: white; font-family: Arial, sans-serif; padding: 20px; border-radius: 10px; margin-top: 20px;  ">
        <h1 style="font-size: 24px;">Bienvenido <?php echo $nombre." ".$apellido." "."vemos que es tu primera vez iniciando sesión,"; ?></h1>
        <h1 style="font-size: 24px;">¡por favor sigue los pasos que te indicamos y activa la verificación de dos factores para mayor seguridad!</h1>
   
        
        <hr style="border-color: white;">
        <p style="font-size: 16px;">1. Para activar el segundo factor de autenticación, instale Google Authenticator en su teléfono desde la Play Store o la App Store y escanee el código QR.</p>
        <div id="codigoQR" style="text-align: center;">
        <img src="data:image/png;base64, <?php echo base64_encode($qrCode); ?>" alt="Código QR" style="border-radius: 10px; border: 4px solid white; background-color: #800000;">
        <p>2. Escriba el codigo generado por Google Authenticator y presione activar Autenticación de dos factores.
    </p>
    <form name ="formulario2FA" id="formulario2FA">
        <br>
        <input class="custom-input" name="codigoTemporal" type="text" id="codigoTemporal" placeholder="Ingrese el código temporal">
        <button id="enviar" type="submit">Activar Autenticación de Dos Factores</button>

    </form>

 
    </div>
    <span id="error-mensaje"></span>
    </div>



<script src="2fa.js"></script>
</body>
</html>
