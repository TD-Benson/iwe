<?php

// Supported jQuery UI easing effects
$easeEffects = array(
	'linear'               => 'Linear',
	'swing'            => 'Swing',
	'easeInQuad'       => 'In quadratic',
	'easeOutQuad'      => 'Out quadratic',
	'easeInOutQuad'    => 'In-out quadratic',
	'easeInCubic'      => 'In cubic',
	'easeOutCubic'     => 'Out cubic',
	'easeInOutCubic'   => 'In-out cubic',
	'easeInQuart'      => 'In quarter',
	'easeOutQuart'     => 'Out quarter',
	'easeInOutQuart'   => 'In-out quarter',
	'easeInQuint'      => 'In quintuple',
	'easeOutQuint'     => 'Out quintuple',
	'easeInOutQuint'   => 'In-out quintuple',
	'easeInSine'       => 'In sine',
	'easeOutSine'      => 'Out sine',
	'easeInOutSine'    => 'In-out sine',
	'easeInExpo'       => 'In exponential',
	'easeOutExpo'      => 'Out exponential',
	'easeInOutExpo'    => 'In-out exponential',
	'easeInCirc'       => 'In circular',
	'easeOutCirc'      => 'Out circular',
	'easeInOutCirc'    => 'In-out circular',
	'easeInElastic'    => 'In elastic',
	'easeOutElastic'   => 'Out elastic',
	'easeInOutElastic' => 'In-out elastic',
	'easeInBack'       => 'In back',
	'easeOutBack'      => 'Out back',
	'easeInOutBack'    => 'In-out back',
	'easeInBounce'     => 'Bounce in',
	'easeOutBounce'    => 'Bounce out',
	'easeInOutBounce'  => 'Bounce in-out',
);

// Link targets
$linkTargets = array('_self' => __('Same window', THEME_SLUG), '_blank' => __('New window', THEME_SLUG));

// Slide transitions
$transitionList = array(
	'left'     => __('Left', THEME_SLUG),
	'right'    => __('Right', THEME_SLUG),
	'top'      => __('Top', THEME_SLUG),
	'bottom'   => __('Bottom', THEME_SLUG),
	'fade'     => __('Fade', THEME_SLUG)
);
$transitionList_noFade = array(
	'left'     => __('Left', THEME_SLUG),
	'right'    => __('Right', THEME_SLUG),
	'top'      => __('Top', THEME_SLUG),
	'bottom'   => __('Bottom', THEME_SLUG)
);


