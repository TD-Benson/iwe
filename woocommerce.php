<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage TDFramework
 * @since framework 1.0
 */
?>

<div id="content-woocommerce">
<?php if ( have_posts() ) :  ?>

		<?php woocommerce_content(); ?>

<?php endif; // end of the loop. ?>
</div><!-- end of #content-woocommerce -->