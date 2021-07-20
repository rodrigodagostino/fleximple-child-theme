<?php
/**
 * fleximplechildtheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package fleximplechildtheme
 */

if ( ! function_exists( 'fleximplechildtheme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fleximplechildtheme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on fleximplechildtheme, use a find and replace
		 * to change 'fleximplechildtheme' to the name of your theme in all the template files.
		 */
		load_child_theme_textdomain( 'fleximplechildtheme', get_stylesheet_directory() . '/languages' );

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
		// Apply hard crop to default medium image size (set in WP Settings)
		add_image_size('medium', get_option( 'medium_size_w' ), get_option( 'medium_size_h' ), true );

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
		add_theme_support( 'custom-background', apply_filters( '_s_custom_background_args', array(
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
			'header-text' => array( 'page-title', 'page-description' ),
		) );

		// Adding support for core block visual styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for custom color scheme.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Dark Blue', 'fleximplechildthemetheme' ),
				'slug'  => 'blue-dark',
				'color' => '#0073aa',
			),
			array(
				'name'  => __( 'Light Blue', 'fleximplechildthemetheme' ),
				'slug'  => 'blue-light',
				'color' => '#229fd8',
			),
			array(
				'name'  => __( 'Lighter Gray', 'fleximplechildthemetheme' ),
				'slug'  => 'gray-lighter',
				'color' => '#c3c3ce',
			),
			array(
				'name'  => __( 'Light Gray', 'fleximplechildthemetheme' ),
				'slug'  => 'gray-light',
				'color' => '#86889d',
			),
			array(
				'name'  => __( 'Gray', 'fleximplechildthemetheme' ),
				'slug'  => 'gray',
				'color' => '#686a84',
			),
			array(
				'name'  => __( 'Dark Gray', 'fleximplechildthemetheme' ),
				'slug'  => 'gray-dark',
				'color' => '#53556a',
			),
			array(
				'name'  => __( 'Darker Gray', 'fleximplechildthemetheme' ),
				'slug'  => 'gray-darker',
				'color' => '#2a2a35',
			),
		) );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'fleximplechildtheme_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fleximplechildtheme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fleximplechildtheme_content_width', 910 );
}
add_action( 'after_setup_theme', 'fleximplechildtheme_content_width', 0 );

// Register scripts and stylesheets.
require get_stylesheet_directory() . '/functions/enqueue-scripts.php';
