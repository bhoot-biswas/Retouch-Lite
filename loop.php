<?php
/**
 * The loop template file.
 *
 * Included on pages like index.php and archive.php to display a loop of posts
 * Learn more: http://codex.wordpress.org/The_Loop
 *
 * @package Retouch_Lite
 */

do_action( 'retouch_lite_loop_before' );

while ( have_posts() ) :

	the_post();

	/*
	 * Include the Post-Type-specific template for the content.
	 * If you want to override this in a child theme, then include a file
	 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
	 */
	get_template_part( 'template-parts/content', get_post_type() );

endwhile;

/**
 * Functions hooked in to retouch_lite_loop_after
 *
 * @hooked retouch_lite_posts_navigation [10]
 */
do_action( 'retouch_lite_loop_after' );
