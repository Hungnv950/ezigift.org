<?php
/**
 * Implementation of slider feature.
 *
 * @package X_Bliss
 */

// Check slider status.
add_filter( 'x_bliss_filter_slider_status', 'x_bliss_check_slider_status' );

// Add slider to the theme.
add_action( 'x_bliss_action_before_content', 'x_bliss_add_featured_slider', 5 );

// Slider details.
add_filter( 'x_bliss_filter_slider_details', 'x_bliss_get_slider_details' );


if ( ! function_exists( 'x_bliss_get_slider_details' ) ) :
	/**
	 * Slider details.
	 *
	 * @since 1.0.0
	 *
	 * @param array $input Slider details.
	 */
	function x_bliss_get_slider_details( $input ) {

		$featured_slider_type           = x_bliss_get_option( 'featured_slider_type' );
		$featured_slider_number         = x_bliss_get_option( 'featured_slider_number' );
		$featured_slider_read_more_text = x_bliss_get_option( 'featured_slider_read_more_text' );

		switch ( $featured_slider_type ) {

			case 'featured-page':

				$blocks = array();
				$ids = array();

				for ( $i = 1; $i <= $featured_slider_number ; $i++ ) {
					$id = x_bliss_get_option( 'featured_slider_page_' . $i );
					if ( ! empty( $id ) ) {
						$item['id'] = absint( $id );
						$item['caption_alignment'] = x_bliss_get_option( 'featured_slider_page_caption_alignment_' . $i );
						$blocks[ $item['id'] ] = $item;
					}
				}

				$ids = wp_list_pluck( $blocks, 'id' );

				// Bail if no valid options are selected.
				if ( empty( $ids ) ) {
					return $input;
				}

				$qargs = array(
					'posts_per_page' => absint( $featured_slider_number ),
					'no_found_rows'  => true,
					'orderby'        => 'post__in',
					'post_type'      => 'page',
					'post__in'       => $ids,
					'meta_query'     => array(
						array( 'key' => '_thumbnail_id' ),
					),
				);

				// Fetch posts.
				$all_posts = get_posts( $qargs );
				$slides = array();

				if ( ! empty( $all_posts ) ) {

					$cnt = 0;
					foreach ( $all_posts as $key => $post ) {

						if ( has_post_thumbnail( $post->ID ) ) {
							$image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'x-bliss-slider' );
							$slides[ $cnt ]['images']  = $image_array;
							$slides[ $cnt ]['title']   = esc_html( $post->post_title );
							$slides[ $cnt ]['url']     = esc_url( get_permalink( $post->ID ) );
							$slides[ $cnt ]['excerpt'] = x_bliss_the_excerpt( apply_filters( 'x_bliss_filter_slider_caption_length', 30 ), $post );
							$slides[ $cnt ]['caption_alignment'] = '';
							if ( isset( $blocks[ $post->ID ] ) && isset( $blocks[ $post->ID ]['caption_alignment'] ) ) {
								$slides[ $cnt ]['caption_alignment'] = $blocks[ $post->ID ]['caption_alignment'];
							}
							if ( ! empty( $featured_slider_read_more_text ) ) {
								$slides[ $cnt ]['primary_button_text'] = esc_attr( $featured_slider_read_more_text );
								$slides[ $cnt ]['primary_button_url'] = $slides[ $cnt ]['url'];
							}

							$cnt++;
						}
					}
				}
				if ( ! empty( $slides ) ) {
					$input = $slides;
				}

			break;

			default:
			break;
		}
		return $input;

	}
endif;

if ( ! function_exists( 'x_bliss_add_featured_slider' ) ) :
	/**
	 * Add featured slider.
	 *
	 * @since 1.0.0
	 */
	function x_bliss_add_featured_slider() {

		$flag_apply_slider = apply_filters( 'x_bliss_filter_slider_status', false );
		if ( true !== $flag_apply_slider ) {
			return false;
		}

		$slider_details = array();
		$slider_details = apply_filters( 'x_bliss_filter_slider_details', $slider_details );

		if ( empty( $slider_details ) ) {
			return;
		}

		// Render slider now.
		x_bliss_render_featured_slider( $slider_details );

	}
