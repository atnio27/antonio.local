<?php
try {
	require_once 'core/bootstrap.php';
	require_once 'core/Router.php';
	require Router::load('app/routes.php')->direct(Request::uri(), Request::method());
} catch (NotFoundException $notFoundException) {
	die($notFoundException->getMessage());
}
