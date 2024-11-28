<?php

require_once 'App.php';
require_once 'Request.php';
require_once 'Router.php';
require_once __DIR__ . '../../public/src/exceptions/notFoundException.class.php';
$config = require_once __DIR__ . '/../app/config.php';
App::bind('config', $config);

$router = Router::load('app/routes.php');
App::bind('router', $router);
