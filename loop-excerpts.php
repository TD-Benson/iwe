<?php
/**
 * The Template for displaying archive pages.
 *
 * @package WordPress
 * @subpackage TDFramework
 * @since framework 1.0
 */
?>

<div class="theme-excerpts">
<?php if ( have_posts() ) : ?>

	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php
			/* Include the Post-Format-specific template for the content.
			 * If you want to overload this in a child theme then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */


			//if ( get_post_format() != '' )
			//	get_template_part( 'tdframework/post-types/content', get_post_format() );
			//else
				get_template_part('content', 'excerpt');
		?>

	<?php endwhile; ?>

	<?php core_layout_pagination(); ?>

<?php else : ?>

	<?php get_template_part( 'no-results', 'index'); ?>

<?php endif; ?>

</div>


