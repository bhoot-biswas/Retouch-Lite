<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Retouch_Lite
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.me/support/social-menu/
 * See: https://jetpack.com/support/content-options/
 */
function retouch_lite_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'retouch_lite_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Social Menu.
	add_theme_support( 'jetpack-social-menu' );

	// Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'post-details'    => array(
			'stylesheet' => 'retouch-lite-style',
			'date'       => '.posted-on',
			'categories' => '.cat-links',
			'tags'       => '.tags-links',
			'author'     => '.byline',
			'comment'    => '.comments-link',
		),
		'featured-images' => array(
			'archive' => true,
			'post'    => true,
			'page'    => true,
		),
	) );
}
add_action( 'after_setup_theme', 'retouch_lite_jetpack_setup' );

/**
 * Return early if Social Menu is not available.
 */
function retouch_lite_social_menu() {
	if ( ! function_exists( 'jetpack_social_menu' ) ) {
		return;
	} else {
		jetpack_social_menu();
	}
}

/**
 * Custom render function for Infinite Scroll.
 */
function retouch_lite_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}
