<?php
/*adding footer options panel*/
$wp_customize->add_panel( 'read-more-footer-panel', array(
    'priority'       => 80,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Footer Options', 'read-more' ),
    'description'    => __( 'Customize your awesome site footer ', 'read-more' )
) );

/*
* file for footer social
*/
require read_more_file_directory('acmethemes/customizer/footer-options/social-options.php');

/*
* file for footer copyright
*/
require read_more_file_directory('acmethemes/customizer/footer-options/footer-copyright.php');