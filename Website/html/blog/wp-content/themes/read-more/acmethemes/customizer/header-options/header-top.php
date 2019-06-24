<?php
/*active callback function for header top left*/
if ( !function_exists('read_more_active_callback_header_top_enable') ) :
    function read_more_active_callback_header_top_enable() {
        $read_more_customizer_all_values = read_more_get_theme_options();
        $read_more_enable_header_top = $read_more_customizer_all_values['read-more-enable-header-top'];
        if( 1 == $read_more_enable_header_top ){
            return true;
        }
        return false;
    }
endif;

/*adding sections for header options*/
$wp_customize->add_section( 'read-more-header-top-option', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Header Top', 'read-more' ),
    'panel'          => 'read-more-header-panel',
) );

/*header top enable*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-enable-header-top]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-enable-header-top'],
    'sanitize_callback' => 'read_more_sanitize_checkbox'
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-enable-header-top]', array(
    'label'		=> __( 'Enable Header Top', 'read-more' ),
    'section'   => 'read-more-header-top-option',
    'settings'  => 'read_more_theme_options[read-more-enable-header-top]',
    'type'	  	=> 'checkbox'
) );

/*Social*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-header-top-enable-social]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-header-top-enable-social'],
    'sanitize_callback' => 'read_more_sanitize_checkbox'
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-header-top-enable-social]', array(
    'label'		=> __( 'Enable Social', 'read-more' ),
    'section'   => 'read-more-header-top-option',
    'settings'  => 'read_more_theme_options[read-more-header-top-enable-social]',
    'type'	  	=> 'checkbox',
    'active_callback'   => 'read_more_active_callback_header_top_enable'
) );

/*Menus*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-header-top-enable-menu]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-header-top-enable-menu'],
    'sanitize_callback' => 'read_more_sanitize_checkbox'
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-header-top-enable-menu]', array(
    'label'		=> __( 'Enable Menu', 'read-more' ),
    'section'   => 'read-more-header-top-option',
    'settings'  => 'read_more_theme_options[read-more-header-top-enable-menu]',
    'type'	  	=> 'checkbox',
    'active_callback'   => 'read_more_active_callback_header_top_enable'
) );

/*phone number*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-phone-number]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-phone-number'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-phone-number]', array(
    'label'		=> __( 'Phone Number', 'read-more' ),
    'section'   => 'read-more-header-top-option',
    'settings'  => 'read_more_theme_options[read-more-phone-number]',
    'type'	  	=> 'text',
    'active_callback'   => 'read_more_active_callback_header_top_enable'
) );

/*Email*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-top-email]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-top-email'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-top-email]', array(
    'label'		=> __( 'Email', 'read-more' ),
    'section'   => 'read-more-header-top-option',
    'settings'  => 'read_more_theme_options[read-more-top-email]',
    'type'	  	=> 'text',
    'active_callback'   => 'read_more_active_callback_header_top_enable'
) );

/*Search*/
$wp_customize->add_setting( 'read_more_theme_options[read-more-header-top-enable-search]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['read-more-header-top-enable-search'],
    'sanitize_callback' => 'read_more_sanitize_checkbox'
) );
$wp_customize->add_control( 'read_more_theme_options[read-more-header-top-enable-search]', array(
    'label'		=> __( 'Enable Search', 'read-more' ),
    'section'   => 'read-more-header-top-option',
    'settings'  => 'read_more_theme_options[read-more-header-top-enable-search]',
    'type'	  	=> 'checkbox',
    'active_callback'   => 'read_more_active_callback_header_top_enable'
) );