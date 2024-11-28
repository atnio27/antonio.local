<?php
require_once __DIR__ . '/../../public/src/exceptions/fileException.class.php';
require_once __DIR__ . '/../../public/src/utils/file.class.php';
require_once __DIR__ . '/../../public/src/entity/Imagen.php';
require_once __DIR__ . '/../../public/src/database/Connection.php';
require_once __DIR__ . '/../../public/src/database/QueryBuilder.php';
require_once __DIR__ . '/../../app/repository/ImagenesRepository.php';
require_once __DIR__ . '/../../app/repository/CategoriasRepository.php';


$errores = [];
$titulo = "";
$descripcion = "";
$mensaje = "";
try {
	$conexion = App::getConnection();
	$imagenesRepository = new ImagenesRepository();
	$categoriasRepository = new CategoriasRepository();
	$imagenes = $imagenesRepository->findAll();
	$categorias = $categoriasRepository->findAll();
} catch (QueryException $queryException) {
	$errores[] = $fileException->getMessage();
} catch (AppException $appException) {
	$errores[] = $appException->getMessage();
}
require_once __DIR__ . '/../views/galeria.view.php';
