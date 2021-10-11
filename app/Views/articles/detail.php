<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container" style="margin: auto;">
	<div class="row">
		<div class="col-12 col-sm-11 col-md-8 col-lg-6" style="margin: auto;">
			<article class="mb-5">
				<h2><?= $detail['title']; ?></h2>

				<a href="<?= base_url('article/category/' . $detail['category_slug']); ?>" class="mb-3">
					<h5>Kategori : <?= $detail['category']; ?></h5>
				</a>

				<img src="<?= base_url('images/thumbnails/' . $detail['thumbnail']); ?>" alt="<?= $detail['title_slug']; ?>" width="100%">

				<p style="text-align: justify;"><?= $detail['content']; ?></p>

				<br><br>
				Penulis: <?= $detail['author']; ?><br>
				Tanggal Terbit: <?= (new DateTime($detail['created_at']))->format('d-m-Y'); ?>
			</article>

			<?php if (\Config\Services::session()->get('is_logged_in') === true) : ?>
				<form id="commentForm" action="<?= base_url('article/addcomment/' . $detail['id']); ?>" method="post">
					<textarea name="comment_text" id="commentText" cols="70" rows="5" placeholder="Masukkan komentar anda tentang artikel ini.."></textarea>
					<button type="submit" class="btn btn-primary">Tambah Komentar</button>
				</form>
			<?php else : ?>
				<textarea name="comment_text" id="commentText" cols="70" rows="5" placeholder="Silakan login untuk berkomentar.." disabled></textarea>
				<button type="submit" class="btn btn-primary" disabled>Tambah Komentar</button>
			<?php endif; ?>

			<?php

			use App\Models\AccountModel;

			$accountModel = new AccountModel();

			foreach ($comments as $key) : ?>
				<div class="container" style="width:50%">
					<div class="col">
						<?php $currAccount = $accountModel->accountGet($key['account_id']); ?>
						<img src="<?= base_url('images/profiles/' . $currAccount['profile_picture']); ?>" alt="<?= $currAccount['username']; ?>'s Profile" class="img-fluid">
					</div>
					<div class="col">
						<h4><?= $currAccount['first_name'] . ' ' . $currAccount['last_name']; ?></h4>
						<p><?= $key['comment_text']; ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" integrity="sha256-TAzGN4WNZQPLqSYvi+dXQMKehTYFoVOnveRqbi42frA=" crossorigin="anonymous"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#commentForm').validate({
			ignore: '.ignore',

			rules: {
				comment_text: {
					required: true,
					minlength: 5,
					maxlength: 300
				}
			},

			messages: {
				comment_text: {
					required: 'Tuliskan komentar terlebih dahulu',
					minlength: 'Komentar minimal {0} karakter',
					maxlength: 'Komentar maksimal {0} karakter'
				}
			},

			errorElement: 'em',
			errorPlacement: function(error, element) {
				error.addClass('invalid-feedback');

				if (element.prop('type') === 'radio') {
					error.insertAfter(element.next('label'));
				} else {
					error.insertAfter(element);
				}
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass('is-invalid').removeClass('is-valid');
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass('is-valid').removeClass('is-invalid');
			},
			submitHandler: function(form) {
				if ($("#commentForm").valid()) {
					form.submit();
				}
			}
		});
	});
</script>
<?= $this->endSection(); ?>