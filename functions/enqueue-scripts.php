<?php
/**
 * Register Google Fonts
 */
function fleximplechildtheme_fonts_url() {
	$font_families = array();
	$font_families[] = 'Bitter:ital,wght@0,400;0,700;1,400;1,700';
	$font_families[] = 'Catamaran:ital,wght@0,400;0,600;1,400;1,600';

	$query_args = array(
		'family' => implode( '&family=', $font_families ),
		'display' => 'swap',
	);

	$fonts_url = esc_url( add_query_arg( $query_args, 'https://fonts.googleapis.com/css2' ) );
	return $fonts_url;
}

/**
 * Enqueue admin scripts.
 */
// function fleximplechildtheme_enqueue_admin_assets() {
// 	wp_enqueue_style(
// 		'theme-admin-fonts',
// 		fleximplechildtheme_fonts_url(),
// 		array(),
// 		null
// 	);

// 	if ( file_exists( get_template_directory() . '/dist/admin-script.js' ) ) {
// 		wp_enqueue_script(
// 			'theme-admin-scripts',
// 			get_template_directory_uri() . '/dist/admin-script.js',
// 			array( 'jquery' ),
// 			date( 'Ymd.His', filemtime( get_template_directory() . '/dist/admin-script.js' ) ),
// 			true
// 		);
// 	}
// }
// add_action( 'admin_enqueue_scripts', 'fleximplechildtheme_enqueue_admin_assets', 10 );

/**
 * Enqueue customizer scripts.
 */
function fleximplechildtheme_enqueue_customizer_assets() {
	if ( file_exists( get_template_directory_uri() . '/dist/customizer-script.js' ) ) {
		wp_enqueue_script(
			'theme-customizer-scripts',
			get_template_directory_uri() . '/dist/customizer-script.js',
			array( 'jquery' ),
			date( 'Ymd.His', filemtime( get_template_directory() . '/dist/customizer-script.js' ) ),
			true
		);
	}
}
add_action( 'customize_preview_init', 'fleximplechildtheme_enqueue_customizer_assets' );

/**
 * Enqueue fonts, scripts and styles.
 */
function fleximplechildtheme_enqueue_assets() {
	wp_enqueue_style(
		'theme-fonts',
		fleximplechildtheme_fonts_url(),
		array(),
		null
	);

	wp_enqueue_style(
		'theme-styles',
		get_stylesheet_directory_uri() . '/dist/style.css',
		false,
		date( 'Ymd.His', filemtime( get_stylesheet_directory() . '/dist/style.css' ) )
	);

	wp_enqueue_script(
		'theme-scripts',
		get_template_directory_uri() . '/dist/script.js',
		array( 'jquery' ),
		date( 'Ymd.His', filemtime( get_template_directory() . '/dist/script.js' ) ),
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fleximplechildtheme_enqueue_assets', 10 );

/**
 * Enqueue editor fonts and styles.
 */
function fleximplechildtheme_enqueue_editor_assets() {
	wp_enqueue_style(
		'theme-editor-fonts',
		fleximplechildtheme_fonts_url(),
		array(),
		null
	);

	wp_enqueue_style(
		'theme-editor-styles',
		get_stylesheet_directory_uri() . '/dist/editor-style.css',
		false,
		date( 'Ymd.His', filemtime( get_stylesheet_directory() . '/dist/editor-style.css' ) ),
		'all'
	);

	if ( file_exists( get_stylesheet_directory() . '/dist/editor-script.js' ) ) {
		wp_enqueue_script(
			'theme-editor-scripts',
			get_stylesheet_directory_uri() . '/dist/editor-script.js',
			array( 'wp-i18n', 'wp-blocks', 'wp-components', 'wp-data', 'wp-editor', 'wp-edit-post', 'wp-element', 'wp-plugins' ),
			date( 'Ymd.His', filemtime( get_stylesheet_directory() . '/dist/editor-script.js' ) ),
			true
		);
	}
}
add_action( 'enqueue_block_editor_assets', 'fleximplechildtheme_enqueue_editor_assets', 10 );

/**
 * Enqueue login styles.
 */
function fleximplechildtheme_enqueue_login_styles() {
	wp_enqueue_style(
		'theme-login-fonts',
		fleximplechildtheme_fonts_url(),
		array(),
		null
	);

	wp_enqueue_style(
		'theme-login-styles',
		get_stylesheet_directory_uri() . '/dist/login-style.css',
		false,
		date( 'Ymd.His', filemtime( get_stylesheet_directory() . '/dist/login-style.css' ) )
	);
}

//This loads the function above on the login page
add_action( 'login_enqueue_scripts', 'fleximplechildtheme_enqueue_login_styles' );
