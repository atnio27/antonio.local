<div id="login" class="d-flex justify-content-center align-items-center vh-100 bg-light">
	<div class="container">
		<div class="row">
			<div class="card shadow-lg border-0 rounded-lg p-4">
				<h2 class="text-center text-success">Login</h2>
				<hr>
				<?php include __DIR__ . '/show-error.part.view.php' ?>
				<form class="form-horizontal" action="/check-login" method="post">
					<div class="form-group">
						<label class="label-control">Username</label>
						<input class="form-control" type="text" name="username" value="<?= $username ?? '' ?>">
					</div>
					<div class="form-group">
						<label class="label-control">Password</label>
						<input class="form-control" name="password" type="password">
					</div>
					<button class="btn btn-success btn-lg btn-block">ENVIAR</button>
				</form>
			</div>
		</div>
	</div>
</div>