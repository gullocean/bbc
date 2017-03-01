<?php

/**
 * bbc functions and definitions.
 *
 * @package bbc
 */
if ( ! function_exists( 'bbc_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bbc_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Add support for the custom logo functionality
		 */
		add_theme_support( 'custom-logo', array(
			'height'     => 55,
			'width'      => 135,
			'flex-width' => true,
		) );

		add_theme_support( 'custom-header', apply_filters( 'bbc_custom_header_args', array(
			'default-image'      => '',
			'default-text-color' => '000000',
			'width'              => 1900,
			'height'             => 225,
			'flex-width'         => true
		) ) );


		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			                    'primary'     => esc_html__( 'Primary', 'BBC' ),
			                    'social-menu' => esc_html__( 'Social Menu', 'BBC' ),
			                    'useful-links' => esc_html__( 'Useful Links', 'BBC' ),
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
		add_theme_support( 'custom-background', apply_filters( 'bbc_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'bbc-full', 1110, 530, true );
		add_image_size( 'bbc-featured', 730, 350, true );
		add_image_size( 'bbc-grid', 350, 300, true );

		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'bbc_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bbc_widgets_init() {
	register_sidebar( array(
		                  'id'            => 'sidebar-1',
		                  'name'          => __( 'Sidebar', 'bbc' ),
		                  'before_widget' => '<div id="%1$s" class="widget %2$s">',
		                  'after_widget'  => '</div>',
		                  'before_title'  => '<h2 class="widget-title">',
		                  'after_title'   => '</h2>',
	                  ) );

	register_sidebar( array(
		                  'id'            => 'sidebar-home',
		                  'name'          => __( 'Homepage', 'bbc' ),
		                  'before_widget' => '<div id="%1$s" class="widget %2$s">',
		                  'after_widget'  => '</div>',
		                  'before_title'  => '<h2 class="widget-title">',
		                  'after_title'   => '</h2>',
	                  ) );

}

add_action( 'widgets_init', 'bbc_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bbc_scripts() {
	// Add Bootstrap default CSS
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.min.css' );

	// Add Font Awesome stylesheet
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/inc/css/font-awesome.min.css' );

	// Add Google Fonts
	wp_enqueue_style( 'bbc-fonts', '//fonts.googleapis.com/css?family=Bree+Serif' );


	//Add custom theme css
	wp_enqueue_style( 'bbc-style', get_stylesheet_uri() );

	wp_enqueue_script( 'bbc-scripts', get_template_directory_uri() . '/js/bbc-scripts.js', array( 'jquery' ), '20170226', true );

	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '20170301', true );
}

add_action( 'wp_enqueue_scripts', 'bbc_scripts' );


// load custom search template for only search function.
function wpse_load_custom_search_template(){
    if( isset($_REQUEST['search']) == 'advanced' ) {
        require('search.php');
        die();
    }
}
add_action('init','wpse_load_custom_search_template');

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/**
 * Load custom nav walker
 */
require get_template_directory() . '/inc/navwalker.php';

/**
 * Load Social Navition
 */
require get_template_directory() . '/inc/socialnav.php';

/**
 * Load Social Navition
 */
require get_template_directory() . '/inc/useful-links.php';