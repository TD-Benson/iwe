<?php
/*
 * Template Name: Home Page Template
 *
 * @package WordPress
 * @subpackage TDFramework
 * @since framework 1.0
 */
?>
<?php
	$home_category = core_options_get('homepage_layout_category');
	$posts_per_page = core_options_get('homepage_post_number');

	$args = array('post_type' => 'post', 'category_name' => $home_category, 'posts_per_page' => $posts_per_page);

	$query = new WP_Query( $args );

	$counter = 0;
	//var_dump($query);
?>


<div class="theme-excerpts">
<?php if ( $query->have_posts() ) : ?>

	<?php /* Start the Loop */ ?>
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>

		<?php
			/* Include the Post-Format-specific template for the content.
			 * If you want to overload this in a child theme then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */

			 $counter ++;

			 $wp_query->current_post = $counter;

			if ( get_post_format() != '' )
				get_template_part( 'tdframework/post-types/content', get_post_format() );
			else
				get_template_part('content', 'excerpt');
		?>

	<?php endwhile; ?>

<?php else : ?>

	<?php get_template_part( 'no-results', 'index'); ?>

<?php endif; ?>

<?php wp_reset_postdata(); ?>

</div>