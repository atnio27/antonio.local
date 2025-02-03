<?php

namespace antonio\app\controllers;

use antonio\app\entity\Imagen;
use antonio\app\entity\Usuario;
use antonio\app\exceptions\ValidationException;
use antonio\app\repository\AsociadosRepository;
use antonio\app\repository\ImagenesRepository;
use antonio\app\repository\UsuariosRepository;
use antonio\core\App;
use antonio\core\helpers\FlashMessage;
use antonio\core\Response;
use antonio\core\Security;

class AuthController
{
	public function login()
	{
		$errores = FlashMessage::get('login-error', []);
		$username = FlashMessage::get('username');
		Response::renderView('login', 'layout', compact('errores', 'username'));
	}

	public function logout()
	{
		if (isset($_SESSION['loguedUser'])) {
			$_SESSION['loguedUser'] = null;
			unset($_SESSION['loguedUser']);
		}
		App::get('router')->redirect('login');
	}

	public function getCurrentUserId()
	{
		$a = $_SESSION['loguedUser'];
		return $a;
	}

	public function checkLogin()
	{
		try {
			if (!isset($_POST['username']) || empty($_POST['username']))
				throw new ValidationException('Debes introducir el usuario y el password');
			FlashMessage::set('username', $_POST['username']);

			if (!isset($_POST['password']) || empty($_POST['password']))
				throw new ValidationException('Debes introducir el usuario y el password');

			$usuario = App::getRepository(UsuariosRepository::class)->findOneBy([
				'username' => $_POST['username']
			]);
			if (!is_null($usuario) && Security::checkPassword($_POST['password'], $usuario->getPassword())) {
				// Guardamos el usuario en la sesión y redireccionamos a la página principal
				$_SESSION['loguedUser'] = $usuario->getId();
				FlashMessage::unset('username');
				App::get('router')->redirect('');
			}
			throw new ValidationException('El usuario y el password introducidos no existen');
		} catch (ValidationException $validationException) {
			FlashMessage::set('login-error', [$validationException->getMessage()]);
			App::get('router')->redirect('login'); // Redireccionamos al login
		}
	}

	public function registro()
	{
		$errores = FlashMessage::get('registro-error', []);
		$mensaje = FlashMessage::get('mensaje');
		$username = FlashMessage::get('username');
		Response::renderView('registro', 'layout', compact('errores', 'username'));
	}

	public function checkRegistro()
	{
		try {
			session_start();

			if (isset($_POST['captcha']) && ($_POST['captcha'] != "")) {
				if ($_SESSION['captchaGenerado'] != $_POST['captcha']) {
					throw new ValidationException("¡Ha introducido un código de seguridad incorrecto! Inténtelo de nuevo.");
				}
			} else {
				throw new ValidationException("Introduzca el código de seguridad.");
			}

			if (!isset($_POST['username']) || empty($_POST['username']))
				throw new ValidationException('El nombre de usuario no puede estar vacío');

			FlashMessage::set('username', $_POST['username']);
			if (!isset($_POST['password']) || empty($_POST['password']))
				throw new ValidationException('El password de usuario no puede estar vacío');
			if (!isset($_POST['re-password']) || empty($_POST['re-password']) || $_POST['password'] !== $_POST['re-password'])
				throw new ValidationException('Los dos password deben ser iguales');
			$password = Security::encrypt($_POST['password']);;
			$usuario = new Usuario();
			$usuario->setUsername($_POST['username']);
			$usuario->setRole('ROLE_USER');
			$usuario->setPassword($password);
			App::getRepository(UsuariosRepository::class)->save($usuario);
			FlashMessage::unset('username');
			$mensaje = "Se ha creado el usuario: " . $usuario->getUsername();
			App::get('logger')->add($mensaje);
			FlashMessage::set('mensaje', $mensaje);
			App::get('router')->redirect('login');
		} catch (ValidationException $validationException) {
			FlashMessage::set('registro-error', [$validationException->getMessage()]);
			App::get('router')->redirect('registro');
		}
	}

