<?php
/*adding feature options panel*/
$wp_customize->add_panel( 'read-more-feature-blog-panel', array(
    'priority'       => 50,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Blog Featured Section', 'read-more' ),
    'description'    => __( 'Customize your awesome site feature section ', 'read-more' )
) );

/*
* file for feature section enable
*/
require read_more_file_directory('acmethemes/customizer/feature-section-blog/feature-enable.php');

/*
* file for feature slider category
*/
require read_more_file_directory('acmethemes/customizer/feature-section-blog/feature-blog.php');