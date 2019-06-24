<?php
/*adding sections for default layout options panel*/
$wp_customize->add_section( 'read-more-front-page-sidebar-layout', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Front/Home Sidebar Layout', 'read-more' ),
    'panel'          => 'read-more-design-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-front-page-sidebar-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-front-page-sidebar-layout'],
    'sanitize_callback' => 'read_more_sanitize_select'
) );
$choices = read_more_sidebar_layout();
$wp_customize->add_control( 'read_more_theme_options[read-more-front-page-sidebar-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Front/Home Sidebar Layout', 'read-more' ),
    'section'   => 'read-more-front-page-sidebar-layout',
    'settings'  => 'read_more_theme_options[read-more-front-page-sidebar-layout]',
    'type'	  	=> 'select'
) );