<?php

if (!defined('CORE_VERSION'))
	die();


// Available advertisement spots on a given page
//
$core_ad_spots = array();


// Registers a new ad spot
//
function core_ads_register_spot($spot_slug, $spot_title) {
	global $core_ad_spots;

	$core_ad_spots[$spot_slug] = $spot_title;
}

// Adds ad post options
//
function core_ads_options() {
	global $core_ad_spots;

	$ad_options = new CoreOptionHandler(THEME_SLUG . '-ads', THEME_NAME . ' ads', array('post', 'page'));
	core_options_handler_register($ad_options);

	$options = new CoreOptionGroup('ads', 'Ads');
	$ad_options->group_add($options);

	// Add settings for each ad spot
	foreach ($core_ad_spots as $spot_slug => $spot_title) {
		$section = new CoreOptionSection($spot_slug, $spot_title);
		$options->section_add($section);
		$section->option_add(new CoreOption('ad_' . $spot_slug . '_show', __('Show this advertisement', THEME_SLUG), 'checkbox', null, false));

		$option = new CoreOption('ad_' . $spot_slug . '_type', __('Type', THEME_SLUG), 'select', '', 'image');
		$option->parameters = array('image' => __('Image', THEME_SLUG), 'code' => __('Code', THEME_SLUG));
		$section->option_add($option);

		$option = new CoreOption('ad_' . $spot_slug . '_alignment', __('Alignment', THEME_SLUG), 'select', '', 'default');
		$option->parameters = array('default' => __('Default', THEME_SLUG), 'left' => __('Left', THEME_SLUG), 'right' => __('Right', THEME_SLUG), 'center' => __('Center', THEME_SLUG));
		$section->option_add($option);

		$section->option_add(new CoreOption('ad_' . $spot_slug . '_image', __('Image', THEME_SLUG), 'image', __('The image displayed for image type ads.', THEME_SLUG)));
		$section->option_add(new CoreOption('ad_' . $spot_slug . '_link', __('Link', THEME_SLUG), 'text'));
		$section->option_add(new CoreOption('ad_' . $spot_slug . '_link_alt', __('ALT text', THEME_SLUG), 'text'));
		$section->option_add(new CoreOption('ad_' . $spot_slug . '_code', __('Code', THEME_SLUG), 'text-multiline', __('The code used for code type ads.', THEME_SLUG)));
		$section->option_add(new CoreOption('ad_' . $spot_slug . '_notes', __('Notes', THEME_SLUG), 'text-multiline'));
	}
}
add_action('after_setup_theme', 'core_ads_options');

// Returns ad HTML for a given spot
// Returns an empty string if the ad is not enabled
//
function core_ads_get($spot) {
	global $post;
	global $core_ad_spots;

	if (!is_singular())
		return '';

	// Check if registered
	if (!isset($core_ad_spots[$spot])) {
		core_warning(sprintf(__('Ad spot %s does not exist.', THEME_SLUG), $spot));
		return '';
	}

	// Check if active or not
	$show = core_options_get('ad_' . $spot . '_show', $post->post_type);
	if (!$show)
		return null;

	// Generic options
	$alignment = core_options_get('ad_' . $spot . '_alignment', $post->post_type);
	$type = core_options_get('ad_' . $spot . '_type', $post->post_type);

	// Alignment style
	if ($alignment != 'default')
		$style = ' style="text-align: ' . $alignment . ';"';

	// Container element
	$output = '<div class="theme-ad ' . $spot . '"' . $style . '>';

	// Add plain code type elements
	if ($type == 'code') {
		$code = core_options_get('ad_' . $spot . '_code', $post->post_type);

		$output .= $code;

	// Add image link type elements
	} else {
		$image = core_options_get('ad_' . $spot . '_image', $post->post_type);
		$link = core_options_get('ad_' . $spot . '_link', $post->post_type);
		$link_alt = core_options_get('ad_' . $spot . '_link_alt', $post->post_type);

		$output .= '<a href="' . $link . '"><img src="' . $image . '" alt="' . $link_alt . '"></a>';
	}

	return $output . '</div>';
}

?>