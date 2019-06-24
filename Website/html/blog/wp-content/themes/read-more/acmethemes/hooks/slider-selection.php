<?php
/**
 * Display default slider
 *
 * @since Read More 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if ( !function_exists('read_more_default_slider') ) :
    function read_more_default_slider(){
        ?>
        <?php
        $bg_image_style = '';
        if ( get_header_image() ) :
            $bg_image_style .= esc_url( get_header_image() );
        else:
            $bg_image_style .= esc_url( get_template_directory_uri()."/assets/img/startup-slider.jpg" );
        endif; // End header image check.

        $text_align = 'text-center';
        ?>
        <div class="image-slider-wrapper home-fullscreen" id="acme-full-slider">
            <div
                class="feature-slider cycle-slideshow"
                data-cycle-loader="wait"
                data-cycle-fx="fade"
                data-cycle-speed = 1000
                data-cycle-pause-on-hover = true
                data-cycle-timeout = 2000
                data-cycle-slides = '.item'
            >
                <div class="item">
                    <a href="<?php the_permalink()?>" title="<?php the_title_attribute();?>">
                       <img src="<?php echo $bg_image_style?>" title="<?php echo esc_attr__('Read More','read-more')?>">
                    </a>
                    <div class="slider-content <?php echo $text_align;?>">
                        <div class="container">
                            <div class="banner-title"><?php bloginfo( 'name' ); ?></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php
    }
endif;

/**
 * Featured Slider display
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return void
 */

if ( ! function_exists( 'read_more_feature_slider' ) ) :

    function read_more_feature_slider( ){
        global $read_more_customizer_all_values;
        $read_more_slider_from_category = $read_more_customizer_all_values['read-more-slider-from-category'];
        $read_more_featured_slider_number = $read_more_customizer_all_values['read-more-featured-slider-number'];
        $read_more_featured_slider_read_more_text = $read_more_customizer_all_values['read-more-featured-slider-read-more-text'];
        if( 0 != $read_more_slider_from_category ) :
            $read_more_feature_args = array(
                'post_type' => 'post',
                'category__in' => $read_more_slider_from_category,
                'posts_per_page' => $read_more_featured_slider_number,
                'ignore_sticky_posts ' => true
            );
            $slider_query = new WP_Query( $read_more_feature_args );
            /*The Loop*/
            if ( $slider_query->have_posts() ):
                ?>
                <div class="image-slider-wrapper home-fullscreen" id="acme-full-slider">
                    <div
                        class="feature-slider cycle-slideshow"
                        data-cycle-loader="wait"
                        data-cycle-loader="wait"
                        data-cycle-log="false"
                        data-cycle-fx="fade"
                        data-cycle-speed = 1000
                        data-cycle-pause-on-hover = true
                        data-cycle-timeout = 2000
                        data-cycle-slides = '.item'
                    >
                        <!-- prev/next links -->
                        <div class="cycle-prev"><i class="fa fa-angle-left"></i></div>
                        <div class="cycle-next"><i class="fa fa-angle-right"></i></div>
                        <?php
                        $slider_index = 1;
                        while( $slider_query->have_posts() ):$slider_query->the_post();
                            $text_align = 'text-center';
                            if (has_post_thumbnail()) {
                                $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                            }
                            else {
                                $image_url[0] = get_template_directory_uri().'/assets/img/startup-slider.jpg';

                            }
                            ?>
                            <div class="item">
                                <a href="<?php the_permalink()?>" title="<?php the_title_attribute();?>">
                                    <?php the_post_thumbnail('full'); ?>
                                </a>
                                <div class="slider-content <?php echo $text_align;?>">
                                    <div class="container">
                                        <?php read_more_entry_cats(); ?>
                                        <h2 class="banner-title"><?php the_title()?></h2>
                                        <?php
                                        if( !empty( $read_more_featured_slider_read_more_text ) ){
                                            ?>
                                            <div class="btn-wrapper clearfix">
                                                <div class="btn-icon-box">
                                                    <div class="btn-data">
                                                        <a class="btn-links" href="<?php the_permalink(); ?>">
                                                            <?php echo esc_html( $read_more_featured_slider_read_more_text ); ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $slider_index ++;
                            if( 3 < $slider_index ){
                                $slider_index = 1;
                            }
                        endwhile;
                        ?>
                    </div>
                </div>
                <?php
            endif;
        else:
            read_more_default_slider();
        endif;
        wp_reset_postdata();
    }
endif;
add_action( 'read_more_action_feature_slider', 'read_more_feature_slider', 0 );