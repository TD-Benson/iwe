<?php

$slider_supersized_transitions = array(
	'0' => __('None', THEME_SLUG),
	'1' => __('Fade', THEME_SLUG),
	'2' => __('Slide Top', THEME_SLUG),
	'3' => __('Slide Right', THEME_SLUG),
	'4' => __('Slide Bottom', THEME_SLUG),
	'5' => __('Slide Left', THEME_SLUG),
	'6' => __('Carousel Right', THEME_SLUG),
	'7' => __('Carousel Left', THEME_SLUG)
);

// Slider definition
$slider = array(
	'name' => __('Supersized Slider', THEME_SLUG),
	'scripts' => array(
		//'jquery-min16' => 'https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js',
		//'jquery-easing' => CORE_URI . '/slider/slider-supersized/js/jquery.easing.min.js',
		//'supersized-script' => CORE_URI . '/slider/slider-supersized/js/supersized.3.2.7.js',
		//'supersized-shutter-script' => CORE_URI . '/slider/slider-supersized/theme/supersized.shutter.min.js',
	),
	'styles' => array(
		'supersized-style' => CORE_URI . '/slider/slider-supersized/css/supersized.css',
		'supersized-shutter-style' => CORE_URI . '/slider/slider-supersized/theme/supersized.shutter.css',
	),
	'supportsLayers' => false,
	'supportsSlides' => true,
	'output' => 'theme_slider_supersized_output',

	// General settings
	'options' => array(
		'transition' => array(
			'type' => 'select',
			'items' => $slider_supersized_transitions,
			'title' => __('Transition effect', THEME_SLUG),
			'default' => '1',
		),
		'autoplay' => array(
			'type' => 'select',
			'items' => array(
				'yes' => __('yes', THEME_SLUG),
				'no' =>__('no', THEME_SLUG),
			),
			'title' => __('AutoPlay', THEME_SLUG),
			'default' => 'yes'
		),
		'slide_interval' => array(
			'type' => 'number',
			'title' => __('Slide Interval', THEME_SLUG),
			'default' => '3000'
		),
		'transition_speed' => array(
			'type' => 'number',
			'title' => __('Transition Speed', THEME_SLUG),
			'default' => '1000',
		),
		'fit_always' => array(
			'type' => 'select',
			'items' => array(
				'1' => __('yes', THEME_SLUG),
				'0' =>__('no', THEME_SLUG),
			),
			'title' => __('Fit Image to Window', THEME_SLUG),
			'default' => '0'
		),
	),

	// Options for individual slides
	'slideOptions' => array(

		// Image
		'image' => array(
			'title' => __('Image', THEME_SLUG),
			'settings' => array(
				'image' => array(
					'type' => 'image',
					'delete' => false,
				),
			),
		),

		// Caption
		'caption' => array(
			'title' => __('Caption', THEME_SLUG),
			'settings' => array(
				'caption' => array(
					'type' => 'multiline',
				),
			),
		),

		// Link
		'link' => array(
			'title' => __('Link', THEME_SLUG),
			'settings' => array(
				'link' => array(
					'type' => 'string',
					'default' => '',
				),
			),
		),
	),
);


// Register
core_slider_register($slider);


function my_scripts_supersized() {
	
	//wp_enqueue_script('jquerymain', 'https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js', array('jquery') );
	wp_enqueue_script('supersized-script', CORE_URI . '/slider/slider-supersized/js/supersized.3.2.7.js', array('jquery') );
	//wp_enqueue_script('supersized-controls-script', CORE_URI . '/slider/slider-supersized/js/supersized-controls.js', array('jquery') );
	wp_enqueue_script('supersized-shutter-script', CORE_URI . '/slider/slider-supersized/theme/supersized.shutter.js', array('jquery') );
}

add_action( 'wp_enqueue_scripts', 'my_scripts_supersized' ); 

// Outputs the Draggable slider code
//
function theme_slider_supersized_output($settings) {
	$slider_settings = $settings['settings'];
	
	$slideautoplay 	= $slider_settings['autoplay'] == 'yes' ? '1': '0';

	$id = core_get_uuid('theme-slider-');
	$skin = isset($slider_settings['skin']) ? $slider_settings['skin']: 'default';

	$output = '';
	$output .=' <script type="text/javascript">';
	$output .='jQuery(function($){';
	$output .='$.supersized({';
					// Functionality
	$output .='slideshow               	:   1,';	
	$output .='autoplay					:	'.$slideautoplay.',';			// Slideshow starts playing automatically
	$output .='start_slide             	:   1,';			// Start slide (0 is random)
	$output .='stop_loop				:	0,';			// Pauses slideshow on last slide
	$output .='random					: 	0,';			// Randomize slide order (Ignores start slide)
	$output .='slide_interval          	:   '.intval($slider_settings['slide_interval']) .',';			// Length between transitions
	$output .='transition              	:   '.intval($slider_settings['transition']).','; 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
	$output .='transition_speed			:	'.intval($slider_settings['transition_speed']) .',';			// Speed of transition
	$output .='new_window				:	1,';			// Image links open in new window/tab
	$output .='pause_hover             	:   0,';			// Pause slideshow on hover
	$output .='keyboard_nav            	:   1,';			// Keyboard navigation on/off
	$output .='performance				:	1,';			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
	$output .='image_protect			:	1,';			// Disables image dragging and right click with Javascript
															   
					// Size & Position						   
	$output .='min_width		       	:   0,';			// Min width allowed (in pixels)
	$output .='min_height		       	:   0,';			// Min height allowed (in pixels)
	$output .='vertical_center         	:   1,';			// Vertically center background
	$output .='horizontal_center       	:   1,';			// Horizontally center background
	//$output .='fit_always				:	'.intval($slider_settings['fit_always']).',';			// Image will never exceed browser width or height (Ignores min. dimensions)
	$output .='fit_always				:	0,';			// Image will never exceed browser width or height (Ignores min. dimensions)
	$output .='fit_portrait         	:   1,';			// Portrait images will not exceed browser height
	$output .='fit_landscape			:   0,';			// Landscape images will not exceed browser width
															   
					// Components							
	$output .='slide_links				:	\'blank\',';	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
	$output .='thumb_links				:	1,';			// Individual thumb links for each slide
	$output .='thumbnail_navigation    	:   1,';			// Thumbnail navigation
	$output .='slides 					:  	[';			// Slideshow Images


	$index = 0;
	$captions = '';
	$imagelist = '';
	foreach ($settings['slides'] as $slide) {
		$slide_settings = $slide['settings'];
		$index++;
		$imagelist .="{image : '". $slide_settings['image']."', title : '". $slide_settings['caption']."', thumb : '". $slide_settings['image']."', url : '". $slide_settings['link']."'},";
	}
	$output .= trim($imagelist,',');
	
	$output .=									'],';
												
					// Theme Options			   
	$output .='progress_bar				:	1,';			// Timer for each slide							
	$output .='image_path				:	\''.CORE_URI . '/slider/slider-supersized/img/'.'\',';			// Timer for each slide							
	$output .='mouse_scrub				:	0';
	$output .=' });';
	$output .=' });';
	$output .='</script>';
	
	
	echo $output;

	
	
	
}

?>