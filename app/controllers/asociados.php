<?php
require_once __DIR__ . '/../public/src/entity/asociado.class.php';
require_once __DIR__ . '/../public/src/utils/file.class.php';
require_once __DIR__ . '/../public/src/utils/utils.class.php';
require_once __DIR__ . '/../public/src/database/connection.class.php';
session_start();

$mensaje = '';
$nombre = '';
$descripcion = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (empty($_POST['nombre'])) {
		$mensaje = 'El nombre es obligatorio.';
	} else {
		$nombre = trim($_POST['nombre']);
		$descripcion = trim($_POST['descripcion'] ?? '');

		try {
			$file = new File('logo', ['image/jpeg', 'image/png', 'image/gif']);
			$logo = $file->getFileName();
			$file->saveUploadFile($_SERVER['DOCUMENT_ROOT'] . '/public/images/asociados/');


			$asociado = new Asociado($nombre, $logo, $descripcion);

			// $mensaje = 'Asociado creado con éxito.';
			$conexion = Connection::make();
			$sql = "INSERT INTO asociados (nombre, logo, descripcion) VALUES (:nombre,:logo,:descripcion)";
			$pdoStatement = $conexion->prepare($sql);
			$parametros = [
				':nombre' => $nombre,
				':logo' => $logo,
				':descripcion' => $descripcion
			];
			if ($pdoStatement->execute($parametros) === false)
				$errores[] = "No se ha podido guardar la imagen en la base de datos";
			else {
				$descripcion = "";
				$mensaje = "Se ha guardado la imagen correctamente";
			}
		} catch (FileException $e) {
			$mensaje = 'Error al subir la imagen: ' . $e->getMessage();
		}
	}
}

require_once __DIR__ . '../views/Asociados.view.php';
