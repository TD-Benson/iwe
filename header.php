<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage TDFramework
 * @since framework 1.0
 */

 /*
 * Add class to allow styling for toolbar.
 */
$html_class = ( is_admin_bar_showing() ) ? 'wp-toolbar' : '';

?>
<!DOCTYPE html>
<?php if ( is_ie() ) : ?>
<!--[if !IE]>
<html class="non-ie <?php echo $html_class; ?>" <?php language_attributes(); ?>
<![ends hereif]-->
<!--[if IE 7]>
<html class="ie ie7 <?php echo $html_class; ?>" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 <?php echo $html_class; ?>" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html class="<?php echo $html_class; ?>" <?php language_attributes(); ?>>
<!--<![endif]-->
<?php else : ?>
<html class="<?php echo $html_class; ?>" <?php language_attributes(); ?>>
<?php endif; ?>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php if ( is_ie() ) : ?>
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<?php endif; ?>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	<div class="gbl-topbg">
		<div class="gbl-btmbg">
	<div id="container" class="<?php container_class(); ?>">
	    <header id="header" class="theme-row clearfix">
			<div class="header-topblk">
				<div class="theme-wrap center-pnl">
					<?php core_theme_hook_before_header(); ?>
					
				</div>
			</div>
			<div class="header-menublk">
				<div class="theme-wrap center-pnl">
					<div class="nav-blk right">
		    			<?php core_theme_hook_in_header(); ?>
					</div>
				</div>
			</div>
		</header><!-- ends here #header -->
		<div id="contentpanel">
			<div class="theme-wrap center-pnl">
				<div id="wrapper" class="theme-row clearfix">


