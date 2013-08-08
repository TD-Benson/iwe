<?php

// Disable WooCommerce internal CSS
define('WOOCOMMERCE_USE_CSS', false);

// WooCommerce CSS
//
function theme_woocommerce_enqueue_scripts() {
	wp_enqueue_style('theme-woocommerce', THEME_URI . '/woocommerce/theme-woocommerce.css');

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', '/wp-includes/js/jquery/jquery.js', array(), '1.9.1' );
	wp_enqueue_script( 'jquery' );

	wp_enqueue_script(
		'woo-theme-js',
		THEME_URI . '/woocommerce/theme-woocommerce.js',
		array('jquery'),
		'',
		true
	);

}
add_action('wp_enqueue_scripts', 'theme_woocommerce_enqueue_scripts', 999999);
add_action('wp_enqueue_scripts', 'add_flexslider_scripts' );

// Adds WooCommerce layout option page
//
function theme_woocommerce_layoutoptions() {
	global $core_theme_options_handler;
	global $core_layout_default;

	$options = new CoreOptionGroup('woocommerce-layouts', __('Woocommerce', THEME_SLUG), __('Use this page to define the layouts of WooCommerce pages.', THEME_SLUG), THEME_URI. '/woocommerce/images/options-woocommerce.png');
	$core_theme_options_handler->group_add($options);

	$layouts = array(
		'layout-woocommerce-shop' => __('Shop page', THEME_SLUG),
		'layout-woocommerce-category' => __('Product category page', THEME_SLUG),
		'layout-woocommerce-tag' => __('Product tag page', THEME_SLUG),
		'layout-woocommerce-product' => __('Product page', THEME_SLUG),
		'layout-woocommerce-cart' => __('Cart page', THEME_SLUG),
		'layout-woocommerce-checkout' => __('Checkout page', THEME_SLUG),
		'layout-woocommerce-account' => __('Account page', THEME_SLUG),
	);
	foreach ($layouts as $key => $value) {
		$section = new CoreOptionSection($key, $value);
		$options->section_add($section);
		$section->option_add(new CoreOption($key, null, 'layout', null, $core_layout_default));

		// Slider
		$section->option_add(new CoreOption('slider_'.$key, __('Slider', THEME_SLUG), 'sliders', __('The slider will be displayed at the top of the '.$value.'.', THEME_SLUG)));

		$section->option_add(new CoreOption($key.'_background', __('Background', THEME_SLUG), 'image'));
		$section->option_add(new CoreOption($key.'_background_author', __('Image Author', THEME_SLUG), 'text', __('The author of the background image.', THEME_SLUG)));
		$section->option_add(new CoreOption($key.'_background_link', __('Author Link', THEME_SLUG), 'text', __('The author link of the background image.', THEME_SLUG)));


		$section->option_add(new CoreOption($key.'_colorscheme', __('Color scheme', THEME_SLUG), 'colorschemes-list'));

		// Custom Category Content section
		$section->option_add(new CoreOption($key.'_custom_content' , __('Subtitle', THEME_SLUG), 'text-multiline', __('Any HTML put here will be included in it\'s own block above the content.', THEME_SLUG)));
	}
}
add_action('after_setup_theme', 'theme_woocommerce_layoutoptions');

// Returns the right layout for the current WooCommerce page
//
function theme_woocommerce_layout($layout) {
	if (!is_woocommerce())
		return $layout;

	if (is_shop())
		return core_options_get('layout-woocommerce-shop');

	if (is_product_category())
		return core_options_get('layout-woocommerce-category');

	if (is_product_tag())
		return core_options_get('layout-woocommerce-tag');

	if (is_product())
		return core_options_get('layout-woocommerce-product');

	if (is_cart())
		return core_options_get('layout-woocommerce-cart');

	if (is_checkout())
		return core_options_get('layout-woocommerce-checkout');

	if (is_account_page())
		return core_options_get('layout-woocommerce-account');

	return $layout;

}
add_filter('core_layout', 'theme_woocommerce_layout');

