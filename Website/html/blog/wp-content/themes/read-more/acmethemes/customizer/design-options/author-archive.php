<?php
/*adding sections for Author Options*/
$wp_customize->add_section( 'read-more-author-options', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Author Archive Options', 'read-more' ),
    'panel'          => 'read-more-design-panel'
) );

/*Author Options*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-author-options]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-author-options'],
    'sanitize_callback' => 'read_more_sanitize_select'
) );
$choices = read_more_author_options();
$wp_customize->add_control( 'read_more_theme_options[read-more-author-options]', array(
    'choices'  	    => $choices,
    'label'		    => __( 'Author Options', 'read-more' ),
    'description'   => __( 'Author Archive Page Options', 'read-more' ),
    'section'       => 'read-more-author-options',
    'settings'      => 'read_more_theme_options[read-more-author-options]',
    'type'	  	    => 'select',
    'priority'      => 10
) );