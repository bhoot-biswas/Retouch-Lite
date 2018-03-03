<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Retouch_Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * Functions hooked into retouch_lite_post
	 *
	 * @hooked retouch_lite_post_header    [10]
	 * @hooked retouch_lite_post_thumbnail [20]
	 * @hooked retouch_lite_post_content   [30]
	 * @hooked retouch_lite_post_footer    [40]
	 */
	do_action( 'retouch_lite_post' );
	?>

</article><!-- #post-<?php the_ID(); ?> -->
