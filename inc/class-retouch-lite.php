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
				$instance->includes();
				$instance->setup_actions();
			}

			return $instance;
		}

		/**
		 * Constructor method.
		 */
		private function __construct() {}

		/**
		 * Loads include and admin files for the plugin.
		 */
		private function includes() {
			// Launch the Hybrid Core framework.
			require get_template_directory() . '/hybrid-core/hybrid.php';

			// Implement the Custom Header feature.
			require get_template_directory() . '/inc/custom-header.php';
			// Custom template tags for this theme.
			require get_template_directory() . '/inc/template-tags.php';
			// Functions which enhance the theme by hooking into WordPress.
			require get_template_directory() . '/inc/template-functions.php';
			// Load template hooks.
			require get_template_directory() . '/inc/template-hooks.php';
			// Customizer additions.
			require get_template_directory() . '/inc/customizer.php';
			// Extras.
			require get_template_directory() . '/inc/extras.php';

			// Load Jetpack compatibility file.
			if ( defined( 'JETPACK__VERSION' ) ) {
				require get_template_directory() . '/inc/jetpack.php';
			}

			// Load WooCommerce compatibility file.
			if ( class_exists( 'WooCommerce' ) ) {
				require get_template_directory() . '/inc/woocommerce.php';
			}
		}

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

			// Register widgets.
			add_action( 'widgets_init', array( $this, 'widgets_init' ) );

			// Register custom layouts.
			add_action( 'hybrid_register_layouts', array( $this, 'register_layouts' ) );

			// Register scripts, styles, and fonts.
			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );
		}

		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 */
		public function theme_setup() {
			// Theme layouts.
			add_theme_support( 'theme-layouts', array( 'default' => is_rtl() ? '2c-r' : '2c-l' ) );

			// Enable custom template hierarchy.
			add_theme_support( 'hybrid-core-template-hierarchy' );

			// The best thumbnail/image script ever.
			add_theme_support( 'get-the-image' );

			// Breadcrumbs. Yay!
			add_theme_support( 'breadcrumb-trail' );

			// Nicer [gallery] shortcode implementation.
			add_theme_support( 'cleaner-gallery' );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			// This theme uses wp_nav_menu() in one location.
			register_nav_menus( array(
				'menu-1' => esc_html__( 'Primary', 'retouch-lite' ),
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

			// Handle content width for embeds and images.
			hybrid_set_content_width( 1280 );
		}

		/**
		 * Register widget area.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		public function widgets_init() {
			$sidebar_args['sidebar'] = array(
				'id'          => 'sidebar-1',
				'name'        => esc_html__( 'Sidebar', 'retouch-lite' ),
				'description' => esc_html__( 'Add widgets here.', 'retouch-lite' ),
			);

			$rows    = intval( apply_filters( 'retouch_lite_footer_widget_rows', 1 ) );
			$regions = intval( apply_filters( 'retouch_lite_footer_widget_columns', 4 ) );

			for ( $row = 1; $row <= $rows; $row++ ) {
				for ( $region = 1; $region <= $regions; $region++ ) {
					$footer_n = $region + $regions * ( $row - 1 ); // Defines footer sidebar ID.
					$footer   = sprintf( 'footer_%d', $footer_n );

					if ( 1 === $rows ) {
						/* translators: 1: column id. */
						$footer_region_name = sprintf( esc_html__( 'Footer Column %1$d', 'retouch-lite' ), $region );
						/* translators: 1: column id. */
						$footer_region_description = sprintf( esc_html__( 'Widgets added here will appear in column %1$d of the footer.', 'retouch-lite' ), $region );
					} else {
						/* translators: 1: row id, 2: column id. */
						$footer_region_name = sprintf( esc_html__( 'Footer Row %1$d - Column %2$d', 'retouch-lite' ), $row, $region );
						/* translators: 1: row id, 2: column id. */
						$footer_region_description = sprintf( esc_html__( 'Widgets added here will appear in column %1$d of footer row %2$d.', 'retouch-lite' ), $region, $row );
					}

					$sidebar_args[ $footer ] = array(
						'id'          => sprintf( 'footer-%d', $footer_n ),
						'name'        => $footer_region_name,
						'description' => $footer_region_description,
					);
				}
			}

			$sidebar_args = apply_filters( 'retouch_lite_sidebar_args', $sidebar_args );

			foreach ( $sidebar_args as $sidebar => $args ) {
				$widget_tags = array(
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<span class="gamma widget-title">',
					'after_title'   => '</span>',
				);

				/**
				 * Dynamically generated filter hooks. Allow changing widget wrapper and title tags. See the list below.
				 *
				 * 'retouch_lite_sidebar_widget_tags'
				 *
				 * 'retouch_lite_footer_1_widget_tags'
				 * 'retouch_lite_footer_2_widget_tags'
				 * 'retouch_lite_footer_3_widget_tags'
				 * 'retouch_lite_footer_4_widget_tags'
				 */
				$filter_hook = sprintf( 'retouch_lite_%s_widget_tags', $sidebar );
				$widget_tags = apply_filters( $filter_hook, $widget_tags );

				if ( is_array( $widget_tags ) ) {
					register_sidebar( $args + $widget_tags );
				}
			}
		}

		/**
		 * Registers layouts.
		 */
		public function register_layouts() {
			hybrid_register_layout( '1c',
				array(
					'label' => esc_html__( '1 Column', 'retouch-lite' ),
					'image' => '%s/assets/images/layouts/1c.png',
				)
			);

			hybrid_register_layout( '2c-l',
				array(
					'label' => esc_html__( '2 Columns: Content / Sidebar', 'retouch-lite' ),
					'image' => '%s/assets/images/layouts/2c-l.png',
				)
			);

			hybrid_register_layout( '2c-r',
				array(
					'label' => esc_html__( '2 Columns: Sidebar / Content', 'retouch-lite' ),
					'image' => '%s/assets/images/layouts/2c-r.png',
				)
			);
		}

		/**
		 * Enqueue scripts.
		 */
		public function scripts() {
			// Load fremework and vendors.
			wp_enqueue_script( 'retouch-lite-vendors', get_template_directory_uri() . '/assets/js/vendors.js', array( 'jquery' ), '20151215', true );
			wp_enqueue_script( 'retouch-lite-main', get_template_directory_uri() . '/assets/js/main.js', array(), '20151215', true );

			wp_enqueue_script( 'retouch-lite-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );
			wp_enqueue_script( 'retouch-lite-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

		/**
		 * Enqueue styles.
		 */
		public function styles() {
			// Add custom fonts, used in the main stylesheet.
			wp_enqueue_style( 'retouch-lite-fonts', retouch_lite_fonts_url(), array(), null );

			// Load gallery style if 'cleaner-gallery' is active.
			if ( current_theme_supports( 'cleaner-gallery' ) ) {
				wp_enqueue_style( 'hybrid-gallery' );
			}

			// Load parent theme stylesheet if child theme is active.
			if ( is_child_theme() ) {
				wp_enqueue_style( 'hybrid-parent' );
			}

			// Load active theme stylesheet.
			wp_enqueue_style( 'hybrid-style' );
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
