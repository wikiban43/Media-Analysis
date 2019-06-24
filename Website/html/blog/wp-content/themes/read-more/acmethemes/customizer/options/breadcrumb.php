<?php
/*adding sections for breadcrumb */
$wp_customize->add_section( 'read-more-breadcrumb-options', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Breadcrumb Options', 'read-more' ),
    'panel'          => 'read-more-options'
) );

/*show breadcrumb*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-show-breadcrumb]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-show-breadcrumb'],
    'sanitize_callback' => 'read_more_sanitize_checkbox'
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-show-breadcrumb]', array(
    'label'		=> __( 'Enable Breadcrumb', 'read-more' ),
    'section'   => 'read-more-breadcrumb-options',
    'settings'  => 'read_more_theme_options[read-more-show-breadcrumb]',
    'type'	  	=> 'checkbox',
    'priority'  => 10
) );