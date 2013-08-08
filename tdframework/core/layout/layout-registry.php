<?php

if (!defined('CORE_VERSION'))
	die();


// Default sidebar configuration
// Key = slug, value = title
$core_layout_default_sidebars = null;

// Default layout configuration
// layout = layout type slug
// layout-sidebars = indexed array of sidebar slugs
// footer = footer type slug
// footer-sidebars = indexed array of sidebar slugs
$core_layout_default = null;

// Registered sidebars
// Key = slug, value = title
$core_sidebars = null;

// Layout types
$core_layout_types = array();
$core_layout_footer_types = array();


// Registers a new layout type
//
function core_layout_type_register($layout) {
	global $core_layout_types;

	$core_layout_types[$layout->slug] = $layout;
}

// Registers a new footer type
//
function core_layout_footer_type_register($footer) {
	global $core_layout_footer_types;

	$core_layout_footer_types[$footer->slug] = $footer;
}

// Sets the default sidebar configuration
//
function core_layout_set_default_sidebars($default) {
	global $core_layout_default_sidebars;

	$core_layout_default_sidebars = $default;
}

// Sets the default layout configuration
//
function core_layout_set_default($default) {
	global $core_layout_default;

	$core_layout_default = $default;
}

// Sets the defaults from default page layouts
//
function core_layout_set_defaults($default) {
	global $core_layout_defaults;

	$core_layout_defaults = $default;
}

// Sets the default footer configuration
//
function core_layout_set_footer_default($default) {
	global $core_layout_footer_default;

	$core_layout_footer_default = $default;
}

?>