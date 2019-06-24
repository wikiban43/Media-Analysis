<?php
/*adding sections for blog layout options*/
$wp_customize->add_section( 'read-more-design-blog-layout-option', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Default Blog/Archive Layout', 'read-more' ),
    'panel'          => 'read-more-design-panel'
) );

/*blog-index-title*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-blog-index-title]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-blog-index-title'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-blog-index-title]', array(
    'label'		=> __( 'Blog Page Title', 'read-more' ),
    'section'   => 'read-more-design-blog-layout-option',
    'settings'  => 'read_more_theme_options[read-more-blog-index-title]',
    'type'	  	=> 'text'
) );

/*blog layout*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-blog-archive-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-blog-archive-layout'],
    'sanitize_callback' => 'read_more_sanitize_select'
) );
$choices = read_more_blog_layout();
$wp_customize->add_control( 'read_more_theme_options[read-more-blog-archive-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Default Blog/Archive Layout', 'read-more' ),
    'description'=> __( 'Image display options', 'read-more' ),
    'section'   => 'read-more-design-blog-layout-option',
    'settings'  => 'read_more_theme_options[read-more-blog-archive-layout]',
    'type'	  	=> 'select'
) );

/*blog image layout*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-blog-archive-image-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-blog-archive-image-layout'],
    'sanitize_callback' => 'read_more_sanitize_select'
) );
$choices = read_more_get_image_sizes_options();
$wp_customize->add_control( 'read_more_theme_options[read-more-blog-archive-image-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Image Layout Options', 'read-more' ),
    'section'   => 'read-more-design-blog-layout-option',
    'settings'  => 'read_more_theme_options[read-more-blog-archive-image-layout]',
    'type'	  	=> 'select',
) );

/*feature-title*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-blog-archive-read-more-text]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-blog-archive-read-more-text'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-blog-archive-read-more-text]', array(
    'label'		=> __( 'Read More Text', 'read-more' ),
    'section'   => 'read-more-design-blog-layout-option',
    'settings'  => 'read_more_theme_options[read-more-blog-archive-read-more-text]',
    'type'	  	=> 'text'
) );

/*feature-title*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-excerpt-length]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-excerpt-length'],
    'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-excerpt-length]', array(
    'label'		=> __( 'Excerpt Length in Words', 'read-more' ),
    'section'   => 'read-more-design-blog-layout-option',
    'settings'  => 'read_more_theme_options[read-more-excerpt-length]',
    'type'	  	=> 'number'
) );