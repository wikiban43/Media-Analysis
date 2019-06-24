<?php
/*header logo/text display options*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-header-id-display-opt]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-header-id-display-opt'],
    'sanitize_callback' => 'read_more_sanitize_select'
) );
$choices = read_more_header_id_display_opt();
$wp_customize->add_control( 'read_more_theme_options[read-more-header-id-display-opt]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Logo/Site Title-Tagline Display Options', 'read-more' ),
    'section'   => 'title_tagline',
    'settings'  => 'read_more_theme_options[read-more-header-id-display-opt]',
    'type'	  	=> 'radio',
    'priority'  => 30
) );