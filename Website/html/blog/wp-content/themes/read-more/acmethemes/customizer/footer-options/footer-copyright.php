<?php
/*adding sections for footer options*/
$wp_customize->add_section( 'read-more-footer-option', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Copyright Text', 'read-more' ),
    'panel'          => 'read-more-footer-panel',
) );

/*copyright*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-footer-copyright]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-footer-copyright'],
    'sanitize_callback' => 'wp_kses_post'
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-footer-copyright]', array(
    'label'		=> __( 'Copyright Text', 'read-more' ),
    'section'   => 'read-more-footer-option',
    'settings'  => 'read_more_theme_options[read-more-footer-copyright]',
    'type'	  	=> 'text',
    'priority'  => 10
) );