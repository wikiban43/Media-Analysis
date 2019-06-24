<?php
/*adding sections for enabling feature section in front page*/
$wp_customize->add_section( 'read-more-enable-feature', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Enable Feature Section', 'read-more' ),
    'panel'          => 'read-more-feature-panel'
) );

/*enable feature section*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-enable-feature]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-enable-feature'],
    'sanitize_callback' => 'read_more_sanitize_checkbox'
) );

$wp_customize->add_control( 'read_more_theme_options[read-more-enable-feature]', array(
    'label'		=> __( 'Enable Feature Section', 'read-more' ),
    'description'	=> __( 'Feature section will display on front/home page.', 'read-more' ),
    'section'   => 'read-more-enable-feature',
    'settings'  => 'read_more_theme_options[read-more-enable-feature]',
    'type'	  	=> 'checkbox',
    'priority'  => 10
) );