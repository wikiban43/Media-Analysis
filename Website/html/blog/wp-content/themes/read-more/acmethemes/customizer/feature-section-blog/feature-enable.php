<?php
/*adding sections for enabling feature section in front page*/
$wp_customize->add_section( 'read-more-enable-feature-blog', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Enable Feature Section', 'read-more' ),
    'panel'          => 'read-more-feature-blog-panel'
) );

/*enable feature section*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-enable-feature-blog]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-enable-feature-blog'],
    'sanitize_callback' => 'read_more_sanitize_checkbox'
) );

$wp_customize->add_control( 'read_more_theme_options[read-more-enable-feature-blog]', array(
    'label'		=> __( 'Enable Feature Section', 'read-more' ),
    'description'=> __( 'Feature section will display on home/blog page.', 'read-more' ),
    'section'   => 'read-more-enable-feature-blog',
    'settings'  => 'read_more_theme_options[read-more-enable-feature-blog]',
    'type'	  	=> 'checkbox',
    'priority'  => 10
) );