endif;

if ( ! function_exists( 'x_bliss_render_featured_slider' ) ) :
	/**
	 * Render featured slider.
	 *
	 * @since 1.0.0
	 *
	 * @param array $slider_details Details of slider content.
	 */
	function x_bliss_render_featured_slider( $slider_details = array() ) {

		if ( empty( $slider_details ) ) {
			return;
		}

		$featured_slider_transition_effect   = x_bliss_get_option( 'featured_slider_transition_effect' );
		$featured_slider_enable_caption      = x_bliss_get_option( 'featured_slider_enable_caption' );
		$featured_slider_caption_alignment   = x_bliss_get_option( 'featured_slider_caption_alignment' );
		$featured_slider_enable_arrow        = x_bliss_get_option( 'featured_slider_enable_arrow' );
		$featured_slider_enable_pager        = x_bliss_get_option( 'featured_slider_enable_pager' );
		$featured_slider_enable_autoplay     = x_bliss_get_option( 'featured_slider_enable_autoplay' );
		$featured_slider_enable_overlay      = x_bliss_get_option( 'featured_slider_enable_overlay' );
		$featured_slider_transition_duration = x_bliss_get_option( 'featured_slider_transition_duration' );
		$featured_slider_transition_delay    = x_bliss_get_option( 'featured_slider_transition_delay' );

		// Cycle data.
		$slide_data = array(
			'fx'             => esc_attr( $featured_slider_transition_effect ),
			'speed'          => esc_attr( $featured_slider_transition_duration ) * 1000,
			'pause-on-hover' => 'true',
			'loader'         => 'true',
			'log'            => 'false',
			'swipe'          => 'true',
			'auto-height'    => 'container',
		);

		if ( $featured_slider_enable_pager ) {
			$slide_data['pager-template'] = '<span class="pager-box"></span>';
		}
		if ( $featured_slider_enable_autoplay ) {
			$slide_data['timeout'] = absint( $featured_slider_transition_delay ) * 1000;
		} else {
			$slide_data['timeout'] = 0;
		}

		$slide_data['slides'] = 'article';

		$slide_attributes_text = '';
		foreach ( $slide_data as $key => $item ) {

			$slide_attributes_text .= ' ';
			$slide_attributes_text .= ' data-cycle-' . esc_attr( $key );
			$slide_attributes_text .= '="' . esc_attr( $item ) . '"';

		}
		$overlay_class = ( true === $featured_slider_enable_overlay ) ? 'overlay-enabled' : 'overlay-disabled' ;

	?>
    <div id="featured-slider">

        <div class="cycle-slideshow <?php echo esc_attr( $overlay_class ); ?>" id="main-slider" <?php echo $slide_attributes_text; ?>>

        	<?php if ( $featured_slider_enable_arrow ) : ?>
        		<div class="cycle-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
        		<div class="cycle-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
        	<?php endif; ?>

        	<?php $cnt = 1; ?>
        	<?php foreach ( $slider_details as $key => $slide ) : ?>

				<?php $class_text = ( 1 === $cnt ) ? 'first' : ''; ?>
				<?php
				$target = '_self';
				if ( isset( $slide['new_window'] ) && 1 === $slide['new_window'] && ! empty( $slide['url'] ) ) {
					$target = '_blank';
				}
				$url = 'javascript:void(0);';
				if ( ! empty( $slide['url'] ) ) {
					$url = esc_url( $slide['url'] );
				}

				// Fixing title.
				$title = htmlspecialchars_decode( $slide['title'] );
				$exploded = explode( '<br>', $title );
				if ( ! empty( $exploded ) ) {
					$first_part = array_shift( $exploded );
					$exploded = array_filter( array_map( 'trim', $exploded ) );
					$second_part = implode( ' ', $exploded );
					$title = $first_part . '<span>' . $second_part . '</span>';
				}
				$title = htmlspecialchars( $title );

				// Buttons stuff.
				$buttons_markup = '';
				$primary_button_text = ! empty( $slide['primary_button_text'] ) ? $slide['primary_button_text'] : '' ;
				$primary_button_url = ! empty( $slide['primary_button_url'] ) ? $slide['primary_button_url'] : '' ;
				$secondary_button_text = ! empty( $slide['secondary_button_text'] ) ? $slide['secondary_button_text'] : '' ;
				$secondary_button_url = ! empty( $slide['secondary_button_url'] ) ? $slide['secondary_button_url'] : '' ;

				if ( ! empty( $primary_button_text ) || ! empty( $secondary_button_text ) ) {
					$buttons_markup .= '<div class="slider-buttons">';
					if ( ! empty( $primary_button_text ) ) {
						$buttons_markup .= '<a href="' . esc_url( $primary_button_url ) . '" class="custom-button slider-button button-primary">' . esc_html( $primary_button_text ) . '</a>';
					}
					if ( ! empty( $secondary_button_text ) ) {
						$buttons_markup .= '<a href="' . esc_url( $secondary_button_url ) . '" class="custom-button slider-button button-secondary">' . esc_html( $secondary_button_text ) . '</a>';
					}
					$buttons_markup .= '</div>';
				}
				?>
				<article class="<?php echo esc_attr( $class_text ); ?>" data-cycle-title="<?php echo esc_attr( $title ); ?>" data-cycle-url="<?php echo esc_url( $url ); ?>"  data-cycle-excerpt="<?php echo esc_attr( $slide['excerpt'] ); ?>" data-cycle-target="<?php echo esc_attr( $target ); ?>" data-cycle-buttons="<?php echo esc_attr( $buttons_markup ); ?>" >

					<?php if ( ! empty( $slide['url'] ) ) : ?>
						<a href="<?php echo esc_url( $slide['url'] ); ?>" target="<?php echo esc_attr( $target ); ?>" >
						<?php endif; ?>

						<img src="<?php echo esc_url( $slide['images'][0]); ?>" alt="<?php echo esc_attr( $slide['title'] ); ?>"  />
						<?php if ( ! empty( $slide['url'] ) ) : ?>
						</a>
					<?php endif; ?>

					<?php if ( $featured_slider_enable_caption ) : ?>
						<?php
						if ( isset( $slide['caption_alignment'] ) && ! empty( $slide['caption_alignment'] ) ) {
							$caption_alignment_class = 'caption-alignment-' . esc_attr( $slide['caption_alignment'] );
						} else {
							$caption_alignment_class = 'caption-alignment-' . esc_attr( $featured_slider_caption_alignment );
						}
						?>
						<div class="cycle-caption <?php echo esc_attr( $caption_alignment_class ); ?>">
							<div class="caption-wrap">
								<h3><a href="<?php echo esc_url( $slide['url'] ); ?>"><?php echo esc_html( $slide['title'] ); ?></a></h3>
								<p><?php echo esc_html( $slide['excerpt'] ); ?></p>
								<?php echo wp_kses_post( $buttons_markup ); ?>
							</div><!-- .cycle-wrap -->
						</div><!-- .cycle-caption -->
					<?php endif; ?>

				</article>

				<?php $cnt++; ?>

            <?php endforeach; ?>

            <?php if ( $featured_slider_enable_pager ) : ?>
            	<div class="cycle-pager"></div>
            <?php endif; ?>

        </div><!-- #main-slider -->

    </div><!-- #featured-slider -->

    <?php

	}

endif;

if( ! function_exists( 'x_bliss_check_slider_status' ) ) :

	/**
	 * Check status of slider.
	 *
	 * @since 1.0.0
	 */
	function x_bliss_check_slider_status( $input ) {

		// Slider status.
		$featured_slider_status = x_bliss_get_option( 'featured_slider_status' );

		switch ( $featured_slider_status ) {

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
