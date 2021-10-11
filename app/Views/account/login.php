<?= $this->extend('layout/template'); ?>

<?php $session = \Config\Services::session(); ?>

<?= $this->section('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-11 col-md-8 col-lg-6 mx-auto">
			<form id="loginForm" action="<?= base_url('login/submit'); ?>" method="post">
				<?= csrf_field(); ?>

				<?php if (!empty($session->getFlashData('login_error_msg'))) : ?>
					<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
						<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
							<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
						</symbol>
					</svg>

					<div class="alert alert-danger alert-dismissible" role="alert">
						<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
							<use xlink:href="#exclamation-triangle-fill" />
						</svg>

						<?= $session->getFlashData('login_error_msg'); ?>

						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif; ?>

				<div class="form-floating mb-2">
					<input type="text" class="form-control" id="emailUsername" placeholder="Email atau username" name="email_username" autofocus>
					<label for="emailUsername">Email atau username</label>
				</div>

				<div class="form-floating mb-3">
					<input type="password" class="form-control" id="password" placeholder="Password" name="password">
					<label for="password">Password</label>
				</div>

				<div class="form-group mb-3">
					<div class="g-recaptcha" data-sitekey="<?= RECAPTCHA_SITE; ?>" data-callback="recaptchaCallback">
					</div>
					<input type="hidden" class="hiddenRecaptcha required" name="hidden_recaptcha" id="hiddenRecaptcha">
				</div>

				<div class="d-grid">
					<button type="submit" class="btn btn-primary" id="loginSubmit">MASUK</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<!-- jQuery Validation -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" integrity="sha256-TAzGN4WNZQPLqSYvi+dXQMKehTYFoVOnveRqbi42frA=" crossorigin="anonymous"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>

<script type="text/javascript">
	function recaptchaCallback() {
		$('#hiddenRecaptcha').valid();
	};

	$(document).ready(function() {
		$('#loginForm').validate({
			ignore: '.ignore',

			rules: {
				email_username: {
					required: true
				},
				password: {
					required: true
				},

				hidden_recaptcha: {
					required: function() {
						return grecaptcha.getResponse() == '';
					}
				}
			},

			/*messages: {
				username: {
					required: ''
				}
			},*/

			errorElement: 'em',
			errorPlacement: function(error, element) {
				error.addClass('invalid-feedback');

				if (element.prop('type') === 'radio') {
					error.insertAfter(element.next('label'));
				} else {
					error.insertAfter(element);
				}
			},
			// highlight: function(element, errorClass, validClass) {
			// 	$(element).addClass('is-invalid').removeClass('is-valid');
			// },
			// unhighlight: function(element, errorClass, validClass) {
			// 	$(element).addClass('is-valid').removeClass('is-invalid');
			// },
			submitHandler: function(form) {
				if ($("#loginForm").valid()) {
					form.submit();
				}
			}
		});
	});
</script>
<?= $this->endSection(); ?>