<?php
/*It is underscores functions.php file and its modification*/
if ( ! function_exists( 'read_more_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function read_more_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Read More, use a find and replace
         * to change 'read-more' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'read-more', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for custom logo.
         *
         *  @since Read More 1.0.0
          */
        add_theme_support( 'custom-logo', array(
            'height'      => 200,
            'width'       => 1080,
            'flex-height' => true,
            'flex-width' => true
        ) );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 340, 240, true );

        // Adding excerpt for page
        add_post_type_support( 'page', 'excerpt' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary', 'read-more' ),
            'top-menu' => esc_html__( 'Top Menu ( Support First Level Only )', 'read-more' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'read_more_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        /*woocommerce support*/
        add_theme_support( 'woocommerce' );
    }
endif;
add_action( 'after_setup_theme', 'read_more_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function read_more_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'read_more_content_width', 640 );
}
add_action( 'after_setup_theme', 'read_more_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function read_more_scripts() {
    global $read_more_customizer_all_values;
    /*google font*/
    wp_enqueue_style( 'read-more-googleapis', '//fonts.googleapis.com/css?family=Montserrat:400,700|Poppins:300,400', array(), null );

    /*Bootstrap*/
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/library/bootstrap/css/bootstrap.min.css', array(), '3.3.6' );
    wp_style_add_data( 'bootstrap', 'rtl', 'replace' );

    /*Font-Awesome-master*/
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/Font-Awesome/css/font-awesome.min.css', array(), '4.7.0' );
    wp_style_add_data( 'font-awesome', 'rtl', 'replace' );

    wp_enqueue_style( 'read-more-style', get_stylesheet_uri(),'','1.0.44' );
    wp_style_add_data( 'read-more-style', 'rtl', 'replace' );


    wp_enqueue_script( 'read-more-skip-link-focus-fix', get_template_directory_uri() . '/acmethemes/core/js/skip-link-focus-fix.js', array(), '20130115', true );

    /*jquery start*/
    /*cycle2*/
    wp_enqueue_script('jquery-cycle2', get_template_directory_uri() . '/assets/library/cycle2/jquery.cycle2.min.js', array('jquery'), '1.3.3', 1);

    /*html5*/
    wp_enqueue_script('html5', get_template_directory_uri() . '/assets/library/html5shiv/html5shiv.min.js', array('jquery'), '3.7.3', false);
    wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

    /*respond*/
    wp_enqueue_script('respond', get_template_directory_uri() . '/assets/library/respond/respond.min.js', array('jquery'), '1.1.2', false);
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

    /*Bootstrap*/
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/library/bootstrap/js/bootstrap.min.js', array('jquery'), '3.3.6', 1);

    if( 1 == $read_more_customizer_all_values['read-more-enable-sticky-sidebar'] ){
        wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() . '/assets/library/theia-sticky-sidebar/theia-sticky-sidebar.min.js', array('jquery'), '1.4.0', 1);
    }
    
    /*theme custom js*/
    wp_enqueue_script('read-more-custom', get_template_directory_uri() . '/assets/js/read-more-custom.js', array('jquery'), '0.0.2', 1);
	global $wp_query;
	$paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
	$max_num_pages = $wp_query->max_num_pages;
	$read_more_ajax_show_more = $read_more_customizer_all_values['read-more-ajax-show-more'];
	$read_more_ajax_no_more = $read_more_customizer_all_values['read-more-ajax-no-more'];
	$read_more_pagination_option = $read_more_customizer_all_values['read-more-pagination-option'];
	wp_localize_script( 'read-more-custom', 'read_more_ajax', array(
		'ajaxurl'        => admin_url( 'admin-ajax.php' ),
		'paged'          => $paged,
		'max_num_pages'  => $max_num_pages,
		'next_posts'     => next_posts( $max_num_pages, false ),
		'show_more'      => $read_more_ajax_show_more,
		'no_more_posts'  => $read_more_ajax_no_more,
		'pagination_option'  => $read_more_pagination_option
	));

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'read_more_scripts' );

/**
 * check if edit page
 */
function read_more_is_edit_page() {
	//make sure we are on the backend
	if ( !is_admin() ){
		return false;
	}
	global $pagenow;
	return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
}

/**
 * Enqueue admin scripts and styles.
 */
function read_more_admin_scripts( $hook ) {

	if ( 'widgets.php' == $hook || read_more_is_edit_page() ){
        wp_enqueue_media();
        wp_enqueue_script( 'read-more-widgets-script', get_template_directory_uri() . '/assets/js/acme-widget.js', array( 'jquery' ), '1.0.0' );
    }

}
add_action( 'admin_enqueue_scripts', 'read_more_admin_scripts' );

/**
 * Implement the Custom Header feature.
 */
require read_more_file_directory('acmethemes/core/custom-header.php');

/**
 * Custom template tags for this theme.
 */
require read_more_file_directory('acmethemes/core/template-tags.php');

/**
 * Custom functions that act independently of the theme templates.
 */
require read_more_file_directory('acmethemes/core/extras.php');

/**
 * Load Jetpack compatibility file.
 */
require read_more_file_directory('acmethemes/core/jetpack.php');