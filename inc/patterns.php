<?php
/**
 * Block Patterns and Styles Registration.
 *
 * @package Child_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register block pattern category.
 *
 * @return void
 */
function my_pattern_category() {

	if ( ! function_exists( 'register_block_pattern_category' ) ) {
		return;
	}

	register_block_pattern_category(
		'mytheme',
		array(
			'label' => 'My Theme Patterns',
		)
	);
}
add_action( 'init', 'my_pattern_category' );

/**
 * Register block patterns.
 *
 * @return void
 */
function my_block_patterns() {

	if ( ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	// Hero section.
	register_block_pattern(
		'mytheme/hero',
		array(
			'title'       => '01 Hero Section',
			'description' => 'A full-width hero section.',
			'categories'  => array( 'mytheme' ),
			'content'     => '<!-- wp:cover {"align":"full","minHeight":400} -->
			<div class="wp-block-cover alignfull" style="min-height:400px">
				<span aria-hidden="true" class="wp-block-cover__background"></span>
				<div class="wp-block-cover__inner-container">
					<!-- wp:heading {"textAlign":"center"} -->
					<h2 class="has-text-align-center">Welcome to My Site</h2>
					<!-- /wp:heading -->
				</div>
			</div>
			<!-- /wp:cover -->',
		)
	);

	// Call to action section.
	register_block_pattern(
		'mytheme/cta',
		array(
			'title'      => '02 Call To Action Section',
			'categories' => array( 'mytheme' ),
			'content'    => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"60px","bottom":"60px"}}}} -->
			<div class="wp-block-group alignfull has-primary-background-color has-background" style="padding-top:60px;padding-bottom:60px">

				<!-- wp:heading {"textAlign":"center","level":2,"textColor":"white"} -->
				<h2 class="has-text-align-center has-white-color has-text-color">Ready to Get Started?</h2>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"align":"center","textColor":"white"} -->
				<p class="has-text-align-center has-white-color has-text-color">Join us today and experience the difference.</p>
				<!-- /wp:paragraph -->

				<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
				<div class="wp-block-buttons">

					<!-- wp:button {"className":"is-style-cta"} -->
					<div class="wp-block-button is-style-cta">
						<a class="wp-block-button__link">Get Started</a>
					</div>
					<!-- /wp:button -->

				</div>
				<!-- /wp:buttons -->

			</div>
			<!-- /wp:group -->',
		)
	);

	// Testimonial section.
	register_block_pattern(
		'mytheme/testimonial',
		array(
			'title'      => '03 Testimonial',
			'categories' => array( 'mytheme' ),
			'content'    => '<!-- wp:quote {"align":"wide"} -->
			<blockquote class="wp-block-quote alignwide">
				<p>Great service!</p>
				<cite>John Doe</cite>
			</blockquote>
			<!-- /wp:quote -->',
		)
	);
}
add_action( 'init', 'my_block_patterns' );

/**
 * Register block styles.
 *
 * @return void
 */
function my_block_styles() {

	// CTA button style.
	register_block_style(
		'core/button',
		array(
			'name'  => 'cta',
			'label' => 'CTA Button',
		)
	);

	// Group shadow box style.
	register_block_style(
		'core/group',
		array(
			'name'  => 'shadow-box',
			'label' => 'Shadow Box',
		)
	);
}
add_action( 'init', 'my_block_styles' );
