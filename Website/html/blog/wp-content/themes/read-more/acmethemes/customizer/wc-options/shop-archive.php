<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'read-more-wc-shop-archive-option', array(
	'priority'       => 20,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Shop Archive Sidebar Layout', 'read-more' ),
	'panel'          => 'read-more-wc-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-wc-shop-archive-sidebar-layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['read-more-wc-shop-archive-sidebar-layout'],
	'sanitize_callback' => 'read_more_sanitize_select'
) );
$choices = read_more_sidebar_layout();
$wp_customize->add_control( 'read_more_theme_options[read-more-wc-shop-archive-sidebar-layout]', array(
	'choices'  	=> $choices,
	'label'		=> esc_html__( 'Shop Archive Sidebar Layout', 'read-more' ),
	'section'   => 'read-more-wc-shop-archive-option',
	'settings'  => 'read_more_theme_options[read-more-wc-shop-archive-sidebar-layout]',
	'type'	  	=> 'select'
) );

/*wc-product-column-number*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-wc-product-column-number]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['read-more-wc-product-column-number'],
	'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-wc-product-column-number]', array(
	'label'		=> esc_html__( 'Products Per Row', 'read-more' ),
	'section'   => 'read-more-wc-shop-archive-option',
	'settings'  => 'read_more_theme_options[read-more-wc-product-column-number]',
	'type'	  	=> 'number'
) );

/*wc-shop-archive-total-product*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-wc-shop-archive-total-product]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['read-more-wc-shop-archive-total-product'],
	'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-wc-shop-archive-total-product]', array(
	'label'		=> esc_html__( 'Total Products Per Page', 'read-more' ),
	'section'   => 'read-more-wc-shop-archive-option',
	'settings'  => 'read_more_theme_options[read-more-wc-shop-archive-total-product]',
	'type'	  	=> 'number'
) );