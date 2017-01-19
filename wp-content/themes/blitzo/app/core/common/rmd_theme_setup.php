<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if ( ! function_exists( 'blitzo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blitzo_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Blitzo, use a find and replace
	 * to change 'blitzo' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'blitzo', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary', 'blitzo' ),
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
	add_theme_support( 'custom-background', apply_filters( 'blitzo_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'blitzo_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blitzo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blitzo_content_width', 640 );
}
add_action( 'after_setup_theme', 'blitzo_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function blitzo_scripts() { 	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'blitzo_scripts' );
 
 

/**
 * 	Limit the number of excerpt character
 */
function wpdocs_custom_excerpt_length( $length ) { 
	return (is_home())? $length : 20; 
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );



// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');


// To remove the filtering of <p> <br> tag
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );


// add_action( 'pre_get_posts', function ( $q ) { 
//     if( !is_admin() && $q->is_main_query() && $q->is_post_type_archive( 'careers' ) ) { 
//         $q->set( 'posts_per_page', 2 ); 
//     } 
// });


