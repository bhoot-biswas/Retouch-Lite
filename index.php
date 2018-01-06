<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Retouch_Lite
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			get_template_part( 'loop' );

		else :

			// Loads the content/error.php template.
			locate_template( array( 'content/error.php' ), true );

		endif;
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
