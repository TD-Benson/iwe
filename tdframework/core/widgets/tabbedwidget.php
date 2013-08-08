<?php
/**
 * Theme Dutch Tabbed Widget
 * Displays a group of widgets in a tabbed display.
 *
 * A modified version of Tabber Tabs Widget
 * from http://slipfire.com/
 *
 * @package td_Extras
 * @subpackage Widget
 */

//error_reporting(E_ALL);

class td_tabbedWidget extends WP_Widget {

    function td_tabbedWidget(){
		$widget_ops = array('classname' => 'tabbertabs', 'description' => 'Displays a group of widgets in a tabbed display. !!! IMPORTANT: Do NOT place this widget in the "TABBED WIDGET AREA".');
		$control_ops = array('');
		parent::WP_Widget('tabbertabs',$name= __('ThemeDutch TabbedWidget', THEME_SLUG),$widget_ops,$control_ops);

		if ( is_active_widget( false, false, $this->id_base, true ) ){
			add_action( 'wp_enqueue_scripts', array(&$this, 'add_tabber_js') );
			add_action( 'wp_enqueue_scripts', array(&$this, 'add_widget_css') );
		}
	}

	function add_widget_css(){
		wp_enqueue_style('widgets', CORE_URI. '/widgets/widgets.css');
	}

	function add_tabber_js(){
		wp_enqueue_script('tabbertabs', CORE_URI. '/widgets/js/tabber.js', '1.0', true);
	}

  /* Displays the Widget the sidebar section */
    function widget($args, $instance){
		extract( $args );

		$style = empty($instance['style']) ? 'style1' : $instance['style'];

		echo $before_widget;
?>
		<?php // Temporarily hides the TabbedWidget while the page is loading ?>
		<style type="text/css">.tabbertabs{ opacity: 0; }</style>

		<div class="tabber <?php echo $style; ?>">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('tabber_tabs') ); ?>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				var ANIMATE_SPEED = 300;
				jQuery('.tabbertabs').stop(true, true).animate({opacity: 1.0}, ANIMATE_SPEED);
			});
		</script>
<?php 	echo $after_widget;

	}

  /*Saves the settings. */
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['style'] = $new_instance['style'];
		return $instance;
	}

  /*Creates the form for the widget in the back-end. */
    function form($instance){
		//Defaults
		$defaults = array( 'title' => __('Tabbed Widgets', THEME_SLUG), 'style' => 'style1');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<div style="float:left;width:98%;"></div>
		<p>
		<?php _e('Place your desired widgets in the Tabbed Widget Area and they will show up here.', THEME_SLUG); ?>
		</p>
		<hr>
		<p><?php _e('!!! Important: DO NOT place this in the Tabbed Widget Area.', THEME_SLUG); ?> </p>
		<hr>
		<div style="clear:both;">&nbsp;</div>
	<?php
	}

}// end td_adWidget class

function td_tabbedWidget_Init() {
	register_widget('td_tabbedWidget');
}
// Initialize the Tabbed Widget
//add_action('widgets_init', 'td_tabbedWidget_Init');


//create a sidebar area for the tabbed widget
function td_tabbedWidget_register_sidebar() {
	register_sidebar(
		array(
			'name' => __('Tabbed Widget Area', THEME_SLUG),
			'id' => 'tabber_tabs',
			'description' => __('All the widgets being placed here will be the contents of ThemeDutch TabbedWidget. !!! IMPORTANT: Do NOT place the "ThemeDutch TABBEDWIDGET" in this area. Please put it in another Sidebar widget area. ', THEME_SLUG),
			'before_widget' => '<div id="%1$s" class="tabbertab">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title section-title">',
			'after_title' => '</h3>'
		)
	);
}
// Load the widget area last so we don't effect other widget areas.
add_action( 'wp_loaded', 'td_tabbedWidget_register_sidebar' );


// Function to check if there are widgets in the Tabber Tabs widget area
// Thanks to Themeshaper: http://themeshaper.com/collapsing-wordpress-widget-ready-areas-sidebars/
function is_td_tabbedWidget_area_active( $index ){

  	global $wp_registered_sidebars;

	  $widgetcolums = wp_get_sidebars_widgets();
	  $key		= (string) $index;

	  if (isset($widgetcolums[$key])) return true;

		return false;
}

// Show the admin notice if there are no widgets in Tabber Tabs widget area
if ( is_td_tabbedWidget_area_active('tabber_tabs') ) {
        //add_action( 'admin_notices', 'td_tabbedWidget_admin_notice' );
	}

	// Here's the admin notice
	function td_tabbedWidget_admin_notice() {
		global $pagenow;

		if ( ! current_user_can( 'install_plugins' ) )
			return;

		if ( $pagenow == 'themes.php' ) {

		echo '<div class="error fade"><p><strong>' . sprintf( __('ThemeDutch TabbedWidget is activated.  To start using, add some widgets to the <a href="%s">Tabbed Widget Area</a>.', THEME_SLUG ), admin_url( 'widgets.php' ) ) . '</strong></p></div>';
		}
	}

?>