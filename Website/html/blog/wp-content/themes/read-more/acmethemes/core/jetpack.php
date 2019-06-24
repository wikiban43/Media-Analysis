<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Acme Themes
 * @subpackage Read More
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */

if ( ! function_exists( 'read_more_jetpack_setup' ) ) :
	function read_more_jetpack_setup() {
		// Add theme support for Infinite Scroll.
		add_theme_support( 'infinite-scroll', array(
			'container' => 'main',
			'render'    => 'read_more_infinite_scroll_render',
			'footer'    => 'page',
		) );

		// Add theme support for Responsive Videos.
		add_theme_support( 'jetpack-responsive-videos' );
	}
endif;
add_action( 'after_setup_theme', 'read_more_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
if ( ! function_exists( 'read_more_jetpack_setup' ) ) :
	function read_more_jetpack_setup() {
		while ( have_posts() ) {
			the_post();
			global $read_more_customizer_all_values;

			$read_more_blog_archive_layout = $read_more_customizer_all_values['read-more-blog-archive-layout'];
			$read_more_content_part = get_post_format();
			if( 'full-image' == $read_more_blog_archive_layout ) {
				$read_more_content_part = 'full';
			}
			get_template_part( 'template-parts/content', $read_more_content_part );
		}
	}
endif;