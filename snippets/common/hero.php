<?php if (!isset($steps)) { $steps = false; } ?>
<?php do_action('breadcrumbs_above', $steps); ?>

<figure class="hero parallax">
	<picture>
		<?php if ($desktop_src) { ?>
			<img src="<?= $desktop_src ?>"
			     alt="<?= $image_alt ?>"
			     class="hero__image"
			     style="--parallax-position: 0%;">
		<?php } ?>
	</picture>
	<figcaption class="hero__caption <?= isset($caption_classes) ? $caption_classes : '' ?>">
		<?php do_action('breadcrumbs_hero', $steps); ?>
		<div class="hero__caption-overlay"></div>
		<div class="hero__content ccontain">
			<h1><?= $caption ?></h1>
		</div>
	</figcaption>
</figure>

<style type="text/css">
	.hero {
		<?php if (isset($opacity) && $opacity != '') { ?>
			--hero-opacity: <?= $opacity ?>;
		<?php } ?>
		<?php if (isset($background) && $background != '') { ?>
			--hero-background: <?= $background ?>;
		<?php } ?>
		<?php if (isset($text_color) && $text_color != '') { ?>
			--hero-text: <?= $text_color ?>;
		<?php } ?>
	}
</style>

<?php do_action('breadcrumbs_below', $steps); ?>