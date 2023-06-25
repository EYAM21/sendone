<?php

session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: index.html"); // Redirige a la página de inicio de sesión
    exit();
}

$correo = $_SESSION['correo'];

// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "singara133";
$dbname = "sendone";

// Crear una nueva conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Consulta para obtener la información de autenticación de dos factores del usuario
$consulta = "SELECT * FROM usuarios WHERE Correo = '$correo'";
$resultado = mysqli_query($conn, $consulta);
$cont = mysqli_num_rows($resultado);

// Verificar si la consulta arrojó un resultado
if ($resultado->num_rows == 1) {
    // Obtener los datos del usuario
    $fila = $resultado->fetch_assoc();
    $up = $fila["up"];


}

if ($up == 0 ) {

    header("Location: update.php");

    
} else {

    header("Location: sistema.php");
}
// Cerrar la conexión
$conn->close();

?>