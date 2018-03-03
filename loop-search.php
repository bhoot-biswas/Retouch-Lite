<?php
/**
 * The loop template file.
 *
 * Included on pages like search.php to display a loop of posts
 * Learn more: http://codex.wordpress.org/The_Loop
 *
 * @package Retouch_Lite
 */

do_action( 'retouch_lite_loop_before' );

while ( have_posts() ) :

	the_post();

	/**
	 * Run the loop for the search to output the results.
	 * If you want to overload this in a child theme then include a file
	 * called content-search.php and that will be used instead.
	 */
	get_template_part( 'template-parts/content', 'search' );

endwhile;

/**
 * Functions hooked in to retouch_lite_loop_after
 *
 * @hooked retouch_lite_posts_navigation [10]
 */
do_action( 'retouch_lite_loop_after' );
