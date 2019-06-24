<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'read-more-design-sidebar-layout-option', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Single Post/page Sidebar Layout', 'read-more' ),
    'panel'          => 'read-more-design-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-single-sidebar-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-single-sidebar-layout'],
    'sanitize_callback' => 'read_more_sanitize_select'
) );
$choices = read_more_sidebar_layout();
$wp_customize->add_control( 'read_more_theme_options[read-more-single-sidebar-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Default Single Post/Page Sidebar Layout', 'read-more' ),
    'section'   => 'read-more-design-sidebar-layout-option',
    'settings'  => 'read_more_theme_options[read-more-single-sidebar-layout]',
    'type'	  	=> 'select'
) );