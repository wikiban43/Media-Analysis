<?php
/**
 * Setting global variables for all theme options saved values
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'read_more_set_global' ) ) :
    function read_more_set_global() {
        /*Getting saved values start*/
        $read_more_saved_theme_options = read_more_get_theme_options();
        $GLOBALS['read_more_customizer_all_values'] = $read_more_saved_theme_options;
        /*Getting saved values end*/
    }
endif;
add_action( 'read_more_action_before_head', 'read_more_set_global', 0 );

/**
 * Doctype Declaration
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'read_more_doctype' ) ) :
    function read_more_doctype() {
        ?><!DOCTYPE html><html <?php language_attributes(); ?>>
        <?php
    }
endif;
add_action( 'read_more_action_before_head', 'read_more_doctype', 10 );

/**
 * Code inside head tage but before wp_head funtion
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'read_more_before_wp_head' ) ) :

    function read_more_before_wp_head() {
        ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php
    }
endif;
add_action( 'read_more_action_before_wp_head', 'read_more_before_wp_head', 10 );

/**
 * Add body class
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'read_more_body_class' ) ) :

    function read_more_body_class( $read_more_body_classes ) {
        global $read_more_customizer_all_values;
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        if ( 'no-image' == $read_more_customizer_all_values['read-more-blog-archive-layout'] ) {
            $read_more_body_classes[] = 'blog-no-image';
        }
        $read_more_body_classes[] = read_more_sidebar_selection();

        if(
            is_front_page()
            && ( is_active_sidebar( 'read-more-home' ) )
            && 1 == $paged  )
        {
            $read_more_body_classes[] = 'read-more-home-sidebar';
        }
        if( is_active_sidebar( 'read-more-footer-full-width' ) ){
            $read_more_body_classes[] = 'read-more-footer-full-width-sidebar';
        }

        if( 1 == $read_more_customizer_all_values['read-more-enable-sticky-sidebar'] ){
            $read_more_body_classes[] = 'at-sticky-sidebar';
        }
        return $read_more_body_classes;
    }
endif;
add_action( 'body_class', 'read_more_body_class', 10, 1);

/**
 * Start site div
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'read_more_site_start' ) ) :

    function read_more_site_start() {
        ?>
        <div class="site" id="page">
        <?php
    }
endif;
add_action( 'read_more_action_before', 'read_more_site_start', 20 );

/**
 * Skip to content
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'read_more_skip_to_content' ) ) :

    function read_more_skip_to_content() {
        ?>
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'read-more' ); ?></a>
        <?php
    }
endif;
add_action( 'read_more_action_before_header', 'read_more_skip_to_content', 10 );

/**
 * Main header
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'read_more_header' ) ) :
    function read_more_header() {
        global $read_more_customizer_all_values;
        $read_more_enable_header_top = $read_more_customizer_all_values['read-more-enable-header-top'];
        if( 1 == $read_more_enable_header_top ){
            ?>
            <div class="top-header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 text-left">
                            <?php
                            $read_more_header_top_enable_menu = $read_more_customizer_all_values['read-more-header-top-enable-menu'];
                            $read_more_header_top_enable_social = $read_more_customizer_all_values['read-more-header-top-enable-social'];

                            if( has_nav_menu( 'top-menu' ) && 1 == $read_more_header_top_enable_menu ){
                               wp_nav_menu(array('theme_location' => 'top-menu','container' => 'div', 'container_class' => 'acmethemes-top-nav top-block', 'depth' => 1 ));
                            }
                            if( 1 ==  $read_more_header_top_enable_social ) {
                                do_action('read_more_action_social_links');
                            }
                            ?>
                        </div>
                        <div class="col-sm-4 text-right">
                            <?php 
                             $read_more_phone_number = $read_more_customizer_all_values['read-more-phone-number'];
                             $read_more_top_email = $read_more_customizer_all_values['read-more-top-email'];
                             $read_more_header_top_enable_search = $read_more_customizer_all_values['read-more-header-top-enable-search'];
                             if( !empty( $read_more_phone_number ) ){
                                echo "<a class='top-phone' href='tel:".esc_attr( esc_html( $read_more_phone_number ))."'><i class='fa fa-phone'></i>".esc_html( $read_more_phone_number )."</a>";
                             }
                             if( !empty( $read_more_top_email ) ){
                                echo "<a class='top-email' href='mailto:".esc_attr( esc_html( $read_more_top_email ))."'><i class='fa fa-envelope-o'></i>".esc_html( $read_more_top_email )."</a>";
                             }
                            if( 1 == $read_more_header_top_enable_search ) {
                                echo '<div class="header-search top-block"><i class="fa fa-search icon-menu search-icon-menu"></i>';
                                echo "<div class='menu-search-toggle'>";
                                echo "<div class='menu-search-inner'>";
                                get_search_form();
                                echo '</div>';/*menu-search-inner*/
                                echo '</div>';/*menu-search-toggle*/
                            }
                            ?>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="navbar at-navbar" id="navbar" role="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></button>
                            <?php
                            if ( 'disable' != $read_more_customizer_all_values['read-more-header-id-display-opt'] ):
                                if ( 'logo-only' == $read_more_customizer_all_values['read-more-header-id-display-opt'] && function_exists( 'the_custom_logo' ) ):
                                    the_custom_logo();
                                else:/*else is title-only or title-and-tagline*/
                                    if ( is_front_page() && is_home() ) : ?>
                                        <h1 class="site-title">
                                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                        </h1>
                                    <?php else : ?>
                                        <p class="site-title">
                                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                        </p>
                                    <?php endif;
                                    if ( 'title-and-tagline' == $read_more_customizer_all_values['read-more-header-id-display-opt'] ):
                                        $description = get_bloginfo( 'description', 'display' );
                                        if ( $description || is_customize_preview() ) : ?>
                                            <p class="site-description"><?php echo esc_html( $description ); ?></p>
                                        <?php endif;
                                    endif;
                                endif;
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="at-navbar-wrapper">
                <div class="at-navbar-trigger-fix">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="main-navigation navbar-collapse collapse">
                                    <?php
                                    wp_nav_menu(
                                        array(
                                            'theme_location' => 'primary',
                                            'menu_id' => 'primary-menu',
                                            'menu_class' => 'nav navbar-nav',
                                        )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
endif;
add_action( 'read_more_action_header', 'read_more_header', 10 );