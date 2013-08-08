<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Theme Option: Colorschemes
 *
 * @package WordPress
 * @subpackage TDFramework
 * @since framework 1.0
 */


// Enqueue scripts
//
function core_colorschemes_enqueue_scripts() {
	wp_enqueue_style('core-colorschemes-style', CORE_URI. '/colorschemes/colorschemes.css');
	wp_enqueue_script('core-colorschemes-script', CORE_URI. '/colorschemes/colorschemes.js', '', '', true);
}
add_action('admin_enqueue_scripts', 'core_colorschemes_enqueue_scripts');


// Outputs colorschemes
function apply_colorscheme($style, $colors) {
	foreach($colors as $option => $tags) {
		$color = core_options_get($option);
		echo implode(', ', $tags);
		echo ' { ', $style, ': ', $color, '; }';
		echo "\n";
	}
}


?>