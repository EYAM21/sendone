<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: index.html"); // Redirige a la página de inicio de sesión
    exit();
}

if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $nombreArchivo = $_FILES['file']['name'];
    $tamanoArchivo = $_FILES['file']['size'];
    $tipoArchivo = $_FILES['file']['type'];
    $directorioDestino = 'shared/'; // Reemplaza "directorio_destino" con el directorio donde deseas almacenar los archivos subidos

    // Mueve el archivo subido al directorio de destino
    if (move_uploaded_file($_FILES['file']['tmp_name'], $directorioDestino . $nombreArchivo)) {
        $respuesta = array('estado' => 'success', 'mensaje' => 'Carga exitosa');
        echo json_encode($respuesta);
    } else {
        // Enviar la respuesta de error
        $respuesta = array('estado' => 'error', 'mensaje' => 'Error al subir el archivo');
        echo json_encode($respuesta);
    }
} else {
    // Enviar la respuesta de error si no se recibió el archivo
    $respuesta = array('estado' => 'error', 'mensaje' => 'Ningún archivo seleccionado');
    echo json_encode($respuesta);
}
?>
