<?php
/**
 * The template for displaying archive pages
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
			?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
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
