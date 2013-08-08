<?php
/**
 * Theme Dutch Ad Widget
 *
 * Add 125x125 advertisements for up to 6 banners
 *
 * @package td_Extras
 * @subpackage Widget
 */


//error_reporting(E_ALL);

class td_adWidget extends WP_Widget {

    function td_adWidget(){
		$widget_ops = array('description' => 'Add 125x125 ad banners on your sidebar.');
		$control_ops = array('width' => 125, 'height' => 125);
		parent::WP_Widget('td_adWidget', $name= __('ThemeDutch AdWidget', THEME_SLUG),$widget_ops,$control_ops);

		if ( is_active_widget( false, false, $this->id_base, true ) )
			add_action( 'wp_enqueue_scripts', array(&$this, 'add_widget_css') );
	}

	function add_widget_css(){
		wp_enqueue_style('widgets', CORE_URI. '/widgets/widgets.css');
	}

  /* Displays the Widget the sidebar section */
    function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		$use_relpath = isset($instance['use_relpath']) ? $instance['use_relpath'] : false;
		$new_window = isset($instance['new_window']) ? $instance['new_window'] : false;
		$adPath[1] = empty($instance['adOnePath']) ? '' : $instance['adOnePath'];
		$adUrl[1] = empty($instance['adOneUrl']) ? '' : $instance['adOneUrl'];
		$adTitle[1] = empty($instance['adOneTitle']) ? '' : $instance['adOneTitle'];
		$adAlt[1] = empty($instance['adOneAlt']) ? '' : $instance['adOneAlt'];
		$adPath[2] = empty($instance['adTwoPath']) ? '' : $instance['adTwoPath'];
		$adUrl[2] = empty($instance['adTwoUrl']) ? '' : $instance['adTwoUrl'];
		$adTitle[2] = empty($instance['adTwoTitle']) ? '' : $instance['adTwoTitle'];
		$adAlt[2] = empty($instance['adTwoAlt']) ? '' : $instance['adTwoAlt'];
		$adPath[3] = empty($instance['adThreePath']) ? '' : $instance['adThreePath'];
		$adUrl[3] = empty($instance['adThreeUrl']) ? '' : $instance['adThreeUrl'];
		$adTitle[3] = empty($instance['adThreeTitle']) ? '' : $instance['adThreeTitle'];
		$adAlt[3] = empty($instance['adThreeAlt']) ? '' : $instance['adThreeAlt'];
		$adPath[4] = empty($instance['adFourPath']) ? '' : $instance['adFourPath'];
		$adUrl[4] = empty($instance['adFourUrl']) ? '' : $instance['adFourUrl'];
		$adTitle[4] = empty($instance['adFourTitle']) ? '' : $instance['adFourTitle'];
		$adAlt[4] = empty($instance['adFourAlt']) ? '' : $instance['adFourAlt'];
		$adPath[5] = empty($instance['adFivePath']) ? '' : $instance['adFivePath'];
		$adUrl[5] = empty($instance['adFiveUrl']) ? '' : $instance['adFiveUrl'];
		$adTitle[5] = empty($instance['adFiveTitle']) ? '' : $instance['adFiveTitle'];
		$adAlt[5] = empty($instance['adFiveAlt']) ? '' : $instance['adFiveAlt'];
		$adPath[6] = empty($instance['adSixPath']) ? '' : $instance['adSixPath'];
		$adUrl[6] = empty($instance['adSixUrl']) ? '' : $instance['adSixUrl'];
		$adTitle[6] = empty($instance['adSixTitle']) ? '' : $instance['adSixTitle'];
		$adAlt[6] = empty($instance['adSixAlt']) ? '' : $instance['adSixAlt'];

		echo $before_widget;