// Get Woocommerce Sliders
function theme_woocommerce_slider($slider){
	if ( !is_woocommerce() )
		return $slider;

	if (is_shop()){
		$post_type = 'theme';
		$slug = '_layout-woocommerce-shop';
	}

	if (is_product_category()){
		$post_type = 'theme';
		$slug = '_layout-woocommerce-category';
	}

	if (is_product_tag()){
		$post_type = 'theme';
		$slug = '_layout-woocommerce-tag';
	}

	if (is_product()){
		$post_type = 'theme';
		$slug = '_layout-woocommerce-product';
	}

	if (is_cart()){
		$post_type = 'theme';
		$slug = '_layout-woocommerce-cart';
	}

	if (is_checkout()){
		$post_type = 'theme';
		$slug = '_layout-woocommerce-checkout';
	}

	if (is_account_page()){
		$post_type = 'theme';
		$slug = '_layout-woocommerce-account';
	}

	return core_options_get('slider'.$slug, $post_type);
}
add_filter('slider_area', 'theme_woocommerce_slider');

// Get Woocommerce background image
function theme_woocommerce_get_background($backgroundimage){
	if ( !is_woocommerce() )
		return $backgroundimage;

	if (is_shop()){
		$backgroundimage = core_options_get('layout-woocommerce-shop_background', 'theme');
	}

	if (is_product_category()){
		$backgroundimage = core_options_get('layout-woocommerce-category_background', 'theme');
	}

	if (is_product_tag()){
		$backgroundimage = core_options_get('layout-woocommerce-tag_background', 'theme');
	}

	if (is_product()){
		$backgroundimage = core_options_get('layout-woocommerce-product_background', 'theme');
	}

	if (is_cart()){
		$backgroundimage = core_options_get('layout-woocommerce-cart_background', 'theme');
	}

	if (is_checkout()){
		$backgroundimage = core_options_get('layout-woocommerce-checkout_background', 'theme');
	}

	if (is_account_page()){
		$backgroundimage = core_options_get('layout-woocommerce-account_background', 'theme');
	}

	return $backgroundimage;
}
add_filter('layout_background', 'theme_woocommerce_get_background');

//Get Woocommerce colorscheme
function theme_woocommerce_colorscheme($scheme){
	if( !is_woocommerce())
		return $scheme;

	if (is_shop()){
		$scheme = core_options_get('layout-woocommerce-shop_colorscheme', 'theme');
	}

	if (is_product_category()){
		$scheme = core_options_get('layout-woocommerce-category_colorscheme', 'theme');
	}

	if (is_product_tag()){
		$scheme = core_options_get('layout-woocommerce-tag_colorscheme', 'theme');
	}

	if (is_product()){
		$scheme = core_options_get('layout-woocommerce-product_colorscheme', 'theme');
	}

	if (is_cart()){
		$scheme = core_options_get('layout-woocommerce-cart_colorscheme', 'theme');
	}

	if (is_checkout()){
		$scheme = core_options_get('layout-woocommerce-checkout_colorscheme', 'theme');
	}

	if (is_account_page()){
		$scheme = core_options_get('layout-woocommerce-account_colorscheme', 'theme');
	}
	return $scheme;
}
add_filter('color_scheme', 'theme_woocommerce_colorscheme');

// Get Woocommerce custom content
function theme_woocommerce_custom_content($content){
	if( !is_woocommerce())
		return $content;

	if (is_shop()){
		$content = core_options_get('custom_content_layout-woocommerce-shop', 'theme');
	}

	if (is_product_category()){
		$content = core_options_get('custom_content_layout-woocommerce-category', 'theme');
	}

	if (is_product_tag()){
		$content = core_options_get('custom_content_layout-woocommerce-tag', 'theme');
	}

	if (is_product()){
		$content = core_options_get('custom_content_layout-woocommerce-product', 'theme');
	}

	if (is_cart()){
		$content = core_options_get('custom_content_layout-woocommerce-cart', 'theme');
	}

	if (is_checkout()){
		$content = core_options_get('custom_content_layout-woocommerce-checkout', 'theme');
	}

	if (is_account_page()){
		$content = core_options_get('custom_content_layout-woocommerce-account', 'theme');
	}
	return $content;
}
add_filter('custom_content', 'theme_woocommerce_custom_content');

