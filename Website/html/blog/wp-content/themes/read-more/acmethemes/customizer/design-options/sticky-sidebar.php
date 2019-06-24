<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'read-more-design-sidebar-sticky-option', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Sticky Sidebar Option', 'read-more' ),
    'panel'          => 'read-more-design-panel'
) );

/*sticky sidebar enable disable*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-enable-sticky-sidebar]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-enable-sticky-sidebar'],
    'sanitize_callback' => 'read_more_sanitize_checkbox'
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-enable-sticky-sidebar]', array(
    'label'		=> __( 'Enable Sticky Sidebar Loader', 'read-more' ),
    'section'   => 'read-more-design-sidebar-sticky-option',
    'settings'  => 'read_more_theme_options[read-more-enable-sticky-sidebar]',
    'type'	  	=> 'checkbox',
    'priority'  => 30
) );