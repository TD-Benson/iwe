<?php
/**
 * The template for displaying posts in the Gallery post format.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="item-content grid box-twelve">

		<header class="entry-header">
			<?php core_theme_hook_entry_header(); ?>
			<?php edit_post_link( __( 'Edit', THEME_SLUG ), '<span class="edit-link">', '</span>' ); ?>
			<div class="clear"></div>
		</header><!-- .entry-header -->

		<?php do_action('core_theme_hook_before_entry_content'); ?>

		<div class="entry-content">
				<?php core_theme_featured_gallery($post); ?>
		</div><!-- .entry-content -->

		<?php if ( is_single() ) : ?>
		<footer class="entry-meta">
			<?php do_action('core_theme_hook_entry_footer'); ?>
			<?php edit_post_link( __( 'Edit', THEME_SLUG ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
		<?php endif; // is_single() ?>

		<?php do_action('core_theme_hook_after_entry_content'); ?>

	</div>
	<div class="clear"></div>

</article><!-- #post -->
