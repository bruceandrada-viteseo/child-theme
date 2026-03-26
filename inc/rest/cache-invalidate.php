<?php
	/**
	 * Cache invalidation handler.
	 *
	 * Clears transient cache via query parameter.
	 *
	 * @package Child_Theme
	 */

	add_action(
		'init',
		function () {

			if (
			isset( $_GET['clear_cache'] ) &&
			'1' === $_GET['clear_cache'] &&
			current_user_can( 'manage_options' ) &&
			isset( $_GET['_wpnonce'] ) &&
			wp_verify_nonce(
				sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ),
				'clear_cache_action'
			)
			) {

				global $wpdb;

				// phpcs:ignore WordPress.DB.DirectDatabaseQuery
				$wpdb->query(
					"
				DELETE FROM {$wpdb->options}
				WHERE option_name LIKE '_transient_ct_post_%'
				OR option_name LIKE '_transient_timeout_ct_post_%'"
				);

				wp_safe_redirect( home_url() );
				exit;
			}
		}
	);
