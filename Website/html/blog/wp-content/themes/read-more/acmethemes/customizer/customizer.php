<?php
/**
 * Read More Theme Customizer.
 *
 * @package Acme Themes
 * @subpackage Read More
 */

/*
* file for upgrade to pro
*/
require read_more_file_directory('acmethemes/customizer/customizer-pro/class-customize.php');

/*
* file for customizer core functions
*/
require read_more_file_directory('acmethemes/customizer/customizer-core.php');

/*
* file for customizer sanitization functions
*/
require read_more_file_directory('acmethemes/customizer/sanitize-functions.php');

/**
 * Adding different options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( !function_exists('read_more_customize_register') ) :
    function read_more_customize_register( $wp_customize ) {

        $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
        $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

        /*saved options*/
        $options  = read_more_get_theme_options();

        /*defaults options*/
        $defaults = read_more_get_default_theme_options();

        require read_more_file_directory('acmethemes/customizer/custom-controls.php');

        /*
         * file for feature panel of home page
         */
        require read_more_file_directory('acmethemes/customizer/feature-section/feature-panel.php');
        /*
         * file for feature panel of blog page
         */
        require read_more_file_directory('acmethemes/customizer/feature-section-blog/feature-panel.php');
        /*
        * file for header panel
        */
        require read_more_file_directory('acmethemes/customizer/header-options/header-panel.php');

        /*
        * file for customizer footer section
        */
        require read_more_file_directory('acmethemes/customizer/footer-options/footer-panel.php');

        /*
        * file for design/layout panel
        */
        require read_more_file_directory('acmethemes/customizer/design-options/design-panel.php');

        /*
        * file for single post sections
        */
        require read_more_file_directory('acmethemes/customizer/single-posts/single-post-section.php');

	    /*
* file for wocommerce panel
*/
	    require_once read_more_file_directory('acmethemes/customizer/wc-options/wc-panel.php');

        /*
         * file for options panel
         */
        require read_more_file_directory('acmethemes/customizer/options/options-panel.php');
    }
endif;
add_action( 'customize_register', 'read_more_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( !function_exists('read_more_customize_preview_js') ) :

    function read_more_customize_preview_js() {
        wp_enqueue_script( 'read-more-customizer', get_template_directory_uri() . '/acmethemes/core/js/customizer.js', array( 'customize-preview' ), '1.1.0', true );
    }
endif;
add_action( 'customize_preview_init', 'read_more_customize_preview_js' );