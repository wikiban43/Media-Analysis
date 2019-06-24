<?php
/*adding sections for category section in front page*/
$wp_customize->add_section( 'read-more-feature-blog-section', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Feature Section Selection', 'read-more' ),
    'panel'          => 'read-more-feature-blog-panel'
) );

/*feature-title*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-blog-feature-title]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-blog-feature-title'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-blog-feature-title]', array(
    'label'		=> __( 'Title', 'read-more' ),
    'section'           => 'read-more-feature-blog-section',
    'settings'  => 'read_more_theme_options[read-more-blog-feature-title]',
    'type'	  	=> 'text',
    'priority'  => 10
) );

/*slider from category*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-blog-feature-from-category]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-blog-feature-from-category'],
    'sanitize_callback' => 'read_more_sanitize_number',
) );

$wp_customize->add_control(
    new Read_More_Customize_Category_Dropdown_Control(
        $wp_customize,
        'read_more_theme_options[read-more-blog-feature-from-category]',
        array(
            'label'		        => __( 'Select Category', 'read-more' ),
            'section'           => 'read-more-feature-blog-section',
            'settings'          => 'read_more_theme_options[read-more-blog-feature-from-category]',
            'type'	  	        => 'category_dropdown',
            'priority'          => 20,
        )
    )
);