// Slider definition
$slider = array(
	'name' => __('Layer Slider', THEME_SLUG),
	'scripts' => array(
		'jquery'              => '',
		'jquery-ui'           => '',
		'jquery-effects-core' => '',

		'jquery-easing'       		=> CORE_URI . '/slider/slider-layerslider/jquery-easing-1.3.js',
		'jquery-transit-modified' 	=> CORE_URI . '/slider/slider-layerslider/jquery-transit-modified.js',
		'layerslider-transition'       		=> CORE_URI . '/slider/slider-layerslider/layerslider.transitions.js',
		'layerslider-script'  		=> CORE_URI . '/slider/slider-layerslider/layerslider.kreaturamedia.jquery.js',
	),
	'styles' => array(
		'layerslider-style' => CORE_URI . '/slider/slider-layerslider/layerslider.css',
	),
	'supportsLayers' => true,
	'supportsSlides' => true,
	'output' => 'theme_slider_layer_output',

	// General settings
	'options' => array(
		'autostart' => array(
			'type' => 'boolean',
			'title' => __('Play automatically', THEME_SLUG),
			'default' => true,
		),
		'twoway' => array(
			'type' => 'boolean',
			'title' => __('Reverse playback at end', THEME_SLUG),
			'default' => false,
		),
		'buttons_prevnext' => array(
			'type' => 'boolean',
			'title' => __('Show previous\next buttons', THEME_SLUG),
			'default' => true,
		),
		'buttons_startstop' => array(
			'type' => 'boolean',
			'title' => __('Show start\stop buttons', THEME_SLUG),
			'default' => true,
		),
		'buttons_slides' => array(
			'type' => 'boolean',
			'title' => __('Show slide buttons', THEME_SLUG),
			'default' => true,
		),
		'hoverpause' => array(
			'type' => 'boolean',
			'title' => __('Pause on hover', THEME_SLUG),
			'default' => false,
		),
		'background' => array(
			'type' => 'image',
			'title' => __('Background image', THEME_SLUG),
			'delete' => true,
		),
		'keyboard' => array(
			'type' => 'boolean',
			'title' => __('Keyboard navigation', THEME_SLUG),
			'default' => true,
		),
		'skinned' => array(
			'type' => 'boolean',
			'title' => __('Skinned', THEME_SLUG),
			'default' => true,
		),
		'skin' => array(
			'type' => 'select',
			'items' => array(
				//'borderlessdark'    => __('Borderless Dark', THEME_SLUG),
				//'borderlessdark3d'  => __('Borderless Dark 3D', THEME_SLUG),
				//'borderlesslight'   => __('Borderless Light', THEME_SLUG),
				//'borderlesslight3d' => __('Borderless Light 3D', THEME_SLUG),
				//'carousel'          => __('Carousel', THEME_SLUG),
				'darkskin'          => __('Dark Skin', THEME_SLUG),
				'defaultskin'       => __('Default Skin', THEME_SLUG),
				//'fullwidth'         => __('Fullwidth', THEME_SLUG),
				//'fullwidthdark'     => __('Fullwidth Dark', THEME_SLUG),
				'glass'             => __('Glass', THEME_SLUG),
				'lightskin'         => __('Light Skin', THEME_SLUG),
				'minimal'           => __('Minimal', THEME_SLUG),
				'noskin'            => __('None', THEME_SLUG)
			),
			'title' => __('Skin', THEME_SLUG),
			'default' => 'default'
		),
		'width' => array(
			'type' => 'string',
			'title' => __('Width', THEME_SLUG),
			'default' => '100%'
		),
		'height' => array(
			'type' => 'string',
			'title' => __('Height', THEME_SLUG),
			'default' => '300',
		),
	),

	// Options for individual slides
	'slideOptions' => array(

		// Background column
		'background' => array(
			'title' => __('Background', THEME_SLUG),
			'settings' => array(
				'background' => array(
					'type' => 'image',
					'delete' => true,
				),
			),
		),

		// Slide direction column
		'slide_direction' => array(
			'title' => __('Transition', THEME_SLUG),
			'settings' => array(
				'slide_direction' => array(
					'type' => 'select',
					'items' => $transitionList_noFade,
					'default' => 'left',
				),
			),
		),

		// Slide delay column
		'slide_delay' => array(
			'title' => __('Duration', THEME_SLUG),
			'help' => __('This value determines how long the slide will remain visible.', THEME_SLUG),
			'settings' => array(
				'slide_delay' => array(
					'type' => 'number',
					'min' => 0,
					'max' => 100000,
					'default' => 3000,
				),
			),
		),

		// Duration column
		'duration' => array(
			'title' => __('In\out duration', THEME_SLUG),
			'settings' => array(
				'duration_in' => array(
					'type' => 'number',
					'min' => 0,
					'max' => 100000,
					'default' => 0,
				),
				'duration_out' => array(
					'type' => 'number',
					'min' => 0,
					'max' => 100000,
					'default' => 0,
				),
			),
		),

		// Easing effect column
		'effect' => array(
			'title' => __('In\out move effect', THEME_SLUG),
			'help' => __('These effects are used when moving the slide in and out of the slider area. Click for demos of these effects.', THEME_SLUG),
			'helplink' => 'http://jqueryui.com/demos/effect/easing.html',
			'settings' => array(
				'effect_in' => array(
					'type' => 'select',
					'items' => $easeEffects,
					'default' => 'easeInCubic',
				),
				'effect_out' => array(
					'type' => 'select',
					'items' => $easeEffects,
					'default' => 'easeOutCubic',
				),
			),
		),

		// Delay column
		'delay' => array(
			'title' => __('In\out delay', THEME_SLUG),
			'settings' => array(
				'delay_in' => array(
					'type' => 'number',
					'min' => 0,
					'max' => 100000,
					'default' => 0,
				),
				'delay_out' => array(
					'type' => 'number',
					'min' => 0,
					'max' => 100000,
					'default' => 0,
				),
			),
		),
	),

	// Options for slide layers
	'layerOptions' => array(

		// Image column
		'image' => array(
			'title' => __('Image', THEME_SLUG),
			'settings' => array(
				'image' => array(
					'type' => 'image',
					'delete' => false,
				),
			),
		),

		// HTML column
		'html' => array(
			'title' => __('HTML', THEME_SLUG),
			'help' => __('The HTML code will be displayed as part of this layer, together with the image.', THEME_SLUG),
			'settings' => array(
				'html' => array(
					'type' => 'multiline',
				),
			),
		),

		// HTML size
		'html_size' => array(
			'title' => __('HTML width\height', THEME_SLUG),
			'settings' => array(
				'html_width' => array(
					'type' => 'number',
					'min' => '0',
					'max' => '9999',
					'default' => '0',
				),
				'html_height' => array(
					'type' => 'number',
					'min' => '0',
					'max' => '9999',
					'default' => '0',
				),
			),
		),

		// Position column
		'position' => array(
			'title' => __('Left\top position', THEME_SLUG),
			'settings' => array(
				'x' => array(
					'type' => 'number',
					'min' => -9999,
					'max' => 9999,
					'default' => 0,
				),
				'y' => array(
					'type' => 'number',
					'min' => -9999,
					'max' => 9999,
					'default' => 0,
				),
			),
		),

		// Link column
		'link' => array(
			'title' => __('Link', THEME_SLUG),
			'help' => __('Clicking this layer will navigate to this address. Layers with HTML will not be clickable.', THEME_SLUG),
			'settings' => array(
				'link' => array(
					'type' => 'string',
					'default' => '',
				),
				'link_target' => array(
					'type' => 'select',
					'items' => $linkTargets,
					'default' => '_blank',
				),
			),
		),

		// Movement direction column
		'direction' => array(
			'title' => __('In\out transition', THEME_SLUG),
			'settings' => array(
				'direction_in' => array(
					'type' => 'select',
					'items' => $transitionList,
					'prefix' => 'From ',
					'default' => 'left',
				),
				'direction_out' => array(
					'type' => 'select',
					'items' => $transitionList,
					'prefix' => 'To ',
					'default' => 'left',
				),
			),
		),

		// Movement delay column
		'delay' => array(
			'title' => __('In\out delay', THEME_SLUG),
			'help' => __('Use this to delay this layer from appearing, after the slide has started.', THEME_SLUG),
			'settings' => array(
				'delay_in' => array(
					'type' => 'number',
					'min' => 0,
					'max' => 100000,
					'default' => 0,
				),
				'delay_out' => array(
					'type' => 'number',
					'min' => 0,
					'max' => 100000,
					'default' => 0,
				),
			),
		),

		// Movement duration column
		'duration' => array(
			'title' => __('In\out duration', THEME_SLUG),
			'settings' => array(
				'duration_in' => array(
					'type' => 'number',
					'min' => 0,
					'max' => 100000,
					'default' => 1000,
				),
				'duration_out' => array(
					'type' => 'number',
					'min' => 0,
					'max' => 100000,
					'default' => 1000,
				),
			),
		),

		// Easing effect column
		'effect' => array(
			'title' => __('In\out move effect', THEME_SLUG),
			'help' => __('These settings determine how the layer moves in or out of view. Click for demos of these effects.', THEME_SLUG),
			'helplink' => 'http://jqueryui.com/demos/effect/easing.html',
			'settings' => array(
				'effect_in' => array(
					'type' => 'select',
					'items' => $easeEffects,
					'default' => 'easeInCubic',
				),
				'effect_out' => array(
					'type' => 'select',
					'items' => $easeEffects,
					'default' => 'easeOutCubic',
				),
			),
		),

		// Parallax depth column
		'depth' => array(
			'title' => __('Depth', THEME_SLUG),
			'help' => __('Higher values will make this layer appear closer, lower values will make it appear farther away.', THEME_SLUG),
			'settings' => array(
				'depth' => array(
					'type' => 'number',
					'min' => 0,
					'max' => 100,
					'default' => 2,
				),
			),
		),

		// Parallax in\out modifier
		'parallax' => array(
			'title' => __('In\out parallax', THEME_SLUG),
			'settings' => array(
				'parallax_in' => array(
					'type' => 'number',
					'min' => 0,
					'max' => 1,
					'default' => 0.45,
				),
				'parallax_out' => array(
					'type' => 'number',
					'min' => 0,
					'max' => 1,
					'default' => 0.45,
				),
			),
		),
	),
);

