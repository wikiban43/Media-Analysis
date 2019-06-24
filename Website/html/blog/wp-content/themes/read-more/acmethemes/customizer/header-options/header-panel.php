<?php
/*adding header options panel*/
$wp_customize->add_panel( 'read-more-header-panel', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Header Options', 'read-more' ),
    'description'    => __( 'Customize your awesome site header ', 'read-more' )
) );

/*
* file for header top options
*/
require read_more_file_directory('acmethemes/customizer/header-options/header-top.php');

/*
* file for header logo options
*/
require read_more_file_directory('acmethemes/customizer/header-options/header-logo.php');

/*
* file for social options
*/
require read_more_file_directory('acmethemes/customizer/header-options/social-options.php');

/*adding header image inside this panel*/
$wp_customize->get_section( 'header_image' )->panel = 'read-more-header-panel';
$wp_customize->get_section( 'header_image' )->description = __( 'Applied to static image of slider', 'read-more' );
$wp_customize->remove_control( 'display_header_text' );