<?php foreach ($imagenesHome as $imagen): ?>
	<div class="col-xs-12 col-sm-6 col-md-3">
		<div class="card shadow-sm border-0 rounded-lg overflow-hidden" style="max-width: 400px;">
			<a href="<?= $imagen->getUrlSubidas() ?>" class="gallery d-block">
				<img class="img-fluid" style="height: 250px; object-fit: fill;" src="<?= $imagen->getUrlSubidas() ?>" alt="<?= $imagen->getDescripcion() ?>">
			</a>
			<div class="card-footer bg-light text-center py-1">
				<div class="d-flex justify-content-between text-muted" style="font-size: 20px;">
					<span><i class="fa fa-eye"></i> <?= $imagen->getNumVisualizaciones() ?></span>
					<span><i class="fa fa-heart text-danger"></i> <?= $imagen->getNumLikes() ?></span>
					<span><i class="fa fa-download"></i> <?= $imagen->getNumDownloads() ?></span>
				</div>
			</div>
		</div>
	</div>


<?php endforeach; ?>