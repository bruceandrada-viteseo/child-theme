<?php
/**
 * REST API callback functions.
 *
 * @package Child_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get filtered posts.
 *
 * @param WP_REST_Request $request Request object.
 * @return WP_REST_Response
 */
function ct_custom_posts( $request ) {
	$per_page = $request->get_param( 'per_page' ) ? intval( $request->get_param( 'per_page' ) ) : 5;
	$orderby  = $request->get_param( 'orderby' ) ? sanitize_text_field( $request->get_param( 'orderby' ) ) : 'date';
	$order    = $request->get_param( 'order' ) ? strtoupper( sanitize_text_field( $request->get_param( 'order' ) ) ) : 'DESC';
	$slug     = $request->get_param( 'slug' ) ? sanitize_title( $request->get_param( 'slug' ) ) : '';

	// Set Cache key request params.

	$cache_key = 'ct_post_' . md5( wp_json_encode( $request->get_params() ) );

	$data = get_transient( $cache_key );

	// ✅ CACHE HIT
	if ( false !== $data ) {
		return new WP_REST_Response(
			array(
				'data'   => $data,
				'cached' => true,
			),
			200
		);
	}

	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => intval( $per_page ),
		'orderby'        => $orderby,
		'order'          => $order,
	);

	if ( $slug ) {
		$args['name'] = $slug;
	}

	// CACHE MISS → query.
	$query = new WP_Query( $args );
	$data  = array();

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();

			$data[] = array(
				'id'    => get_the_ID(),
				'title' => get_the_title(),
				'slug'  => get_post_field( 'post_name' ),
				'link'  => get_permalink(),
			);
		}
	}

	wp_reset_postdata();

	// Set Cache for 12 hours.

	set_transient( $cache_key, $data, 12 * HOUR_IN_SECONDS );

	if ( empty( $data ) ) {
		return new WP_REST_Response(
			array(
				'message' => 'No posts found.',
			),
			404
		);
	}

	return new WP_REST_Response(
		array(
			'data'   => $data,
			'cached' => false,
		),
		200
	);
}
