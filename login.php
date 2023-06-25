<?php
// Obtener los valores enviados por la solicitud AJAX
$correo = $_POST["correo"];
$contraseña = $_POST["contraseña"];

// Conectar a la base de datos y realizar la validación
// Aquí debes reemplazar "nombre_base_de_datos", "usuario" y "contraseña" con los valores correspondientes a tu configuración
$conexion = new mysqli("localhost", "root", "singara133", "sendone");

// Verificar si hay errores en la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Preparar consulta SQL para validar el correo
$consulta = "SELECT * FROM usuarios WHERE Correo = '$correo'";
$resultado = mysqli_query($conexion, $consulta);
$cont = mysqli_num_rows($resultado);

// Verificar si la consulta arrojó un resultado
if ($resultado->num_rows == 1) {
    // Obtener los datos del usuario
    $fila = $resultado->fetch_assoc();
    $contraseña_cifrada = $fila["Contrasena"];
    $nombre = $fila["Nombre"];
    $apellido = $fila["Apellido_P"];
    $rol = $fila["Rol"];

    // Verificar si la contraseña ingresada coincide con el hash almacenado
    if (password_verify($contraseña, $contraseña_cifrada)) {
        // Iniciar sesión y establecer las variables de sesión
        session_start();
        $_SESSION['correo'] = $correo;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellido'] = $apellido;
        $_SESSION['rol'] = $rol;

        // Inicio de sesión exitoso
        echo "success";
    } else {
        // Error de autenticación
        echo "contraseña";
    }
} else {
    // Error de autenticación
    echo "correo";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
