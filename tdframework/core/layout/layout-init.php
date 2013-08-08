<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Theme Option: Layouts
 *
 * @package WordPress
 * @subpackage TDFramework
 * @since framework 1.0
 */


// Enqueue scripts
//
function core_layout_enqueue_scripts() {
	wp_enqueue_style('core-layout', CORE_URI. '/layout/layout.css');
	wp_enqueue_script('core-layout', CORE_URI. '/layout/layout.js', '', '', true);

	wp_enqueue_script('json2', '', '', '', '', true);
}
add_action('admin_enqueue_scripts', 'core_layout_enqueue_scripts');

// Register options
//
function core_layout_options_register() {
	global $core_layout_default_sidebars;
	global $core_layout_default;
	global $core_layout_footer_default;
	global $core_theme_options_handler;

	// Theme layout options
	$options = new CoreOptionGroup('layouts', __('Layouts', THEME_SLUG), __('Use this page to define the layouts of special pages.', THEME_SLUG), CORE_URI. '/layout/images/icon-layouts.png');
	$core_theme_options_handler->group_add($options);

	/**
	 * added a default layout
	 * @since Mikmag 2.0
	 */
	$section = new CoreOptionSection('layout-default', __('Default page', THEME_SLUG) );
	$options->section_add($section);
	$section->option_add(new CoreOption('layout-default', null, 'layout', null, $core_layout_default));

	// Slider
	$section->option_add(new CoreOption('slider_layout-default', __('Slider', THEME_SLUG), 'sliders', __('The slider will be displayed at the top of this page.', THEME_SLUG)));

	$section->option_add(new CoreOption('layout-default_background', __('Background', THEME_SLUG), 'image'));
	$section->option_add(new CoreOption('layout-default_background_author', __('Image Author', THEME_SLUG), 'text', __('The author of the background image.', THEME_SLUG)));
	$section->option_add(new CoreOption('layout-default_background_link', __('Author Link', THEME_SLUG), 'text', __('The author link of the background image.', THEME_SLUG)));

	$section->option_add(new CoreOption('layout-default_colorscheme', __('Color scheme', THEME_SLUG), 'colorschemes-list'));

	// Custom Category Content section
	$section->option_add(new CoreOption('custom_content_layout-default' , __('HTML section', THEME_SLUG), 'text-multiline', __('Any HTML put here will be included in it\'s own block above the content.', THEME_SLUG)));

	$layouts = array(

		//'layout-single' => __('Single page', THEME_SLUG),
		'layout-home' => __('Home page', THEME_SLUG),
		'layout-search' => __('Search page', THEME_SLUG),
		'layout-archive' => __('Archive page', THEME_SLUG),
		'layout-404' => __('404 page', THEME_SLUG),
		'layout-author' => __('Author page', THEME_SLUG),
		'layout-tag' => __('Tag page', THEME_SLUG),
	);
	foreach ($layouts as $key => $value) {
		$section = new CoreOptionSection($key, $value);
		$options->section_add($section);
		$section->option_add(new CoreOption($key, null, 'layout', null, $core_layout_default));

		/**
		 * added sliders, backkground, custom content,
		 * @since Mikmag 2.0
		 */

		// Slider
		$section->option_add(new CoreOption('slider_'.$key, __('Slider', THEME_SLUG), 'sliders', __('The slider will be displayed at the top of this page.', THEME_SLUG)));

		$section->option_add(new CoreOption($key.'_background', __('Background', THEME_SLUG), 'image'));
		$section->option_add(new CoreOption($key.'_background_author', __('Image Author', THEME_SLUG), 'text', __('The author of the background image.', THEME_SLUG)));
		$section->option_add(new CoreOption($key.'_background_link', __('Author Link', THEME_SLUG), 'text', __('The author link of the background image.', THEME_SLUG)));

		$section->option_add(new CoreOption($key.'_colorscheme', __('Color scheme', THEME_SLUG), 'colorschemes-list'));

		// Custom Category Content section
		$section->option_add(new CoreOption('custom_content_' .$key , __('HTML section', THEME_SLUG), 'text-multiline', __('Any HTML put here will be included in it\'s own block above the content.', THEME_SLUG)));

	}

	// Post layout options
	$layout_options = new CoreOptionHandler(THEME_SLUG . '-layout', THEME_NAME . ' layout', array('post', 'page'));
	core_options_handler_register($layout_options);

	$options = new CoreOptionGroup('layout', __('Layout', THEME_SLUG));
	$layout_options->group_add($options);

	$section = new CoreOptionSection('layout');
	$options->section_add($section);
	$section->option_add(new CoreOption('layout', '', 'layout', __('Use this option to change the layout of the current page. Sidebars are ordered from left to right.', THEME_SLUG), null));

	// Sidebar options
	$options = new CoreOptionGroup('sidebars', __('Widgets', THEME_SLUG), __('By adding widgets here, you can assign and use them in your page layouts.', THEME_SLUG), CORE_URI. '/layout/images/icon-sidebars.png');
	$core_theme_options_handler->group_add($options);

	$section = new CoreOptionSection('sidebars');
	$options->section_add($section);
	$section->option_add(new CoreOption('sidebars', '', 'sidebars', null, $core_layout_default_sidebars));
}
add_action('after_setup_theme', 'core_layout_options_register');

