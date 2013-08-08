<?php

if (!defined('CORE_VERSION'))
	die();


// Registered sociables
// key = array('title' => string,
//             'icon_uri' => string,
//             'uri' => string,
//             'custom' => boolean)
$core_sociables = array();

// Registers the options for all registered sociables
//
function core_sociables_options_register() {
	global $core_theme_options_handler;
	global $core_sociables;

	// Theme options
	$options = new CoreOptionGroup('sociables', 'Sociables', __('Use this page to enter your social media profile names, or to define custom social media links.', THEME_URI), CORE_URI. '/images/options-sociables.png');
	$core_theme_options_handler->group_add($options);

	$section = new CoreOptionSection('sociables', __('Predefined', THEME_SLUG));
	$options->section_add($section);

	// Predefined sociable profiles
	foreach ($core_sociables as $slug => $sociable) {
		if ($sociable['custom'] == false)
			$section->option_add(new CoreOption('sociable_'. $slug, $sociable['title'], 'text'));
	}

	// Custom sociables
	foreach ($core_sociables as $slug => $sociable) {
		if ($sociable['custom'] == true) {
			$section = new CoreOptionSection('sociable-custom-'. $slug, $sociable['title']);
			$options->section_add($section);

			$section->option_add(new CoreOption('sociable_' .$slug, __('URL', THEME_SLUG), 'text'));
			$section->option_add(new CoreOption('sociable_' .$slug. '_icon', __('Icon', THEME_SLUG), 'image'));
			$section->option_add(new CoreOption('sociable_' .$slug. '_hover_icon', __('Hover icon', THEME_SLUG), 'image'));
		}
	}
}
add_action('after_setup_theme', 'core_sociables_options_register');

// Registers a new sociable
//
function core_sociables_register($slug, $title, $uri, $icon_uri, $icon_hover_uri, $custom=false) {
	global $core_sociables;

	$core_sociables[$slug] = compact('title', 'uri', 'icon_uri', 'icon_hover_uri', 'custom');
}

// Outputs sociables
//
function core_sociables($class='social_icons') {
	global $core_sociables;
	$social_style = "";
	echo '<ul class="', $class, '">';

	foreach ($core_sociables as $slug => $sociable) {
		$profile = core_options_get('sociable_' .$slug);
		if (!$profile)
			continue;

		// Custom sociables are a link, not a profile name
		if ($sociable['custom'] == true) {
			$link = $profile;
			$icon = core_options_get('sociable_' .$slug. '_icon');
			$icon_hover = core_options_get('sociable_' .$slug. '_hover_icon');
		} else {
			$link = $sociable['uri'] . $profile;
			$icon = $sociable['icon_uri'];
		}

		// Icon or sociable name
		if ($sociable['custom'] == true){
			echo '<li class="icons custom"><a class="', $slug,'" target="_blank" href="', $link, '"></a>';
			echo '<style> .icons a.', $slug,'{ background: url(', $icon,') center no-repeat; background-size: cover; background-position: 0 0; } .icons a.', $slug,':hover{ background: url(', $icon_hover,') center no-repeat; background-size: cover; } </style></li>';
		} else
			echo '<li class="icons"><a title="',$sociable['title'],'" class="', $slug,'" target="_blank" href="', $link, '"><i class="icon-',$slug,'"></i></a></li>';
	}
	echo '</ul>';
}

/** Sociable shortcode
 * @since Mikmag 2.0
 */
function core_sociable_shortcode($atts, $content=null, $tag){
	global $core_sociables;
	$social_style = "";
	$output = '<ul class="social_icons">';

	foreach ($core_sociables as $slug => $sociable) {
		$profile = core_options_get('sociable_' .$slug);
		if (!$profile)
			continue;

		// Custom sociables are a link, not a profile name
		if ($sociable['custom'] == true) {
			$link = $profile;
			$icon = core_options_get('sociable_' .$slug. '_icon');
			$icon_hover = core_options_get('sociable_' .$slug. '_hover_icon');
		} else {
			$link = $sociable['uri'] . $profile;
			$icon = $sociable['icon_uri'];
		}

		// Icon or sociable name
		if ($sociable['custom'] == true){
			$output .= '<li class="icons custom"><a class="'. $slug.'" target="_blank" href="'. $link. '"></a>';
			$output .=  '<style> .icons a.'. $slug.'{ background: url('. $icon.') center no-repeat; background-size: cover; background-position: 0 0; } .icons a.'. $slug.':hover{ background: url('. $icon_hover.') center no-repeat; background-size: cover; } </style></li>';
		} else
			$output .= '<li class="icons"><a title="'.$sociable['title'].'" class="'. $slug.'" target="_blank" href="'. $link. '"><i class="icon-'.$slug.'"></i></a></li>';
	}
	$output .=  '</ul>';

	return $output;
}
add_shortcode('sociables', 'core_sociable_shortcode');

?>