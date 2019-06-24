<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acme Themes
 * @subpackage Read More
 */

/**
 * read_more_action_after_content hook
 * @since Read More 1.0.0
 *
 * @hooked null
 */
do_action( 'read_more_action_after_content' );

/**
 * read_more_action_before_footer hook
 * @since Read More 1.0.0
 *
 * @hooked null
 */
do_action( 'read_more_action_before_footer' );

/**
 * read_more_action_footer hook
 * @since Read More 1.0.0
 *
 * @hooked read_more_footer - 10
 */
do_action( 'read_more_action_footer' );

/**
 * read_more_action_after_footer hook
 * @since Read More 1.0.0
 *
 * @hooked null
 */
do_action( 'read_more_action_after_footer' );

/**
 * read_more_action_after hook
 * @since Read More 1.0.0
 *
 * @hooked read_more_page_end - 10
 */
do_action( 'read_more_action_after' );
wp_footer();
?>
</body>
</html>