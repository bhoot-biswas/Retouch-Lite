<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Retouch Lite
 */

/**
 * Add featured image as background image.
 */
function retouch_lite_background_image() {

	if ( 'post' === get_post_type() ) {
		$image = retouch_lite_get_attachment_image_src( get_the_ID(), get_post_thumbnail_id( get_the_ID() ), 'post-thumbnail' );
	} else {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'post-thumbnail' );
		$image = $image[0];
	}

	if ( ! $image ) {
		return;
	}

	printf( ' style="background-image: url(\'%s\');"', esc_url( $image ) );
}


/**
 * Custom function to get the URL of a post thumbnail;
 * If Jetpack is not available, fall back to wp_get_attachment_image_src()
 *
 * @param  [type] $post_id           [description].
 * @param  [type] $post_thumbnail_id [description].
 * @param  [type] $size              [description].
 * @return [type]                    [description]
 */
function retouch_lite_get_attachment_image_src( $post_id, $post_thumbnail_id, $size ) {
	if ( function_exists( 'jetpack_featured_images_fallback_get_image_src' ) ) {
		return jetpack_featured_images_fallback_get_image_src( $post_id, $post_thumbnail_id, $size );
	} else {
		$attachment = wp_get_attachment_image_src( $post_thumbnail_id, $size ); // Attachment array.
		$url        = $attachment[0]; // Attachment URL.
		return $url;
	}
}

/**
 * Custom function to check for a post thumbnail;
 * If Jetpack is not available, fall back to has_post_thumbnail()
 *
 * @param  [type] $post [description].
 * @return boolean       [description]
 */
function retouch_lite_has_post_thumbnail( $post = null ) {
	if ( function_exists( 'jetpack_has_featured_image' ) ) {
		return jetpack_has_featured_image( $post );
	} else {
		return has_post_thumbnail( $post );
	}
}

/**
 * Register custom fonts.
 */
function retouch_lite_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'retouch-lite' ) ) {
		$fonts[] = 'Roboto:100,300,400,500,700,900';
	}

	/* translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'retouch-lite' ) ) {
		$fonts[] = 'Poppins:100,200,300,400,500,600,700,800,900';
	}

	/* translators: If there are characters in your language that are not supported by Material Icons, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Material Icons font: on or off', 'retouch-lite' ) ) {
		$fonts[] = 'Material Icons';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => rawurlencode( implode( '|', $fonts ) ),
			'subset' => rawurlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
