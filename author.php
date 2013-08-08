<?php

$author = get_user_by('slug', get_query_var('author_name'));

//if( get_the_author_meta('description', $author->ID) != '' && is_single() ) :
	echo '<div class="theme-author">';
	echo '<div class="avatar alignleft">' . get_avatar($author->user_email, 64) . '</div>';
	echo '<h6>' . sprintf(__('ABOUT %s', THEME_SLUG), get_the_author()) . '</h6>';
	echo '<p>' . do_shortcode( get_the_author_meta('description', $author->ID)) . '</p>';
	echo '</div>';
//endif;

echo '<div class="shortcode-divider invisible"></div>';
echo '<h3>' . sprintf(__('Entries by %s', THEME_SLUG), $author->display_name) . '</h3>';
echo '<div class="title-row"></div>';
echo '<div class="shortcode-divider invisible"></div>';
echo '<div class="shortcode-divider invisible"></div>';

get_template_part('loop', 'excerpts');

?>