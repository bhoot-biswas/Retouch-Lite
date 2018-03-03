<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Retouch_Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * Functions hooked into retouch_lite_page
	 *
	 * @hooked retouch_lite_page_header [10]
	 * @hooked retouch_lite_post_thumbnail [20]
	 * @hooked retouch_lite_page_content [30]
	 */
	do_action( 'retouch_lite_page' );
	?>

</article><!-- #post-<?php the_ID(); ?> -->
