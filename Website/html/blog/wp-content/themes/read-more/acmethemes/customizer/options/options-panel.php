<?php
/*adding theme options panel*/
$wp_customize->add_panel( 'read-more-options', array(
    'priority'       => 210,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Theme Options', 'read-more' ),
    'description'    => __( 'Customize your awesome site with theme options ', 'read-more' )
) );

/*
* file for header breadcrumb options
*/
require read_more_file_directory('acmethemes/customizer/options/breadcrumb.php');

/*
* file for header search options
*/
require read_more_file_directory('acmethemes/customizer/options/search.php');

/*file for pagination*/
require read_more_file_directory('acmethemes/customizer/options/pagination.php');