<?= $this->extend('layout/template'); ?>

<?= $this->section('styles'); ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
	@media only screen and (max-width: 650px) {
		div.follow-scroll {
			display: none;
		}

		div.maincontent {
			width: 100%;
		}
	}

	@media only screen and (min-width: 650px) {
		div.maincontent {
			float: left;
			width: 55%;
		}
	}
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class=container>
	<div class="column" style="float:left;width:55%;">
		<?php foreach ($articles as $key) : ?>
			<div class="row">
				<article class='mb-5' data-aos='fade-up'>
					<a href="<?= base_url('article/' . $key['title_slug']); ?>">
						<img src="<?= base_url('images/thumbnails/' . $key['thumbnail']); ?>" alt="<?= $key['title_slug']; ?>" style="margin-left:auto; margin-right:auto;" class="rounded img-fluid" width="100%;">
					</a>
					<a href="<?= base_url('article/' . $key['title_slug']); ?>" style="text-decoration:none;">
						<h2 class="text-success"><?= $key['title']; ?></h2>
					</a>
					<a href="<?= base_url('article/category/' . $key['category_slug']); ?>" style="text-decoration:none;">
						<h5 class="text-info">Kategori : <?= $key['category']; ?></h5>
					</a>
				</article>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="column follow-scroll" style="float:right;width:35%;position:sticky;top: 0;">
		<h3 style="text-align:center">TRENDING TOPIC</h3>
		<hr style="height:5px;color:black;opacity:inherit">
		<?php foreach ($articles as $key) :
			if ($key['is_trending'] == 1) { ?>
				<a href="<?= base_url('article/' . $key['title_slug']); ?>" style="text-decoration:none;">
					<div class="row bg-light">
						<h3 class="text-body"><?= $key['title']; ?></h3>
						<hr style="height:3px;color:black;">
					</div>
				</a>
		<?php }
		endforeach; ?>
	</div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
	AOS.init({
		disable: false,
		disableMutationObserver: false, // disables automatic mutations' detections (advanced)
		debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
		throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)

		// Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
		offset: 400, // offset (in px) from the original trigger point
		delay: 400, // values from 0 to 3000, with step 50ms
		duration: 300, // values from 0 to 3000, with step 50ms
		easing: 'ease-in-sine', // default easing for AOS animations
		once: false, // whether animation should happen only once - while scrolling down
		mirror: true, // whether elements should animate out while scrolling past them
		anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation
	});

	(function($) {
		var element = $('.follow-scroll'),
			originalY = element.offset().top;

		// Space between element and top of screen (when scrolling)
		var topMargin = 20;

		// Should probably be set in CSS; but here just for emphasis
		element.css('position', 'relative');

		$(window).on('scroll', function(event) {
			var scrollTop = $(window).scrollTop();

			element.stop(false, false).animate({
				top: scrollTop < originalY ?
					0 : scrollTop - originalY + topMargin
			}, 300);
		});
	})(jQuery);
</script>
<?= $this->endSection(); ?>