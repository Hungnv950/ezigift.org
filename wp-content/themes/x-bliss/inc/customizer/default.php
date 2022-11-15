<?php
/**
 * Default theme options.
 *
 * @package X_Bliss
 */

if ( ! function_exists( 'x_bliss_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function x_bliss_get_default_theme_options() {

		$defaults = array();

		// Header.
		$defaults['show_title']            = true;
		$defaults['show_tagline']          = true;
		$defaults['show_social_in_header'] = false;
		$defaults['contact_number']        = '';
		$defaults['contact_email']         = '';
		$defaults['contact_address']       = '';
		$defaults['search_in_header']      = true;

		// Layout.
		$defaults['site_layout']             = 'boxed';
		$defaults['global_layout']           = 'right-sidebar';
		$defaults['archive_layout']          = 'excerpt';
		$defaults['archive_image']           = 'large';
		$defaults['archive_image_alignment'] = 'center';
		$defaults['single_image']            = 'large';

		// Home Page.
		$defaults['home_content_status'] = true;

		// Footer.
		$defaults['copyright_text']        = esc_html__( 'Copyright &copy; All rights reserved.', 'x-bliss' );
		$defaults['show_social_in_footer'] = false;
		$defaults['go_to_top']             = true;

		// Blog.
		$defaults['blog_title']         = esc_html__( 'Blog', 'x-bliss' );
		$defaults['excerpt_length']     = 40;
		$defaults['read_more_text']     = esc_html__( 'Read More', 'x-bliss' );
		$defaults['exclude_categories'] = '';

		// Breadcrumb.
		$defaults['breadcrumb_type'] = 'simple';

		// Slider Options.
		$defaults['featured_banner_status']              = 'home-page';
		$defaults['featured_banner_image']               = get_template_directory_uri() . '/images/featured-banner.jpg';
		$defaults['featured_banner_title']               = esc_html__( 'Merry Xmas', 'x-bliss' );
		$defaults['featured_banner_subtitle']            = esc_html__( 'Enjoy your holiday!', 'x-bliss' );;
		$defaults['featured_banner_button_text']         = esc_html__( 'Know More', 'x-bliss' );
		$defaults['featured_banner_button_url']          = '#';
		$defaults['featured_slider_status']              = 'disabled';
		$defaults['featured_slider_transition_effect']   = 'fadeout';
		$defaults['featured_slider_transition_delay']    = 3;
		$defaults['featured_slider_transition_duration'] = 1;
		$defaults['featured_slider_enable_caption']      = true;
		$defaults['featured_slider_caption_alignment']   = 'left';
		$defaults['featured_slider_enable_arrow']        = true;
		$defaults['featured_slider_enable_pager']        = true;
		$defaults['featured_slider_enable_autoplay']     = true;
		$defaults['featured_slider_enable_overlay']      = true;
		$defaults['featured_slider_type']                = 'featured-page';
		$defaults['featured_slider_number']              = 3;
		$defaults['featured_slider_read_more_text']      = esc_html__( 'Read More', 'x-bliss' );

		// Pass through filter.
		$defaults = apply_filters( 'x_bliss_filter_default_theme_options', $defaults );
		return $defaults;
	}

endif;
