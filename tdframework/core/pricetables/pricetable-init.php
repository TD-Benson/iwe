<?php


function create_post_tdpricetable() {
	register_post_type( 'td_pricelist',
		array(
			'labels' => array(
				'name' => __( 'Price Tables', THEME_SLUG ),
				'singular_name' => __( 'Price Table', THEME_SLUG )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'pricelist'),
			'menu_icon' => THEME_URI . '/images/td-logo16.png',
		)
	);
}

function my_editor_content( $content, $post ) {
    global $post_type;
    if ( $post_type == 'td_pricelist' ) {
            $content = '[tdpricetable columns="1"][tdpricetable_column  title="title" titlefontcolor="#282828" subtitle="subtitle" toplisttitle="toplisttitle" toplistsubtitle="toplistsubtitle" backgroundcolor="#ffffff"  fontcolor="#7D7D7D" ][tdpricetable_content][list none]
list 1
list 2
list 3
list 4
[/list][/tdpricetable_content][tdpricetable_button buttoncolor="#999999" buttonfontcolor="#ffffff" buttonlink="#" buttontitle="Button Title"]Register Here![/tdpricetable_button][/tdpricetable_column][/tdpricetable]';
        return $content;
    }
}

function core_shortcode_td_pricetable_panel($atts, $content=null, $tag) {
	extract(shortcode_atts(array(
		'id' => '1'
	), $atts));

	$post_id = get_post($id);
	$mcontent = $post_id->post_content;

	$output = do_shortcode($mcontent);


	return $output;
}

function createShortCode() {
	global $post;
	?>
	<span class="note-txt" style="color:#999; display:block; padding-bottom:10px;">copy/paste this shortcode to your page/post</span>
	<div style="padding:10px; background-color:#e9e9e9;">
		<?php echo ' [td_pricetable_panel id='.get_the_ID().']'; ?>
	</div>
	<?php
}

function add_events_metaboxes() {
  add_meta_box('tdCore_options', 'ShortCode', 'createShortCode', 'td_pricelist', 'normal', 'high');
}

add_filter( 'default_content', 'my_editor_content', 10, 2 );
add_action( 'admin_menu', 'add_events_metaboxes' );
add_action( 'init', 'create_post_tdpricetable' );
add_shortcode('td_pricetable_panel', 'core_shortcode_td_pricetable_panel');

?>