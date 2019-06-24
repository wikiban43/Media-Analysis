<?php
/*adding theme options panel*/
$wp_customize->add_panel( 'read-more-design-panel', array(
    'priority'       => 90,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Layout/Design Option', 'read-more' )
) );

$wp_customize->get_section( 'background_image' )->panel = 'read-more-design-panel';
$wp_customize->get_section( 'background_image' )->priority = 50;

/*
* file for front page hiding content
*/
require read_more_file_directory('acmethemes/customizer/design-options/front-page-content.php');

/*
* file for sidebar layout
*/
require read_more_file_directory('acmethemes/customizer/design-options/sidebar-layout.php');

/*
* file for front page sidebar layout options
*/
require read_more_file_directory('acmethemes/customizer/design-options/front-page-sidebar-layout.php');

/*
* file for front archive sidebar layout options
*/
require read_more_file_directory('acmethemes/customizer/design-options/archive-sidebar-layout.php');

/*
* file for sticky sidebar
*/
require read_more_file_directory('acmethemes/customizer/design-options/sticky-sidebar.php');

/*
* file for blog layout
*/
require read_more_file_directory('acmethemes/customizer/design-options/author-archive.php');

/*
* file for author archive layout
*/
require read_more_file_directory('acmethemes/customizer/design-options/blog-layout.php');

/*
* file for color options
*/
require read_more_file_directory('acmethemes/customizer/design-options/colors-options.php');

/*
* file for button options
*/
require read_more_file_directory('acmethemes/customizer/design-options/button-design.php');