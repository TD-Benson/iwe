<?php


if ( core_options_get('meta') ) :

	// if there is "Biographical Info", then display the post author
	if( get_the_author_meta('description') != '' && is_single() ) :
		echo '<div class="theme-author">';
		echo '<div class="description">';

		echo '<h3>' . sprintf(__('ABOUT %s', THEME_SLUG), get_the_author()) . '</h3>';
		echo '<div class="avatar">' . get_avatar(get_the_author_meta('ID'), 64) . '</div>';
		echo '<p>' . do_shortcode(get_the_author_meta('description')) . '</p>';

		echo '<p>' . __('View all posts by', THEME_SLUG) . ' ';
		the_author_posts_link();
		echo '</p>';

		echo '</div>';

		// List other posts by this author --- Removed
		//echo '<div class="posts">';
//		echo '<h6>' . sprintf(__('MORE POSTS BY %s', THEME_SLUG), get_the_author()) . '</h6>';
//
//		$author_posts = get_posts(array(
//		    'numberposts'     => 5,
//		    'offset'          => 0,
//		    'orderby'         => 'post_date',
//		    'order'           => 'DESC',
//		    'post_type'       => 'post',
//		    'post_status'     => 'publish',
//		    'author'          => get_the_author_meta('ID'),
//		));
//
//		echo '<ul>';
//		foreach ($author_posts as $author_post) {
//			echo '<li><i class="icon-angle-right"></i>  <a href="' . get_permalink($author_post->ID) . '">' . $author_post->post_title . '</a></li>';
//		}
//		echo '</ul>';
//		echo '</div>';

		echo '<div class="clear"></div>';

		echo '</div>';

	endif;



	// Related posts
	if (is_single()) :
		$tags = wp_get_post_tags($post->ID);
		$cats = wp_get_post_categories($post->ID);

		if ($tags || $cats) :
			// Construct array of just tag slugs
			$new_tags = array();
			foreach ($tags as $tag)
				$new_tags[] = $tag->slug;

			// Query related posts
			$related_posts = get_posts(array(
				'tag_slug__in' => $new_tags,
				'category__in' => $cats,
				'post__not_in' => array($post->ID),
				'numberposts' => 6,
				'order' => 'ASC',
				'orderby' => 'rand',
			));

			if ($related_posts) :
				$items = '';
				foreach ($related_posts as $related_post) :
					if (!has_post_thumbnail($related_post->ID))
						continue;

					$thumb_id = get_post_thumbnail_id($related_post->ID);
					$post_image = wp_get_attachment_image_src($thumb_id, 'post-excerpt-small');
					$alt_text = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
					$icon = core_theme_get_post_format();
					if ($post_image[0] != '') :
					$items .= '
					<li class="post">
						<a href="' . get_permalink($related_post->ID) . '" rel="bookmark" title="' . $related_post->post_title . '">
						<img src="' . $post_image[0] . '" class="thumbnail" alt="' . $related_post->post_title . '">
						<span class="icon"><i class="' . $icon . '"></i></span>
						</a>
					</li>';
					endif;
				endforeach;

				if ($items != '') :
					echo '<div class="related-posts"><h3 class="header">'. __('You may also like', THEME_SLUG).'</h3>';
					echo '<div class="flexslider">';
					echo '<ul class="slides">';
					echo $items;
					echo '</ul>';
					echo '</div></div>';
				?>

				<script type="text/javascript">
					jQuery(window).load(function() {
						// tiny helper function to add breakpoints
						function getThumbSize() {
							return (window.innerWidth < 600) ? 110 :
						           (window.innerWidth < 900) ? 340 : 460;
						}

						jQuery(".flexslider").flexslider({
							animation: "slide",
							animationLoop: false,
							controlNav: false,
							prevText: "<i class=icon-chevron-left></i>",
							nextText: "<i class=icon-chevron-right></i>",
							itemWidth: getThumbSize(),
							maxItems: 2
						});
					});
				</script>

				<?php
				endif;
			endif;
		endif;
	endif;


endif;

?>