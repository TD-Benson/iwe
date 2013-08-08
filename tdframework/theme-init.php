<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Theme init
 *
 * @package WordPress
 * @subpackage TDFramework
 * @since framework 1.0
 */

?>
<?php

// Theme constants
$theme_data = wp_get_theme();
define('THEME_PATH', get_theme_root() . '/' . get_template());
define('THEME_URI', get_template_directory_uri());
define('THEME_NAME', $theme_data['Name']);
define('THEME_SLUG', strtolower(str_replace(' ', '-', THEME_NAME)));

// Home URL
define('HOME_URL', home_url('/'));

// CSS constants
define('CSS_URI', get_stylesheet_directory_uri(). '/css');
define('CSS_PATH', get_stylesheet_directory(). '/css');

// Core constants
define('CORE_VERSION', '1.0');
define('CORE_PATH', THEME_PATH . '/tdframework/core');
define('CORE_URI', THEME_URI . '/tdframework/core');

// theme icon
define('THEME_ICON', get_template_directory(). 'images/icon-theme.png');



?>