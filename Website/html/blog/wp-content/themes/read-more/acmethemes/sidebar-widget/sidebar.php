<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function read_more_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'read-more' ),
        'id'            => 'read-more-sidebar',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Left', 'read-more' ),
		'id'            => 'read-more-sidebar-left',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    register_sidebar(array(
        'name' => __('Home Main Content Area', 'read-more'),
        'id'   => 'read-more-home',
        'description' => __('Displays widgets on home page main content area.', 'read-more'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => __('Footer Full Width', 'read-more'),
        'id' => 'read-more-footer-full-width',
        'description' => __('Displays items on footer section full width', 'read-more'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer Column One', 'read-more'),
        'id' => 'read-more-footer-top-col-one',
        'description' => __('Displays items on footer section.', 'read-more'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer Column Two', 'read-more'),
        'id' => 'read-more-footer-top-col-two',
        'description' => __('Displays items on footer section.', 'read-more'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer Column Three', 'read-more'),
        'id' => 'read-more-footer-top-col-three',
        'description' => __('Displays items on footer section.', 'read-more'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
}
add_action( 'widgets_init', 'read_more_widgets_init' );