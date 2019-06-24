<?php
/*adding feature options panel*/
$wp_customize->add_panel( 'read-more-feature-panel', array(
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Slider Featured Section', 'read-more' ),
    'description'    => __( 'Customize your awesome site feature section ', 'read-more' )
) );

/*
* file for feature section enable
*/
require read_more_file_directory('acmethemes/customizer/feature-section/feature-enable.php');

/*
* file for feature slider category
*/
require read_more_file_directory('acmethemes/customizer/feature-section/feature-slider.php');