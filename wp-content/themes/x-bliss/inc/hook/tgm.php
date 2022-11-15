<?php
/**
 * Recommended plugins.
 *
 * @package X_Bliss
 */

if ( ! function_exists( 'x_bliss_recommended_plugins' ) ) :

	/**
	 * Recommend plugins.
	 *
	 * @since 1.0.0
	 */
	function x_bliss_recommended_plugins() {

		$plugins = array(
			array(
				'name'     => esc_html__( 'Team View', 'x-bliss' ),
				'slug'     => 'team-view',
				'required' => false,
			),
		);

		$config = array();

		tgmpa( $plugins, $config );

	}

endif;

add_filter( 'tgmpa_register', 'x_bliss_recommended_plugins' );
