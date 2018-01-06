<?php
/**
 * The loop template file.
 *
 * Included on pages like index.php, archive.php and search.php to display a loop of posts
 * Learn more: http://codex.wordpress.org/The_Loop
 *
 * @package Retouch_Lite
 */

do_action( 'retouch_lite_loop_before' );

while ( have_posts() ) :
	the_post();

	// Loads the content/*.php template.
	hybrid_get_content_template();

endwhile;

/**
 * Functions hooked in to retouch_lite_loop_after
 *
 * @hooked retouch_lite_posts_navigation [10]
 */
do_action( 'retouch_lite_loop_after' );
