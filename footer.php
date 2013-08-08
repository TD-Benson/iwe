<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #wrapper, #container div and all content after
 *
 * @package WordPress
 * @subpackage TDFramework
 * @since framework 1.0
 */
?>

    		</div>
		</div><!-- ends here #wrapper -->
	</div>
	<footer id="footer" class="theme-row clearfix">
		<div class="footer-mainblk">
			<div class="theme-wrap center-pnl">
				<?php core_theme_hook_footer_content(); ?>
				
			</div>
		</div>

	</footer><!-- ends here #footer -->


</div><!-- ends here #container -->
</div>
</div>
<?php wp_footer(); ?>

</body>
</html>