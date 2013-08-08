<?php

// Supported jQuery UI easing effects
$flex_ease_effects = array(
	'linear' => 'Linear',
	'swing' => 'Swing',
	'easeInQuad' => 'In quadratic',
	'easeOutQuad' => 'Out quadratic',
	'easeInOutQuad' => 'In-out quadratic',
	'easeInCubic' => 'In cubic',
	'easeOutCubic' => 'Out cubic',
	'easeInOutCubic' => 'In-out cubic',
	'easeInQuart' => 'In quarter',
	'easeOutQuart' => 'Out quarter',
	'easeInOutQuart' => 'In-out quarter',
	'easeInQuint' => 'In quintuple',
	'easeOutQuint' => 'Out quintuple',
	'easeInOutQuint' => 'In-out quintuple',
	'easeInSine' => 'In sine',
	'easeOutSine' => 'Out sine',
	'easeInOutSine' => 'In-out sine',
	'easeInExpo' => 'In exponential',
	'easeOutExpo' => 'Out exponential',
	'easeInOutExpo' => 'In-out exponential',
	'easeInCirc' => 'In circular',
	'easeOutCirc' => 'Out circular',
	'easeInOutCirc' => 'In-out circular',
	'easeInElastic' => 'In elastic',
	'easeOutElastic' => 'Out elastic',
	'easeInOutElastic' => 'In-out elastic',
	'easeInBack' => 'In back',
	'easeOutBack' => 'Out back',
	'easeInOutBack' => 'In-out back',
	'easeInBounce' => 'Bounce in',
	'easeOutBounce' => 'Bounce out',
	'easeInOutBounce' => 'Bounce in-out',
);

// Slider definition
$slider = array(
	'name' => __('Latest Posts Slider', THEME_SLUG),
	'scripts' => array(
		'jquery' => ' ',
		'flexslider-js' => CORE_URI . '/slider/slider-flexslider/jquery.flexslider.js',
	),
	'styles' => array(
		'flexslider-style' => CORE_URI . '/slider/slider-flexslider/custom-flexslider.css',
	),
	'supportsLayers' => false,
	'supportsSlides' => false,
	'output' => 'theme_slider_flexslider_output',

	// General settings
	'options' => array(
		/*'width' => array(
			'type' => 'string',
			'title' => __('Width', THEME_SLUG),
			'default' => '100%'
		),*/
		'height' => array(
			'type' => 'string',
			'title' => __('Height', THEME_SLUG),
			'default' => '600',
		),
		'categories' => array(
			'type' => 'multiline',
			'title' => __('Categories', THEME_SLUG),
			'description' => __('Enter the slug names of categories you want the slider to display, separated by commas.', THEME_SLUG),
			'default' => '',
		),
		'post_count' => array(
			'type' => 'string',
			'title' => __('Post count', THEME_SLUG),
			'default' => '10',
		),
		'word_count' => array(
			'type' => 'string',
			'title' => __('Word count', THEME_SLUG),
			'default' => '120',
		),
		// Slider settings
		/*'slideshow' => array(
			'type' => 'boolean',
			'title' => __('Slideshow', THEME_SLUG),
			'default' => false,
		),*/
		/*'animation' => array(
			'type' => 'select',
			'items' => array(
					'fade' => __('Fade', THEME_SLUG),
					'slide'=> __('Slide', THEME_SLUG)
				),
			'title' => __('Animation', THEME_SLUG),
			'default' => 'fade',
		),
		'easing' => array(
			'type' => 'select',
			'items' => $flex_ease_effects,
			'title' => __('Easing', THEME_SLUG),
			'default' => 'swing',
		),
		'direction' => array(
			'type' => 'select',
			'title' => __('Direction', THEME_SLUG),
			'items' => array(
					'horizontal' => __('Horizontal', THEME_SLUG),
					'vertical'=> __('Vertical', THEME_SLUG)
				),
			'title' => __('Direction', THEME_SLUG),
			'default' => 'horizontal',
		),
		'slideshowSpeed' => array(
			'type' => 'number',
			'title' => __('Slideshow speed', THEME_SLUG),
			'default' => '7000',
		),
		'animationSpeed' => array(
			'type' => 'number',
			'title' => __('Animation speed', THEME_SLUG),
			'default' => '600',
		),
		'pauseonHover' => array(
			'type' => 'boolean',
			'title' => __('Pause on hover', THEME_SLUG),
			'default' => true,
		),
		'controlNav' => array(
			'type' => 'boolean',
			'title' => __('Control Nav', THEME_SLUG),
			'default' => true,
		),
		'directionNav' => array(
			'type' => 'boolean',
			'title' => __('Direction Nav', THEME_SLUG),
			'default' => true,
		),
		/*'randomFlex' => array(
			'type' => 'boolean',
			'title' => __('Randomize', THEME_SLUG),
			'default' => false,
		),*/
		'thumbnails' => array(
			'type' => 'select',
			'title' => __('Thumbnails', THEME_SLUG),
			'description' => __('Display thumbnail carousel', THEME_SLUG),
			'items' => array(
				'none' => __('None', THEME_SLUG),
				'top' => __('Top', THEME_SLUG),
				/*'right' => __('Right', THEME_SLUG),*/
				'bottom' => __('Bottom', THEME_SLUG),
				/*'left' => __('Left', THEME_SLUG)*/
			),
			'default' => 'none',
		),
		'tsWidth' => array(
			'type' => 'string',
			'title' => __('Thumbnail Width', THEME_SLUG),
			'default' => '110'
		)/*,
		'tsHeight' => array(
			'type' => 'string',
			'title' => __('Thumbnail Height', THEME_SLUG),
			'default' => '90'
		)*/
	)
);

