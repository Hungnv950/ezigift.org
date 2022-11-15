<?php
/**
 * Implementation of banner feature.
 *
 * @package X_Bliss
 */

// Check banner status.
add_filter( 'x_bliss_filter_banner_status', 'x_bliss_check_banner_status' );

// Add banner to the theme.
add_action( 'x_bliss_action_before_content', 'x_bliss_add_featured_banner', 5 );

// Blider details.
add_filter( 'x_bliss_filter_banner_details', 'x_bliss_get_banner_details' );

if ( ! function_exists( 'x_bliss_add_featured_banner' ) ) :

	/**
	 * Add featured banner.
	 *
	 * @since 1.0.0
	 */
	function x_bliss_add_featured_banner() {

		$flag_apply_banner = apply_filters( 'x_bliss_filter_banner_status', false );
		if ( true !== $flag_apply_banner ) {
		return false;
		}

		$banner_details = array();
		$banner_details = apply_filters( 'x_bliss_filter_banner_details', $banner_details );

		if ( empty( $banner_details ) ) {
			return;
		}

		// Render.
		x_bliss_render_featured_banner( $banner_details );

	}
endif;


if ( ! function_exists( 'x_bliss_get_banner_details' ) ) :

	/**
	 * Banner details.
	 *
	 * @since 1.0.0
	 *
	 * @param array $input Banner details.
	 */
	function x_bliss_get_banner_details( $input ) {

		$featured_banner_image       = x_bliss_get_option( 'featured_banner_image' );
		$featured_banner_title       = x_bliss_get_option( 'featured_banner_title' );
		$featured_banner_subtitle    = x_bliss_get_option( 'featured_banner_subtitle' );
		$featured_banner_button_text = x_bliss_get_option( 'featured_banner_button_text' );
		$featured_banner_button_url  = x_bliss_get_option( 'featured_banner_button_url' );

		$input = array(
			'image'       => $featured_banner_image,
			'title'       => $featured_banner_title,
			'subtitle'    => $featured_banner_subtitle,
			'button_text' => $featured_banner_button_text,
			'button_url'  => $featured_banner_button_url,
		);

		return $input;

	}
endif;

if ( ! function_exists( 'x_bliss_render_featured_banner' ) ) :
	/**
	 * Render featured banner.
	 *
	 * @since 1.0.0
	 *
	 * @param array $banner_details Details of banner content.
	 */
	function x_bliss_render_featured_banner( $banner_details = array() ) {

		if ( empty( $banner_details ) ) {
			return;
		}
		?>
		<div id="featured-banner">

			<?php if ( ! empty( $banner_details['image'] ) ) : ?>
				<img src="<?php echo esc_url( $banner_details['image'] ); ?>" alt="" />
			<?php endif; ?>

			<div class="banner-caption">
				<div class="container">
					<?php if ( ! empty( $banner_details['title'] ) ) : ?>
						<h3 class="banner-title"><?php echo esc_html( $banner_details['title'] ); ?></h3>
					<?php endif; ?>
					<?php if ( ! empty( $banner_details['subtitle'] ) ) : ?>
						<div class="banner-subtitle"><?php echo esc_html( $banner_details['subtitle'] ); ?></div>
					<?php endif; ?>
					<?php if ( ! empty( $banner_details['button_text'] ) && ! empty( $banner_details['button_url'] ) ) : ?>
						<a href="<?php echo esc_url( $banner_details['button_url'] ); ?>" class="custom-button"><?php echo esc_html( $banner_details['button_text'] ); ?></a>
					<?php endif; ?>
				</div><!-- .container -->
			</div><!-- .banner-caption -->

		</div><!-- #featured-banner -->
		<?php

	}

endif;

if ( ! function_exists( 'x_bliss_check_banner_status' ) ) :

	/**
	 * Check status.
	 *
	 * @since 1.0.0
	 */
	function x_bliss_check_banner_status( $input ) {

		// Banner status.
		$featured_banner_status = x_bliss_get_option( 'featured_banner_status' );

		switch ( $featured_banner_status ) {

			case 'disabled':
				$input = false;
				break;

			case 'home-page':
				if ( is_front_page() ) {
					$input = true;
				}
				break;

			default:
				break;
		}
		return $input;

	}

endif;
