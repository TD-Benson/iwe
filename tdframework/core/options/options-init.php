<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Theme Option: Options Panel
 *
 * @package WordPress
 * @subpackage TDFramework
 * @since framework 1.0
 */


// Option handler for theme options
$core_theme_options_handler = array();


// Enqueue scripts
//
function core_options_enqueue_scripts() {
	global $core_menu_pages;

	$screen = get_current_screen();

	// Post editing options only
	if ($screen->base == 'post') {
		wp_enqueue_style('core-options-post', CORE_URI. '/options/css/core-options-post.css');

	// Theme options only
	} else if ($screen->base == 'appearance_page_' .THEME_SLUG . '-options') {
		wp_enqueue_style('core-options-theme', CORE_URI. '/options/css/core-options-theme.css');

		// Font Awesome
		wp_enqueue_style('font-awesome', THEME_URI. '/tdframework/css/font-awesome.min.css');

	}

	// Common
	wp_enqueue_script('core-options', CORE_URI. '/options/options.js', '', '', true);

	//if( function_exists( 'wp_enqueue_media' ) ) {
		/**
		 * Media Uploader
		 * @since WP 3.5
		 * @since Mikmag 2.0
		 */
		wp_enqueue_media();
	//} else {
		/**
		 * Thickbox support
		 * completely dropped
		 * @since Mikmag 2.0
		 */
	//	wp_enqueue_script('thickbox', '', '', '', true);
	//	wp_enqueue_script('media-upload');
	//	wp_enqueue_style('thickbox');
	//}

	// Color picker
	wp_enqueue_style('core-colorpicker');
	wp_enqueue_script('core-colorpicker', '', '', true);
}
add_action('admin_enqueue_scripts', 'core_options_enqueue_scripts');

// Admin menu initialisation
// Adds theme option page
//
function core_options_menu_init() {
	add_theme_page(THEME_NAME, THEME_NAME, 'edit_theme_options', THEME_SLUG . '-options', 'core_options_theme_output');
}
add_action('admin_menu', 'core_options_menu_init');

// Initialise options module
//
function core_options_init() {
	global $core_theme_options_handler;

	// Register standard option types
	core_options_register_types();

	// Create the default theme options handler
	$core_theme_options_handler = new CoreOptionHandler('theme');
}
core_options_init();

?>