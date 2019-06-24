<?php
/*adding sections for footer social options */
$wp_customize->add_section( 'read-more-front-page-content', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Front Page Content Options', 'read-more' ),
    'panel'          => 'read-more-design-panel'

) );

/*enable front-page-content*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-hide-front-page-content]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-hide-front-page-content'],
    'sanitize_callback' => 'read_more_sanitize_checkbox',
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-hide-front-page-content]', array(
    'label'		 => __( 'Hide Front Page Content', 'read-more' ),
    'description'=> __( 'You may want to hide front page content( Blog or Static page content). Check this to hide them', 'read-more' ),
    'section'   => 'read-more-front-page-content',
    'settings'  => 'read_more_theme_options[read-more-hide-front-page-content]',
    'type'	  	=> 'checkbox',
    'priority'  => 100
) );