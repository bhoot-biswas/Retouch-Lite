<?php
/**
 * Retouch Lite class
 *
 * @package Retouch_Lite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Retouch_Lite' ) ) {

	/**
	 * Singleton class for launching the theme and setup configuration.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	class Retouch_Lite {

		/**
		 * Returns the instance.
		 */
		public static function get_instance() {

			static $instance = null;

			if ( is_null( $instance ) ) {
				$instance = new self();
				$instance->setup_actions();
				$instance->includes();
			}

			return $instance;
		}

		/**
		 * Constructor method.
		 */
		private function __construct() {}

		/**
		 * Sets up initial actions.
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function setup_actions() {
			// Theme setup.
			add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
			add_action( 'after_setup_theme', array( $this, 'content_width' ), 0 );

			// Register widgets.
			add_action( 'widgets_init', array( $this, 'widgets_init' ) );

			// Register scripts, styles, and fonts.
			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
		}

		/**
		 * Loads include and admin files for the plugin.
		 */
		private function includes() {
			/**
			 * Implement the Custom Header feature.
			 */
			require get_template_directory() . '/inc/custom-header.php';

			/**
			 * Custom template tags for this theme.
			 */
			require get_template_directory() . '/inc/template-tags.php';

			/**
			 * Functions which enhance the theme by hooking into WordPress.
			 */
			require get_template_directory() . '/inc/template-functions.php';

			/**
			 * Customizer additions.
			 */
			require get_template_directory() . '/inc/customizer.php';

			/**
			 * Load Jetpack compatibility file.
			 */
			if ( defined( 'JETPACK__VERSION' ) ) {
				require get_template_directory() . '/inc/jetpack.php';
			}

			/**
			 * Load WooCommerce compatibility file.
			 */
			if ( class_exists( 'WooCommerce' ) ) {
				require get_template_directory() . '/inc/woocommerce.php';
			}
		}

		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 */
		public function theme_setup() {
			/*
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 * If you're building a theme based on Retouch Lite, use a find and replace
			 * to change 'retouch-lite' to the name of your theme in all the template files.
			 */
			load_theme_textdomain( 'retouch-lite', get_template_directory() . '/languages' );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			/*
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
			 */
			add_theme_support( 'title-tag' );

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
			 */
			add_theme_support( 'post-thumbnails' );

			// This theme uses wp_nav_menu() in one location.
			register_nav_menus( array(
				'menu-1' => esc_html__( 'Primary', 'retouch-lite' ),
			) );

			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );

			// Set up the WordPress core custom background feature.
			add_theme_support( 'custom-background', apply_filters( 'retouch_lite_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			) ) );

			// Add theme support for selective refresh for widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );

			/**
			 * Add support for core custom logo.
			 *
			 * @link https://codex.wordpress.org/Theme_Logo
			 */
			add_theme_support( 'custom-logo', array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			) );
		}

		/**
		 * Set the content width in pixels, based on the theme's design and stylesheet.
		 *
		 * Priority 0 to make it available to lower priority callbacks.
		 *
		 * @global int $content_width
		 */
		public function content_width() {
			$GLOBALS['content_width'] = apply_filters( 'retouch_lite_content_width', 640 );
		}

		/**
		 * Register widget area.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		public function widgets_init() {
			register_sidebar( array(
				'name'          => esc_html__( 'Sidebar', 'retouch-lite' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here.', 'retouch-lite' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
		}

		/**
		 * Enqueue scripts and styles.
		 */
		public function scripts() {
			wp_enqueue_style( 'retouch-lite-style', get_stylesheet_uri() );

			wp_enqueue_script( 'retouch-lite-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

			wp_enqueue_script( 'retouch-lite-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}
	}
}

/**
 * Gets the instance of the `Retouch_Lite` class.  This function is useful for quickly grabbing data
 * used throughout the theme.
 */
function retouch_lite() {
	return Retouch_Lite::get_instance();
}
