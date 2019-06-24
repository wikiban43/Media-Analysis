<?php
/*adding sections for Single post options*/
$wp_customize->add_section( 'read-more-single-post', array(
    'priority'       => 95,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Single Post Options', 'read-more' )
) );

/*single image layout*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-single-image-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-single-image-layout'],
    'sanitize_callback' => 'read_more_sanitize_select'
) );
$choices = read_more_get_image_sizes_options(1);
$wp_customize->add_control( 'read_more_theme_options[read-more-single-image-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Image Layout Options', 'read-more' ),
    'section'   => 'read-more-single-post',
    'settings'  => 'read_more_theme_options[read-more-single-image-layout]',
    'type'	  	=> 'select',
    'priority'  => 20
) );

/*show related posts*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-show-related]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-show-related'],
    'sanitize_callback' => 'read_more_sanitize_checkbox'
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-show-related]', array(
    'label'		=> __( 'Show Related Posts In Single Post', 'read-more' ),
    'section'   => 'read-more-single-post',
    'settings'  => 'read_more_theme_options[read-more-show-related]',
    'type'	  	=> 'checkbox',
    'priority'  => 30
) );