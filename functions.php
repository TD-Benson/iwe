<?php
/**
 * Mikmag functions and definitions
 *
 * @package WordPress
 * @subpackage TDFramework
 * @since framework 1.0
 */

?>
<?php

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since framework 1.0
 */

if ( ! isset( $content_width ) )
	$content_width = 1080; /* pixels */


	/*
	 * Load theme constants and defaults
	 */
	require( get_template_directory() . '/tdframework/theme-init.php' );

	/**
	 * Options Panel
	 *
	 */
	require( THEME_PATH . '/tdframework/core/options/options-classes.php');
	require( THEME_PATH . '/tdframework/core/options/options-registry.php');
	require( THEME_PATH . '/tdframework/core/options/options-types.php');
	require( THEME_PATH . '/tdframework/core/options/options-theme.php');
	require( THEME_PATH . '/tdframework/core/options/options-metabox.php');
	require( THEME_PATH . '/tdframework/core/options/options-init.php');

	/**
	 * Layouts
	 *
	 */
	require( THEME_PATH . '/tdframework/core/layout/layout-classes.php');
	require( THEME_PATH . '/tdframework/core/layout/layout-options.php');
	require( THEME_PATH . '/tdframework/core/layout/layout-registry.php');
	require( THEME_PATH . '/tdframework/core/layout/layout-generate.php');
	require( THEME_PATH . '/tdframework/core/layout/layout-init.php');

	/**
	 * Sliders
	 *
	 */
	require( THEME_PATH . '/tdframework/core/slider/slider-registry.php');
	require( THEME_PATH . '/tdframework/core/slider/slider-options.php');
	require( THEME_PATH . '/tdframework/core/slider/slider-init.php');

	/**
	 * Register sliders
	 */
	require( THEME_PATH . '/tdframework/core/slider/slider-nivoslider/slider-nivoslider.php');
	require( THEME_PATH . '/tdframework/core/slider/slider-flexslider/flexslider.php');
	require( THEME_PATH . '/tdframework/core/slider/slider-slideshow/slider-slideshow.php');
	require( THEME_PATH . '/tdframework/core/slider/slider-draggable/slider-draggable.php');
	//require( THEME_PATH . '/tdframework/core/slider/slider-supersized/slider-supersized.php');

	/**
	 * Fonts
	 *
	 */
	require( THEME_PATH . '/tdframework/core/fonts/fonts-list.php');
	require( THEME_PATH . '/tdframework/core/fonts/fonts-init.php');

	/**
	 * Color Schemes
	 *
	 */
	require( THEME_PATH . '/tdframework/core/colorschemes/colorschemes-options.php');
	require( THEME_PATH . '/tdframework/core/colorschemes/colorschemes-init.php');

	// Core functions
	require( THEME_PATH . '/tdframework/core/core-utils.php');

	// Single file modules
	require( THEME_PATH . '/tdframework/core/core-breadcrumbs.php');
	require( THEME_PATH . '/tdframework/core/core-sociables.php');
	require( THEME_PATH . '/tdframework/core/core-ads.php');
	require( THEME_PATH . '/tdframework/core/core-seo.php');
	require( THEME_PATH . '/tdframework/core/demo/core-demo.php');

	/**
	 * Theme Options
	 */
	require( THEME_PATH . '/tdframework/theme-options.php');
	require( THEME_PATH . '/tdframework/theme-post-options.php');
	require( THEME_PATH . '/tdframework/theme-page-options.php');

	/**
	 * Theme widgets
	 */
	require( THEME_PATH . '/tdframework/core/widgets/categories.php');
	require( THEME_PATH . '/tdframework/core/widgets/adwidget.php');
	require( THEME_PATH . '/tdframework/core/widgets/postwidget.php');
	require( THEME_PATH . '/tdframework/core/widgets/tabbedwidget.php');


	require( THEME_PATH . '/tdframework/core/pricetables/pricetable-init.php');

