<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Retouch_Lite
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();

				do_action( 'retouch_lite_page_before' );

				// Loads the content/*.php template.
				hybrid_get_content_template();

				/**
				 * Functions hooked into retouch_lite_page_after
				 *
				 * @hooked retouch_lite_display_comments [10]
				 */
				do_action( 'retouch_lite_page_after' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'retouch_lite_sidebar' );
get_footer();
