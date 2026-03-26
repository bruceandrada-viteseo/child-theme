<?php
/**
 * Main functions file.
 *
 * @package Child_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once get_stylesheet_directory() . '/inc/enqueue.php';
require_once get_stylesheet_directory() . '/inc/hooks.php';
require_once get_stylesheet_directory() . '/inc/patterns.php';
require_once get_stylesheet_directory() . '/inc/settings/settings.php';
require_once get_stylesheet_directory() . '/inc/rest/callbacks.php';
require_once get_stylesheet_directory() . '/inc/rest/routes.php';
require_once get_stylesheet_directory() . '/inc/rest/cache-delete.php';
