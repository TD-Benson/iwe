<?php
/**
 * Sidebar
 *
 * @package WordPress
 * @subpackage TDFramework
 * @since framework 1.0
 */

global $core_sidebars;

$sidebar_slug = core_layout_current_sidebar();

if (!$sidebar_slug)
	return;

do_action('core_theme_before_sidebar');

if (!dynamic_sidebar($sidebar_slug))
	//core_warning( __('Sidebar with name', THEME_SLUG) .' "' .$core_sidebars[$sidebar_slug]. '" '. __('not found, or has no widgets assigned to it.', THEME_SLUG));

do_action('core_theme_after_sidebar');

?>