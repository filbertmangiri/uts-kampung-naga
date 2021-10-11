<?= $this->extend('layout/template'); ?>

<?php $session = \Config\Services::session(); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container">
	<div class="row">
		<div class="col">
			<form id="insertForm" action="<?= base_url('admin/insert'); ?>" method="post" enctype="multipart/form-data">
				<?= csrf_field(); ?>

				<?php if (!empty($session->getFlashData('article_insert_error_msg'))) : ?>
					<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
						<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
							<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
						</symbol>
					</svg>

					<div class="alert alert-danger alert-dismissible" role="alert">
						<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
							<use xlink:href="#exclamation-triangle-fill">
						</svg>

						<?= $session->getFlashData('article_insert_error_msg'); ?>

						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif; ?>

				<div class="form-group mb-3">
					<label for="title" class="form-label">Judul</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Masukkan judul">
				</div>

				<div class="form-group mb-3">
					<label for="category" class="form-label">Kategori</label>
					<select class="mb-4 col" id="category" name="category">
						<?php foreach ($categories as $key) : ?>
							<option value="<?= $key['category']; ?>"><?= $key['category']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="form-group mb-3">
					<label for="author" class="form-label">Penulis</label>
					<input type="text" class="form-control" id="author" name="author" placeholder="Masukkan nama penulis">
				</div>

				<div class="form-group mb-3">
					<label for="content" class="form-label">Isi Konten</label>
					<textarea class="form-control" name="content" id="content" name="content" rows="10" cols="80" placeholder="Masukkan isi konten"></textarea>
				</div>

				<div class="form-group mb-3">
					<label for="thumbnail" class="form-label">Thumbnail</label>
					<input class="form-control" type="file" id="thumbnail" name="thumbnail">
				</div>

				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" integrity="sha256-TAzGN4WNZQPLqSYvi+dXQMKehTYFoVOnveRqbi42frA=" crossorigin="anonymous"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#category').select2({
			width: '100%'
		});

		CKEDITOR.replace('content');

		$('#insertForm').validate({
			ignore: '.ignore',

			rules: {
				title: {
					required: true,
					minlength: 5
				},
				category: {
					required: true
				},
				author: {
					required: true,
					minlength: 3
				},
				content: {
					required: true,
					minlength: 10
				},
				thumbnail: {
					required: true,
					accept: "image/*"
				}
			},

			messages: {

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
				if ($("#insertForm").valid()) {
					form.submit();
				}
			}
		});
	});
</script>
<?= $this->endSection(); ?>