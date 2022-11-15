<?php
/**
 * Custom Header feature.
 *
 * @link http://codex.wordpress.org/Custom_Headers
 *
 * @package X_Bliss
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @since 1.0.0
 */
function x_bliss_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'x_bliss_custom_header_args', array(
			'default-image' => get_template_directory_uri() . '/images/header-banner.jpg',
			'width'         => 1920,
			'height'        => 500,
			'flex-height'   => true,
			'header-text'   => false,
	) ) );

	// Register default headers.
	register_default_headers( array(
		'corporate-business' => array(
			'url'           => '%s/images/header-banner.jpg',
			'thumbnail_url' => '%s/images/header-banner.jpg',
			'description'   => _x( 'Corporate Business', 'header image description', 'x-bliss' ),
		),

	) );

}

add_action( 'after_setup_theme', 'x_bliss_custom_header_setup' );
