<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "singara133";
$dbname = "sendone";

session_start();

$correo = $_SESSION['correo'];

// Obtener el usuario enviado desde JavaScript




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
    $doblefactor = $fila["doblefactor"];


}


if (empty($doblefactor) ) {
    // El usuario tiene habilitada la doble autenticación
    echo "no_habilitada";

    
} else {
    // El usuario no tiene habilitada la doble autenticación
    echo "habilitada";
}
// Cerrar la conexión
$conn->close();
?>
