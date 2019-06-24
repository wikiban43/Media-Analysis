<?php
/**
 * Footer content
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'read_more_footer' ) ) :

    function read_more_footer() {
        global $read_more_customizer_all_values;
        ?>
        <div class="clearfix"></div>
        <?php
        if( is_active_sidebar( 'read-more-footer-full-width' ) ) {
           ?>
            <div class="acme-full-width-sidebar">
                <div class="container acme-full-sidebar-wrapper read-more-footer-full-width">
                    <?php dynamic_sidebar( 'read-more-footer-full-width' ); ?>
                </div>
            </div>
            <?php
        }
        ?>
        <footer class="site-footer at-remove-width">
            <?php
            if(
                is_active_sidebar( 'read-more-footer-top-col-one' ) ||
                is_active_sidebar( 'read-more-footer-top-col-two' ) ||
                is_active_sidebar( 'read-more-footer-top-col-three' )
            ){
                $footer_top_col = 'col-sm-4';
                ?>
                <div class="footer-top-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="footer-columns">
                                <?php if( is_active_sidebar( 'read-more-footer-top-col-one' ) ) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr( $footer_top_col );?>">
                                        <?php dynamic_sidebar( 'read-more-footer-top-col-one' ); ?>
                                    </div>
                                <?php endif;
                                if( is_active_sidebar( 'read-more-footer-top-col-two' ) ) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr( $footer_top_col );?>">
                                        <?php dynamic_sidebar( 'read-more-footer-top-col-two' ); ?>
                                    </div>
                                <?php endif;
                                if( is_active_sidebar( 'read-more-footer-top-col-three' ) ) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr( $footer_top_col );?>">
                                        <?php dynamic_sidebar( 'read-more-footer-top-col-three' ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div><!-- footer-top-wrapper-->
                <?php
            }
            ?>
            <div class="footer-bottom-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php
                            if ( 1 == $read_more_customizer_all_values['read-more-enable-social'] ) {
                                /**
                                 * Social Sharing
                                 * read_more_action_social_links
                                 * @since Read More 1.1.0
                                 *
                                 * @hooked read_more_social_links -  10
                                 */
                                echo "<div class='text-center'>";
                                do_action('read_more_action_social_links');
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php
                            if( isset( $read_more_customizer_all_values['read-more-footer-copyright'] ) ): ?>
                                <p class="text-center">
                                    <?php echo wp_kses_post( $read_more_customizer_all_values['read-more-footer-copyright'] ); ?>
                                </p>
                            <?php endif;
                            ?>
                            <div class="footer-copyright border text-center">
                                <div class="site-info">
                                    <?php printf( esc_html__( '%1$s by %2$s', 'read-more' ), 'Read More', '<a href="http://www.acmethemes.com/" rel="designer">Acme Themes</a>' ); ?>
                                </div><!-- .site-info -->
                            </div>
                        </div>
                    </div>
                    <a href="#page" class="sm-up-container"><i class="fa fa-angle-up sm-up"></i></a>
                </div>
            </div>
    </footer>
    <?php
    }
endif;
add_action( 'read_more_action_footer', 'read_more_footer', 10 );

/**
 * Page end
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'read_more_page_end' ) ) :

    function read_more_page_end() {
        ?>
        </div><!-- #page -->
    <?php
    }
endif;
add_action( 'read_more_action_after', 'read_more_page_end', 10 );