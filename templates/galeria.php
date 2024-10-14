<?php
require_once __DIR__ . '/../src/exceptions/fileException.class.php';
require_once __DIR__ . '/../src/utils/file.class.php';
require_once __DIR__ . '/../src/entity/imagen.class.php';


$errores = [];
$titulo = "";
$descripcion = "";
$mensaje = "";

session_start();

if (isset($_POST['captcha']) && ($_POST['captcha'] != "")) {
	if ($_SESSION['captchaGenerado'] != $_POST['captcha']) {
		$mensaje = "¡Ha introducido un código de seguridad incorrecto! Inténtelo de nuevo.";
		$errores = [];
		$nombre = "";
		$descripcion = "";
	} else {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			try {
				$titulo = trim(htmlspecialchars($_POST['titulo']));
				$descripcion = trim(htmlspecialchars($_POST['descripcion']));
				$tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
				$imagen = new File('imagen', $tiposAceptados); // El nombre 'imagen' es el que se ha puesto en el formulario de galeria.view.php
				$imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS);
				$mensaje = "Datos enviados";
			} catch (FileException $fileException) {
				$errores[] = $fileException->getMessage();
			}
		}
	}
} else {
	$mensaje = "Introduzca el código de seguridad.";
	$errores = [];
	$nombre = "";
	$descripcion = "";
}

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// 	try {
// 		$titulo = trim(htmlspecialchars($_POST['titulo']));
// 		$descripcion = trim(htmlspecialchars($_POST['descripcion']));
// 		$tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
// 		$imagen = new File('imagen', $tiposAceptados); // El nombre 'imagen' es el que se ha puesto en el formulario de galeria.view.php
// 		$imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS);
// 		$mensaje = "Datos enviados";
// 	} catch (FileException $fileException) {
// 		$errores[] = $fileException->getMessage();
// 	}
// }

require_once __DIR__ . '/views/galeria.view.php';
