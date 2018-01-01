<?php
/**
 * Retouch Lite functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Retouch_Lite
 */

/**
 * Assign the Retouch Lite version to a var
 */
$theme                = wp_get_theme( 'retouch-lite' );
$retouch_lite_version = $theme['Version'];

$retouch_lite = (object) array(
	'version' => $retouch_lite_version,
	'main'    => require get_template_directory() . '/inc/class-retouch-lite.php',
);

// Let's roll!
retouch_lite();
