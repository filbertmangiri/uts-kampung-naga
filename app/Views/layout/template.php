<!DOCTYPE html>

<html lang="id">

<head>
	<title><?= $title; ?></title>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

	<?= $this->renderSection('styles'); ?>

	<style type="text/css">
		html {
			scroll-behavior: smooth;
		}
	</style>
</head>

<body>
	<header class="mb-5">
		<?= $this->include('layout/navbar/index'); ?>
	</header>

	<main class="mb-5">
		<?= $this->renderSection('content'); ?>
	</main>

	<?= $this->renderSection('modals'); ?>

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

	<?= $this->include('layout/navbar/script'); ?>

	<?= $this->renderSection('scripts'); ?>
</body>

</html>