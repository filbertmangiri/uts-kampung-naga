<script type="text/javascript">
	$(window).on('click', function(event) {
		let clickOver = $(event.target)
		if ($('.navbar .navbar-toggler').attr('aria-expanded') == 'true' && clickOver.closest('.navbar').length === 0) {
			$('button[aria-expanded="true"]').click();
		}
	});
</script>