if ( ! function_exists( 'core_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since framework 1.0
 */
function core_theme_setup() {

	/**
	 * Theme Functions
	 */
	require( THEME_PATH . '/tdframework/theme-functions.php' );

	/**
	 * Custom functions and plugin support
	 */
	require( THEME_PATH . '/tdframework/support-extras.php' );

	/**
	 * Customizer additions
	 */
	//require( THEME_PATH . '/tdframework/customization.php' );

	/**
	 * Hooks for this theme
	 */
	require( THEME_PATH . '/tdframework/theme-hooks.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Mikmag, use a find and replace
	 * to change THEME_SLUG to the name of your theme in all the template files
	 */
	load_theme_textdomain( THEME_SLUG, THEME_PATH . '/languages' );

	/**
	 * This theme styles the visual editor with editor-style.css to match the theme style.
	 */
	add_editor_style();

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	// Post thumbnail support

	set_post_thumbnail_size( 300, 275, false );
	add_image_size( 'post-excerpt-small', 650, 350, true);
	add_image_size( 'post-excerpt-full', 1140, 350, true);
	add_image_size( 'tdac-thumb', 90, 90, true);

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus(array(
		'theme_main'	=> __( 'Main menu', THEME_SLUG),
		'theme_footer' 	=> __( 'Footer menu', THEME_SLUG),
		'top_menu' 		=> __( 'Top Menu', THEME_SLUG ),
	));


	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

	// Add WooCommerce Support
    add_theme_support( 'woocommerce' );

}
endif; // core_theme_setup
add_action( 'after_setup_theme', 'core_theme_setup' );

add_action('after_setup_theme', 'theme_options_register');

/**
 * Setup the WordPress core custom header and background.
 * Hooks into the after_setup_theme action.
 */
function core_theme_register_custom_header() {
	add_theme_support( 'custom-header', array(
		'default-image' => '',
	) );
}

function core_theme_register_custom_background() {
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );
}

//add_action( 'after_setup_theme', 'core_theme_register_custom_background' );

/**
 * Enqueue scripts and styles
 */
function core_theme_scripts() {
	global $wp_styles;
	global $wp_scripts;

	wp_enqueue_script('jquery');

	wp_enqueue_style( 'style', get_stylesheet_uri() );

	// PrettyPhoto lightbox
	wp_enqueue_style( 'prettyphoto', THEME_URI. '/js/prettyPhoto/prettyPhoto.css' );
	wp_enqueue_script( 'prettyphoto', THEME_URI. '/js/prettyPhoto/jquery.prettyPhoto.js', array('jquery'), '3.1.5', true );

	//wp_enqueue_script( 'navigation', THEME_URI . '/js/navigation.js', array(), '20130406', true );

	wp_enqueue_script( 'skip-link-focus-fix', THEME_URI . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'responsive-scripts', THEME_URI . '/js/theme-scripts.js', array(), '1.0', true );
	wp_enqueue_script( 'responsive-plugins', THEME_URI . '/js/theme-plugins.js', array(), '1.0', true );

	wp_enqueue_script( 'tool-tip', THEME_URI . '/js/tooltips.js', array(), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', THEME_URI . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

	// Font Awesome
	wp_enqueue_style( 'font-awesome-styles', THEME_URI. '/tdframework/css/font-awesome.min.css' );

	if ( is_ie() ) {
		wp_enqueue_script( 'ie-support', THEME_URI . '/js/theme-plugins-ie.js', array(), '1.0', true );

		wp_enqueue_script( 'html5-shiv', THEME_URI . '/js/html5shiv.js' );
		$wp_scripts->add_data( 'html5-shiv', 'conditional', 'lte IE 9' );

		wp_enqueue_style( 'font-awesome-ie7', THEME_URI. '/tdframework/css/font-awesome-ie7.min.css', array(), '1.0', 'all'  );
		$wp_styles->add_data( 'font-awesome-ie7', 'conditional', 'lte IE 7' );

	}

}


if ( ! is_admin() )
	add_action( 'wp_enqueue_scripts', 'core_theme_scripts' );

/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/tdframework/custom-header.php' );

/**
 * Load Theme defaults
 * @since framework 1.0
 */

/**
 * Register Theme Widgets
 * @since framework 1.0
 */
	function core_theme_register_widgets() {
		if ( ! is_blog_installed() )
			return;

		register_widget('TD_Widget_Categories');
		register_widget('td_adWidget');
		register_widget('td_postWidget');
		register_widget('td_tabbedWidget');

	}
	add_action( 'widgets_init', 'core_theme_register_widgets' );

/*
 * Sets argument constants for Navigation
 */

	$theme_menus['main'] = array(
		'theme_location' => 'theme_main',
		'depth'          => 6,
		'menu_class'     => 'menu',
		'menu_id'        => 'theme-menu-main',
		'container'      => false,
		'fallback_cb'    => 'wp_page_menu'
	);

	$theme_menus['topmenu'] = array(
		'theme_location' => 'top_menu',
		'depth'          => 6,
		'menu_class'     => 'menu',
		'menu_id'        => 'theme-top-menu',
		'container'      => false,
		'fallback_cb'    => ''
	);

	$theme_menus['footer'] = array(
		'theme_location' => 'theme_footer',
		'depth'          => 1,
		'menu_class'     => 'grid menu',
		'menu_id'        => '',
		'container'      => false,
		'fallback_cb'    => ''
	);

/**
 * Register SEO Basic
 */
	core_seo_register_spot( 'meta', __('Meta Title, Description and Keywords', THEME_SLUG) );

/**
 * Register Advertisements Spots
 */
  	core_ads_register_spot( 'content_before', __('Before content', THEME_SLUG) );
  	core_ads_register_spot( 'content_after', __('After content', THEME_SLUG) );

/**
 * Sets default social icons
 */
	core_sociables_register( 'twitter', 'Twitter', 'http://twitter.com/', null, null );
	core_sociables_register( 'facebook', 'Facebook', 'http://facebook.com/', null, null );
	core_sociables_register( 'linkedin', 'LinkedIn', 'http://linkedin.com/', null, null );
	core_sociables_register( 'youtube', 'YouTube', 'http://youtube.com/', null, null );
	core_sociables_register( 'youtube-play', 'Vimeo', 'http://vimeo.com/', null, null );
	core_sociables_register( 'pinterest', 'Pinterest', 'http://pinterest.com/', null, null );
	core_sociables_register( 'flickr', 'Flickr', 'http://flickr.com/', null, null );
	core_sociables_register( 'instagram', 'Instagram', 'http://instagram.com/', null, null );
	core_sociables_register( 'tumblr', 'Tumblr', 'http://tumblr.com/', null, null );
	core_sociables_register( 'google-plus', 'Google+', 'http://plus.google.com/', null, null );
	core_sociables_register( 'rss', 'RSS', HOME_URL, null, null );
	core_sociables_register( 'custom1', 'Custom 1', '', '', '', true );
	core_sociables_register( 'custom2', 'Custom 2', '', '', '', true );
	core_sociables_register( 'custom3', 'Custom 3', '', '', '', true );
	core_sociables_register( 'custom4', 'Custom 4', '', '', '', true );

/**
 *
 * Shortcodes everywhere
 * @since Migmag 2.0
 */
	// shortcodes in Widget areas
	add_filter( 'widget_text', 'shortcode_unautop' );
	add_filter( 'widget_text', 'do_shortcode' );

	// shortcodes in Excerpts
	add_filter( 'the_excerpt', 'shortcode_unautop' );
	add_filter( 'the_excerpt', 'do_shortcode' );

	// shortcodes in Category, Tag, and Taxonomy Descriptions
	add_filter( 'term_description', 'shortcode_unautop' );
	add_filter( 'term_description', 'do_shortcode' );

/**
 * Plugin Support
 */

// PHP Browser Detection
if ( ! core_theme_is_plugin_active( 'php-browser-detection/php-browser-detection.php' ) )
	require_once( THEME_PATH . '/tdframework/browser-detection/php-browser-detection.php' );

// Activate LayerSlider
if ( ! core_theme_is_plugin_active( 'LayerSlider/layerslider.php' ) ) {
	$layerslider = THEME_PATH . '/tdframework/LayerSlider/layerslider.php';

	// Check if the file is available to prevent warnings
	if( file_exists( $layerslider ) ) {

		// Include the file
		include $layerslider;

		// Activate the plugin if necessary
		if( get_option( THEME_SLUG . '_layerslider_activated', '0') == '0' ) {

			// Run activation script
			layerslider_activation_scripts();

			// Save a flag that it is activated, so this won't run again
			update_option( THEME_SLUG . '_layerslider_activated', '1');
		}
	}
}



// SocialBox
function plugin_override_styles() {
    // check if Socialbox is active
	if ( core_theme_is_plugin_active( 'socialbox/socialbox.php' ) ) {
    	wp_dequeue_style('socialbox');
    }
}
add_action( 'wp_print_styles', 'plugin_override_styles', 11 );

// Woocommerce
if ( core_theme_is_plugin_active( 'woocommerce/woocommerce.php' ) )
	require_once THEME_PATH . '/woocommerce/theme-woocommerce.php';
