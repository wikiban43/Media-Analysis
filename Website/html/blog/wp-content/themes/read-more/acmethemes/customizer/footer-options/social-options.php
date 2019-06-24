<?php
/*adding sections for footer social options */
$wp_customize->add_section( 'read-more-footer-social', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Social Options', 'read-more' ),
    'panel'          => 'read-more-footer-panel'
) );

/*enable social*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-enable-social]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-enable-social'],
    'sanitize_callback' => 'read_more_sanitize_checkbox',
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-enable-social]', array(
    'label'		=> __( 'Enable social', 'read-more' ),
    'section'   => 'read-more-footer-social',
    'settings'  => 'read_more_theme_options[read-more-enable-social]',
    'type'	  	=> 'checkbox',
    'priority'  => 100
) );