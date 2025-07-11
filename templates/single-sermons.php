<?php 

get_header(); 

while (have_posts()) { 
	the_post();

	$post = get_post();
	$post_id = $post->ID;
	$sermon_content = util_get_actual_content($post->post_content);
	$image = util_get_hero_src($post);
	$pattern = util_get_pattern_object('church_sermon_contents_pattern');
	$sermon_cards = get_option('church_sermons_card_order');
	$series_ID = get_post_meta($post_id, 'sermon_series', true);
	$series = $series_ID ? get_post($series_ID) : false;

	$steps = $series ? array(
		array('type' => 'sermons', 'slug' => false),
		array('type' => 'sermon-series', 'slug' => false),
		array('type' => 'sermon-series', 'slug' => $series->post_name),
		array('type' => 'sermons', 'slug' => $post->post_name),
	) : array(
		array('type' => 'sermons', 'slug' => false),
		array('type' => 'sermons', 'slug' => $post->post_name),
	);

	$sermon_snippet = util_render_snippet('sermons/sermon-link', array(
		'link' => get_post_meta($post_id, 'link', true),
		'audio_link' => get_post_meta($post_id, 'audio_link', true)
	));

	util_render_snippet('common/hero', array(
		'desktop_src' => $image['src'],
		'image_alt' => $image['alt'],
		'caption_classes' => '',
		'caption' => get_the_title(),
		'steps' => $steps,
		'opacity' => get_post_meta($post_id, 'hero_opacity', true),
		'background' => get_post_meta($post_id, 'hero_background', true),
		'text_color' => get_post_meta($post_id, 'hero_text', true),
		'hero_height' => get_post_meta($post_id, 'hero_height', true),
	), false);

	do_action('church_layout_after_header');
} ?>


<article class="ccontain sermon">
	<div class="sermon__content">
		<?php if ($pattern) { ?>
			<?= util_get_actual_content($pattern->post_content) ?>
		<?php } else { ?>
			<?= util_render_snippet('sermons/card-options/audio') ?>

			<div class="sermon__content-cards">
				<?php foreach($sermon_cards as $card) { ?>
					<?= util_render_snippet('sermons/card-options/' . $card, array(
						'sermon' => $post,
						'series' => $series
					)); ?>
				<?php } ?>
			</div>

			<?= util_render_snippet('sermons/card-options/download') ?>
		<?php } ?>
	</div>
	
	<div class="sermon__content">
		<?php 
			$content = get_the_content();
			$url = '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i';
			echo preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>', $content);
		?>
	</div>
</article>


<?php get_footer();
