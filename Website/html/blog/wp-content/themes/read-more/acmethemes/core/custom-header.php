<?php
/**
 * Sample implementation of the Custom Header feature.
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Acme Themes
 * @subpackage Read More
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses read_more_header_style()
 */
if ( ! function_exists( 'read_more_custom_header_setup' ) ) :
	function read_more_custom_header_setup() {
		add_theme_support( 'custom-header', apply_filters( 'read_more_custom_header_args', array(
			'default-image'          => '',
			'width'                  => 1800,
			'height'                 => 700,
			'flex-height'            => true,
			'header-text'            => false
		) ) );
	}
endif;
add_action( 'after_setup_theme', 'read_more_custom_header_setup' );