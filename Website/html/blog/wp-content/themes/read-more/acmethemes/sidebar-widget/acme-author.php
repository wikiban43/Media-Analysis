<?php
/**
 * Custom author
 *
 * @package Acme Themes
 * @subpackage Read More
 */
if ( ! class_exists( 'read_more_author_widget' ) ) :
    /**
     * Class for adding author widget
     * A new way to add author
     * @package AcmeThemes
     * @subpackage Read More
     * @since 1.1.0
     */
    class read_more_author_widget extends WP_Widget {
        /*defaults values for fields*/
        private $defaults = array(
            'read_more_author_title' => '',
            'read_more_author_image' => '',
            'read_more_author_link'  => '',
            'read_more_author_new_window' => 1,
            'read_more_author_short_disc'  => '',
        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'read_more_author',
                /*Widget name will appear in UI*/
                __('AT Author', 'read-more'),
                /*Widget description*/
                array( 'description' => __( 'Add author with different options.', 'read-more' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            /*merging arrays*/
            $instance = wp_parse_args( (array) $instance, $this->defaults);
            $read_more_author_title  = esc_attr( $instance['read_more_author_title'] );
            $read_more_author_image  = esc_url( $instance['read_more_author_image'] );
            $read_more_author_link   = esc_url( $instance['read_more_author_link'] );
            $read_more_author_new_window = esc_attr( $instance['read_more_author_new_window'] );
            $read_more_author_short_disc = esc_attr( $instance['read_more_author_short_disc'] );
            ?>
            <p class="description">
                <?php
                _e('Note: Use square image. Recommended image size : 250 x 250', 'read-more' );
                ?>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'read_more_author_title' ); ?>"><?php _e( 'Title:', 'read-more' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'read_more_author_title' ); ?>" name="<?php echo $this->get_field_name( 'read_more_author_title' ); ?>" type="text" value="<?php echo esc_attr( $read_more_author_title ); ?>" />
            </p>
            <h4><?php _e( 'Author Image', 'read-more' ); ?></h4>
            <p>
                <label for="<?php echo $this->get_field_id('read_more_author_image'); ?>">
                    <?php _e( 'Select Author Image', 'read-more' ); ?>
                </label>
                <?php
                $read_more_display_none = '';
                if ( empty( $read_more_author_image ) ){
                    $read_more_display_none = ' style="display:none;" ';
                }
                ?>
                <span class="img-preview-wrap" <?php echo esc_attr( $read_more_display_none ); ?>>
                    <img class="widefat" src="<?php echo esc_url( $read_more_author_image ); ?>" alt="<?php _e( 'Image preview', 'read-more' ); ?>"  />
                </span><!-- .ad-preview-wrap -->
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('read_more_author_image'); ?>" id="<?php echo $this->get_field_id('read_more_author_image'); ?>" value="<?php echo esc_url( $read_more_author_image ); ?>" />
                <input type="button" value="<?php _e( 'Upload Image', 'read-more' ); ?>" class="button media-image-upload" data-title="<?php _e( 'Select Author Image','read-more'); ?>" data-button="<?php _e( 'Select Author Image','read-more'); ?>"/>
                <input type="button" value="<?php _e( 'Remove Image', 'read-more' ); ?>" class="button media-image-remove" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'read_more_author_short_disc' ); ?>"><?php _e( 'Author Short Disc:', 'read-more' ); ?></label>
                <textarea class="widefat" id="<?php echo $this->get_field_id( 'read_more_author_short_disc' ); ?>" name="<?php echo $this->get_field_name( 'read_more_author_short_disc' ); ?>"><?php echo esc_attr( $read_more_author_short_disc ); ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'read_more_author_link' ); ?>"><?php _e( 'Link URL:', 'read-more' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'read_more_author_link' ); ?>" name="<?php echo $this->get_field_name( 'read_more_author_link' ); ?>" type="text" value="<?php echo esc_attr( $read_more_author_link ); ?>" />
            </p>
            <p>
                <input id="<?php echo $this->get_field_id( 'read_more_author_new_window' ); ?>" name="<?php echo $this->get_field_name( 'read_more_author_new_window' ); ?>" type="checkbox" <?php checked( 1 == $read_more_author_new_window ? $instance['read_more_author_new_window'] : 0); ?> />
                <label for="<?php echo $this->get_field_id( 'read_more_author_new_window' ); ?>"><?php _e( 'Open in new window', 'read-more' ); ?></label>
            </p>
            <hr />
            <?php
        }

        /**
         * Function to Updating widget replacing old instances with new
         *
         * @access public
         * @since 1.0
         *
         * @param array $new_instance new arrays value
         * @param array $old_instance old arrays value
         * @return array
         *
         */
        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['read_more_author_title'] = ( isset( $new_instance['read_more_author_title'] ) ) ?  sanitize_text_field( $new_instance['read_more_author_title'] ): '';
            $instance['read_more_author_image'] = ( isset( $new_instance['read_more_author_image'] ) ) ?  esc_url( $new_instance['read_more_author_image'] ): '';
            $instance['read_more_author_link'] = ( isset( $new_instance['read_more_author_link'] ) ) ?  esc_url( $new_instance['read_more_author_link'] ): '';
            $instance['read_more_author_short_disc'] = ( isset( $new_instance['read_more_author_short_disc'] ) ) ?  wp_kses_post( $new_instance['read_more_author_short_disc'] ): '';
            $instance['read_more_author_new_window'] = isset($new_instance['read_more_author_new_window'])? 1 : 0;

            return $instance;
        }

        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         * @access public
         * @since 1.0
         *
         * @param array $args widget setting
         * @param array $instance saved values
         * @return void
         *
         */
        function widget( $args, $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults);
            $read_more_author_title      = apply_filters( 'widget_title', $instance['read_more_author_title'], $instance, $this->id_base );
            $read_more_author_image      = esc_url( $instance['read_more_author_image'] );
            $read_more_author_link       = esc_url( $instance['read_more_author_link'] );
            $read_more_author_new_window = esc_attr( $instance['read_more_author_new_window'] );
            $read_more_author_short_disc = wp_kses_post( $instance['read_more_author_short_disc'] );

            echo $args['before_widget'];

            if ( !empty($read_more_author_title) ) {
                echo $args['before_title'] . $read_more_author_title . $args['after_title'];
            }
            $ad_content_image = '';
            if ( ! empty( $read_more_author_image ) ) {
                /*creating add*/
                $img_html = '<img src="' . $read_more_author_image . '"/><span class="clearfix"></span>';
                $link_open = '';
                $link_close = '';
                if ( ! empty( $read_more_author_link ) ) {
                    $target_text = ( 1 == $read_more_author_new_window ) ? ' target="_blank" ' : '';
                    $link_open = '<a href="' .  $read_more_author_link . '" ' . $target_text . '>';
                    $link_close = '</a>';
                }
                $ad_content_image = $link_open . $img_html .  $link_close.$read_more_author_short_disc;
            }
            if ( !empty( $ad_content_image ) ) {
                echo '<div class="read-more-author-widget">';
                echo $ad_content_image;
                echo '</div>';
            }
            echo $args['after_widget'];
        }
    }
endif;

if ( ! function_exists( 'read_more_author_widget' ) ) :
    /**
     * Function to Register and load the widget
     *
     * @since 1.0
     *
     * @param null
     * @return void
     *
     */
    function read_more_author_widget() {
        register_widget( 'read_more_author_widget' );
    }
endif;
add_action( 'widgets_init', 'read_more_author_widget' );