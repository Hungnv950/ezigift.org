<?php
/**
 * Basic theme functions.
 *
 * This file contains hook functions attached to core hooks.
 *
 * @package X_Bliss
 */

if ( ! function_exists( 'x_bliss_customize_search_form' ) ) :

	/**
	 * Customize search form.
	 *
	 * @since 1.0.0
	 *
	 * @return string The search form HTML output.
	 */
	function x_bliss_customize_search_form() {

		$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
		<label>
			<span class="screen-reader-text">' . esc_html_x( 'Search for:', 'label', 'x-bliss' ) . '</span>
			<input type="search" class="search-field" placeholder="' . esc_attr__( 'Search&hellip;', 'x-bliss' ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search for:', 'label', 'x-bliss' ) . '" />
		</label>
		<input type="submit" class="search-submit" value="&#xf002;" /></form>';

		return $form;

	}

endif;

add_filter( 'get_search_form', 'x_bliss_customize_search_form', 15 );

if ( ! function_exists( 'x_bliss_implement_excerpt_length' ) ) :

	/**
	 * Implement excerpt length.
	 *
	 * @since 1.0.0
	 *
	 * @param int $length The number of words.
	 * @return int Excerpt length.
	 */
	function x_bliss_implement_excerpt_length( $length ) {

		$excerpt_length = x_bliss_get_option( 'excerpt_length' );
		if ( empty( $excerpt_length ) ) {
			$excerpt_length = $length;
		}
		return apply_filters( 'x_bliss_filter_excerpt_length', absint( $excerpt_length ) );

	}

endif;

if ( ! function_exists( 'x_bliss_implement_read_more' ) ) :

	/**
	 * Implement read more in excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The excerpt.
	 */
	function x_bliss_implement_read_more( $more ) {

		$flag_apply_excerpt_read_more = apply_filters( 'x_bliss_filter_excerpt_read_more', true );
		if ( true !== $flag_apply_excerpt_read_more ) {
			return $more;
		}

		$output = $more;
		$read_more_text = x_bliss_get_option( 'read_more_text' );
		if ( ! empty( $read_more_text ) ) {
			$output = ' <a href="'. esc_url( get_permalink() ) . '" class="more-link">' . esc_html( $read_more_text ) . '</a>';
			$output = apply_filters( 'x_bliss_filter_read_more_link' , $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'x_bliss_content_more_link' ) ) :

	/**
	 * Implement read more in content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more_link Read More link element.
	 * @param string $more_link_text Read More text.
	 * @return string Link.
	 */
	function x_bliss_content_more_link( $more_link, $more_link_text ) {

		$flag_apply_excerpt_read_more = apply_filters( 'x_bliss_filter_excerpt_read_more', true );
		if ( true !== $flag_apply_excerpt_read_more ) {
			return $more_link;
		}

		$read_more_text = x_bliss_get_option( 'read_more_text' );
		if ( ! empty( $read_more_text ) ) {
			$more_link = str_replace( $more_link_text, esc_html( $read_more_text ), $more_link );
		}
		return $more_link;

	}

endif;

if ( ! function_exists( 'x_bliss_custom_body_class' ) ) :
	/**
	 * Custom body class
	 *
	 * @since 1.0.0
	 *
	 * @param string|array $input One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function x_bliss_custom_body_class( $input ) {

		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$input[] = 'group-blog';
		}

		// Site layout.
		$site_layout = x_bliss_get_option( 'site_layout' );
		$input[] = 'site-layout-' . esc_attr( $site_layout );

		$home_content_status =	x_bliss_get_option( 'home_content_status' );
		if( true !== $home_content_status ){
			$input[] = 'home-content-not-enabled';
		}

		// Global layout.
		global $post;
		$global_layout = x_bliss_get_option( 'global_layout' );
		$global_layout = apply_filters( 'x_bliss_filter_theme_global_layout', $global_layout );

		// Check if single.
		if ( $post  && is_singular() ) {
			$post_options = get_post_meta( $post->ID, 'x_bliss_theme_settings', true );
			if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
				$global_layout = $post_options['post_layout'];
			}
		}

		$input[] = 'global-layout-' . esc_attr( $global_layout );

		// Common class for three columns.
		switch ( $global_layout ) {
			case 'three-columns':
			$input[] = 'three-columns-enabled';
			break;

			default:
			break;
		}

		return $input;

	}
endif;

add_filter( 'body_class', 'x_bliss_custom_body_class' );

if ( ! function_exists( 'x_bliss_featured_image_instruction' ) ) :

	/**
	 * Message to show in the Featured Image Meta box.
	 *
	 * @since 1.0.0
	 *
	 * @param string $content Admin post thumbnail HTML markup.
	 * @param int    $post_id Post ID.
	 * @return string HTML.
	 */
	function x_bliss_featured_image_instruction( $content, $post_id ) {

		$allowed = array( 'post', 'page' );

		if ( in_array( get_post_type( $post_id ), $allowed ) ) {
			$content .= '<strong>' . __( 'Recommended Image Sizes', 'x-bliss' ) . ':</strong><br/>';
			$content .= __( 'Slider Image', 'x-bliss' ) . ' : 1920px X 800px';
		}

		return $content;

	}

endif;

add_filter( 'admin_post_thumbnail_html', 'x_bliss_featured_image_instruction', 10, 2 );

if ( ! function_exists( 'x_bliss_custom_content_width' ) ) :

	/**
	 * Custom content width.
	 *
	 * @since 1.0.0
	 */
	function x_bliss_custom_content_width() {

		global $post, $wp_query, $content_width;

		$global_layout = x_bliss_get_option( 'global_layout' );
		$global_layout = apply_filters( 'x_bliss_filter_theme_global_layout', $global_layout );

		// Check if single.
		if ( $post  && is_singular() ) {
			$post_options = get_post_meta( $post->ID, 'x_bliss_theme_settings', true );
			if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
				$global_layout = esc_attr( $post_options['post_layout'] );
			}
		}
		switch ( $global_layout ) {

			case 'no-sidebar':
				$content_width = 1220;
				break;

			case 'three-columns':
				$content_width = 570;
				break;

			case 'left-sidebar':
			case 'right-sidebar':
				$content_width = 895;
				break;

			default:
				break;
		}

	}
endif;

add_filter( 'template_redirect', 'x_bliss_custom_content_width' );

if ( ! function_exists( 'x_bliss_hook_read_more_filters' ) ) :

	/**
	 * Hook read more filters.
	 *
	 * @since 1.0.0
	 */
	function x_bliss_hook_read_more_filters() {
		if ( is_home() || is_category() || is_tag() || is_author() || is_date() ) {

			add_filter( 'excerpt_length', 'x_bliss_implement_excerpt_length', 999 );
			add_filter( 'the_content_more_link', 'x_bliss_content_more_link', 10, 2 );
			add_filter( 'excerpt_more', 'x_bliss_implement_read_more' );

		}
	}
endif;

add_action( 'wp', 'x_bliss_hook_read_more_filters' );
