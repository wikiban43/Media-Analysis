<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'read-more-wc-single-product-options', array(
	'priority'       => 20,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Single Product', 'read-more' ),
	'panel'          => 'read-more-wc-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-wc-single-product-sidebar-layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['read-more-wc-single-product-sidebar-layout'],
	'sanitize_callback' => 'read_more_sanitize_select'
) );
$choices = read_more_sidebar_layout();
$wp_customize->add_control( 'read_more_theme_options[read-more-wc-single-product-sidebar-layout]', array(
	'choices'  	=> $choices,
	'label'		=> esc_html__( 'Single Product Sidebar Layout', 'read-more' ),
	'section'   => 'read-more-wc-single-product-options',
	'settings'  => 'read_more_theme_options[read-more-wc-single-product-sidebar-layout]',
	'type'	  	=> 'select'
) );