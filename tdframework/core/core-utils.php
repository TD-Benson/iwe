<?php

if (!defined('CORE_VERSION'))
	die();


// Converts an array's key value pairs to a list of CSS-style properties
//
function core_implode_properties($array) {
	$string = array();
	foreach ($array as $key => $val) {
		$string[] = "{$key}: {$val}";
	}

	return implode('; ', $string);
}

// Outputs a core warning\error message
//
function core_warning($message) {
	echo core_get_warning($message);
}
function core_get_warning($message) {
	return '<div class="core-warning"><i class="icon-warning-sign"></i> WARNING: ' .$message. '</div>';
}

// Outputs a core error and aborts all execution
//
function core_error($message) {
	echo '<div class="core-error">ERROR: ' .$message. '</div>';
	die();
}

// Returns the full requested page URI
//
function core_request_uri() {
	if (isset($_SERVER['HTTPS']))
		$request_uri = 'https://';
	else
		$request_uri = 'http://';

	$request_uri .= $_SERVER['HTTP_HOST'];

	if ($_SERVER["SERVER_PORT"] != '80')
		$request_uri .= ':' .$_SERVER['SERVER_PORT'];

	return $request_uri . $_SERVER['REQUEST_URI'];
}

// http://www.maverick.it/en/tech/create-thumbnails-using-wordpress-built-in-functions
function core_generate_thumbnail($img_url, $width=0, $height=0, $crop=null) {
	if ($width == 0)
		$width = get_option('thumbnail_size_w');
	if ($height == 0)
		$height = get_option('thumbnail_size_h');
	if ($crop == null)
		$crop = get_option('thumbnail_crop');

    $img = substr($img_url, strpos($img_url, 'wp-content'));
	//$thumb = image_resize($img, $width, $height, $crop);
	$thumb = wp_get_image_editor($img);
	if ( ! is_wp_error( $thumb ) ) {
	    $thumb->resize( $width, $height, $crop );
	    $thumb->save();
	}
    return (is_string($thumb)) ? site_url() . '/' .  $thumb : $img_url;
}

// Returns a reasonably unique identifier
//
function core_get_uuid($prefix='') {
	return uniqid($prefix);
}

// Returns true if the current request is an Ajax request
//
function core_is_ajax() {
	return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
}

// Returns a valid CSS unit
// Converts purely numeric values into px values
//
function core_css_unit($value) {
	if (is_numeric($value))
		return $value . 'px';
	else
		return $value;
}

// Returns a list of files inside a directory
//
function core_get_directory_list($directory) {
	$list = array();
	$handle = opendir($directory);

	while ($file = readdir($handle)) {
		if ($file != '.' && $file != '..')
			array_push($list, $file);
	}

	closedir($handle);

	return $list;
}

/**
 * Convert a hexadecimal color code to its RGB equivalent
 * http://www.php.net/manual/en/function.hexdec.php#99478
 *
 * @param string $hexStr (hexadecimal color value)
 * @param boolean $returnAsString (if set true, returns the value separated by the separator character. Otherwise returns associative array)
 * @param string $seperator (to separate RGB values. Applicable only if second parameter is true.)
 * @return array or string (depending on second parameter. Returns False if invalid hex color value)
 */
function core_hex2rgb($hexStr, $returnAsString = false, $seperator = ',') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}

function core_color2rgba($colors) {
	return 'rgba(' .$colors['red']. ', ' .$colors['green']. ', ' .$colors['blue']. ', ' .$colors['alpha']. ')';
}

$alignment = array('left', 'right', 'center');
function core_element_align($align = 'left'){
	//if(in_array($align, $alignment, true))
		$align = $align.' --';
	return $align;
}

// Outputs font family CSS
function apply_fonts($fonts) {
	global $theme_load_fonts;

	foreach($fonts as $option => $tags) {
		$font = core_options_get($option);
		echo implode(', ', $tags);
		echo ' { font-family: "', $font, '"; }';
		echo "\n";

		array_push($theme_load_fonts, $font);
	}
}

// Outputs font size CSS
function apply_font_sizes($sizes) {


	foreach($sizes as $option => $tags) {
		$size = intval(core_options_get($option));
		echo implode(', ', $tags);
		echo ' { font-size: ', ($size / BASE_FONT_SIZE), 'em; }';
		//echo ' { font-size: ', ($size), 'px; }';
		echo "\n";
	}
}

// Outputs color CSS
function apply_colors($style, $colors) {
	foreach($colors as $option => $tags) {
		$color = core_options_get($option);
		echo implode(', ', $tags);
		echo ' { ', $style, ': ', $color, '; }';
		echo "\n";
	}
}

