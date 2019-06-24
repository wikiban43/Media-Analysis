<?php
/**
 * The front-page template file.
 *
 * @package Acme Themes
 * @subpackage Read More
 * @since Read More 1.0.0
 */
get_header();
/**
 * read_more_action_front_page hook
 * @since Read More 1.0.0
 *
 * @hooked read_more_featured_slider -  10
 * @hooked read_more_front_page -  20
 */
do_action( 'read_more_action_front_page' );

get_footer();