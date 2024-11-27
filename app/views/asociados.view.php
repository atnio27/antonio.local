<!DOCTYPE html>
<html lang="en">

<head>
	<title>Registrar Asociado</title>
	<?php require_once __DIR__ . "/../views/inicio.part.php"; ?>
</head>

<body>
	<?php require_once __DIR__ . "/../views/navegacion.part.php"; ?>

	<div class="container">
		<h2>Registrar Nuevo Asociado</h2>
		<?php if ($mensaje): ?>
			<div class="alert alert-info"><?= htmlspecialchars($mensaje) ?></div>
		<?php endif; ?>
		<form method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="nombre">Nombre:</label>
				<input type="text" name="nombre" id="nombre" class="form-control" required
					value="<?= htmlspecialchars($nombre) ?>">
			</div>
			<div class="form-group">
				<label for="descripcion">Descripción (opcional):</label>
				<textarea name="descripcion" id="descripcion"
					class="form-control"><?= htmlspecialchars($descripcion) ?></textarea>
			</div>
			<div class="form-group">
				<label for="logo">Logo:</label>
				<input type="file" name="logo" id="logo" class="form-control" accept="image/*" required>
			</div>
			<button type="submit" class="btn btn-primary">Registrar Asociado</button>
		</form>
	</div>

	<?php require_once __DIR__ . "/../views/fin.part.php"; ?>
</body>

</html>