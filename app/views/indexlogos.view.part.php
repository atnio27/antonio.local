<?php
require_once __DIR__ . '/../index.php';
require_once __DIR__ . '/../../public/src/entity/asociado.class.php';
require_once __DIR__ . '/../../public/src/utils/utils.class.php';
$asociadosAleatorios = Utils::extraeElementosAleatorios($asociados, 3);
// $hola = array_chunk($asociados, 3);
// shuffle($hola);
?>

<?php foreach ($asociadosAleatorios as $asociado): ?>
	<ul class="list-inline">
		<li>
			<img src="<?= $asociado->getUrl(); ?>" alt="logo" />
		</li>
		<li><?= $asociado->getNombre(); ?></li>
	</ul>
<?php endforeach ?>