// Print custom scripts
//
function core_print_scripts() {
	?>
	<script type="text/javascript">
		window.templateDir = "<?php echo get_template_directory_uri(); ?>";
		window.coreDir = "<?php echo CORE_URI; ?>";
	</script>
	<?php
}
add_action('wp_head', 'core_print_scripts');
add_action('admin_head', 'core_print_scripts');

// Register common styles and scripts
//
function core_enqueue_scripts() {
	wp_enqueue_script('core-colorpicker', CORE_URI . '/includes/colorpicker/colorpicker.js', '', '', true);
	wp_enqueue_style('core-colorpicker', CORE_URI . '/includes/colorpicker/colorpicker.css');
}
add_action('admin_enqueue_scripts', 'core_enqueue_scripts');

// Theme customize option
//
function theme_menus() {
	if (function_exists('_wp_customize_include'))
		add_theme_page(sprintf(__('Customize %s', THEME_SLUG), THEME_NAME), sprintf(__('Customize %s', THEME_SLUG), THEME_NAME), 'edit_theme_options', 'customize.php', '', '', 6);
}
//add_action('admin_menu', 'theme_menus');

// Replaces admin panel login logo with theme logo
//
function theme_login_logo() {
	$login_logo = core_options_get('login_logo');
	if ($login_logo != ''){
		echo '<style type="text/css">';
		echo 'h1 a { background-image: url(' .$login_logo. ') !important; background-size: auto !important; height: 100px !important; }';
		echo '</style>';
	}
}
add_action('login_head', 'theme_login_logo');

// Removes container from wp_nav_menu's menu output
// wp_nav_menu always outputs a div container otherwise, despite the arguments passed to it
//
function theme_fix_menus($args = '') {
	$args['container'] = false;
	return $args;
}
add_filter('wp_nav_menu_args', 'theme_fix_menus');

// Automatically adds prettyPhoto rel attributes to embedded images
//
function theme_content_lightbox($content) {
	$pattern = '/<a(.*?)href="(.*?).(bmp|gif|jpeg|jpg|png)"(.*?)>/i';
  	$replacement = '<a$1href="$2.$3" data-gal="prettyPhoto"$4>';

	return preg_replace($pattern, $replacement, $content);
}
add_filter('the_content', 'theme_content_lightbox');


function theme_custom_excerpt_length( $length ) {
	return 155;
}
add_filter( 'excerpt_length', 'theme_custom_excerpt_length', 999 );


// limit the excerpt words to be displayed on the Thumbnail CA Slider
// adapted from C.Bavota
// http://bavotasan.com/2009/limiting-the-number-of-words-in-your-excerpt-or-content-in-wordpress/
//
function limited_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).' ';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}


// Displays the custom content area
//
function theme_custom_content() {
	$post_type = get_post_type();
	$category = get_query_var('cat');
	$current_category = get_category ($category);
	$content = '';

	//if (!$post_type)
	//	return null;

	if ( is_home() )
		$content = core_options_get('custom_content_layout-home', 'theme');
	else
		$content = core_options_get('custom_content_layout-default', 'theme');

	// check if it's a page or post with a custom content
	if ( is_singular() && (is_page() || is_single()) )
		$content = core_options_get('custom_content', $post_type);

	// Archive
	if ( is_archive() ) {
		// check if it's a category and display the custom content if there are any
		if ( is_category() )
			$content = core_options_get('custom_content_' . $current_category->slug, 'theme');

		// Author
		elseif ( is_author() )
			$content = core_options_get('custom_content_layout-author', 'theme');

		// Tag
		elseif ( is_tag() )
			$content = core_options_get('custom_content_layout-tag', 'theme');
		else
			$content = core_options_get('custom_content_layout-archive', 'theme');
	}

	// 404
	if ( is_404() )
		$content = core_options_get('custom_content_layout-404', 'theme');

	// Search
	if ( is_search() )
		$content = core_options_get('custom_content_layout-search', 'theme');

	$content = apply_filters('custom_content', $content);

	if ($content)
		return $content;

	return null;
}

// Check if a plugin is active
function core_theme_is_plugin_active( $plugin ) {
    return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
}

// Enqueue Flexslider when needed
function add_flexslider_scripts(){
	wp_enqueue_style('flexslider-style', CORE_URI . '/slider/slider-flexslider/custom-flexslider.css');
	wp_enqueue_script('flexslider-js', CORE_URI . '/slider/slider-flexslider/jquery.flexslider.js', array(), '', true);
}

?>