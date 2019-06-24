<?php
/**
 * The sidebar containing the left widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acme Themes
 * @subpackage Read More
 */
if ( ! is_active_sidebar( 'read-more-sidebar-left' ) ) {
	return;
}
$sidebar_layout = read_more_sidebar_selection();
if( $sidebar_layout == "left-sidebar" || $sidebar_layout == "both-sidebar"  ) : ?>
    <div id="secondary-left" class="widget-area at-remove-width sidebar secondary-sidebar" role="complementary">
        <div id="sidebar-section-top" class="widget-area sidebar clearfix">
			<?php dynamic_sidebar( 'read-more-sidebar-left' );; ?>
        </div>
    </div>
<?php endif;