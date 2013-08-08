<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage TDFramework
 * @since framework 1.0
 */
?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php

		if ( get_post_format() != '' )
			get_template_part( 'tdframework/post-types/content', get_post_format() );
		else
			get_template_part('content');

	?>

	<?php core_theme_content_nav( 'nav-below' ); ?>

	<?php
		// If comments are open or we have at least one comment, load up the comment template
		if ( comments_open() || '0' != get_comments_number() )
			comments_template();
	?>

<?php endwhile; // end of the loop. ?>