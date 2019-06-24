<?php
/*adding sections for default layout options panel*/
$wp_customize->add_section( 'read-more-archive-sidebar-layout', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Archive Sidebar Layout', 'read-more' ),
    'panel'          => 'read-more-design-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-archive-sidebar-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-archive-sidebar-layout'],
    'sanitize_callback' => 'read_more_sanitize_select'
) );
$choices = read_more_sidebar_layout();
$wp_customize->add_control( 'read_more_theme_options[read-more-archive-sidebar-layout]', array(
    'choices'  	    => $choices,
    'label'		    => __( 'Archive Sidebar Layout', 'read-more' ),
    'description'   => __( 'Sidebar Layout for listing pages like category, author etc', 'read-more' ),
    'section'       => 'read-more-archive-sidebar-layout',
    'settings'      => 'read_more_theme_options[read-more-archive-sidebar-layout]',
    'type'	  	    => 'select'
) );