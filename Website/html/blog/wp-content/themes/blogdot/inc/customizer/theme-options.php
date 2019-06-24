<?php

// Add Section
$wp_customize->add_section( 'blogdot_theme_general_settings', array(
	'title'             => __( 'Theme Options', 'blogdot' ),
	'priority'          => 30,
) );



$wp_customize->add_setting( 'blogdot_logo_height', array(
	'default'           => 60,
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'blogdot_logo_height', array(
	'label'             => __( 'Enter logo height (in px)', 'blogdot' ),
	'type'              => 'number',
	'section'           => 'title_tagline',
	'setting'           => 'blogdot_logo_height',
	'priority'          => '9',
) );



$wp_customize->add_setting( 'blogdot_color_scheme', array(
	'default'           => 'dark',
	'sanitize_callback' => 'esc_html',
) );

$wp_customize->add_control( 'blogdot_color_scheme', array(
	'label'             => __( 'Color Scheme', 'blogdot' ),
	'type'              => 'select',
	'section'           => 'blogdot_theme_general_settings',
	'setting'           => 'blogdot_color_scheme',
	'choices'           => array(
		'dark'   => __( 'Dark (Default)', 'blogdot' ),
		'light'  => __( 'Light', 'blogdot' ),
		'red'    => __( 'Red', 'blogdot' ),
		'blue'   => __( 'Blue', 'blogdot' ),
		'yellow' => __( 'Yellow', 'blogdot' ),
	  )
) );



$wp_customize->add_setting( 'blogdot_sidebar_position', array(
	'default'           => 'right',
	'sanitize_callback' => 'esc_html',
) );

$wp_customize->add_control( 'blogdot_sidebar_position', array(
	'label'             => __( 'Sidebar Position', 'blogdot' ),
	'type'              => 'select',
	'section'           => 'blogdot_theme_general_settings',
	'setting'           => 'blogdot_sidebar_position',
	'choices'           => array(
		'right'         => __( 'Right', 'blogdot' ),
		'left'          => __( 'Left', 'blogdot' ),
		'hide'          => __( 'Hide Sidebar', 'blogdot' ),
	  )
) );



$wp_customize->add_setting( 'blogdot_display_full_blog', array(
	'default'           => false,
	'sanitize_callback' => 'esc_html',
) );

$wp_customize->add_control( 'blogdot_display_full_blog', array(
	'label'             => __( 'Display full posts on the Homepage', 'blogdot' ),
	'type'              => 'checkbox',
	'section'           => 'blogdot_theme_general_settings',
	'setting'           => 'blogdot_display_full_blog',
	'active_callback'   => 'is_home',
	'description'       => esc_html__( 'By default, excerpt is displayed on the blog homepage.', 'blogdot' ),
) );



$wp_customize->add_setting( 'blogdot_sticky_navbar', array(
	'default'           => true,
	'sanitize_callback' => 'esc_html',
) );

$wp_customize->add_control( 'blogdot_sticky_navbar', array(
	'label'             => __( 'Stick the Navbar to top', 'blogdot' ),
	'type'              => 'checkbox',
	'section'           => 'blogdot_theme_general_settings',
	'setting'           => 'blogdot_sticky_navbar',
	'description'       => esc_html__( 'Select this setting if you want to keep navigation bar fixed at top while scrolling.', 'blogdot' ),
) );



$wp_customize->add_setting( 'blogdot_hide_breadcrumb', array(
	'default'           => false,
	'sanitize_callback' => 'esc_html',
) );

$wp_customize->add_control( 'blogdot_hide_breadcrumb', array(
	'label'             => __( 'Hide breadcrumbs on single post/page', 'blogdot' ),
	'type'              => 'checkbox',
	'section'           => 'blogdot_theme_general_settings',
	'setting'           => 'blogdot_hide_breadcrumb',
	'description'       => esc_html__( 'Select this setting if you want to hide breadcrumbs displayed on the single blog post/page.', 'blogdot' ),
) );



$wp_customize->add_setting( 'blogdot_display_cover_section', array(
	'default'           => true,
	'sanitize_callback' => 'esc_html',
) );

$wp_customize->add_control( 'blogdot_display_cover_section', array(
	'label'             => __( 'Display cover section on Homepage', 'blogdot' ),
	'type'              => 'checkbox',
	'section'           => 'blogdot_theme_general_settings',
	'setting'           => 'blogdot_display_cover_section',
	'active_callback'   => 'is_home',
	'description'       => esc_html__( 'Uncheck this setting if you want to hide cover section from the blog homepage.', 'blogdot' ),
) );



$wp_customize->add_setting('blogdot_cover_img', array(
    'default'           => get_template_directory_uri() . '/assets/images/cover-img.jpg',
	'sanitize_callback' => 'blogdot_sanitize_image',
));

$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'blogdot_cover_img', array(
    'label'           => __('Cover Section Image', 'blogdot'),
    'section'         => 'blogdot_theme_general_settings',
    'setting'         => 'blogdot_cover_img',
	'active_callback' => 'blogdot_is_cover_active',
)));



$wp_customize->add_setting( 'blogdot_cover_title', array(
	'default'           => __( 'Create A Beautiful Blog Easily.', 'blogdot' ),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'blogdot_cover_title', array(
	'label'           => __( 'Title on Cover Section', 'blogdot' ),
	'type'            => 'text',
	'section'         => 'blogdot_theme_general_settings',
	'setting'         => 'blogdot_cover_title',
	'active_callback' => 'blogdot_is_cover_active',
) );

$wp_customize->get_setting( 'blogdot_cover_title' )->transport = 'postMessage';


$wp_customize->add_setting( 'blogdot_cover_subtitle', array(
	'default'           => __( 'Blogdot is simple and easy to use blog theme. It is designed and developed primarily to create professional blogging websites.', 'blogdot' ),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'blogdot_cover_subtitle', array(
	'label'           => __( 'Sub-title on Cover Section', 'blogdot' ),
	'type'            => 'textarea',
	'section'         => 'blogdot_theme_general_settings',
	'setting'         => 'blogdot_cover_subtitle',
	'active_callback' => 'blogdot_is_cover_active',
) );

$wp_customize->get_setting( 'blogdot_cover_subtitle' )->transport = 'postMessage';



$wp_customize->add_setting( 'blogdot_upgrade_msg', array(
	'default'           => '',
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'blogdot_upgrade_msg', array(
	'label'       => __( 'Take your website to the next level!', 'blogdot' ),
	'type'        => 'hidden',
	'section'     => 'blogdot_theme_general_settings',
	'setting'     => 'blogdot_upgrade_msg',
	'description' => wp_kses_post( __( '<p>With the premium version, you get more premium features with professional technical support.</p><p>You can also improve your website’s speed and performance. Your website can be further optimized for better search engine ranking.</p> <a href="https://wp-points.com/themes/blogdot-pro/" target="_blank" class="button button-primary">Learn More</a> <a href="https://blogdot-pro.wp-points.com/" target="_blank" class="button button-primary bd-ml-5">View Pro Demo</a>', 'blogdot' ) ),
) );
