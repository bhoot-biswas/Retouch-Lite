<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Retouch_Lite
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			do_action( 'retouch_lite_single_post_before' );

			// Loads the content/*.php template.
			hybrid_get_content_template();

			/**
			 * Functions hooked into retouch_lite_single_post_after
			 *
			 * @hooked retouch_lite_post_navigation [10]
			 * @hooked retouch_lite_display_comments [20]
			 */
			do_action( 'retouch_lite_single_post_after' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
/**
 * Functions hooked into retouch_lite_sidebar
 *
 * @hooked retouch_lite_get_sidebar [10]
 */
do_action( 'retouch_lite_sidebar' );
get_footer();
