<?php
/*adding sections for default layout options panel*/
$wp_customize->add_section( 'read-more-option-pagination-option', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Pagination Options', 'read-more' ),
    'panel'          => 'read-more-options'
) );

/*Pagination Options*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-pagination-option]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-pagination-option'],
    'sanitize_callback' => 'read_more_sanitize_select'
) );
$choices = read_more_pagination_options();
$wp_customize->add_control( 'read_more_theme_options[read-more-pagination-option]', array(
    'choices'  	    => $choices,
    'label'		    => __( 'Pagination Options', 'read-more' ),
    'description'   => __( 'Blog and Archive Pages Pagination', 'read-more' ),
    'section'       => 'read-more-option-pagination-option',
    'settings'      => 'read_more_theme_options[read-more-pagination-option]',
    'type'	  	    => 'select'
) );

/*Show More*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-ajax-show-more]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-ajax-show-more'],
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-ajax-show-more]', array(
    'label'		=> __( 'Show More Text', 'read-more' ),
    'section'   => 'read-more-option-pagination-option',
    'settings'  => 'read_more_theme_options[read-more-ajax-show-more]',
    'type'	  	=> 'text',
    'priority'  => 10
) );

/*No More*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-ajax-no-more]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-ajax-no-more'],
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-ajax-no-more]', array(
    'label'		=> __( 'No More Text', 'read-more' ),
    'section'   => 'read-more-option-pagination-option',
    'settings'  => 'read_more_theme_options[read-more-ajax-no-more]',
    'type'	  	=> 'text',
    'priority'  => 20
) );