		if ( $title != '' )
			echo $before_title . $title . $after_title;
?>
<div class="td_adwidget_wrap">
<?php $i = 1;
while ($i <= 6):
if ($adPath[$i] <> '') { ?>
<?php if ($adTitle[$i] == '') $adTitle[$i] = "advertisement";
	  if ($adAlt[$i] == '') $adAlt[$i] = "advertisement"; ?>
	<div class="td_adwidget_thumb"><a href="<?php echo $adUrl[$i] ?>" <?php if ($new_window == 1) echo('target="_blank"') ?>><img src="<?php if ($use_relpath == 1) home_url(); else echo $adPath[$i]; ?><?php if ($use_relpath == 1 ) echo ("/" . $adPath[$i]); ?>" alt="<?php echo $adAlt[$i]; ?>" title="<?php echo $adTitle[$i]; ?>" ></a></div>
<?php }; $i++;
endwhile; ?>
	<div class="clear"></div>
</div> <!-- end wrap_td_adwidget -->
<?php
		echo $after_widget;
	}

  /*Saves the settings. */
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = stripslashes($new_instance['title']);
		$instance['use_relpath'] = 0;
		$instance['new_window'] = 0;
		if ( isset($new_instance['use_relpath']) ) $instance['use_relpath'] = 1;
		if ( isset($new_instance['new_window']) ) $instance['new_window'] = 1;
		$instance['adOnePath'] = stripslashes($new_instance['adOnePath']);
		$instance['adOneUrl'] = stripslashes($new_instance['adOneUrl']);
		$instance['adOneTitle'] = stripslashes($new_instance['adOneTitle']);
		$instance['adOneAlt'] = stripslashes($new_instance['adOneAlt']);
		$instance['adTwoPath'] = stripslashes($new_instance['adTwoPath']);
		$instance['adTwoUrl'] = stripslashes($new_instance['adTwoUrl']);
		$instance['adTwoTitle'] = stripslashes($new_instance['adTwoTitle']);
		$instance['adTwoAlt'] = stripslashes($new_instance['adTwoAlt']);
		$instance['adThreePath'] = stripslashes($new_instance['adThreePath']);
		$instance['adThreeUrl'] = stripslashes($new_instance['adThreeUrl']);
		$instance['adThreeTitle'] = stripslashes($new_instance['adThreeTitle']);
		$instance['adThreeAlt'] = stripslashes($new_instance['adThreeAlt']);
		$instance['adFourPath'] = stripslashes($new_instance['adFourPath']);
		$instance['adFourUrl'] = stripslashes($new_instance['adFourUrl']);
		$instance['adFourTitle'] = stripslashes($new_instance['adFourTitle']);
		$instance['adFourAlt'] = stripslashes($new_instance['adFourAlt']);
		$instance['adFivePath'] = stripslashes($new_instance['adFivePath']);
		$instance['adFiveUrl'] = stripslashes($new_instance['adFiveUrl']);
		$instance['adFiveTitle'] = stripslashes($new_instance['adFiveTitle']);
		$instance['adFiveAlt'] = stripslashes($new_instance['adFiveAlt']);
		$instance['adSixPath'] = stripslashes($new_instance['adSixPath']);
		$instance['adSixUrl'] = stripslashes($new_instance['adSixUrl']);
		$instance['adSixTitle'] = stripslashes($new_instance['adSixTitle']);
		$instance['adSixAlt'] = stripslashes($new_instance['adSixAlt']);
		return $instance;
	}

  /*Creates the form for the widget in the back-end. */
    function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('title'=>'Advertisements', 'use_relpath' => false, 'new_window' => true, 'adOnePath'=> THEME_URI . '/images/ad_125x125.jpg', 'adOneUrl'=>'#', 'adOneTitle'=>THEME_NAME, 'adOneAlt'=>THEME_NAME, 'adTwoPath'=>THEME_URI . '/images/ad_125x125.jpg', 'adTwoUrl'=>'#', 'adTwoTitle'=>THEME_NAME, 'adTwoAlt'=>THEME_NAME,'adThreePath'=>'', 'adThreeUrl'=>'','adThreeTitle'=>'', 'adThreeAlt'=>'','adFourPath'=>'', 'adFourUrl'=>'','adFourTitle'=>'', 'adFourAlt'=>'','adFivePath'=>'', 'adFiveUrl'=>'','adFiveTitle'=>'', 'adFiveAlt'=>'','adSixPath'=>'', 'adSixUrl'=>'','adSixTitle'=>'','adSixAlt'=>'', 'adSevenPath'=>'', 'adSevenUrl'=>'','adSevenTitle'=>'','adSevenAlt'=>'','adEightPath'=>'', 'adEightUrl'=>'','adEightTitle'=>'','adEightAlt'=>'') );

		$title = htmlspecialchars($instance['title']);
		$adPath[1] = htmlspecialchars($instance['adOnePath']);
		$adUrl[1] = htmlspecialchars($instance['adOneUrl']);
		$adTitle[1] = htmlspecialchars($instance['adOneTitle']);
		$adAlt[1] = htmlspecialchars($instance['adOneAlt']);
		$adPath[2] = htmlspecialchars($instance['adTwoPath']);
		$adUrl[2] = htmlspecialchars($instance['adTwoUrl']);
		$adTitle[2] = htmlspecialchars($instance['adTwoTitle']);
		$adAlt[2] = htmlspecialchars($instance['adTwoAlt']);
		$adPath[3] = htmlspecialchars($instance['adThreePath']);
		$adUrl[3] = htmlspecialchars($instance['adThreeUrl']);
		$adTitle[3] = htmlspecialchars($instance['adThreeTitle']);
		$adAlt[3] = htmlspecialchars($instance['adThreeAlt']);
		$adPath[4] = htmlspecialchars($instance['adFourPath']);
		$adUrl[4] = htmlspecialchars($instance['adFourUrl']);
		$adTitle[4] = htmlspecialchars($instance['adFourTitle']);
		$adAlt[4] = htmlspecialchars($instance['adFourAlt']);
		$adPath[5] = htmlspecialchars($instance['adFivePath']);
		$adUrl[5] = htmlspecialchars($instance['adFiveUrl']);
		$adTitle[5] = htmlspecialchars($instance['adFiveTitle']);
		$adAlt[5] = htmlspecialchars($instance['adFiveAlt']);
		$adPath[6] = htmlspecialchars($instance['adSixPath']);
		$adUrl[6] = htmlspecialchars($instance['adSixUrl']);
		$adTitle[6] = htmlspecialchars($instance['adSixTitle']);
		$adAlt[6] = htmlspecialchars($instance['adSixAlt']);

		# Title
		echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>'; ?>

		<input class="checkbox" type="checkbox" <?php checked($instance['use_relpath'], true) ?> id="<?php echo $this->get_field_id('use_relpath'); ?>" name="<?php echo $this->get_field_name('use_relpath'); ?>" />
		<label for="<?php echo $this->get_field_id('use_relpath'); ?>">Use Relative Image Paths</label><br />
		<input class="checkbox" type="checkbox" <?php checked($instance['new_window'], true) ?> id="<?php echo $this->get_field_id('new_window'); ?>" name="<?php echo $this->get_field_name('new_window'); ?>" />
		<label for="<?php echo $this->get_field_id('new_window'); ?>">Open in a new window</label><br /><br />

		<?php	# Ad #1 Image
		echo '<p><label for="' . $this->get_field_id('adOnePath') . '">' . 'Ad #1 Image:' . '</label><input class="widefat" id="' . $this->get_field_id('adOnePath') . '" name="' . $this->get_field_name('adOnePath') . '" type="text" value="' . $adPath[1] . '" /></p>';
		# Ad #1 Url
		echo '<p><label for="' . $this->get_field_id('adOneUrl') . '">' . 'Ad #1 Url:' . '</label><input class="widefat" id="' . $this->get_field_id('adOneUrl') . '" name="' . $this->get_field_name('adOneUrl') . '" type="text" value="' . $adUrl[1] . '" /></p>';
		# Ad #1 Title
		echo '<p><label for="' . $this->get_field_id('adOneTitle') . '">' . 'Ad #1 Title:' . '</label><input class="widefat" id="' . $this->get_field_id('adOneTitle') . '" name="' . $this->get_field_name('adOneTitle') . '" type="text" value="' . $adTitle[1] . '" /></p>';
		# Ad #1 Alt
		echo '<p><label for="' . $this->get_field_id('adOneAlt') . '">' . 'Ad #1 Alt:' . '</label><input class="widefat" id="' . $this->get_field_id('adOneAlt') . '" name="' . $this->get_field_name('adOneAlt') . '" type="text" value="' . $adAlt[1] . '" /></p>';
		# Ad #2 Image
		echo '<p><label for="' . $this->get_field_id('adTwoPath') . '">' . 'Ad #2 Image:' . '</label><input class="widefat" id="' . $this->get_field_id('adTwoPath') . '" name="' . $this->get_field_name('adTwoPath') . '" type="text" value="' . $adPath[2] . '" /></p>';
		# Ad #2 Url
		echo '<p><label for="' . $this->get_field_id('adTwoUrl') . '">' . 'Ad #2 Url:' . '</label><input class="widefat" id="' . $this->get_field_id('adTwoUrl') . '" name="' . $this->get_field_name('adTwoUrl') . '" type="text" value="' . $adUrl[2] . '" /></p>';
		# Ad #2 Title
		echo '<p><label for="' . $this->get_field_id('adTwoTitle') . '">' . 'Ad #2 Title:' . '</label><input class="widefat" id="' . $this->get_field_id('adTwoTitle') . '" name="' . $this->get_field_name('adTwoTitle') . '" type="text" value="' . $adTitle[2] . '" /></p>';
		# Ad #2 Alt
		echo '<p><label for="' . $this->get_field_id('adTwoAlt') . '">' . 'Ad #2 Alt:' . '</label><input class="widefat" id="' . $this->get_field_id('adTwoAlt') . '" name="' . $this->get_field_name('adTwoAlt') . '" type="text" value="' . $adAlt[2] . '" /></p>';
		# Ad #3 Image
		echo '<p><label for="' . $this->get_field_id('adThreePath') . '">' . 'Ad #3 Image:' . '</label><input class="widefat" id="' . $this->get_field_id('adThreePath') . '" name="' . $this->get_field_name('adThreePath') . '" type="text" value="' . $adPath[3] . '" /></p>';
		# Ad #3 Url
		echo '<p><label for="' . $this->get_field_id('adThreeUrl') . '">' . 'Ad #3 Url:' . '</label><input class="widefat" id="' . $this->get_field_id('adThreeUrl') . '" name="' . $this->get_field_name('adThreeUrl') . '" type="text" value="' . $adUrl[3] . '" /></p>';
		# Ad #3 Title
		echo '<p><label for="' . $this->get_field_id('adThreeTitle') . '">' . 'Ad #3 Title:' . '</label><input class="widefat" id="' . $this->get_field_id('adThreeTitle') . '" name="' . $this->get_field_name('adThreeTitle') . '" type="text" value="' . $adTitle[3] . '" /></p>';
		# Ad #3 Alt
		echo '<p><label for="' . $this->get_field_id('adThreeAlt') . '">' . 'Ad #3 Alt:' . '</label><input class="widefat" id="' . $this->get_field_id('adThreeAlt') . '" name="' . $this->get_field_name('adThreeAlt') . '" type="text" value="' . $adAlt[3] . '" /></p>';
		# Ad #4 Image
		echo '<p><label for="' . $this->get_field_id('adFourPath') . '">' . 'Ad #4 Image:' . '</label><input class="widefat" id="' . $this->get_field_id('adFourPath') . '" name="' . $this->get_field_name('adFourPath') . '" type="text" value="' . $adPath[4] . '" /></p>';
		# Ad #4 Url
		echo '<p><label for="' . $this->get_field_id('adFourUrl') . '">' . 'Ad #4 Url:' . '</label><input class="widefat" id="' . $this->get_field_id('adFourUrl') . '" name="' . $this->get_field_name('adFourUrl') . '" type="text" value="' . $adUrl[4] . '" /></p>';
		# Ad #4 Title
		echo '<p><label for="' . $this->get_field_id('adFourTitle') . '">' . 'Ad #4 Title:' . '</label><input class="widefat" id="' . $this->get_field_id('adFourTitle') . '" name="' . $this->get_field_name('adFourTitle') . '" type="text" value="' . $adTitle[4] . '" /></p>';
		# Ad #4 Alt
		echo '<p><label for="' . $this->get_field_id('adFourAlt') . '">' . 'Ad #4 Alt:' . '</label><input class="widefat" id="' . $this->get_field_id('adFourAlt') . '" name="' . $this->get_field_name('adFourAlt') . '" type="text" value="' . $adAlt[4] . '" /></p>';
		# Ad #5 Image
		echo '<p><label for="' . $this->get_field_id('adFivePath') . '">' . 'Ad #5 Image:' . '</label><input class="widefat" id="' . $this->get_field_id('adFivePath') . '" name="' . $this->get_field_name('adFivePath') . '" type="text" value="' . $adPath[5] . '" /></p>';
		# Ad #5 Url
		echo '<p><label for="' . $this->get_field_id('adFiveUrl') . '">' . 'Ad #5 Url:' . '</label><input class="widefat" id="' . $this->get_field_id('adFiveUrl') . '" name="' . $this->get_field_name('adFiveUrl') . '" type="text" value="' . $adUrl[5] . '" /></p>';
		# Ad #5 Title
		echo '<p><label for="' . $this->get_field_id('adFiveTitle') . '">' . 'Ad #5 Title:' . '</label><input class="widefat" id="' . $this->get_field_id('adFiveTitle') . '" name="' . $this->get_field_name('adFiveTitle') . '" type="text" value="' . $adTitle[5] . '" /></p>';
		# Ad #5 Alt
		echo '<p><label for="' . $this->get_field_id('adFiveAlt') . '">' . 'Ad #5 Alt:' . '</label><input class="widefat" id="' . $this->get_field_id('adFiveAlt') . '" name="' . $this->get_field_name('adFiveAlt') . '" type="text" value="' . $adAlt[5] . '" /></p>';
		# Ad #6 Image
		echo '<p><label for="' . $this->get_field_id('adSixPath') . '">' . 'Ad #6 Image:' . '</label><input class="widefat" id="' . $this->get_field_id('adSixPath') . '" name="' . $this->get_field_name('adSixPath') . '" type="text" value="' . $adPath[6] . '" /></p>';
		# Ad #6 Url
		echo '<p><label for="' . $this->get_field_id('adSixUrl') . '">' . 'Ad #6 Url:' . '</label><input class="widefat" id="' . $this->get_field_id('adSixUrl') . '" name="' . $this->get_field_name('adSixUrl') . '" type="text" value="' . $adUrl[6] . '" /></p>';
		# Ad #6 Title
		echo '<p><label for="' . $this->get_field_id('adSixTitle') . '">' . 'Ad #6 Title:' . '</label><input class="widefat" id="' . $this->get_field_id('adSixTitle') . '" name="' . $this->get_field_name('adSixTitle') . '" type="text" value="' . $adTitle[6] . '" /></p>';
		# Ad #6 Alt
		echo '<p><label for="' . $this->get_field_id('adSixAlt') . '">' . 'Ad #6 Alt:' . '</label><input class="widefat" id="' . $this->get_field_id('adSixAlt') . '" name="' . $this->get_field_name('adSixAlt') . '" type="text" value="' . $adAlt[6] . '" /></p>';
		echo '<p><small>If you don\'t want to display some ads - leave approptiate fields blank.</small></p>';
		echo '<div class="clear"></div>';
	}


}// end td_adWidget class




?>