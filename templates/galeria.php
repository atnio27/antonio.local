<?php
require_once __DIR__ . '/../src/exceptions/fileException.class.php';
require_once __DIR__ . '/../src/utils/file.class.php';
require_once __DIR__ . '/../src/entity/imagen.class.php';
require_once __DIR__ . '/../src/database/connection.class.php';
require_once __DIR__ . '/../src/database/queryBuilder.class.php';
require_once __DIR__ . '/../app/repository/imagenesRepository.class.php';
require_once __DIR__ . '/../app/repository/categoriasRepository.class.php';


// $errores = [];
// $titulo = "";
// $descripcion = "";
// $mensaje = "";

// session_start();

// if (isset($_POST['captcha']) && ($_POST['captcha'] != "")) {
// 	if ($_SESSION['captchaGenerado'] != $_POST['captcha']) {
// 		$mensaje = "¡Ha introducido un código de seguridad incorrecto! Inténtelo de nuevo.";
// 		$errores = [];
// 		$nombre = "";
// 		$descripcion = "";
// 	} else {
// 		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// 			try {
// 				$titulo = trim(htmlspecialchars($_POST['titulo']));
// 				$descripcion = trim(htmlspecialchars($_POST['descripcion']));
// 				$tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
// 				$imagen = new File('imagen', $tiposAceptados); // El nombre 'imagen' es el que se ha puesto en el formulario de galeria.view.php
// 				$imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS);
// 				// $mensaje = "Datos enviados";
// 				$conexion = Connection::make();
// 				$sql = "INSERT INTO imagenes (nombre, descripcion, categoria) VALUES (:nombre,:descripcion,:categoria)";
// 				$pdoStatement = $conexion->prepare($sql);
// 				$parametros = [
// 					':nombre' => $imagen->getFileName(),
// 					':descripcion' => $descripcion,
// 					':categoria' => '1'
// 				];
// 				if ($pdoStatement->execute($parametros) === false)
// 					$errores[] = "No se ha podido guardar la imagen en la base de datos";
// 				else {
// 					$descripcion = "";
// 					$mensaje = "Se ha guardado la imagen correctamente";
// 				}
// 			} catch (FileException $fileException) {
// 				$errores[] = $fileException->getMessage();
// 			}
// 		}
// 	}
// } else {
// 	$mensaje = "Introduzca el código de seguridad.";
// 	$errores = [];
// 	$nombre = "";
// 	$descripcion = "";
// }

// // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// // 	try {
// // 		$titulo = trim(htmlspecialchars($_POST['titulo']));
// // 		$descripcion = trim(htmlspecialchars($_POST['descripcion']));
// // 		$tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
// // 		$imagen = new File('imagen', $tiposAceptados); // El nombre 'imagen' es el que se ha puesto en el formulario de galeria.view.php
// // 		$imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS);
// // 		$mensaje = "Datos enviados";
// // 	} catch (FileException $fileException) {
// // 		$errores[] = $fileException->getMessage();
// // 	}
// // }

// require_once __DIR__ . '/views/galeria.view.php';

$errores = [];
$titulo = "";
$descripcion = "";
$mensaje = "";
try {
	$config = require_once __DIR__ . '/../app/config.php';
	App::bind('config', $config); // Guardamos la configuración en el contenedor de servicios
	$conexion = App::getConnection();
	//$queryBuilder = new QueryBuilder('imagenes', 'Imagen');
	$imagenesRepository = new ImagenesRepository();

	$categoriaRepository = new CategoriasRepository();
	$categorias = $categoriaRepository->findAll();



	// $imagenes = $queryBuilder->findAll();
	$imagenes = $imagenesRepository->findAll();
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$titulo = trim(htmlspecialchars($_POST['titulo']));
		$descripcion = trim(htmlspecialchars($_POST['descripcion']));



		$categoria = trim(htmlspecialchars($_POST['categoria']));
		if (empty($categoria))
			throw new CategoriaException;


		$tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
		$imagen = new File('imagen', $tiposAceptados); // El nombre 'imagen' es el que se ha puesto en elformulario de galeria.view.php
		$imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS);
		$imagenGaleria = new Imagen($imagen->getFileName(), $descripcion, $categoria);
		// $queryBuilder->save($imagenGaleria);
		$imagenesRepository->guarda($imagenGaleria);




		$mensaje = "Se ha guardado la imagen correctamente";
		// $imagenes = $queryBuilder->findAll();
		$imagenes = $imagenesRepository->findAll();
	}
} catch (FileException $fileException) {
	$errores[] = $fileException->getMessage();
} catch (QueryException $queryException) {
	$errores[] = $queryException->getMessage();
} catch (AppException $appException) {
	$errores[] = $appException->getMessage();
} catch (CategoriaException) {
	$errores[] = "No se ha seleccionado una categoría válida";
}
require_once __DIR__ . '/views/galeria.view.php';
