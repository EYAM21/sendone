<?php

// Establecer conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "singara133", "sendone");

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$encryption_key = "c1be6c4f9a3da2ec6e5872f3d13d342e"; // Reemplaza esto con tu propia clave
// Incluir la función de encriptar/descifrar
include_once 'funciones.php';

// Obtener el correo electrónico del formulario
$correoElectronico = $_POST['correoElectronico'];


// Preparar consulta SQL para validar el correo
$consulta = "SELECT * FROM usuarios WHERE Correo = '$correoElectronico'";
$resultado = mysqli_query($conexion, $consulta);
$cont = mysqli_num_rows($resultado);

// Verificar si la consulta arrojó un resultado
if ($resultado->num_rows == 1) {
    // Obtener los datos del usuario
    $fila = $resultado->fetch_assoc();
    $pregunta_cifrada = $fila["pregunta"];
    // Descifrar la pregunta
    $pregunta_descifrada = encrypt_decrypt('decrypt', $pregunta_cifrada);

    // Generar una respuesta JSON con el correo verificado y la pregunta correspondiente
    $response = [
        'correoVerificado' => true,
        'pregunta' => $pregunta_descifrada
    ];
} else {
    // Si el correo no existe, generar una respuesta JSON con el correo no verificado
    $response = [
        'correoVerificado' => false,
        'pregunta' => ''
    ];
}

// Devolver la respuesta JSON
echo json_encode($response);

//respuesta




?>