function theme_woocommerce_bg_authorInfo($author){
	if( !is_woocommerce())
		return $author;

	if (is_shop())
		$author 			= core_options_get('layout-woocommerce-shop_author', 'theme');

	if (is_product_category())
		$author 			= core_options_get('layout-woocommerce-shop_author', 'theme');

	if (is_product_tag())
		$author 			= core_options_get('layout-woocommerce-tag_author', 'theme');

	if (is_product())
		$author 			= core_options_get('layout-woocommerce-product_author', 'theme');

	if (is_cart())
		$author 			= core_options_get('layout-woocommerce-cart_author', 'theme');

	if (is_checkout())
		$author 			= core_options_get('layout-woocommerce-checkout_author', 'theme');

	if (is_account_page())
		$author 			= core_options_get('layout-woocommerce-account_author', 'theme');

	return $author;

} // theme_woocommerce_bg_authorInfo()
add_filter('bg_authorInfo', 'theme_woocommerce_bg_authorInfo');

function theme_woocommerce_bg_authorLink($link){
	if( !is_woocommerce())
		return $link;

	if (is_shop())
		$link 				= core_options_get('layout-woocommerce-shop_link', 'theme');

	if (is_product_category())
		$link 				= core_options_get('layout-woocommerce-shop_link', 'theme');

	if (is_product_tag())
		$link 				= core_options_get('layout-woocommerce-tag_link', 'theme');

	if (is_product())
		$link 				= core_options_get('layout-woocommerce-product_link', 'theme');

	if (is_cart())
		$link 				= core_options_get('layout-woocommerce-cart_link', 'theme');

	if (is_checkout())
		$link 				= core_options_get('layout-woocommerce-checkout_link', 'theme');

	if (is_account_page())
		$link 				= core_options_get('layout-woocommerce-account_link', 'theme');

	return $link;

} // theme_woocommerce_bg_authorLink()
add_filter('bg_authorLink', 'theme_woocommerce_bg_authorLink');


