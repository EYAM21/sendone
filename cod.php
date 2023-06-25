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
$respuestaSeguridad = $_POST['respuestaSeguridad'];


// Preparar consulta SQL para validar el correo
$consulta = "SELECT * FROM usuarios WHERE Correo = '$correoElectronico'";
$resultado = mysqli_query($conexion, $consulta);

// Verificar si la consulta arrojó un resultado
if ($resultado->num_rows == 1) {
    // Obtener los datos del usuario
    $fila = $resultado->fetch_assoc();
    $pregunta_cifrada = $fila["pregunta"];
    $respuesta_cifrada = $fila["respuesta"];

 

    // Descifrar la pregunta y la respuesta

    $respuesta_descifrada = encrypt_decrypt('decrypt', $respuesta_cifrada);
 
    $up = 0;
    
    // Verificar si la respuesta es correcta


    if ($respuestaSeguridad === $respuesta_descifrada) {
        // Generar un código de recuperación aleatorio
        $codigoRecuperacion = generateRandomCode();

        
        // Encriptar la contraseña usando el algoritmo bcrypt
        $contraseña_encriptada = password_hash($codigoRecuperacion, PASSWORD_BCRYPT);

        // Guardar el código de recuperación en la base de datos
        $consultaUpdate = "UPDATE usuarios SET Contrasena = '$contraseña_encriptada', up = '$up' WHERE Correo = '$correoElectronico'";
        mysqli_query($conexion, $consultaUpdate);

        // Generar una respuesta JSON con la respuesta correcta y el código de recuperación
        $response = [
            'respuestaCorrecta' => true,
            'codigoRecuperacion' => $codigoRecuperacion
        ];
    } else {
        // Si la respuesta es incorrecta, generar una respuesta JSON con la respuesta incorrecta
        $response = [
            'respuestaCorrecta' => false,
            'codigoRecuperacion' => ''
        ];
    }
} else {
    // Si el correo no existe, generar una respuesta JSON con la respuesta incorrecta
    $response = [
        'respuestaCorrecta' => false,
        'codigoRecuperacion' => ''
    ];
}

// Devolver la respuesta JSON
echo json_encode($response);

// Función para generar un código de recuperación aleatorio
function generateRandomCode()
{
    $length = 8;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';

    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $code;
}

?>
