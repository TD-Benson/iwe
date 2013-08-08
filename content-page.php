<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage TDFramework
 * @since framework 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php core_theme_hook_entry_header(); ?>
		<?php edit_post_link( __( 'Edit', THEME_SLUG ), '<span class="edit-link">', '</span>' ); ?>
		<div class="clear"></div>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : ?>
	<div class="entry-media">
		<?php the_post_thumbnail('post-excerpt-full'); ?>
	</div><!-- .entry-media -->
	<?php endif; ?>

	<?php do_action('core_theme_hook_before_entry_content'); ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', THEME_SLUG ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<?php do_action('core_theme_hook_after_entry_content'); ?>


	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', THEME_SLUG ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
		<div class="footer-divider">
		</div>

</article><!-- #post-## -->
