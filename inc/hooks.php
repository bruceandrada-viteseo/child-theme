<?php
/**
 * Hooks file.
 *
 * @package Child_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Theme setup (nav + supports).
/**
 * Set up theme defaults and register features.
 *
 * @return void
 */
function my_child_theme_setup() {

	// Register navigation menu.
	register_nav_menus(
		array(
			'primary' => 'Primary Nav',
		)
	);

	// Add theme supports.
	add_theme_support( 'custom-logo' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'gallery',
			'caption',
		)
	);
}
add_action( 'after_setup_theme', 'my_child_theme_setup' );
