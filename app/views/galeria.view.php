<div class="hero hero-inner text-left py-5 bg-success text-white">
	<div class="container">
		<h1 class="mb-3">Mi galería</h1>
		<p class="lead">Sube tu moto y compártela con la comunidad!</p>
	</div>
</div>

<div id="galeria" class="py-5 bg-light text-left">
	<div class="container">
		<div>
			<div class="card shadow-lg p-5 bg-white">
				<h2 class="text-left text-success">Subir imágenes</h2>
				<hr>

				<?php if (!empty($mensaje) || !empty($errores)) : ?>
					<div class="alert alert-<?= empty($errores) ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<?php if (empty($errores)) : ?>
							<p><?= $mensaje ?></p>
						<?php else : ?>
							<ul>
								<?php foreach ($errores as $error) : ?>
									<li><?= $error ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<form class="form text-left" action="/galeria/nueva" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="categoria" class="text-success font-weight-bold">Categoría</label>
						<select class="form-control custom-select text-left" name="categoria">
							<?php foreach ($categorias as $categoria) : ?>
								<option value="<?= $categoria->getId() ?>"
									<?= ($categoriaSeleccionada == $categoria->getId()) ? 'selected' : '' ?>>
									<?= $categoria->getNombre() ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group text-left">
						<label for="imagen" class="text-success font-weight-bold">Imagen</label>
						<input class="form-control-file text-left" type="file" name="imagen">
					</div>
					<div class="form-group">
						<label for="titulo" class="text-success font-weight-bold">Título</label>
						<input type="text" class="form-control text-left" id="titulo" name="titulo" value="<?= $titulo ?>">
					</div>
					<div class="form-group">
						<label for="descripcion" class="text-success font-weight-bold">Descripción</label>
						<textarea class="form-control text-left" name="descripcion" rows="3"><?= $descripcion ?></textarea>
					</div>
					<button class="btn btn-success btn-lg btn-block">ENVIAR</button>
				</form>
			</div>
			<hr>
			<div class="imagenes_galeria mt-4">
				<table class="table table-hover table-bordered text-left bg-white">
					<thead class="bg-success text-white">
						<tr>
							<th>#</th>
							<th>Imagen</th>
							<th>Visualizaciones</th>
							<th>Likes</th>
							<th>Descargas</th>
							<th>Categoría</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($imagenes as $imagen) : ?>
							<tr>
								<td><?= $imagen->getNombre() ?></td>
								<td>
									<img src="<?= $imagen->getUrlSubidas() ?>" class="img-thumbnail" alt="<?= $imagen->getDescripcion() ?>" width="100">
								</td>
								<td><?= $imagen->getNumVisualizaciones() ?></td>
								<td><?= $imagen->getNumLikes() ?></td>
								<td><?= $imagen->getNumDownloads() ?></td>
								<td><?= $imagen->getCategoria() ?></td>
								<td>
									<form action="/galeria/borrar" method="POST" enctype="multipart/form-data" style="display:inline;">
										<input type="hidden" name="id" value="<?= $imagen->getId() ?>">
										<button type="submit" class="btn btn-danger btn-sm">Borrar</button>
									</form>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>