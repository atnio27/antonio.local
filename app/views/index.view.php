<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body id="page-top">

	<!-- Principal Content Start -->
	<div id="index">

		<!-- Header -->
		<div class="row">
			<div class="col-xs-12 intro">
				<div class="carousel-inner">
					<div class="item active">
						<img class="img-responsive" src="/../public/images/index/dakar.webp" alt="header picture">
					</div>
					<div class="carousel-caption">
						<h1>ENCUENTRA LA MOTO DE TU VIDA</h1>
						<hr>
					</div>
				</div>
			</div>
		</div>

		<div id="index-body">
			<!-- Navigation Table Content -->
			<div class="tab-content">

				<!-- First Category pictures -->
				<div id="category1" class="tab-pane active">
					<div class="row popup-gallery">
						<?php
						$idCategoria = 1;
						shuffle($imagenesHome);
						include __DIR__ . "/imagen-index.part.php";
						?>
					</div>
				</div>

				<!-- Second Category pictures -->
				<div id="category2" class="tab-pane">
					<div class="row popup-gallery">
						<?php
						$idCategoria = 2;
						shuffle($imagenesHome);
						include __DIR__ . "/imagen-index.part.php";
						?>
					</div>
				</div>

				<!-- Third Category pictures -->
				<div id="category3" class="tab-pane">
					<!-- <div class="row popup-gallery"> -->
					<?php
					$idCategoria = 3;
					shuffle($imagenesHome);
					include __DIR__ . "/imagen-index.part.php";
					?>
					<!-- </div> -->
				</div>
				<!-- <nav class="text-center">
					<ul class="pagination">
						<li class="active"><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#" aria-label="suivant">
								<span aria-hidden="true">&raquo;</span>
							</a></li>
					</ul>
				</nav> -->
			</div>
		</div>
	</div>
</body>

</html>