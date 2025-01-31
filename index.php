<?php

use antonio\app\exceptions\AppException;
use antonio\app\exceptions\NotFoundException;
use antonio\core\Request;
use antonio\core\App;

try {
    require_once 'core/Bootstrap.php';
    App::get('router')->direct(Request::uri(), Request::method());
}catch ( AppException $appException ) {
    $appException->handleError();
}