// Displays the WooCommerce cart, also updates the cart fragment on AJAX callbacks
//
function theme_woocommerce_cart($fragments=null) {
	global $woocommerce;

	if (is_array($fragments))
		ob_start();

	// Output dropdown cart
	echo '<table class="tbl-wcminicart" cellpadding="0" cellspacing="0"><tr><td>';
	echo '<div id="theme-woocommerce-cart-dropdown">';

	// Articles
	echo '<ul class="cart_list">';
	if (sizeof($woocommerce->cart->cart_contents) > 0) {
		$i = 0;
		foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) {

			$i++;
			if ($i == 1) {
				$rowclass = ' class="cart_oddrow"';
			} else {
				$rowclass = ' class="cart_evenrow"';
				$i = 0;
			}

			$_product = $cart_item['data'];
			if ($_product->exists() && $cart_item['quantity'] > 0) {
				echo '<li' . $rowclass . '>';

				// Thumbnail
				echo '<div class="dropdowncartimage">';
				echo '<a href="' . get_permalink($cart_item['product_id']) . '">';

				if (has_post_thumbnail($cart_item['product_id']))
					echo get_the_post_thumbnail($cart_item['product_id'], 'shop_thumbnail');
				else
					echo '<img src="' . $woocommerce->plugin_url() . '/assets/images/placeholder.png" alt="Placeholder" width="' . $woocommerce->get_image_size('shop_thumbnail_image_width') . '" height="' . $woocommerce->get_image_size('shop_thumbnail_image_height') . '">';

				echo '</a>';
				echo '</div>';

				// Product title
				echo '<div class="dropdowncartproduct">';
				//echo '<a href="' . get_permalink($cart_item['product_id']) . '">';
				echo apply_filters('woocommerce_cart_widget_product_title', $_product->get_title(), $_product);

				if ($_product instanceof woocommerce_product_variation && is_array($cart_item['variation']))
					echo woocommerce_get_formatted_variation($cart_item['variation']);

				//echo '</a>';
				echo '</div>';

				// Product quantity
				echo '<div class="dropdowncartquantity">';
				echo '<span class="quantity">' . $cart_item['quantity'] . ' &times; ' . woocommerce_price($_product->get_price()) . '</span>';
				echo '</div>';
				echo '<div class="clear"></div>';

				echo '</li>';
			}
		}

		// No articles present
	} else {
		echo '<li class="empty">' . __('No products in the cart.', THEME_SLUG) . '</li>';
	}
	echo '</ul>';

	echo '</div>';
	echo '</td><td valign="middle">';

	// Cart display
	echo '<div id="cart-contents">';
	echo '<h3>';
	echo sprintf(_n('You have %d product in your bag.', 'You have %d products in your bag.', $woocommerce->cart->cart_contents_count, THEME_SLUG), $woocommerce->cart->cart_contents_count);
	echo '</h3>';

	// Totals
	if (sizeof($woocommerce->cart->cart_contents) > 0) {
		echo '<h4 class="total">';

		if (get_option('js_prices_include_tax') == 'yes')
			_e('Total', 'woothemes');
		else
			_e('Subtotal', 'woothemes');

		echo ': ' . $woocommerce->cart->get_cart_total();

		echo '</h4>';

		// Buttons
		do_action('woocommerce_widget_shopping_cart_before_buttons');
		echo '<div class="buttons checkout-minicart">
			  <a href="' . $woocommerce->cart->get_checkout_url() . '" class="button medium"><i class="icon-shopping-cart"></i>  ' . __('Proceed to Checkout &rarr;', THEME_SLUG).'</a>
			  </div>';
	}

	echo '</div>';
	echo '</td></tr></table>';
	echo '<div class="clear"></div>';


	// Return fragment with updated cart
	if (is_array($fragments)) {
		$fragments['div.cart-contents'] = ob_get_clean();
		return $fragments;
	}
}
add_filter('add_to_cart_fragments', 'theme_woocommerce_cart');

function theme_woocommerce_cart_colors(){
	$colors = array(
		// theme-woocommerce-cart color
		'color_menu_text' => array(
			'.theme-woocommerce-cart',
			'.theme-woocommerce-cart a.button',
			'.cart_list a',
			'.dropdowncartproduct a'
		),

		'color_menu_text_hover' => array(
			'.cart_list a:hover',
			'.dropdowncartproduct a:hover'
		),

		// woocommerce buttons
		'color_button_text'           => array('input.button'),
		'color_button_text_hover'     => array('input.button:hover'),
	);

	$bgcolors = array(
		'color_menu_background' => array(
			'.theme-woocommerce-cart-dropdown'
		),

		'color_button' => array(
			'input.button',
		),

		'color_button_hover' => array(
			'input.button:hover',
		),
	);

	apply_colors('color', $colors);
	apply_colors('background-color', $bgcolors);
}
add_action('core_custom_css', 'theme_woocommerce_cart_colors');

// Additional WooCommerce settings
//
function theme_woocommerce_page_settings($options)
{
	$options[] = array(
		'name' => 'Column and Product Count',
		'type' => 'title',
		'desc' => 'These settings control the number of columns and products in product listings.',
		'id'   => 'column_options'
	);

	$options[] = array(
		'name' => 'Column Count',
		'desc' => 'The amount of product columns on an overview page.',
		'id' => 'core_woocommerce_column_count',
		'css' => 'min-width: 100px;',
		'std' => '3',
		'type' => 'select',
		'options' => array
		(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
		),
	);

	$itemcount = array('-1' => 'All');
	for($i = 3; $i < 101; $i++)
		$itemcount[$i] = $i;

	$options[] = array(
		'name' => 'Product Count',
		'desc' => 'The amount of products on an overview page.',
		'id' => 'core_woocommerce_product_count',
		'css' => 'min-width: 100px;',
		'std' => '24',
		'type' => 'select',
		'options' => $itemcount,
	);

	$options[] = array(
		'name' => __('Related Items', THEME_SLUG),
		'desc' => __('The number of related items.', THEME_SLUG),
		'id' => 'core_woocommerce_related_item_count',
		'css' => 'min-width: 100px;',
		'std' => '4',
		'type' => 'select',
		'options' => array
		(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
		),
	);

	$options[] = array(
		'type' => 'sectionend',
		'id' => 'column_options'
	);

	return $options;
}
add_filter('woocommerce_page_settings', 'theme_woocommerce_page_settings');