// Register
core_slider_register($slider);

// Outputs the Layer Slider code
//

function display_thumbs($id,$posts, $thumbnail, $height){
	if ( $thumbnail != ' ') :

	if ( $thumbnail == 'left' || $thumbnail == 'right' ) :
	?>
	<div id="carousel-<?php echo $id; ?>" class="flexslider carousel <?php echo $thumbnail; ?>"  style="height: <?php echo $height; ?>">

	<?php else : ?>

	<div id="carousel-<?php echo $id; ?>" class="flexslider carousel <?php echo $thumbnail; ?>">

	<?php endif; ?>

	  <ul class="slides">
		<?php

		// Output slides
		foreach ($posts as $post) {

			$post_id = $post['ID'];
			$thumb_id = get_post_thumbnail_id($post_id);
			$post_image = wp_get_attachment_image_src($thumb_id, 'slider-layer');

			if (has_post_thumbnail($post_id)) {
				echo "<li>\n";
				echo '<img alt="slide-image', $post_id, '" class="slider-latest-image" src="', $post_image[0], '">';
				echo "</li>";
			}

		}

		?>
	    <!-- items mirrored twice, total of 12 -->
	  </ul>
	</div>

	<?php

	endif;
}

function theme_slider_flexslider_output($settings) {
	$slider_settings = $settings['settings'];

	$thumbnail = $slider_settings['thumbnails'] == 'none' ? ' ' : $slider_settings['thumbnails'] ;

	$id = core_get_uuid('theme-slider-');

	// Get recent posts
	$posts = wp_get_recent_posts(array(
		'numberposts' => intval($slider_settings['post_count']),
		'category_name' => $slider_settings['categories'],
		'post_type' => 'post',
		'order' => 'DESC',
		'orderby' => 'post_date',
		'post_status' => 'publish',
	));

	if ( $thumbnail == 'top' || $thumbnail == 'left' )
		display_thumbs($id,$posts, $thumbnail, core_css_unit($slider_settings['height']));

	echo "<div class=\"grid box-twelve ", $thumbnail ,"\">";

	echo "<div id=\"", $id, "\" class=\"flexslider thumbnail-", $thumbnail ,"\">";

	?>
	<ul class="slides">

	<?php

	// Output slides
	foreach ($posts as $post) {

		$post_id = $post['ID'];
		$thumb_id = get_post_thumbnail_id($post_id);
		$post_image = wp_get_attachment_image_src($thumb_id, 'slider-layer');

		if (has_post_thumbnail($post_id)) {
			echo "<li>\n";
			echo '<a href="', get_permalink($post_id), '">';
			echo '<img alt="slide-image', $post_id, '" class="slider-latest-image" src="', $post_image[0], '">';
			echo '</a>';

			$category = get_the_category($post_id);
			if($category[0])
				echo '<a class="slide-category" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';

			echo '<div class="slide-content"><div class="grid box-twelve">';
			echo '<h2 class="slider-title">', $post['post_title'], '</h2>';

			$post_content = $post['post_content'];

			$excerpt = explode(' ', $post_content, $slider_settings['word_count']);
			if (count($excerpt)>=$limit) {
				array_pop($excerpt);
				$excerpt = implode(" ",$excerpt).' ';
			} else
				$excerpt = implode(" ",$excerpt);

			$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);

			echo '<div>'.$excerpt.'&hellip;<br><a class="button small right glidebutton" href="', get_permalink($post_id), '"><span>'.__('Read more', THEME_SLUG). '</span><span>'.__('Read more', THEME_SLUG). '</span></a></div>';

			echo '</div></div>';

			echo "</li>";
		}

	}

	?>
	    <!-- items mirrored twice, total of 12 -->
	  </ul>
	</div>
	</div>

	<?php

	if ( $thumbnail == 'bottom' || $thumbnail == 'right')
		display_thumbs($id,$posts, $thumbnail, core_css_unit($slider_settings['height']));

	echo "<div class=\"clear\"></div>";

	if ( $thumbnail == 'left' || $thumbnail == 'right') : ?>

	<style style="text/css">
		#carousel-<?php echo $id; ?> .flex-viewport { width: 110px; height: <?php echo core_css_unit($slider_settings['height']); ?> !important; }
	</style>

	<?php endif;

	// Output inline JavaScript
	$slideshow 		= intval($slider_settings['slideshow']) == '1' ? 'true': 'false';
	$pauseonHover 	= intval($slider_settings['pauseonHover']) == '1' ? 'true': 'false';
	$controlNav		= intval($slider_settings['controlNav	']) == '1' ? 'true': 'false';
	$directionNav 	= intval($slider_settings['directionNav']) == '1' ? 'true': 'false';
	?>
	<script type="text/javascript">
		jQuery(window).load(function() {

			jQuery('#carousel-<?php echo $id; ?>').flexslider({
				animation : 'slide',
			    controlNav: false,
			    directionNav: true,
			    animationLoop: false,
			    slideshow: false,
			    prevText		: "<i class='icon-minus'></i>",
				nextText		: "<i class='icon-plus'></i>",
			    itemWidth: <?php echo $slider_settings['tsWidth']; ?>,
			    itemMargin: 0,
			    asNavFor: '#<?php echo $id; ?>'
			});

			jQuery('#<?php echo $id; ?>').flexslider({
				slideshow		: true,
				controlNav: false,
				animation 		: 'slide',
				prevText		: "<i class='icon-minus'></i>",
				nextText		: "<i class='icon-plus'></i>",
				<?php if ( $thumbnail != ' ') : ?>
				sync: "#carousel-<?php echo $id; ?>"
				<?php endif; ?>
			});

		});
	</script>
	<?php
}

?>