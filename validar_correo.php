<?php
// Establecer conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "singara133", "sendone");

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener el valor del correo electrónico del formulario
$correo = $_POST['correo'];

// Verificar si el usuario ya existe en la base de datos
$consulta = "SELECT id FROM usuarios WHERE correo = ?";
$consulta_preparada = mysqli_prepare($conexion, $consulta);
mysqli_stmt_bind_param($consulta_preparada, "s", $correo);
mysqli_stmt_execute($consulta_preparada);
mysqli_stmt_store_result($consulta_preparada);

if (mysqli_stmt_num_rows($consulta_preparada) > 0) {
    echo "existe";
} else {
    echo "no_existe";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
