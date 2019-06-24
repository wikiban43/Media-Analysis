<?php
/**
 * Blogdot Theme Customizer
 *
 * @package Blogdot
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blogdot_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'blogdot_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'blogdot_customize_partial_blogdescription',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdot_cover_title', array(
			'selector'         => '.bd-cover-title',
			'render_callback' => 'blogdot_customize_partial_cover_title',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdot_cover_subtitle', array(
			'selector'         => '.bd-cover-subtitle',
			'render_callback' => 'blogdot_customize_partial_cover_subtitle',
		) );
	}

	include get_template_directory() . '/inc/customizer/theme-options.php';
}
add_action( 'customize_register', 'blogdot_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function blogdot_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function blogdot_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function blogdot_customize_partial_cover_title() {
	echo get_theme_mod( 'blogdot_cover_title' );
}
function blogdot_customize_partial_cover_subtitle() {
	echo get_theme_mod( 'blogdot_cover_subtitle' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blogdot_customize_preview_js() {
	wp_enqueue_script( 'blogdot-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'blogdot_customize_preview_js' );


// Add Styles to the Customizer
function blogdot_customizer_css()
{
	wp_enqueue_style( 'blogdot-customizer-css', get_template_directory_uri() . '/inc/customizer/customizer.css' );
}
add_action( 'customize_controls_print_styles', 'blogdot_customizer_css' );


// Custom CSS output for theme options
function blogdot_custom_css_output() { ?>
	<style type="text/css" id="custom-theme-css">
		.custom-logo { height: <?php echo esc_html( get_theme_mod( 'blogdot_logo_height', '60' ) ); ?>px; width: auto; }
		<?php if( get_theme_mod( 'blogdot_display_cover_section', true ) ) { ?>
			.home.blog .site-header {border-bottom-width: 0px;}
		<?php } ?>
	</style>
	<?php
}
add_action( 'wp_head', 'blogdot_custom_css_output');
