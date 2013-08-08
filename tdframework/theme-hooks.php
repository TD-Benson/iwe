<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Theme Hooks
 *
 * @package WordPress
 * @subpackage TDFramework
 * @since framework 1.0
 */

?>
<?php

/**
 * Just after opening <body> tag
 *
 * @see header.php
 */
function core_theme_hook_before_container() {
    do_action('core_theme_hook_before_container');
}

/**
 * Just after opening <div id="container">
 *
 * @see header.php
 */
function core_theme_hook_before_header() {
    do_action('core_theme_hook_before_header');
}

/**
 * Just after opening <div id="header">
 *
 * @see header.php
 */
function core_theme_hook_in_header() {
    do_action('core_theme_hook_in_header');
}

/**
 * Just before opening <div id="wrapper">
 *
 * @see header.php
 */
function core_theme_hook_before_wrapper() {
    do_action('core_theme_hook_before_wrapper');
}

/**
 * Just before the content area
 *
 * @see header.php
 */
function core_theme_hook_before_content() {
    do_action('core_theme_hook_before_content');
}

/**
 * Just after the content area
 *
 * @see footer.php
 */
function core_theme_hook_after_content() {
    do_action('core_theme_hook_after_content');
}

/**
 * Just before opening <div id="widgets">
 *
 * @see sidebar.php
 */
function core_theme_hook_widgets() {
    do_action('core_theme_hook_widgets');
}

/**
 * Just after closing </div><!-- end of #widgets -->
 *
 * @see sidebar.php
 */
function core_theme_hook_after_widgets() {
    do_action('core_theme_hook_after_widgets');
}

/**
 * Just after closing </div><!-- end of #wrapper -->
 *
 * @see footer.php
 */
function core_theme_hook_after_wrapper() {
    do_action('core_theme_hook_after_wrapper');
}

/**
 * Just after closing </div><!-- end of #container -->
 *
 * @see footer.php
 */
function core_theme_hook_after_container() {
    do_action('core_theme_hook_after_container');
}

/**
 * Just before opening <div id="footer">
 *
 * @see footer.php
 */
function core_theme_hook_before_footer() {
    do_action('core_theme_hook_before_footer');
}

/**
 * Just after opening footer wrapper
 *
 * @see footer.php
 */
function core_theme_hook_footer_content() {
    do_action('core_theme_hook_footer_content');
}

/**
 * Just after closing </div><!-- end of #footer -->
 *
 * @see footer.php
 */
function core_theme_hook_footer_after() {
    do_action('core_theme_hook_footer_after');
}

/**
 *  Displaying the content area
 *
 * @see index.php
 */
function get_core_theme_content(){
	do_action('core_content');
}

/**
 *  Post Content: entry header
 *
 * @see content-xxx.php
 */
function core_theme_hook_entry_header(){
	do_action('core_theme_hook_entry_header');
}

/**
 *  Post Content: entry content
 *
 * @see content-xxx.php
 */
function core_theme_hook_entry_content(){
	do_action('core_theme_hook_entry_content');
}

/**
 *  Post Content: entry footer meta
 *
 * @see content-xxx.php
 */
function core_theme_hook_entry_footer_menu(){
	do_action('core_theme_hook_entry_footer_menu');
}

/**
 *  Displaying the theme styles
 *
 * @see theme-styles.php
 */
function core_theme_hook_styles(){
	do_action('core_theme_hook_styles');
}

/**
 *  Adding custom container class
 *
 * @see header.php
 */
function container_class(){
	do_action('container_class');
}


/**
 * WooCommerce
 *
 * Unhook/Hook the WooCommerce Wrappers
 */
//remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
//remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

//add_action('woocommerce_before_main_content', 'core_theme_woocommerce_wrapper', 10);
//add_action('woocommerce_after_main_content', 'core_theme_woocommerce_wrapper_end', 10);

function core_theme_woocommerce_wrapper() {
  echo '<div id="content-woocommerce"';
}

function core_theme_woocommerce_wrapper_end() {
  echo '</div><!-- end of #content-woocommerce -->';
}

?>