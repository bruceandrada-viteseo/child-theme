<?php
/**
 * Register custom REST API routes.
 *
 * @package Child_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Check if user can access posts endpoint.
 *
 * @param WP_REST_Request $request Request object.
 * @return bool
 */
function ct_check_permissions( $request ) {
	// Allow public read.
	if ( $request->get_method() === 'GET' ) {
		return true;
	}

	return is_user_logged_in();
}

/**
 * Register custom posts endpoint.
 *
 * @return void
 */
function ct_register_routes() {
	register_rest_route(
		'vseo/v2',
		'/posts',
		array(
			'methods'             => 'GET',
			'callback'            => 'ct_custom_posts',
			'permission_callback' => 'ct_check_permissions',
			'args'                => array(
				'per_page' => array(
					'validate_callback' => function ( $param ) {
						return is_numeric( $param );
					},
				),
				'orderby'  => array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				'order'    => array(
					'validate_callback' => function ( $param ) {
						return in_array( strtoupper( $param ), array( 'ASC', 'DESC' ), true );
					},
				),
				'slug'     => array(
					'sanitize_callback' => 'sanitize_title',
				),
			),
		)
	);
}

add_action( 'rest_api_init', 'ct_register_routes' );
