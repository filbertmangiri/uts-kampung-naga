<?php $session = \Config\Services::session(); ?>

<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
	<div class="container">
		<a class="navbar-brand" href="<?= base_url(); ?>"><?= NAVBAR_BRAND; ?></a>

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url(); ?>">Beranda</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('about'); ?>">Tentang Kami</a>
				</li>
			</ul>

			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
				<?php if ($session->get('is_logged_in') === true) : ?>
					<?php if ($session->get('is_admin') === true) : ?>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url('admin'); ?>">Admin</a>
						</li>
					<?php endif; ?>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('logout'); ?>">Logout</a>
					</li>
				<?php else : ?>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('login'); ?>">Masuk</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('register'); ?>">Daftar</a>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</nav>