// Text replacements
function theme_woocommerce_addcart_button_text() {
	return __('Add to cart', THEME_SLUG);
}
add_filter('single_add_to_cart_text', 'theme_woocommerce_addcart_button_text');

function theme_woocommerce_viewcart_button_text() {
	return __('View cart', THEME_SLUG);
}
add_filter('single_view_cart_text', 'theme_woocommerce_viewcart_button_text');

// Disable WooCommerce Add to Cart buttons in the product loop
function woocommerce_template_loop_add_to_cart() {
}

// Move sorting form to top
remove_action('woocommerce_pagination', 'woocommerce_catalog_ordering', 20);

// Disable WooCommerce breadcrumbs
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

// Move sorting form to top
//remove_action('woocommerce_pagination', 'woocommerce_catalog_ordering', 20);
//add_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 20);

// Number of columns on a product page
function theme_woocommerce_column_count() {
	return get_option('core_woocommerce_column_count');
}
add_filter('loop_shop_columns', 'theme_woocommerce_column_count');

// Number of items to loop through on a product page
function theme_woocommerce_loop_count() {
	return get_option('core_woocommerce_product_count');
}
add_filter('loop_shop_per_page', 'theme_woocommerce_loop_count');

// Redefine woocommerce_output_related_products()
function woocommerce_output_related_products() {
	$columns = get_option('core_woocommerce_related_item_count');
	woocommerce_related_products($columns,$columns); // Display related products columns
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 15 );

// Redefine woocommerce_output_upsells()
function woocommerce_output_upsells() {
	$columns = get_option('core_woocommerce_related_item_count');
	woocommerce_upsell_display($columns,$columns); // Display up sell products columns
}

// Redefine woocommerce_output_cross_sells()
function woocommerce_output_cross_sells() {
	$columns = get_option('core_woocommerce_related_item_count');
	woocommerce_cross_sell_display($columns,4); // Display up sell products columns
}

// Add custom post class to product items
function theme_woocommerce_post_class($classes){
	global $woocommerce_loop;
	if ( is_woocommerce() ) {
		$columns = $woocommerce_loop['columns'];
		$classes[] = core_theme_get_column($columns);
	}

	return $classes;
}
add_filter('post_class', 'theme_woocommerce_post_class');

//Shop Page
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

function woo_pagination_args( $args ){
    $args['prev_text'] = '<i class="icon-double-angle-left icon-large"></i>';
    $args['next_text'] = '<i class="icon-double-angle-right icon-large"></i>';
    $args['end_size'] = 3;
    $args['mid_size'] = 3;
    return $args;
}
add_filter( 'woocommerce_pagination_args', 'woo_pagination_args' );

function woo_single_product_cat(){
    $product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
    if ( $product_cats && ! is_wp_error ( $product_cats ) ){
        $single_cat = array_shift( $product_cats ); ?>
        <span class="product-cat"><?php echo $single_cat->name; ?></span>
<?php }
}

function woo_shop_item_image(){
	echo '<div class="item-image">';
		woocommerce_template_loop_product_thumbnail();
	echo '</div>';
}
add_action( 'woocommerce_before_shop_loop_item', 'woo_shop_item_image' );

function woo_custom_add_to_cart_text(){
	return '<i class="icon-check"></i>';
}
add_filter( 'added_to_cart_text', 'woo_custom_add_to_cart_text' );

// Single Product Page changes
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );


