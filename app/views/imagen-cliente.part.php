<?php foreach ($imagenesClientes as $imagenCliente): ?>
	<div class="col-xs-12 col-sm-3">
		<img class="img-responsive" src="<?= $imagenCliente->getUrlClientes(); ?>" alt="client's picture">
		<h5><?= $imagenCliente->getDescripcion(); ?></h5>
		<q>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</q>
	</div>
<?php endforeach; ?>