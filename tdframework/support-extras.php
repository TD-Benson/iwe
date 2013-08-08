<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package WordPress
 * @subpackage TDFramework
 * @since framework 1.0
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since framework 1.0
 */
function core_theme_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'core_theme_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since framework 1.0
 */
function core_theme_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'core_theme_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since framework 1.0
 */
function core_theme_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'core_theme_enhanced_image_navigation', 10, 2 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @since Mikmag 1.1
 */
function core_theme_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', THEME_SLUG ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'core_theme_wp_title', 10, 2 );

/**
 * Will not be installed is WP version is lower than 3.5
 *
 * @since framework 1.0
 */

function core_theme_switch_theme( $theme_name, $theme ) {
	global $wp_version;
	if ( version_compare( $wp_version, '3.5', '<=' ) ) {
		switch_theme( WP_DEFAULT_THEME );
		unset( $_GET['activated'] );
		add_action( 'admin_notices', 'core_theme_upgrade_notice' );
	}

}
add_action( 'after_switch_theme', 'core_theme_switch_theme', 10, 2 );

function core_theme_upgrade_notice() {
	$message = sprintf( __( '<strong>%s</strong> requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', THEME_SLUG ), THEME_NAME,  $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Core Theme Hooks and Actions
 *
 * @since framework 1.0
 */

function core_options_theme_info(){
	echo "<div class=\"core-theme-wrap\">\n";
	echo "<p><i class=\"icon-info-sign\"></i> Version: <strong>" . CORE_VERSION . "</strong><br><br><i class=\"icon-pushpin\"></i> <a target=\"_blank\" href=\"http://themeforest.net/user/themedutch\" title=\"". __('ThemeForest Profile', THEME_SLUG). " \"><strong>". __('ThemeForest Profile', THEME_SLUG ) . "</strong></a><br><i class=\"icon-question-sign\"></i> <a target=\"_blank\" href=\"http://theme-dutch.com/support/\" title=\"" . __('Support Forum', THEME_SLUG). "\"><strong>" .__('Support Forum', THEME_SLUG)." </strong></a><br><i class=\"icon-home\"></i> <a target=\"_blank\" href=\"http://www.theme-dutch.com/\" title=\"". __('Website', THEME_SLUG). "\"><strong>". __('Website', THEME_SLUG ). "</strong></a></p>\n";

	echo "</div>\n";
}
//add_action('core_options_sidebar', 'core_options_theme_info');

function core_theme_get_column($column_count = 3){
	$column = 'grid box-three';
	switch ($column_count) {
	    case 1:
	        $column = 'grid box-twelve';
	        break;
	    case 2:
	        $column = 'grid box-six';
	        break;
	    case 3:
	        $column = 'grid box-four';
	        break;
	    case 4:
	        $column = 'grid box-three';
	        break;
	    case 6:
	        $column = 'grid box-two';
	        break;
	    case 12:
	        $column = 'grid box-one';
	        break;
	    default:
	    	$column = '';
	}
	return $column;
}


function core_theme_get_post_format(){
	$icon = "icon-copy";
	switch(get_post_format()) {
		case "aside":  	$icon = "icon-reorder";
						break;
		case "audio":  	$icon = "icon-music";
						break;
		case "chat":  	$icon = "icon-comments-alt";
						break;
		case "gallery": $icon = "icon-th-large";
						break;
		case "image":  	$icon = "icon-picture";
						break;
		case "link":  	$icon = "icon-link";
						break;
		case "quote":  	$icon = "icon-quote-right";
						break;
		case "status":  $icon = "icon-lightbulb";
						break;
		case "video":  	$icon = "icon-facetime-video";
						break;
	}
	return $icon;
}

/********************************************************************
 * Plugin Support
 *******************************************************************/

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function core_theme_infinite_scroll_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'core_theme_infinite_scroll_setup' );

/**
 * bbPress plugin filters
 * Change bbPress separator
 */
	 function theme_bbp_styles(){
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		// check if BBPress is active
		if ( is_plugin_active('bbpress/bbpress.php')) {
			wp_enqueue_style('style-bbp', THEME_URI. '/bbpress/style-bbp.css');
		}
	 }
	 //add_action( 'wp_enqueue_scripts', 'theme_bbp_styles' );

	function theme_bbp_breadcrumb_sep( $args ) {
		$args['sep'] = ' \ ';
		return $args;
	}
	//add_filter( 'bbp_before_get_breadcrumb_parse_args', 'theme_bbp_breadcrumb_sep' );

	// Change bbPress before container
	function theme_bbp_breadcrumb_before( $args ) {
		$args['before'] = '<div class="theme-breadcrumbs breadcrumb-list"><i class="icon-home"></i> ';
		return $args;
	}
	//add_filter( 'bbp_before_get_breadcrumb_parse_args', 'theme_bbp_breadcrumb_before' );

	// Change bbPress before container
	function theme_bbp_breadcrumb_after( $args ) {
		$args['after'] = '</div>';
		return $args;
	}
	//add_filter( 'bbp_before_get_breadcrumb_parse_args', 'theme_bbp_breadcrumb_after' );

/**
 * Woocommerce
 *
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}