function woo_container_productDetails_start(){
	echo '<div id="product-details">';
}
function woo_container_productDetails_end(){
	echo '</div>';
}

function woo_container_productDetails(){
	echo '<div id="product-details">';
	echo '<div class="product_header">';
	do_action( 'product_header' );
	echo '</div>';

	echo '<div class="product_price">';
	do_action( 'product_price' );
	echo '</div>';

	echo '<div class="product_button">';
	do_action( 'product_button' );
	echo '</div>';
	echo '</div>';
}

function woo_stock_badge(){
	global $product;
	// Availability
	$availability = $product->get_availability();

	echo '<div class="stock">';
	if ($availability['availability']) :

		if ( $availability['class'] == 'out-of-stock' )
			$custom_stock = 'Out of stock';
		else
			$custom_stock = 'Available';

		echo apply_filters( 'woocommerce_stock_html', '<span class="stock ' . esc_attr( $availability['class'] ) . '">' . $custom_stock . '</span>', $availability['availability'] );
	endif;
	echo '</div>';
}

function woo_star_rating(){
	global $post, $product, $woocommerce;

	$attachment_ids = $product->get_gallery_attachment_ids();

	if ( $attachment_ids ) {
		$moveup = 'moveup';
	}

	if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

		$count = $product->get_rating_count();

		if ( $count > 0 ) {

			$average = $product->get_average_rating();

			echo '<div class="woo_star_rating '.$moveup.'"><div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', THEME_SLUG ), $average ).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', THEME_SLUG ).'</span></div></div>';
		}
	}
}

add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash');
add_action( 'woocommerce_product_thumbnails', 'woo_star_rating', 99);
add_action( 'woocommerce_product_thumbnails', 'woo_stock_badge');
add_action( 'woocommerce_product_thumbnails', 'woo_container_productDetails', 5 );
add_action( 'product_header', 'woocommerce_template_single_title' );
add_action( 'product_header', 'woocommerce_template_single_meta' );
add_action( 'product_price', 'woocommerce_template_single_price' );

add_action( 'product_button', 'woocommerce_template_single_add_to_cart' );
add_action( 'product_button', 'woocommerce_template_single_sharing' );


function woo_custom_styles(){
	if( !is_woocommerce())
		return;

	$colors = array(
		'color_links' => array(
			'div.product div.images .icon-resize-full',
			'#content-woocommerce div.product div.images .icon-resize-full',
		),
		'color_button' => array(
			'#product-details .product_header .product_meta a',
			'#product-details p.price ins'
		),
		'color_button_text' => array(
			'div.product .woocommerce-tabs ul.tabs li a',
			'#content-woocommerce div.product .woocommerce-tabs ul.tabs li a'
		),
		'color_menu_background' => array(
			'ul.products .item-details a.product_hover:hover',
			'span.onsale'
		)
	);
	$bg_colors = array(
		'color_button' => array(
			'div.product .woocommerce-tabs ul.tabs li.active',
			'#content-woocommerce div.product .woocommerce-tabs ul.tabs li.active',
			'div.product div.images div.stock'
		),
		'color_button_hover' => array(
			'div.product .woocommerce-tabs ul.tabs li, #content-woocommerce div.product .woocommerce-tabs ul.tabs li'
		),
	);
	$border_colors = array(
		'color_button' => array(
			'div.product div.images div.thumbnails .slides',
			'#content-woocommerce div.product div.images div.thumbnails .slides',
			'div.product .woocommerce-tabs',
			'#content-woocommerce div.product .woocommerce-tabs',
			'div.product .woocommerce-tabs ul.tabs:before',
			'#content-woocommerce div.product .woocommerce-tabs ul.tabs:before'
		),
		'color_menu_background' => array(
			'ul.products .item-details a.product_hover:hover',
			'span.onsale'

		)
	);

	apply_colors('color', $colors);
	apply_colors('background-color', $bg_colors);
	apply_colors('border-color', $border_colors);

} // woo_custom_styles()
add_action( 'core_theme_hook_styles', 'woo_custom_styles');



?>