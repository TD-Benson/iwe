<?php
/**
 * The Template for displaying all bbp forums, topics and single posts.
 *
 * @package WordPress
 * @subpackage TDFramework
 * @since framework 1.0
 */
?>

<?php if ( have_posts() ) : the_post();  ?>
	<div id="content-bp">

		<?php get_template_part( 'tdframework/post-types/content', 'generic' ); ?>

	</div><!-- end of #content-bp -->
<?php endif; // end of the loop. ?>