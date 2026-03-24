<?php
/**
 * Customizer settings.
 *
 * @package Child_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register customizer settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function my_child_customize_register( $wp_customize ) {

	// Add section.
	$wp_customize->add_section(
		'my_theme_section',
		array(
			'title'    => 'My Theme Settings',
			'priority' => 30,
		)
	);

	// Add setting.
	$wp_customize->add_setting(
		'header_text',
		array(
			'default' => 'Welcome to My Site',
		)
	);

	// Add control.
	$wp_customize->add_control(
		'header_text',
		array(
			'label'   => 'Header Text',
			'section' => 'my_theme_section',
			'type'    => 'text',
		)
	);
}

add_action( 'customize_register', 'my_child_customize_register' );