	public function profile()
	{
		// Check if user is logged in
		if (!isset($_SESSION['loguedUser'])) {
			App::get('router')->redirect('login');
		}

		// Retrieve user information
		$userId = $_SESSION['loguedUser'];
		$usuario = App::getRepository(UsuariosRepository::class)->find($userId);

		if (!$usuario) {
			throw new \Exception("Usuario no encontrado.");
		}

		// Render the profile view with the user data
		Response::renderView('profile', 'layout', [
			'username' => $usuario->getUsername(),
		]);
	}

	public function editProfileUsername()
	{
		if (!isset($_SESSION['loguedUser'])) {
			App::get('router')->redirect('login');
		}

		$userId = $_SESSION['loguedUser'];
		$usuario = App::getRepository(UsuariosRepository::class)->find($userId);

		Response::renderView('edit-profile-username', 'layout', compact('usuario'));
	}

	public function updateUsername()
	{
		try {
			if (!isset($_SESSION['loguedUser'])) {
				throw new ValidationException("No user is logged in.");
			}

			$usuarioId = $_SESSION['loguedUser'];
			$usuarioRepo = App::getRepository(UsuariosRepository::class);
			$usuario = $usuarioRepo->find($usuarioId);

			if (!$usuario) {
				throw new ValidationException("User not found.");
			}

			// Validate new username
			if (!isset($_POST['username']) || empty($_POST['username'])) {
				throw new ValidationException("El nombre de usuario no puede estar vacío.");
			}

			$newUsername = $_POST['username'];

			// Check if the new username already exists
			$existingUser = $usuarioRepo->findOneBy(['username' => $newUsername]);
			if ($existingUser && $existingUser->getId() !== $usuario->getId()) {
				throw new ValidationException("El nombre de usuario ya está en uso.");
			}

			// Update the username in the database
			$usuario->setUsername($newUsername);
			$usuarioRepo->update($usuario);

			// Update the session with the new username
			$_SESSION['loguedUser'] = $usuario->getId(); // Make sure the session is still valid

			// Set a success message
			FlashMessage::set('success', "Nombre de usuario actualizado correctamente.");
			App::get('router')->redirect('profile');
		} catch (ValidationException $validationException) {
			FlashMessage::set('error', $validationException->getMessage());
			App::get('router')->redirect('profile/edit-username');
		}
	}

	public function editProfilePassword()
	{
		if (!isset($_SESSION['loguedUser'])) {
			App::get('router')->redirect('login');
		}

		$userId = $_SESSION['loguedUser'];
		$usuario = App::getRepository(UsuariosRepository::class)->find($userId);

		Response::renderView('edit-profile-password', 'layout', compact('usuario'));
	}

	public function updatePassword()
	{
		try {
			if (!isset($_SESSION['loguedUser'])) {
				throw new ValidationException("No user is logged in.");
			}

			$usuarioId = $_SESSION['loguedUser'];
			$usuarioRepo = App::getRepository(UsuariosRepository::class);
			$usuario = $usuarioRepo->find($usuarioId);

			if (!$usuario) {
				throw new ValidationException("User not found.");
			}

			// Validate new username
			if (!isset($_POST['username']) || empty($_POST['username'])) {
				throw new ValidationException("El nombre de usuario no puede estar vacío.");
			}

			$newUsername = $_POST['username'];

			// Check if the new username already exists
			$existingUser = $usuarioRepo->findOneBy(['username' => $newUsername]);
			if ($existingUser && $existingUser->getId() !== $usuario->getId()) {
				throw new ValidationException("El nombre de usuario ya está en uso.");
			}

			// Update the username in the database
			$usuario->setPassword($newUsername);
			$usuarioRepo->update($usuario);

			// Update the session with the new username
			$_SESSION['loguedUser'] = $usuario->getId(); // Make sure the session is still valid

			// Set a success message
			FlashMessage::set('success', "Contraseña de usuario actualizado correctamente.");
			App::get('router')->redirect('profile');
		} catch (ValidationException $validationException) {
			FlashMessage::set('error', $validationException->getMessage());
			App::get('router')->redirect('profile/edit-password');
		}
	}
}
