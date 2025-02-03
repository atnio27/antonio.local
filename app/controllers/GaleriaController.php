<?php

namespace antonio\app\controllers;

use antonio\core\helpers\FlashMessage;
use antonio\app\exceptions\AppException;
use antonio\app\exceptions\QueryException;
use antonio\app\repository\CategoriasRepository;
use antonio\app\repository\ImagenesRepository;
use antonio\core\App;
use antonio\app\exceptions\CategoriaException;
use antonio\app\exceptions\FileException;
use antonio\app\entity\Imagen;
use antonio\app\exceptions\NotFoundException;
use antonio\app\exceptions\ValidationException;
use antonio\app\utils\File;
use antonio\core\Response;

class GaleriaController
{
	public function index()
	{

		$errores = FlashMessage::get('errores', []);
		$mensaje = FlashMessage::get('mensaje');
		$descripcion = FlashMessage::get('descripcion');
		$categoriaSeleccionada = FlashMessage::get('categoriaSeleccionada');
		$titulo = FlashMessage::get('titulo');

		try {
			$authController = new AuthController();
			$usuarioId = $authController->getCurrentUserId();
			$imagenes = App::getRepository(ImagenesRepository::class)->findBy(['idUsuario' => $usuarioId]);
			$categorias = App::getRepository(CategoriasRepository::class)->findAll();
		} catch (QueryException $queryException) {
			FlashMessage::set('errores', [$queryException->getMessage()]);
		} catch (AppException $appException) {
			FlashMessage::set('errores', [$appException->getMessage()]);
		}

		Response::renderView(
			'galeria',
			'layout',
			compact('imagenes', 'categorias', 'errores', 'titulo', 'descripcion', 'mensaje', 'categoriaSeleccionada')
		);
	}

	public function nueva()
	{
		try {
			$imagenesRepository = App::getRepository(ImagenesRepository::class);

			$titulo = trim(htmlspecialchars($_POST['titulo']));
			FlashMessage::set('titulo', $titulo);

			$descripcion = trim(htmlspecialchars($_POST['descripcion']));
			FlashMessage::set('descripcion', $descripcion);

			$categoria = trim(htmlspecialchars($_POST['categoria']));
			if (empty($categoria)) {
				throw new CategoriaException;
			}
			FlashMessage::set('categoriaSeleccionada', $categoria);

			$tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
			$imagen = new File('imagen', $tiposAceptados);

			$imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS);

			$authController = new AuthController();
			$usuarioId = $authController->getCurrentUserId();

			$imagenGaleria = new Imagen($imagen->getFileName(), $descripcion, $categoria, $usuarioId);
			$imagenesRepository->save($imagenGaleria);

			$mensaje = "Se ha guardado una imagen: " . $imagenGaleria->getNombre();

			App::get('logger')->add($mensaje);
			FlashMessage::set('mensaje', $mensaje);

			FlashMessage::unset('descripcion');
			FlashMessage::unset('categoriaSeleccionada');
			FlashMessage::unset('titulo');
		} catch (ValidationException $validationException) {
			FlashMessage::set('errores', [$validationException->getMessage()]);
		} catch (FileException $fileException) {
			FlashMessage::set('errores', [$fileException->getMessage()]);
		} catch (QueryException $queryException) {
			FlashMessage::set('errores', [$queryException->getMessage()]);
		} catch (AppException $appException) {
			FlashMessage::set('errores', [$appException->getMessage()]);
		} catch (CategoriaException) {
			FlashMessage::set('errores', ["No se ha seleccionado una categoría válida"]);
		}

		App::get('router')->redirect('galeria');
	}

	public function borrar()
	{
		try {
			$imagenesRepository = App::getRepository(ImagenesRepository::class);
			$id = $_POST['id'];

			$imagen = $imagenesRepository->find($id);
			if ($imagen) {
				$imagenesRepository->borrar($imagen);
				$mensaje = "Se ha borrado la imagen: " . $imagen->getNombre();
				App::get('logger')->add($mensaje);
				FlashMessage::set('mensaje', $mensaje);
			} else {
				throw new NotFoundException("No se ha encontrado la imagen con id $id.");
			}
		} catch (NotFoundException $notFoundException) {
			FlashMessage::set('errores', [$notFoundException->getMessage()]);
		} catch (QueryException $queryException) {
			FlashMessage::set('errores', [$queryException->getMessage()]);
		} catch (AppException $appException) {
			FlashMessage::set('errores', [$appException->getMessage()]);
		}

		App::get('router')->redirect('galeria');
	}

	public function show($id)
	{
		$imagenesRepository = App::getRepository(ImagenesRepository::class);
		$imagen = $imagenesRepository->find($id);
		Response::renderView(
			'imagen-show',
			'layout',
			compact('imagen', 'imagenesRepository')
		);
	}
}