// Register sidebars
//
function core_layout_sidebars_register() {
	global $core_sidebars;

	$core_sidebars = core_options_get('sidebars');

	foreach ($core_sidebars as $sidebar_slug => $sidebar_title) {
		register_sidebar(array(	'name' => THEME_NAME. ': ' .$sidebar_title,
								'id' => $sidebar_slug,
								'before_widget' => '<aside id="%1$s" class="widget %2$s">',
								'after_widget' => '</aside>',
								'before_title' => '<h3 class="widget-title">',
								'after_title' => '<i class="icon- "></i></h3>'));
	}
}
add_action('after_setup_theme', 'core_layout_sidebars_register');

// Layout types
//
$layout = new CoreLayout('full', THEME_URI. '/images/layouts/layout-full.png');
$layout->element_add(new CoreLayoutElement('template', '<div class="grid box-twelve full"><div class="theme-content">', '</div></div>'));
core_layout_type_register($layout);

$layout = new CoreLayout('left-single', THEME_URI. '/images/layouts/layout-left-single.png');
$layout->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-two left"><div class="theme-sidebar">', '</div></div>'));
$layout->element_add(new CoreLayoutElement('template', '<div class="grid box-ten fit left-single"><div class="theme-content">', '</div></div>'));
core_layout_type_register($layout);

$layout = new CoreLayout('left-dual', THEME_URI. '/images/layouts/layout-left-dual.png');
$layout->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-two left"><div class="theme-sidebar">', '</div></div>'));
$layout->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-two middle"><div class="theme-sidebar">', '</div></div>'));
$layout->element_add(new CoreLayoutElement('template', '<div class="grid box-eight fit left-dual"><div class="theme-content">', '</div></div>'));
core_layout_type_register($layout);

$layout = new CoreLayout('right-single', THEME_URI. '/images/layouts/layout-right-single.png');
$layout->element_add(new CoreLayoutElement('template', '<div class="grid box-ten right-single"><div class="theme-content">', '</div></div>'));
$layout->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-two fit right"><div class="theme-sidebar">', '</div></div>'));
core_layout_type_register($layout);

$layout = new CoreLayout('right-dual', THEME_URI. '/images/layouts/layout-right-dual.png');
$layout->element_add(new CoreLayoutElement('template', '<div class="grid box-eight right-dual"><div class="theme-content">', '</div></div>'));
$layout->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-two middle"><div class="theme-sidebar">', '</div></div>'));
$layout->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-two fit right"><div class="theme-sidebar">', '</div></div>'));
core_layout_type_register($layout);

$layout = new CoreLayout('both', THEME_URI. '/images/layouts/layout-both.png');
$layout->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-two left"><div class="theme-sidebar">', '</div></div>'));
$layout->element_add(new CoreLayoutElement('template', '<div class="grid box-eight both"><div class="theme-content">', '</div></div>'));
$layout->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-two fit right"><div class="theme-sidebar">', '</div></div>'));
core_layout_type_register($layout);

$layout = new CoreLayout('left-wide', THEME_URI. '/images/layouts/layout-left-wide.png');
$layout->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-three left"><div class="theme-sidebar">', '</div></div>'));
$layout->element_add(new CoreLayoutElement('template', '<div class="grid box-nine fit left-wide"><div class="theme-content">', '</div></div>'));
core_layout_type_register($layout);

$layout = new CoreLayout('right-wide', THEME_URI. '/images/layouts/layout-right-wide.png');
$layout->element_add(new CoreLayoutElement('template', '<div class="grid box-nine right-wide"><div class="theme-content">', '</div></div>'));
$layout->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-three fit right"><div class="theme-sidebar">', '</div></div>'));
core_layout_type_register($layout);

