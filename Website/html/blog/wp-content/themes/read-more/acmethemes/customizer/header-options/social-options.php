<?php
/*adding sections for header social options */
$wp_customize->add_section( 'read-more-header-social', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Social Options', 'read-more' ),
    'panel'          => 'read-more-header-panel'
) );

/*facebook url*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-facebook-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-facebook-url'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-facebook-url]', array(
    'label'		=> __( 'Facebook url', 'read-more' ),
    'section'   => 'read-more-header-social',
    'settings'  => 'read_more_theme_options[read-more-facebook-url]',
    'type'	  	=> 'url',
    'priority'  => 10
) );

/*twitter url*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-twitter-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-twitter-url'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-twitter-url]', array(
    'label'		=> __( 'Twitter url', 'read-more' ),
    'section'   => 'read-more-header-social',
    'settings'  => 'read_more_theme_options[read-more-twitter-url]',
    'type'	  	=> 'url',
    'priority'  => 20
) );

/*youtube url*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-youtube-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-youtube-url'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-youtube-url]', array(
    'label'		=> __( 'Youtube url', 'read-more' ),
    'section'   => 'read-more-header-social',
    'settings'  => 'read_more_theme_options[read-more-youtube-url]',
    'type'	  	=> 'url',
    'priority'  => 30
) );

/*
 * plus.google url*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-google-plus-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-google-plus-url'],
    'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-google-plus-url]', array(
    'label'		=> __( 'Google Plus Url', 'read-more' ),
    'section'   => 'read-more-header-social',
    'settings'  => 'read_more_theme_options[read-more-google-plus-url]',
    'type'	  	=> 'url',
    'priority'  => 40
) );