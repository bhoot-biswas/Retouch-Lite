<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Retouch_Lite
 */

?>

	</div><!-- #content -->

	<?php do_action( 'retouch_lite_before_footer' ); ?>

	<footer id="colophon" class="site-footer">

		<?php
		/**
		 * Functions hooked into retouch_lite_footer
		 *
		 * @hooked retouch_lite_credit [10]
		 */
		do_action( 'retouch_lite_footer' );
		?>

	</footer><!-- #colophon -->

	<?php do_action( 'retouch_lite_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
