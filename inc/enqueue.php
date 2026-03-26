<?php
/**
 * Enqueue scripts and styles.
 *
 * @package Child_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue theme styles.
 *
 * @return void
 */
function my_child_theme_enqueue_styles() {
	wp_enqueue_style(
		'parent-style',
		get_parent_theme_file_uri( 'style.css' ),
		array(),
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_style(
		'child-style',
		get_stylesheet_directory_uri() . '/assets/css/custom.css',
		array( 'parent-style' ),
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_script(
		'api-script',
		get_stylesheet_directory_uri() . '/assets/js/api.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	wp_localize_script(
		'api-script',
		'apiSettings',
		array(
			'root'  => esc_url_raw( rest_url() ),
			'nonce' => wp_create_nonce( 'wp_rest' ),
		)
	);
}

add_action( 'wp_enqueue_scripts', 'my_child_theme_enqueue_styles' );

/**
 * Add defer to script.
 *
 * @param string $tag    The script tag.
 * @param string $handle The script handle.
 * @return string
 */
function add_defer_to_script( $tag, $handle ) {

	if ( is_admin() ) {
		return $tag;
	}

	if ( 'api-script' === $handle ) {
		return str_replace( ' src', ' defer src', $tag );
	}

	return $tag;
}

add_filter( 'script_loader_tag', 'add_defer_to_script', 10, 2 );
