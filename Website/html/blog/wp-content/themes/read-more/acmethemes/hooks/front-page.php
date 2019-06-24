<?php
/**
 * Front page hook for all WordPress Conditions
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'read_more_featured_slider' ) ) :

    function read_more_featured_slider() {
        global $read_more_customizer_all_values;

        $read_more_enable_feature = $read_more_customizer_all_values['read-more-enable-feature'];
        if( is_front_page() && 1 == $read_more_enable_feature  ) :
            do_action( 'read_more_action_feature_slider' );
        endif;
    }

endif;
add_action( 'read_more_action_front_page', 'read_more_featured_slider', 10 );

if ( ! function_exists( 'read_more_front_page' ) ) :

    function read_more_front_page() {
        global $read_more_customizer_all_values;

        $read_more_hide_front_page_content = $read_more_customizer_all_values['read-more-hide-front-page-content'];
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        /*show widget in front page, now user are not force to use front page*/
        if( is_active_sidebar( 'read-more-home' ) && 1 == $paged ){
            ?>
            <div class="acme-full-width-sidebar top">
                <div class="container acme-full-sidebar-wrapper read-more-home">
                    <?php dynamic_sidebar( 'read-more-home' ); ?>
                </div>
            </div>
            <?php
        }
        if( 1 != $read_more_hide_front_page_content ){
            if ( 'posts' == get_option( 'show_on_front' ) ) {
                include( get_home_template() );
            }
            else {
                include( get_page_template() );
            }
        }
    }
endif;
add_action( 'read_more_action_front_page', 'read_more_front_page', 20 );

/**
 * Feature Section Function for Home/Blog Page
 * It is function not hook ***
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'read_more_featured_section' ) ) :

    function read_more_featured_section() {
        global $read_more_customizer_all_values;
        $read_more_enable_feature_blog = $read_more_customizer_all_values['read-more-enable-feature-blog'];
        $read_more_blog_feature_title = $read_more_customizer_all_values['read-more-blog-feature-title'];
        if( 1 != $read_more_enable_feature_blog ) {
            return;
        }
        $read_more_blog_feature_from_category = $read_more_customizer_all_values['read-more-blog-feature-from-category'];
        $sticky = get_option( 'sticky_posts' );
        if( 0 != $read_more_blog_feature_from_category ) :
            $read_more_child_page_args = array(
                'post_type' => 'post',
                'category__in' => $read_more_blog_feature_from_category,
                'posts_per_page' => 6,
                'ignore_sticky_posts ' => true,
                'post__not_in' => $sticky,
            );
        else:
            $read_more_child_page_args = array(
                'post_type' => 'post',
                'posts_per_page' => 6,
                'ignore_sticky_posts ' => true,
                'post__not_in' => $sticky,
            );
        endif;
        $slider_query = new WP_Query( $read_more_child_page_args );
        /*The Loop*/
        if ( $slider_query->have_posts() ):
            ?>
            <div class="blog-feature-section" id="acme-feature-section">
                <div class="blog-feature-wrap">
                    <?php
                    if( !empty( $read_more_blog_feature_title ) ):
                    ?>
                        <div class="main-title">
                            <h3 class="widget-title"><span><?php echo esc_html( $read_more_blog_feature_title ); ?></span></h3>
                        </div>
                        <?php
                    endif;
                    ?>
                    <div class="row">
                        <?php
                        $slider_index = 1;
                        while( $slider_query->have_posts() ):$slider_query->the_post();
                            ?>
                            <div class="blog-feature-item col-sm-4">
                                <?php
                                if( has_post_thumbnail() ){
                                    ?>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php
                                        the_post_thumbnail('post-thumbnail');
                                        ?>
                                    </a>
                                    <?php
                                }
                                else{
                                    ?>
                                    <div class="no-img-wrapper">
                                        <?php the_title( sprintf( '<p class="no-img-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></p>' ); ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="blog-feature-content">
                                    <?php read_more_entry_cats(); ?>
                                    <?php the_title( sprintf( '<h2 class="blog-feature-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                                </div>
                            </div>
                            <?php
                            if( $slider_index == 3 ){
                                echo "</div><div class='row second'>";/*row end and row start*/
                            }
                            $slider_index ++;
                        endwhile;
                        ?>
                    </div>
                </div>
            </div>
            <?php
        endif;
        wp_reset_postdata();
    }
endif;