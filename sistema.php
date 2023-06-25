<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: index.html"); // Redirige a la página de inicio de sesión
    exit();
}

if (!$_SESSION['autenticacion_2fa_completada']) {
    header('Location: 2fa.php');
    exit();

}

// Deshabilitar el almacenamiento en caché de la página
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Verificar si la variable de sesión de tiempo de actividad está establecida
if (isset($_SESSION['last_activity'])) {
    $inactivity_limit = 1800; // Tiempo límite de inactividad en segundos (1800 = 30  minutos)
    $current_time = time();
    $last_activity = $_SESSION['last_activity'];

    // Verificar si ha transcurrido el tiempo límite de inactividad
    if (($current_time - $last_activity) > $inactivity_limit) {
        // Cerrar la sesión y redirigir al usuario a la página de inicio de sesión
        session_unset();
        session_destroy();
        header("Location: expired.html");
        exit();
    }
}

// Actualizar la marca de tiempo de la última actividad solo si el usuario está autenticado
if (isset($_SESSION['correo'])) {
    $_SESSION['last_activity'] = time();
}

?>

<!-- Aquí continúa el resto del código de tu página sistema.php -->


<!DOCTYPE html>
<html>
<head>
	<title>SenDone</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="estilos.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<link rel="shortcut icon" href="img/logo2.png" type="image/x-icon">
	<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />


</head>
<body>
	<header>
		<div class="logo"><img src="img/logo.png" alt="Sendone"></div>
		<h1>Envia, Respalda y Recibe</h1>
		<?php
		// Verifica si la sesión está iniciada y si existe el nombre y el primer apellido del usuario en la variable de sesión
		if (isset($_SESSION['correo']) && isset($_SESSION['nombre']) && isset($_SESSION['apellido'])) {
    		$nombre = $_SESSION['nombre'];
			$apellido = $_SESSION['apellido'];

    	?>
        	<span style="margin-left: 910px;  position: absolute; margin-top: -11px;" class="apellido"><?php echo $nombre." ".$apellido; ?></span>
    	<?php
		}
		?>
		
		<nav>
			<ul>
				
				<li>
					<div class="dropdown">
						<button  class="dropbtn"><i class="fas fa-bell"></i></button>
						
							
						</div>
					</div>
				</li>
				<li>
					<div class="dropdown">
							<button class="dropbtn"><i class="fas fa-user"></i></button>

					</div>
				</li>

				<li>
					<div class="dropdown">
						<button  onclick="toggleMenu()" class="dropbtn"><i class="fas fa-cog"></i></button>
						<div id="config" class="dropdown-content">
							<a href="#">Opción 1</a>
							<a href="#">Opción 2</a>
							<a href="cerrar_sesion.php">Cerrar sesión</a>
							</div>
						
						</div>
					</div>
				</li>
			</ul>
		</nav>
	</header>
	<main>
		<div class="container">
			<div class="documento importante">
				<h3>Documento importante</h3>
				<p>Este es un documento muy importante que debes revisar cuanto antes</p>
				<span class="fecha">07/05/2023 10:00 am</span>
				<a href="#" class="descargar_uno">Descargar</a>
			</div>

			<div class="documento">
				<h3>Documento normal</h3>
				<p>Este es un documento que puedes revisar cuando tengas tiempo</p>
				<span class="fecha">06/05/2023 3:00 pm</span>
				<a href="#" class="descargar">Descargar</a>
			</div>

			<div class="documento">
				<h3>Documento no urgente</h3>
				<p>Este es un documento que no requiere de tu atención inmediata</p>
				<span class="fecha">05/05/2023 5:00 pm</span>
				<a href="#" class="descargar">Descargar</a>
			</div>
		</div>
		
		<form id="procesar" method="POST" action="procesar.php" enctype="multipart/form-data">
  <section>
    <h2 class="nueva-subida">Nueva Subida</h2>



    <p id="mensaje-archivo" class="nombre-archivo">Ningún archivo seleccionado</p>

    <div id="miDropzone" class="subida-torrent">
      <div id="nombre_file" class="nombre-archivo">Nombre del archivo</div>
      <div class="info-archivo">
        <span id="estadoArchivo" class="estado">En espera</span>
        <span id="tamaño" class="tamano">Tamaño: 0 MB</span>
        <span class="tiempo">Tiempo estimado: 3 minutos</span>
      </div>
      <div class="barra-progreso">
        <div class="progreso"></div>
      </div>

    </div>

    <div class="botones">
      <button type="button" id="pr_env">Enviar</button>
      <button type="button" id="pr_cn">Cancelar</button>
    </div>
    <div class="botones_uno">
      <button id="pr_pausa" type="button" class="pausa">Pausa</button>
      <button id="pr_reanudar" type="button" class="reanudar">Reanudar</button>
      <button id="pr_detener" type="button" class="detener">Detener</button>
    </div>
  </section>
</form>

		<section>
			<h2>Descargas activas</h2>
			<ul>
				<li>
					<div class="subida-torrent">
                				<div class="nombre-archivo">Nombre del archivo </div>
                				<div class="info-archivo">
                    				<span class="estado">Descargando</span>
                   				<span class="tamano">Tamaño: 25 MB</span>
                    				<span class="tiempo">Tiempo estimado: 8 minutos</span>
                				</div>
                				<div class="barra-progreso">
                   				 <div class="progreso" style="width: 20%;"></div>
               				</div>
           				 </div>
					<div class="botones">
						<button class="pausa">Pausa</button>
						<button class="reanudar">Reanudar</button>
						<button class="detener">Detener</button>
					</div>
				</li>
				
			</ul>
		</section>
		<section>
			<h2>Descargas completadas</h2>
			<ul>
				<table>
        <thead>
            <tr>
                <th>Nombre del documento</th>
                <th>Tipo de documento</th>
                <th>Tamaño</th>
                <th>Enviado por</th>
                <th>Autorizado por</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Archivo 3</td>
                <td>PDF</td>
                <td>10 MB</td>
                <td>Juan Perez</td>
                <td>Maria Rodriguez</td>
                <td>
                    <button class="abrir">Abrir</button>
                    <button class="borrar">Borrar</button>
                    <button class="editar">Editar</button>
                </td>
            </tr>
            <tr>
                <td>Archivo 4</td>
                <td>Word</td>
                <td>5 MB</td>
                <td>Pablo Gomez</td>
                <td>Juan Perez, Maria Rodriguez</td>
                <td>
                    <button class="abrir">Abrir</button>
                    <button class="borrar">Borrar</button>
                    <button class="editar">Editar</button>
                </td>
            </tr>
        </tbody>
    </table>
			</ul>
		</section>


	</main>
	<footer>
		<p>Derechos reservados &copy; 2023 SenDone</p>
	</footer>
	<script  src="sistema.js"></script>
	<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>

	<script  src="procesar.js"></script>
	
</body>
</html>