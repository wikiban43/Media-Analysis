<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Blogdot
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blogdot_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( get_theme_mod( 'blogdot_sidebar_position', 'right' ) === 'left' ) {
		$classes[] = 'bd-left-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'blogdot_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function blogdot_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'blogdot_pingback_header' );

/**
* Breadcrumb Trail Customization
*/
function blogdot_breadcrumb_trail() {
	$breadcrumb_defaults = array(
		'browse_tag'      => 'h6',
		'show_browse'     => false,
		'labels' => array(
			'home' => '<i class="fas fa-home"></i>'
		),
	);
	if ( function_exists( 'breadcrumb_trail' ) ) :
		breadcrumb_trail( $breadcrumb_defaults );
	endif;
}

/**
* Add classes to navigation buttons
*/
add_filter( 'next_posts_link_attributes', 'blogdot_posts_link_attributes' );
add_filter( 'previous_posts_link_attributes', 'blogdot_posts_link_attributes' );
add_filter( 'next_comments_link_attributes', 'blogdot_comments_link_attributes' );
add_filter( 'previous_comments_link_attributes', 'blogdot_comments_link_attributes' );

function blogdot_posts_link_attributes() {
    return 'class="btn btn-sm cont-btn no-underl mb-4"';
}

function blogdot_comments_link_attributes() {
    return 'class="btn btn-sm cont-btn no-underl mb-4"';
}

/**
* Check if cover section is displayed
*/
function blogdot_is_cover_active() {
	if( ! is_home() ) {
		return false;
	}
	if( get_theme_mod( 'blogdot_display_cover_section', true ) ) {
		return true;
	}
	return false;
}


/**
 * Image sanitization callback
 */
function blogdot_sanitize_image( $image, $setting ) {
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
	// Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
	// If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}



/**
* Greet new users & guide them to help page
*/
function blogdot_admin_notice(){
	if ( is_admin() ) {
		blogdot_greet_user();
	}
}
$intro_notice_dismissed = get_option( 'blogdot-intro-dismissed' );
if( empty( $intro_notice_dismissed ) ) {
	add_action('admin_notices', 'blogdot_admin_notice');
}

function blogdot_greet_user() {
	echo '<div class="notice blogdot-intro-notice notice-success is-dismissible">';
	echo wp_kses_post( __( '<p style="margin-bottom: 5px;">Welcome! Thank you for choosing Blogdot. You can always reach out to us on the support forum if you need any help. Please do take a look at the pro version of the theme. If you liked our work, please support us by providing a review with 5-star ratings.', 'blogdot' ) );
	echo "<p><a href='https://wp-points.com/themes/blogdot-pro' class='button button-primary' target='_blank' style=''>";
	esc_html_e( 'Check Blogdot Pro', 'blogdot' );
	echo "</a><a href='https://blogdot-pro.wp-points.com/' class='button' target='_blank' style='margin-left: 10px;'>";
	esc_html_e( 'View Pro Demo', 'blogdot' );
	echo "</a><a href='https://wordpress.org/support/theme/blogdot/reviews/#new-post' class='' target='_blank' style='margin-left: 10px;'>";
	esc_html_e( 'Rate us 5 stars', 'blogdot' );
	echo "</a><a href='#' class='bd-notice-dismiss' style='margin-left: 10px;float: right;'>";
	esc_html_e( 'Don\'t display this again!', 'blogdot' );
	echo '</a></p></div>';
}


// Enqueue dismiss script
function blogdot_admin_scripts() {
	wp_enqueue_script( 'blogdot-admin', get_template_directory_uri() . '/assets/js/blogdot-admin.js' );
}
$intro_notice_dismissed = get_option( 'blogdot-intro-dismissed' );
if( empty( $intro_notice_dismissed ) ) {
	add_action( 'admin_enqueue_scripts' , 'blogdot_admin_scripts' );
}

// Update option if notice dismissed
add_action( 'wp_ajax_blogdot-intro-dismissed', 'blogdot_dismiss_intro_notice' );
function blogdot_dismiss_intro_notice() {
	update_option( 'blogdot-intro-dismissed', 1 );
}
