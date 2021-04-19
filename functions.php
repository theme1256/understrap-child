<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

// Register and load the widgets
require_once get_stylesheet_directory() . "/custom/tab-menu-widget.php";
require_once get_stylesheet_directory() . "/custom/footer-menu-widget.php";
require_once get_stylesheet_directory() . "/custom/hero-slide-widget.php";
require_once get_stylesheet_directory() . "/custom/blockquote-widget.php";
function understrap_child_load_widget() {
    register_sidebar(array(
        'name'          => __( 'Footer hero', 'understrap-child' ),
        'id'            => 'footer-hero',
        'description'   => __( 'Add widgets here to appear in your footer area.', 'understrap-child' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    register_widget( 'bs_tab_menu_widget' );
    register_widget( 'big_footer_menu_widget' );
    register_widget( 'hero_slide_widget' );
    register_widget( 'blockquote_widget' );
}
add_action( 'widgets_init', 'understrap_child_load_widget' );