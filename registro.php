<?php

// Establecer conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "singara133", "sendone");

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener los valores del formulario
$nombre = $_POST['nombre'];
$segundo_nombre = $_POST['segundo_nombre'];
$apellido_paterno = $_POST['apellido_paterno'];
$apellido_materno = $_POST['apellido_materno'];
$cargo = $_POST['cargo'];
$correo = $_POST['correo'];
$contraseña = $_POST['contrasena'];
$confirmacion = $_POST['confirmacion'];
$pregunta = $_POST['pregunta'];
$respuesta = $_POST['respuesta'];
$up = 1;



// Encriptar la contraseña usando el algoritmo bcrypt
$contraseña_encriptada = password_hash($contraseña, PASSWORD_BCRYPT);

$encryption_key = "c1be6c4f9a3da2ec6e5872f3d13d342e"; // Reemplaza esto con tu propia clave

// Incluir la función de encriptar/descifrar
include_once 'funciones.php';

// Encriptar la respuesta
$pregunta_encriptada = encrypt_decrypt('encrypt', $pregunta);

// Encriptar la respuesta
$respuesta_encriptada = encrypt_decrypt('encrypt', $respuesta);


// Obtener la fecha y hora actual
date_default_timezone_set('America/Santiago');
$fecha_actual = date("Y-m-d");
$hora_actual = date("H:i:s");

$rol = "usuario";
$estado = 1;

// Insertar los datos del formulario en la base de datos
$insertar = "INSERT INTO usuarios (Nombre, Segundo_N, Apellido_P, Apellido_S, Correo, Contrasena, Cargo, Rol, Fecha_registro, Hora_registro, Estado, pregunta, respuesta, up) VALUES ('$nombre', '$segundo_nombre', '$apellido_paterno', '$apellido_materno', '$correo', '$contraseña_encriptada', '$cargo', '$rol', '$fecha_actual', '$hora_actual', '$estado', '$pregunta_encriptada', '$respuesta_encriptada', '$up')";
$insertar_preparado = mysqli_prepare($conexion, $insertar);

mysqli_stmt_bind_param($insertar_preparado, "sssssssssiissi", $nombre, $segundo_nombre, $apellido_paterno, $apellido_materno, $correo, $contraseña_encriptada, $cargo, $rol, $fecha_actual, $hora_actual, $estado, $pregunta_encriptada, $respuesta_encriptada, $up);

if (mysqli_stmt_execute($insertar_preparado)) {
    echo "Registro exitoso.";
} else {
    echo "Error al registrar el usuario: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
