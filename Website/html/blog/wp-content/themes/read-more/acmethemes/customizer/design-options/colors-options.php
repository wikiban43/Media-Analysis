<?php
/*customizing default colors section and adding new controls-setting too*/
$wp_customize->add_section( 'colors', array(
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Colors', 'read-more' ),
    'panel'          => 'read-more-design-panel'
) );
/*Primary color*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-primary-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-primary-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'read_more_theme_options[read-more-primary-color]',
        array(
            'label'		=> __( 'Primary Color', 'read-more' ),
            'section'   => 'colors',
            'settings'  => 'read_more_theme_options[read-more-primary-color]',
            'type'	  	=> 'color'
        ) )
);