<?php

use dwes\app\core\helpers\FlashMessage; ?>

<div id="profile-username-update" class="d-flex justify-content-center align-items-center vh-100 bg-light">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card shadow-lg border-0 rounded-lg p-4">
					<h2 class="text-center text-primary">Cambiar password de Perfil</h2>
					<hr>
					<form action="/profile/update-password" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label class="label-control">Password</label>
							<input class="form-control" name="password" type="password">
						</div>
						<div class="form-group">
							<label class="label-control">Repeat password</label>
							<input class="form-control" name="re-password" type="password">
						</div>
						<button class="btn btn-primary btn-lg btn-block mt-3">Actualizar</button>
					</form>

					<div class="text-center mt-3">
						<a href="/profile" class="btn btn-outline-secondary">Volver al perfil</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>