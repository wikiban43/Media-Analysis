<?php
/*adding sections for category section in front page*/
$wp_customize->add_section( 'read-more-feature-section', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Feature Slider Selection', 'read-more' ),
    'description'	=> __( 'Recommended featured image size is 1800 × 700 pixels for each post of selected category. ', 'read-more' ),
    'panel'          => 'read-more-feature-panel'
) );

/*slider from category*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-slider-from-category]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-slider-from-category'],
    'sanitize_callback' => 'read_more_sanitize_number',
) );

$wp_customize->add_control(
    new Read_More_Customize_Category_Dropdown_Control(
        $wp_customize,
        'read_more_theme_options[read-more-slider-from-category]',
        array(
            'label'		    => __( 'Select Category', 'read-more' ),
            'section'       => 'read-more-feature-section',
            'settings'      => 'read_more_theme_options[read-more-slider-from-category]',
            'type'	  	    => 'category_dropdown',
            'priority'      => 5,
        )
    )
);

/* number of slider*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-featured-slider-number]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-featured-slider-number'],
    'sanitize_callback' => 'read_more_sanitize_select'
) );
$choices = read_more_featured_slider_number();
$wp_customize->add_control( 'read_more_theme_options[read-more-featured-slider-number]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Number Of Slides', 'read-more' ),
    'section'   => 'read-more-feature-section',
    'settings'  => 'read_more_theme_options[read-more-featured-slider-number]',
    'type'	  	=> 'select',
    'priority'  => 20
) );

/*feature-title*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-featured-slider-read-more-text]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-featured-slider-read-more-text'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-featured-slider-read-more-text]', array(
    'label'		=> __( 'Read More Text', 'read-more' ),
    'section'   => 'read-more-feature-section',
    'settings'  => 'read_more_theme_options[read-more-featured-slider-read-more-text]',
    'type'	  	=> 'text',
    'priority'  => 30
) );