// Register
core_slider_register($slider);


// Outputs the Layer Slider code
//
function theme_slider_layer_output($settings) {
	$slider_settings = $settings['settings'];

	$id = core_get_uuid('theme-slider-');

	// Output inline JavaScript
	?>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			<?php
				$autostart = intval($slider_settings['autostart']) == '1' ? 'true': 'false';
				$twoway 	=	intval($slider_settings['twoway']) == '1' ? 'true': 'false';
				$keyboard 	=	intval($slider_settings['keyboard']) == '1' ? 'true': 'false';
				$buttons_prevnext 	=	intval($slider_settings['buttons_prevnext']) == '1' ? 'true': 'false';
				$buttons_startstop 	=	intval($slider_settings['buttons_startstop']) == '1' ? 'true': 'false';
				$buttons_slides 	=	intval($slider_settings['buttons_slides']) == '1' ? 'true': 'false';
				$hoverpause 	=	intval($slider_settings['hoverpause']) == '1' ? 'true': 'false';

			?>
			jQuery('#<?php echo $id; ?>').layerSlider({
				autoStart         : <?php echo $autostart; ?>,
				firstLayer        : 0,
				twoWaySlideshow   : <?php echo $twoway; ?>,
				keybNav           : <?php echo $keyboard; ?>,
				imgPreload        : 1,
				navPrevNext       : <?php echo $buttons_prevnext; ?>,
				navStartStop      : <?php echo $buttons_startstop; ?>,
				navButtons        : <?php echo $buttons_slides; ?>,
				thumbnailNavigation : 'disabled',
				<?php
					$skin = isset($slider_settings['skin']) ? $slider_settings['skin'] : 'noskin';

					if ($slider_settings['skinned'])
						echo 'skin              : "'. $skin .'",';
					else
						echo 'skin              : "noskin",';
				?>

				skinsPath         : templateDir + '/tdframework/core/slider/slider-layerslider/skins/',
				pauseOnHover      : <?php echo $hoverpause; ?>,
				globalBGColor     : 'transparent',
				globalBGImage     : '<?php echo $slider_settings['background']; ?>',
				animateFirstLayer : 1,
				showCircleTimer     : false,
			});
		});
	</script>
	<?php

	echo '<div id="', $id, '" class="ls-container" style="width: ', core_css_unit($slider_settings['width']), '; height: ', core_css_unit($slider_settings['height']), '">';

	// Output slides
	foreach ($settings['slides'] as $slide) {
		$slide_settings = $slide['settings'];
		$properties = array(
			'slidedirection' => $slide_settings['slide_direction'],
			'slidedelay'     => $slide_settings['slide_delay'],
			'durationin'     => $slide_settings['duration_in'],
			'durationout'    => $slide_settings['duration_out'],
			'easingin'       => $slide_settings['effect_in'],
			'easingout'      => $slide_settings['effect_out'],
			'delayin'        => $slide_settings['delay_in'],
			'delayout'       => $slide_settings['delay_out'],
		);
		$properties = core_implode_properties($properties);

		echo '<div class="ls-layer" style="', $properties, '">';
		if ($slide_settings['background'] != '')
			echo '<img class="ls-bg" alt="layer-background" src="', $slide_settings['background'], '">';

		// Output layers
		foreach ($slide['layers'] as $layer) {
			$properties = array(
				'slidedirection'    => $layer['direction_in'],
				'slideoutdirection' => $layer['direction_out'],
				'parallaxin'        => $layer['parallax_in'],
				'parallaxout'       => $layer['parallax_out'],
				'durationin'        => $layer['duration_in'],
				'durationout'       => $layer['duration_out'],
				'easingin'          => $layer['effect_in'],
				'easingout'         => $layer['effect_out'],
				'delayin'           => $layer['delay_in'],
				'delayout'          => $layer['delay_out'],
			);
			$properties = core_implode_properties($properties);

			//$style = 'left: ' .core_css_unit($layer['x']). ';';
			//$style .= 'top: ' .core_css_unit($layer['y']). ';';
			$style = 'left: ' .$layer['x']. ';';
			$style .= 'top: ' .$layer['y']. ';';

			// Linked layer
			if ($layer['link'] != '') {
				echo '<a href="', $layer['link'], '" target="', $layer['link_target'], '" title="sublayer" class="ls-s', $layer['depth'], '" style="', $properties, ' ', $style, '">';
				echo '<img alt="sublayer image" src="', $layer['image'], '">';
				echo '</a>';

			// HTML layer
			} else if ($layer['html'] != '') {
				echo '<div class="ls-s', $layer['depth'], '" style="', $properties, ' ', $style, '" title="sublayer">';
				if ($layer['image'])
					echo '<img alt="sublayer image" src="', $layer['image'], '">';
				echo '<div style="overflow: hidden; width: ', core_css_unit($layer['html_width']), '; height: ', core_css_unit($layer['html_height']), ';">';
				echo do_shortcode($layer['html']);
				echo '</div>';
				echo '</div>';

			// Only image
			} else if ($layer['image'] != '') {
				echo '<img alt="sublayer image" class="ls-s', $layer['depth'], '" style="', $properties, ' ', $layer['image'], '" style="', $style, '" title="sublayer">';

			// Missing content
			} else {
				echo '<div class="ls-s', $layer['depth'], '" style="', $properties, ' ', $style, '" title="sublayer">';
				echo '<b>No content defined for this layer.</b>';
				echo '</div>';
			}
		}

		echo '</div>';
	}

	echo '</div>';

}

?>