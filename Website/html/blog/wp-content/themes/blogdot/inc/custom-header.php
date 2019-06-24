<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Blogdot
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses blogdot_header_style()
 */
function blogdot_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'blogdot_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '363636',
		'width'                  => 1200,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'blogdot_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'blogdot_custom_header_setup' );

if ( ! function_exists( 'blogdot_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see blogdot_custom_header_setup().
	 */
	function blogdot_header_style() {

		if ( get_header_image() ) : ?>
			<style type="text/css">
				.site-header {
					background-image: url(<?php echo esc_url( get_header_image() ); ?>);
					background-position: center;
					background-size: cover;
				}
				.site-branding {
					background: rgba(25, 25, 25, 0.4);
				}
			</style>
		<?php
		endif;

		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
		// If the user has set a custom color for the text use that.
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
			.site-description {
				opacity: 0.85;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
