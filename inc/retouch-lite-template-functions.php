<?php
/**
 * Retouch Lite template functions.
 *
 * @package Retouch_Lite
 */

if ( ! function_exists( 'retouch_lite_display_comments' ) ) {
	/**
	 * Display comments
	 *
	 * @since  1.0.0
	 */
	function retouch_lite_display_comments() {
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	}
}

if ( ! function_exists( 'retouch_lite_credit' ) ) {
	/**
	 * Display the theme credit
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function retouch_lite_credit() {
		?>
		<div class="site-info">
			<div class="container">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'retouch-lite' ) ); ?>">
					<?php
						/* translators: %s: CMS name, i.e. WordPress. */
						printf( esc_html__( 'Proudly powered by %s', 'retouch-lite' ), 'WordPress' );
					?>
				</a>
				<span class="sep"> | </span>
				<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Theme: %1$s by %2$s.', 'retouch-lite' ), 'retouch-lite', '<a href="http://underscores.me/">Underscores.me</a>' );
				?>
			</div>
		</div><!-- .site-info -->
		<?php
	}
}

if ( ! function_exists( 'retouch_lite_site_branding' ) ) {
	/**
	 * Site branding wrapper and display
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function retouch_lite_site_branding() {
		?>
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif;
			?>
		</div><!-- .site-branding -->
		<?php
	}
}

if ( ! function_exists( 'retouch_lite_primary_navigation' ) ) {
	/**
	 * Display Primary Navigation
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function retouch_lite_primary_navigation() {
		?>
		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'retouch-lite' ); ?></button>
			<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
			?>
		</nav><!-- #site-navigation -->
		<?php
	}
}

if ( ! function_exists( 'retouch_lite_skip_links' ) ) {
	/**
	 * Skip links
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function retouch_lite_skip_links() {
		?>
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'retouch-lite' ); ?></a>
		<?php
	}
}

if ( ! function_exists( 'retouch_lite_page_header' ) ) {
	/**
	 * Display the page header
	 *
	 * @since 1.0.0
	 */
	function retouch_lite_page_header() {
		?>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<?php
	}
}

if ( ! function_exists( 'retouch_lite_page_content' ) ) {
	/**
	 * Display the post content
	 *
	 * @since 1.0.0
	 */
	function retouch_lite_page_content() {
		?>
		<div class="entry-content">
			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'retouch-lite' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		<?php
	}
}

if ( ! function_exists( 'retouch_lite_page_footer' ) ) {
	/**
	 * Display the post footer
	 *
	 * @since 1.0.0
	 */
	function retouch_lite_page_footer() {
		if ( get_edit_post_link() ) :
			?>
			<footer class="entry-footer">
				<?php
					edit_post_link(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Edit <span class="screen-reader-text">%s</span>', 'retouch-lite' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						),
						'<span class="edit-link">',
						'</span>'
					);
				?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>
		<?php
	}
}

if ( ! function_exists( 'retouch_lite_post_header' ) ) {
	/**
	 * Display the post header with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function retouch_lite_post_header() {
		?>
		<header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) :
				?>
			<div class="entry-meta">
				<?php retouch_lite_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif;
			?>
		</header><!-- .entry-header -->
		<?php
	}
}

if ( ! function_exists( 'retouch_lite_post_content' ) ) {
	/**
	 * Display the post content with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function retouch_lite_post_content() {
		?>
		<div class="entry-content">
			<?php
				the_content( sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'retouch-lite' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'retouch-lite' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		<?php
	}
}

if ( ! function_exists( 'retouch_lite_post_footer' ) ) {
	/**
	 * Display the post footer
	 *
	 * @since 1.0.0
	 */
	function retouch_lite_post_footer() {
		?>
		<footer class="entry-footer">
			<?php retouch_lite_entry_footer(); ?>
		</footer><!-- .entry-footer -->
		<?php
	}
}

if ( ! function_exists( 'retouch_lite_posts_navigation' ) ) {
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function retouch_lite_posts_navigation() {
		the_posts_navigation();
	}
}

if ( ! function_exists( 'retouch_lite_post_navigation' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function retouch_lite_post_navigation() {
		the_post_navigation();
	}
}

if ( ! function_exists( 'retouch_lite_get_sidebar' ) ) {
	/**
	 * Display sidebar
	 *
	 * @uses get_sidebar()
	 * @since 1.0.0
	 */
	function retouch_lite_get_sidebar() {
		get_sidebar();
	}
}
