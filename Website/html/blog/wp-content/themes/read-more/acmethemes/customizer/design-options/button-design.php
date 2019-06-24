<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'read-more-button-design-layout-option', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Button Design', 'read-more' ),
    'panel'          => 'read-more-design-panel'
) );

/*button-design*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-button-design]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-button-design'],
    'sanitize_callback' => 'read_more_sanitize_select'
) );
$choices = read_more_button_design();
$wp_customize->add_control( 'read_more_theme_options[read-more-button-design]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Button Design', 'read-more' ),
    'section'   => 'read-more-button-design-layout-option',
    'settings'  => 'read_more_theme_options[read-more-button-design]',
    'type'	  	=> 'select'
) );