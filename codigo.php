<?php
// Generar el código secreto OTP de 16 caracteres
function generarCodigoSecreto() {
    $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    $codigoSecreto = '';
    for ($i = 0; $i < 16; $i++) {
        $codigoSecreto .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $codigoSecreto;
}

// Generar el código secreto utilizando la función generarCodigoSecreto()
$codigoSecretoUsuario = generarCodigoSecreto();

// Devolver el código secreto como respuesta
echo $codigoSecretoUsuario;
?>
