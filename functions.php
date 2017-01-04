<?php

if ( ! function_exists( 'fifteen_issues_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function fifteen_issues_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyfifteen
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'twentyfifteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'fifteen-issues', get_stylesheet_directory() . '/languages' );

}
endif; // fifteen_issues_setup
add_action( 'init', 'fifteen_issues_setup' );


if ( ! function_exists( 'fifteen_issues_styles' ) ) :
/**
 * Enqueues the theme stylesheet files.
 */
function fifteen_issues_styles() {
    // Workaround to include twentyfifteen-style just once, before including fifteen-issues-style
    wp_deregister_style( 'twentyfifteen-style' );
    wp_enqueue_style( 'twentyfifteen-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'fifteen-issues-style', get_stylesheet_uri(), array('twentyfifteen-style') );
}
endif; // fifteen_issues_styles
add_action( 'wp_enqueue_scripts', 'fifteen_issues_styles', PHP_INT_MAX);


if ( ! function_exists( 'fifteen_issues_thumbnail_sizes' ) ) :
/**
 * Adds custom thumbnail size for issue covers
 */
function fifteen_issues_thumbnail_sizes() {
	add_image_size( 'fifteen-issues-issue-cover', 220, 440, false );
}
endif; // fifteen_issues_thumbnail_sizes
add_action( 'after_setup_theme', 'fifteen_issues_thumbnail_sizes' );

/**
 * Registers additional widget area.
 */
function fifteen_issues_widgets_init() {
        register_sidebar( array(
                'name'          => __( 'Top Widget Area', 'fifteen-issues' ),
                'id'            => 'sidebar-2',
                'description'   => __( 'Add widgets here to appear at the top of your sidebar.', 'fifteen-issues' ),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
        ) );
}
add_action( 'widgets_init', 'fifteen_issues_widgets_init' );

/**
 * Custom template tags for this theme.
 *
 * @since Twenty Fifteen 1.0
 */
require get_stylesheet_directory() . '/inc/template-tags.php';
