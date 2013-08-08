<?php
if (!defined('CORE_VERSION'))
	die();


// Enable demo settings
function core_demo_settings_enable($customize = false){
	if ($customize){
		add_action('wp_footer', 'core_demo_settings', 10);
	}
}

// Add all necessary files
//
function core_demo_enqueue_files(){
	$customize = core_options_get('customize');
	if ($customize){
		wp_enqueue_script(
				'demo-setting',
				CORE_URI . '/demo/demo-setting.js',
				array('jquery')
			);

		wp_register_style( 'demo-style',
		    CORE_URI . '/demo/css/demo.css',
		    array(),
		    '20122078',
		    'all' );
		wp_enqueue_style( 'demo-style' );
	}
}
add_action('wp_enqueue_scripts', 'core_demo_enqueue_files');

// Custom Fonts and Patterns Preview
//
function core_demo_settings(){ ?>

	<div id="customize-demo">
		<div id="settings">Customize</div>
	</div>

	<div id="demo-pane">

			<div class="columns">

				<h2 class="heading">Customize</h2>

				<div class="option-group">
					<h3>Patterns</h3>
					<ul>
						<li class="tiles">
							<?php core_demo_patterns(); ?>
						</li>
					</ul>
				</div>

				<div class="option-group">
					<h3>Typography</h3>
					<ul>
						<li>
							<?php core_demo_load_fonts(); ?>
						</li>
					</ul>
				</div>

				<?php
				//<a class="moreFeatures" href="http://themeforest.net/item/mikmag-responsive-buddypress-and-woocommerce/2728331">Check out more awesome features <img class="arrow" src="<?php echo THEME_URI; ?>/core/demo/images/arrow-medium.png" alt="arrow" /></a> ?>

			</div>
			<div style="clear:both;"></div>

	</div>

<?php
}


// Load all the patterns
function core_demo_patterns($option = 'pattern'){
	global $core_theme_options_handler;
	$folder = THEME_PATH . '/images/patterns';
	$patterns = core_get_directory_list($folder);
	sort($patterns, SORT_NUMERIC);
	$i = 1;
	foreach($patterns as $file) {
		if(strstr($file, '.png'))
			echo '<div class="tile" style="background: url(\''. THEME_URI. '/images/patterns/' .$file. '\') repeat">Pattern '.$i.'</div>';
		$i++;
	}
}

// Load the fonts
function core_demo_load_fonts(){
	global $core_fonts;
	global $core_fonts_preview_text;
	$id = 'id';
	$value = '';
	echo '<div class="core-option-font-container">';
	echo '<select id="font_lists" name="font_lists">';

	foreach ($core_fonts as $group_name => $group) {
		echo '<optgroup label="' .$group_name. '">';
		foreach ($group as $font_name) {
			echo '<option value="'.$font_name.'">' .$font_name. '</option>';
		}
	}
	echo '</select>';
	echo '<input type="hidden" id="' .$id. '" name="" value="', $value, '" data-previous="', $value, '">';
	echo '<div class="font-status"></div>';
	echo '</div>';
}
