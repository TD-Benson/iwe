<?php
/*
Template Name: Blank Page Template
*/

?>
<link rel="stylesheet" type="text/css" href="<?php echo THEME_URI; ?>/css/blank-page.css" media="screen" />
<?php if (have_posts()) : while (have_posts()) : the_post();?>
<?php the_content(); ?>
<?php endwhile; endif; ?>

<script type="text/javascript">

	jQuery(window).resize(function() {
		ctrMainContent();
	});

	jQuery(window).load(function () {
		removeHeadFootSide();
		ctrMainContent();
		jQuery('#container').css('display', 'block');

	});
	function removeHeadFootSide()
	{
		jQuery('#header').remove();
		jQuery('#theme-custom-content').remove();
		jQuery('#footer').remove();
		jQuery('#sidebar').remove();
	}

</script>
