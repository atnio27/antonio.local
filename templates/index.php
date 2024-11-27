<?php
require_once __DIR__ . '/../public/src/entity/imagen.class.php';
require_once __DIR__ . '/../public/src/entity/asociado.class.php';

$imagenesHome = [];
for ($i = 1; $i <= 12; $i++) {
	$imagenesHome[] = new Imagen("$i.jpg", "Descripción de la imagen $i", 1, random_int(1, 10000), random_int(1, 10000), random_int(1, 10000));
}

$asociados = [
	new Asociado("Asociado 1", "log1.jpg", "Descripción del logo 1"),
	new Asociado("Asociado 2", "log2.jpg", "Descripción del logo 2"),
	new Asociado("Asociado 3", "log3.jpg", "Descripción del logo 3"),
	new Asociado("Asociado 4", "log1.jpg", "Descripción del logo 3"),
	new Asociado("Asociado 5", "log3.jpg", "Descripción del logo 3"),
];

require_once __DIR__ . '/views/index.view.php';
