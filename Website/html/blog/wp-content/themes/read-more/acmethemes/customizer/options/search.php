<?php
/*adding sections for Search Placeholder*/
$wp_customize->add_section( 'read-more-search', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Search', 'read-more' ),
    'panel'          => 'read-more-options'
) );

/*Search Placeholder*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-search-placholder]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-search-placholder'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-search-placholder]', array(
    'label'		=> __( 'Search Placeholder', 'read-more' ),
    'section'   => 'read-more-search',
    'settings'  => 'read_more_theme_options[read-more-search-placholder]',
    'type'	  	=> 'text',
    'priority'  => 10
) );