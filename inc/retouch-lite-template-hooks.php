<?php
/**
 * Retouch Lite hooks
 *
 * @package Retouch_Lite
 */

/**
 * Header
 *
 * @see  retouch_lite_skip_links()
 * @see  retouch_lite_site_branding()
 * @see  retouch_lite_primary_navigation()
 */
add_action( 'retouch_lite_before_header', 'retouch_lite_skip_links', 10 );
add_action( 'retouch_lite_header', 'retouch_lite_primary_navigation', 10 );
add_action( 'retouch_lite_primary_navigation', 'retouch_lite_navbar_brand', 10 );
add_action( 'retouch_lite_primary_navigation', 'retouch_lite_navbar_toggler', 20 );
add_action( 'retouch_lite_primary_navigation', 'retouch_lite_navbar_collapse', 30 );
add_action( 'retouch_lite_navbar_collapse', 'retouch_lite_primary_menu', 10 );

/**
 * Posts
 *
 * @see  retouch_lite_post_header()
 * @see  retouch_lite_post_thumbnail()
 * @see  retouch_lite_post_content()
 * @see  retouch_lite_post_footer()
 */
add_action( 'retouch_lite_post', 'retouch_lite_post_header', 10 );
add_action( 'retouch_lite_post', 'retouch_lite_post_thumbnail', 20 );
add_action( 'retouch_lite_post', 'retouch_lite_post_content', 30 );
add_action( 'retouch_lite_post', 'retouch_lite_post_footer', 40 );

/**
 * Pages
 *
 * @see  retouch_lite_page_header()
 * @see  retouch_lite_post_thumbnail()
 * @see  retouch_lite_page_content()
 */
add_action( 'retouch_lite_page', 'retouch_lite_page_header', 10 );
add_action( 'retouch_lite_page', 'retouch_lite_post_thumbnail', 20 );
add_action( 'retouch_lite_page', 'retouch_lite_page_content', 30 );

/**
 * Navigation
 *
 * @see  retouch_lite_posts_navigation()
 * @see  retouch_lite_post_navigation()
 */
add_action( 'retouch_lite_loop_after', 'retouch_lite_posts_navigation', 10 );
add_action( 'retouch_lite_single_post_after', 'retouch_lite_post_navigation', 10 );

/**
 * Comments
 *
 * @see  retouch_lite_display_comments()
 */
add_action( 'retouch_lite_single_post_after', 'retouch_lite_display_comments', 20 );
add_action( 'retouch_lite_page_after', 'retouch_lite_display_comments', 10 );

/**
 * Sidebar
 *
 * @see  retouch_lite_get_sidebar()
 */
add_action( 'retouch_lite_sidebar', 'retouch_lite_get_sidebar', 10 );

/**
 * Footer
 *
 * @see  retouch_lite_credit()
 */
add_action( 'retouch_lite_footer', 'retouch_lite_credit', 10 );
