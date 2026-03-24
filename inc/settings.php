<?php
/**
 * Theme settings page.
 *
 * Demonstrates nonce usage, sanitization, and escaping.
 *
 * @package Child_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add settings page.
 *
 * @return void
 */
function ct_add_settings_page() {
    add_menu_page(
        'Theme Settings',
        'Theme Settings',
        'manage_options',
        'ct-settings',
        'ct_render_settings_page'
    );
}
add_action( 'admin_menu', 'ct_add_settings_page' );

/**
 * Register setting with sanitization.
 *
 * @return void
 */
function ct_register_settings() {
    register_setting(
        'ct_settings_group',
        'ct_custom_text',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
}
add_action( 'admin_init', 'ct_register_settings' );

/**
 * Render settings page.
 *
 * @return void
 */
function ct_render_settings_page() {

    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    ?>

    <div class="wrap">
        <h1><?php echo esc_html( 'Theme Settings' ); ?></h1>

        <form method="post" action="options.php">
            <?php
            // NONCE (automatic via Settings API)
            settings_fields( 'ct_settings_group' );
            ?>

            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="ct_custom_text">
                            <?php echo esc_html( 'Custom Text' ); ?>
                        </label>
                    </th>
                    <td>
                        <input
                            type="text"
                            id="ct_custom_text"
                            name="ct_custom_text"
                            value="<?php echo esc_attr( get_option( 'ct_custom_text' ) ); ?>"
                            class="regular-text"
                        >
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>

    <?php
}