//$layout = new CoreLayout('wide-dual', THEME_URI. '/images/layouts/layout-wide-dual.png');
//$layout->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-three left"><div class="theme-sidebar">', '</div></div>'));
//$layout->element_add(new CoreLayoutElement('template', '<div class="grid box-six wide-dual"><div class="theme-content">', '</div></div>'));
//$layout->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-three fit right"><div class="theme-sidebar">', '</div></div>'));
//core_layout_type_register($layout);

// Footer types
//
$footer = new CoreLayout('none', THEME_URI. '/images/layouts/footer-none.png');
core_layout_footer_type_register($footer);

$footer = new CoreLayout('one', THEME_URI. '/images/layouts/footer-one.png');
//$footer->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-twelve fit"><div class="footer-sidebar">', '</div></div>'));
$footer->element_add(new CoreLayoutElement('sidebar', '', ''));
core_layout_footer_type_register($footer);

$footer = new CoreLayout('two', THEME_URI. '/images/layouts/footer-two.png');
//$footer->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-six"><div class="footer-sidebar">', '</div></div>'));
//$footer->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-six fit"><div class="footer-sidebar">', '</div></div>'));
$footer->element_add(new CoreLayoutElement('sidebar', '', ''));
$footer->element_add(new CoreLayoutElement('sidebar', '', ''));
core_layout_footer_type_register($footer);

$footer = new CoreLayout('three', THEME_URI. '/images/layouts/footer-three.png');
//$footer->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-four"><div class="footer-sidebar">', '</div></div>'));
//$footer->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-four"><div class="footer-sidebar">', '</div></div>'));
//$footer->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-four fit"><div class="footer-sidebar">', '</div></div>'));
$footer->element_add(new CoreLayoutElement('sidebar', '', ''));
$footer->element_add(new CoreLayoutElement('sidebar', '', ''));
$footer->element_add(new CoreLayoutElement('sidebar', '', ''));
core_layout_footer_type_register($footer);

$footer = new CoreLayout('four', THEME_URI. '/images/layouts/footer-four.png');
//$footer->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-three"><div class="footer-sidebar">', '</div></div>'));
//$footer->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-three"><div class="footer-sidebar">', '</div></div>'));
//$footer->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-three"><div class="footer-sidebar">', '</div></div>'));
//$footer->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-three fit"><div class="footer-sidebar">', '</div></div>'));
$footer->element_add(new CoreLayoutElement('sidebar', '', ''));
$footer->element_add(new CoreLayoutElement('sidebar', '', ''));
$footer->element_add(new CoreLayoutElement('sidebar', '', ''));
$footer->element_add(new CoreLayoutElement('sidebar', '', ''));
core_layout_footer_type_register($footer);

$footer = new CoreLayout('six', THEME_URI. '/images/layouts/footer-six.png');
//$footer->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-two"><div class="footer-sidebar">', '</div></div>'));
//$footer->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-two"><div class="footer-sidebar">', '</div></div>'));
//$footer->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-two"><div class="footer-sidebar">', '</div></div>'));
//$footer->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-two"><div class="footer-sidebar">', '</div></div>'));
//$footer->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-two"><div class="footer-sidebar">', '</div></div>'));
//$footer->element_add(new CoreLayoutElement('sidebar', '<div class="grid box-two fit"><div class="footer-sidebar">', '</div></div>'));
$footer->element_add(new CoreLayoutElement('sidebar', '', ''));
$footer->element_add(new CoreLayoutElement('sidebar', '', ''));
$footer->element_add(new CoreLayoutElement('sidebar', '', ''));
$footer->element_add(new CoreLayoutElement('sidebar', '', ''));
$footer->element_add(new CoreLayoutElement('sidebar', '', ''));
$footer->element_add(new CoreLayoutElement('sidebar', '', ''));
core_layout_footer_type_register($footer);

// Default sidebar configuration
//
core_layout_set_default_sidebars(array(
	//'none' => __('None', THEME_SLUG),
	'default-left' => __('Default Left', THEME_SLUG),
	'default-right' => __('Default Right', THEME_SLUG),
	'footer-1' => __('Widget 1', THEME_SLUG),
	'footer-2' => __('Widget 2', THEME_SLUG),
	'footer-3' => __('Widget 3', THEME_SLUG),
	'footer-4' => __('Widget 4', THEME_SLUG),
	'footer-5' => __('Widget 5', THEME_SLUG),
	'footer-6' => __('Widget 6', THEME_SLUG)
));

// Default layout configuration
//
core_layout_set_default(array(
	'layout' => 'full',
	'layout-sidebars' => array('default-left', 'default-right'),
	'footer' => 'two',
	'footer-sidebars' => array('footer-1', 'footer-2', 'footer-3', 'footer-4')
));


?>