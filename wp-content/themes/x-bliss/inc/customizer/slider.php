<?php
/**
 * Theme Options related to slider.
 *
 * @package X_Bliss
 */

$default = x_bliss_get_default_theme_options();

// Add Panel.
$wp_customize->add_panel( 'theme_slider_panel',
	array(
	'title'      => __( 'Featured Banner/Slider', 'x-bliss' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	)
);

// Slider Type Section.
$wp_customize->add_section( 'section_theme_slider_type',
	array(
	'title'      => __( 'Banner/Slider Type', 'x-bliss' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_slider_panel',
	)
);

// Setting featured_banner_status.
$wp_customize->add_setting( 'theme_options[featured_banner_status]',
	array(
	'default'           => $default['featured_banner_status'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'x_bliss_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[featured_banner_status]',
	array(
	'label'    => __( 'Enable Banner On', 'x-bliss' ),
	'section'  => 'section_theme_slider_type',
	'type'     => 'select',
	'priority' => 100,
	'choices'  => x_bliss_get_featured_banner_content_options(),
	)
);

// Setting featured_banner_image.
$wp_customize->add_setting( 'theme_options[featured_banner_image]',
	array(
	'default'           => $default['featured_banner_image'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'x_bliss_sanitize_image',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control( $wp_customize, 'theme_options[featured_banner_image]',
		array(
		'label'           => __( 'Banner Image', 'x-bliss' ),
		'description'     => sprintf( __( 'Recommended Size: %1$dpx X %2$dpx', 'x-bliss' ), 1940, 800 ),
		'section'         => 'section_theme_slider_type',
		'priority'        => 100,
		'settings'        => 'theme_options[featured_banner_image]',
		'active_callback' => 'x_bliss_is_featured_banner_active',
		)
	)
);

// Setting featured_banner_title.
$wp_customize->add_setting( 'theme_options[featured_banner_title]',
	array(
	'default'           => $default['featured_banner_title'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[featured_banner_title]',
	array(
	'label'           => __( 'Banner Title', 'x-bliss' ),
	'section'         => 'section_theme_slider_type',
	'type'            => 'text',
	'priority'        => 100,
	'active_callback' => 'x_bliss_is_featured_banner_active',
	)
);

// Setting featured_banner_subtitle.
$wp_customize->add_setting( 'theme_options[featured_banner_subtitle]',
	array(
	'default'           => $default['featured_banner_subtitle'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[featured_banner_subtitle]',
	array(
	'label'           => __( 'Banner Subtitle', 'x-bliss' ),
	'section'         => 'section_theme_slider_type',
	'type'            => 'text',
	'priority'        => 100,
	'active_callback' => 'x_bliss_is_featured_banner_active',
	)
);

// Setting featured_banner_button_text.
$wp_customize->add_setting( 'theme_options[featured_banner_button_text]',
	array(
	'default'           => $default['featured_banner_button_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[featured_banner_button_text]',
	array(
	'label'           => __( 'Button Text', 'x-bliss' ),
	'section'         => 'section_theme_slider_type',
	'type'            => 'text',
	'priority'        => 100,
	'active_callback' => 'x_bliss_is_featured_banner_active',
	)
);

// Setting featured_banner_button_url.
$wp_customize->add_setting( 'theme_options[featured_banner_button_url]',
	array(
	'default'           => $default['featured_banner_button_url'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control( 'theme_options[featured_banner_button_url]',
	array(
	'label'           => __( 'Button URL', 'x-bliss' ),
	'section'         => 'section_theme_slider_type',
	'type'            => 'text',
	'priority'        => 100,
	'active_callback' => 'x_bliss_is_featured_banner_active',
	)
);

// Setting featured_slider_status.
$wp_customize->add_setting( 'theme_options[featured_slider_status]',
	array(
	'default'           => $default['featured_slider_status'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'x_bliss_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_status]',
	array(
	'label'    => __( 'Enable Slider On', 'x-bliss' ),
	'section'  => 'section_theme_slider_type',
	'type'     => 'select',
	'priority' => 100,
	'choices'  => x_bliss_get_featured_slider_content_options(),
	)
);

// Setting featured_slider_type.
$wp_customize->add_setting( 'theme_options[featured_slider_type]',
	array(
	'default'           => $default['featured_slider_type'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'x_bliss_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_type]',
	array(
	'label'           => __( 'Select Slider Type', 'x-bliss' ),
	'section'         => 'section_theme_slider_type',
	'type'            => 'select',
	'priority'        => 100,
	'choices'         => x_bliss_get_featured_slider_type(),
	'active_callback' => 'x_bliss_is_featured_slider_active',
	)
);

// Setting featured_slider_number.
$wp_customize->add_setting( 'theme_options[featured_slider_number]',
	array(
	'default'           => $default['featured_slider_number'],
	'capability'        => 'edit_theme_options',
	'transport'         => 'postMessage',
	'sanitize_callback' => 'x_bliss_sanitize_number_range',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_number]',
	array(
	'label'           => __( 'No of Slides', 'x-bliss' ),
	'description'     => __( 'Enter number between 1 and 5. Save and refresh the page if No of Slides is changed.', 'x-bliss' ),
	'section'         => 'section_theme_slider_type',
	'type'            => 'number',
	'priority'        => 100,
	'active_callback' => 'x_bliss_is_featured_slider_active_non_demo',
	'input_attrs'     => array( 'min' => 1, 'max' => 5, 'step' => 1, 'style' => 'width: 55px;' ),
	)
);

$featured_slider_number = absint( x_bliss_get_option( 'featured_slider_number' ) );

if ( $featured_slider_number > 0 ) {
	for ( $i = 1; $i <= $featured_slider_number; $i++ ) {
		$wp_customize->add_setting( "theme_options[featured_slider_page_heading_$i]",
			array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			new X_Bliss_Heading_Control( $wp_customize, "theme_options[featured_slider_page_heading_$i]",
				array(
					'label'           => __( 'Slide', 'x-bliss' ) . ' #' . $i,
					'section'         => 'section_theme_slider_type',
					'settings'        => "theme_options[featured_slider_page_heading_$i]",
					'priority'        => 100,
					'active_callback' => 'x_bliss_is_featured_page_slider_active',
				)
			)
		);

		$wp_customize->add_setting( "theme_options[featured_slider_page_$i]",
			array(
			'default'           => isset( $default[ 'featured_slider_page_' . $i ] ) ? $default[ 'featured_slider_page_' . $i ] : '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'x_bliss_sanitize_dropdown_pages',
			)
		);
		$wp_customize->add_control( "theme_options[featured_slider_page_$i]",
			array(
			'label'           => __( 'Select Page', 'x-bliss' ),
			'section'         => 'section_theme_slider_type',
			'type'            => 'dropdown-pages',
			'priority'        => 100,
			'active_callback' => 'x_bliss_is_featured_page_slider_active',
			)
		);

		$wp_customize->add_setting( "theme_options[featured_slider_page_caption_alignment_$i]",
			array(
			'default'           => isset( $default[ 'featured_slider_page_caption_alignment_' . $i ] ) ? $default[ 'featured_slider_page_caption_alignment_' . $i ] : 'left',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'x_bliss_sanitize_select',
			)
		);
		$wp_customize->add_control( "theme_options[featured_slider_page_caption_alignment_$i]",
			array(
			'label'           => __( 'Caption Alignment', 'x-bliss' ),
			'section'         => 'section_theme_slider_type',
			'type'            => 'select',
			'priority'        => 100,
			'choices'         => x_bliss_get_slider_caption_alignment_options(),
			'active_callback' => 'x_bliss_is_featured_page_slider_active',
			)
		);
	} // End for loop.
}

// Setting featured_slider_read_more_text.
$wp_customize->add_setting( 'theme_options[featured_slider_read_more_text]',
	array(
	'default'           => $default['featured_slider_read_more_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_read_more_text]',
	array(
	'label'           => __( 'Read More Text', 'x-bliss' ),
	'section'         => 'section_theme_slider_type',
	'type'            => 'text',
	'priority'        => 100,
	'active_callback' => 'x_bliss_is_featured_slider_active_non_demo_non_image',
	)
);


// Slider Options Section.
$wp_customize->add_section( 'section_theme_slider_options',
	array(
	'title'      => __( 'Slider Options', 'x-bliss' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_slider_panel',
	)
);

// Setting featured_slider_transition_effect.
$wp_customize->add_setting( 'theme_options[featured_slider_transition_effect]',
	array(
	'default'           => $default['featured_slider_transition_effect'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'x_bliss_sanitize_select_liberal',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_transition_effect]',
	array(
	'label'    => __( 'Transition Effect', 'x-bliss' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'select',
	'priority' => 100,
	'choices'  => x_bliss_get_featured_slider_transition_effects(),
	)
);

// Setting featured_slider_transition_delay.
$wp_customize->add_setting( 'theme_options[featured_slider_transition_delay]',
	array(
	'default'           => $default['featured_slider_transition_delay'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'x_bliss_sanitize_number_range',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_transition_delay]',
	array(
	'label'       => __( 'Transition Delay', 'x-bliss' ),
	'description' => __( 'in seconds', 'x-bliss' ),
	'section'     => 'section_theme_slider_options',
	'type'        => 'number',
	'priority'    => 100,
	'input_attrs' => array( 'min' => 1, 'max' => 10, 'step' => 1, 'style' => 'width: 55px;' ),
	)
);
// Setting featured_slider_transition_duration.
$wp_customize->add_setting( 'theme_options[featured_slider_transition_duration]',
	array(
	'default'           => $default['featured_slider_transition_duration'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'x_bliss_sanitize_number_range',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_transition_duration]',
	array(
	'label'       => __( 'Transition Duration', 'x-bliss' ),
	'description' => __( 'in seconds', 'x-bliss' ),
	'section'     => 'section_theme_slider_options',
	'type'        => 'number',
	'priority'    => 100,
	'input_attrs' => array( 'min' => 1, 'max' => 10, 'step' => 1, 'style' => 'width: 55px;' ),
	)
);
// Setting featured_slider_enable_caption.
$wp_customize->add_setting( 'theme_options[featured_slider_enable_caption]',
	array(
	'default'           => $default['featured_slider_enable_caption'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'x_bliss_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_enable_caption]',
	array(
	'label'    => __( 'Enable Caption', 'x-bliss' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);

// Setting featured_slider_caption_alignment.
$wp_customize->add_setting( 'theme_options[featured_slider_caption_alignment]',
	array(
	'default'           => $default['featured_slider_caption_alignment'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'x_bliss_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_caption_alignment]',
	array(
	'label'           => __( 'Caption Alignment', 'x-bliss' ),
	'section'         => 'section_theme_slider_options',
	'type'            => 'select',
	'priority'        => 100,
	'choices'         => x_bliss_get_slider_caption_alignment_options(),
	'active_callback' => 'x_bliss_is_featured_slider_caption_active',
	)
);

// Setting featured_slider_enable_arrow.
$wp_customize->add_setting( 'theme_options[featured_slider_enable_arrow]',
	array(
	'default'           => $default['featured_slider_enable_arrow'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'x_bliss_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_enable_arrow]',
	array(
	'label'    => __( 'Enable Arrow', 'x-bliss' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);
// Setting featured_slider_enable_pager.
$wp_customize->add_setting( 'theme_options[featured_slider_enable_pager]',
	array(
	'default'           => $default['featured_slider_enable_pager'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'x_bliss_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_enable_pager]',
	array(
	'label'    => __( 'Enable Pager', 'x-bliss' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);
// Setting featured_slider_enable_autoplay.
$wp_customize->add_setting( 'theme_options[featured_slider_enable_autoplay]',
	array(
	'default'           => $default['featured_slider_enable_autoplay'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'x_bliss_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_enable_autoplay]',
	array(
	'label'    => __( 'Enable Autoplay', 'x-bliss' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);

// Setting featured_slider_enable_overlay.
$wp_customize->add_setting( 'theme_options[featured_slider_enable_overlay]',
	array(
	'default'           => $default['featured_slider_enable_overlay'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'x_bliss_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_enable_overlay]',
	array(
	'label'    => __( 'Enable Overlay', 'x-bliss' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);
