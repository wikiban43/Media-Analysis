<?php
/**
 * Column Post Widgets
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return array $read_more_posts_col__column_number
 *
 */
if ( !function_exists('read_more_posts_col__column_number') ) :
    function read_more_posts_col__column_number() {
        $read_more_posts_col__column_number =  array(
            1 => __( '1', 'read-more' ),
            2 => __( '2', 'read-more' ),
            3 => __( '3', 'read-more' ),
            4 =>  __( '4', 'read-more' )
        );
        return apply_filters( 'read_more_posts_col__column_number', $read_more_posts_col__column_number );
    }
endif;

/**
 * Custom columns of category with various options
 *
 * @package Acme Themes
 * @subpackage Read More
 */
if ( ! class_exists( 'Read_more_posts_col' ) ) {
    /**
     * Class for adding widget
     *
     * @package Acme Themes
     * @subpackage Read_more_posts_col
     * @since 1.0.0
     */
    class Read_more_posts_col extends WP_Widget {

        /*defaults values for fields*/
        private $defaults = array(
            'title'                 => '', 
            'read_more_cat_id'     => '', 
            'post_number'           => 3, 
            'column_number'         => 3,
            'read_more_post_col_image_layout' => 'large',
            'read_more_post_col_content_length' => 130,
            'read_more_text'        => 'Read More', 
            'button_text'           => 'View More', 
            'button_url'            => ''
        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'read_more_posts_col',
                /*Widget name will appear in UI*/
                __('AT Posts Column', 'read-more'),
                /*Widget description*/
                array( 'description' => __( 'Show recents post or post from category', 'read-more' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults );

            /*default values*/
            $title = esc_attr( $instance[ 'title' ] );
            $read_more_selected_cat = esc_attr( $instance[ 'read_more_cat_id' ] );
            $post_number = absint( $instance[ 'post_number' ] );
            $column_number = absint( $instance[ 'column_number' ] );
            /*first featured image*/
            $read_more_post_col_image_layout = $instance['read_more_post_col_image_layout'];
            $read_more_post_col_content_length = absint( $instance[ 'read_more_post_col_content_length' ] );
            $read_more_text = esc_attr( $instance[ 'read_more_text' ] );
            $button_text = esc_attr( $instance[ 'button_text' ] );
            $button_url = esc_url( $instance[ 'button_url' ] );

            $choices = read_more_get_image_sizes_options();
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'read-more' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('read_more_cat_id'); ?>"><?php _e('Select Category', 'read-more'); ?></label>
                <?php
                $read_more_dropown_cat = array(
                    'show_option_none'   => __('From Recent Posts','read-more'),
                    'orderby'            => 'name',
                    'order'              => 'asc',
                    'show_count'         => 1,
                    'hide_empty'         => 1,
                    'echo'               => 1,
                    'selected'           => $read_more_selected_cat,
                    'hierarchical'       => 1,
                    'name'               => $this->get_field_name('read_more_cat_id'),
                    'id'                 => $this->get_field_name('read_more_cat_id'),
                    'class'              => 'widefat',
                    'taxonomy'           => 'category',
                    'hide_if_empty'      => false,
                );
                wp_dropdown_categories($read_more_dropown_cat);
                ?>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'post_number' ); ?>"><?php _e( 'Post Number', 'read-more' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'post_number' ); ?>" name="<?php echo $this->get_field_name( 'post_number' ); ?>" type="number" value="<?php echo $post_number; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'column_number' ); ?>"><?php _e( 'Column Number', 'read-more' ); ?>:</label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'column_number' ); ?>" name="<?php echo $this->get_field_name( 'column_number' ); ?>" >
                    <?php
                    $read_more_posts_col__column_numbers = read_more_posts_col__column_number();
                    foreach ( $read_more_posts_col__column_numbers as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $column_number ); ?>><?php echo esc_attr( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'read_more_post_col_image_layout' ); ?>">
                    <?php _e( 'Post Image', 'read-more' ); ?>
                </label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'read_more_post_col_image_layout' ); ?>" name="<?php echo $this->get_field_name( 'read_more_post_col_image_layout' ); ?>">
                    <?php
                    foreach( $choices as $key => $read_more_column_array ){
                        echo ' <option value="'.$key.'"'.selected( $read_more_post_col_image_layout, $key, 0).'>'.$read_more_column_array.'</option>';
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'read_more_post_col_content_length' ); ?>"><?php _e( 'Post Content Length', 'read-more' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'read_more_post_col_content_length' ); ?>" name="<?php echo $this->get_field_name( 'read_more_post_col_content_length' ); ?>" type="number" value="<?php echo $read_more_post_col_content_length; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'read_more_text' ); ?>"><?php _e( 'Read More Text', 'read-more' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'read_more_text' ); ?>" name="<?php echo $this->get_field_name( 'read_more_text' ); ?>" type="text" value="<?php echo $read_more_text; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Text', 'read-more' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo $button_text; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'button_url' ); ?>"><?php _e( 'Button Link Url', 'read-more' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'button_url' ); ?>" name="<?php echo $this->get_field_name( 'button_url' ); ?>" type="text" value="<?php echo $button_url; ?>" />
            </p>
            <?php
        }

        /**
         * Function to Updating widget replacing old instances with new
         *
         * @access public
         * @since 1.0.0
         *
         * @param array $new_instance new arrays value
         * @param array $old_instance old arrays value
         * @return array
         *
         */
        public function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
            $instance[ 'read_more_cat_id' ] = ( isset( $new_instance['read_more_cat_id'] ) ) ? esc_attr( $new_instance['read_more_cat_id'] ) : '';
            $instance[ 'post_number' ] = absint( $new_instance[ 'post_number' ] );
            $instance[ 'column_number' ] = absint( $new_instance[ 'column_number' ] );
            $instance[ 'read_more_post_col_image_layout' ] = isset($new_instance['read_more_post_col_image_layout'])? esc_attr( $new_instance['read_more_post_col_image_layout'] ) : 'large';
            $instance[ 'read_more_post_col_content_length' ] = absint( $new_instance[ 'read_more_post_col_content_length' ] );
            $instance[ 'read_more_text' ] = sanitize_text_field( $new_instance[ 'read_more_text' ] );
            $instance[ 'button_text' ] = sanitize_text_field( $new_instance[ 'button_text' ] );
            $instance[ 'button_url' ] = esc_url_raw( $new_instance[ 'button_url' ] );

            return $instance;
        }

        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         * @access public
         * @since 1.0.0
         *
         * @param array $args widget setting
         * @param array $instance saved values
         * @return void
         *
         */
        public function widget($args, $instance) {
            if( isset( $args['id'] )){
                $read_more_sidebar_id = $args['id'];
            }
            else{
                $read_more_sidebar_id = 'read-more-footer-full-width';
            }
            $instance = wp_parse_args( (array) $instance, $this->defaults);

            /*default values*/
            $title = apply_filters( 'widget_title', !empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
            $read_more_cat_id = esc_attr( $instance[ 'read_more_cat_id' ] );
            $post_number = absint( $instance[ 'post_number' ] );
            $column_number = absint( $instance[ 'column_number' ] );
            /*first featured post layout*/
            $read_more_post_col_image_layout = esc_attr( $instance['read_more_post_col_image_layout'] );
            $read_more_post_col_content_length = absint( $instance[ 'read_more_post_col_content_length' ] );

            $read_more_text = esc_html( $instance[ 'read_more_text' ] );
            $button_text = esc_html( $instance[ 'button_text' ] );
            $button_url = esc_url( $instance[ 'button_url' ] );

            /**
             * Filter the arguments for the Recent Posts widget.
             *
             * @since 1.0.0
             *
             * @see WP_Query
             *
             */
            $read_more_cat_post_args = array(
                'posts_per_page'      => $post_number,
                'no_found_rows'       => true,
                'post_status'         => 'publish',
                'ignore_sticky_posts' => true
            );
            if( -1 != $read_more_cat_id ){
                $read_more_cat_post_args['cat'] = $read_more_cat_id;
            }
            $the_query = new WP_Query( $read_more_cat_post_args );
            echo $args['before_widget']; 
            ?>
            <section class="acme-widgets acme-col-posts  <?php echo esc_attr( $read_more_sidebar_id );?>">
                <?php
                if( !empty( $title ) ) {
                    echo '<div class="main-title">';
                    echo $args['before_title'] .esc_html( $title ).$args['after_title'];
                    echo '</div>';
                }
                ?>
                <div class="row">
                    <?php
                    if ( $the_query->have_posts() ):
                        $i = 1;
                        global $read_more_read_more_text,
                               $read_more_image_size_options,
                               $read_more_content_length_options;
                        $read_more_read_more_text = $read_more_text;
                        $read_more_image_size_options = $read_more_post_col_image_layout;
                        $read_more_content_length_options = $read_more_post_col_content_length;
                        while( $the_query->have_posts() ):$the_query->the_post();

                            if( 1 == $column_number ){
                                $b_col = " col-sm-12";
                            }
                            elseif( 2 == $column_number ){
                                $b_col = " col-sm-6";
                            }
                            elseif( 3 == $column_number ){
                                $b_col = " col-sm-12 col-md-4";
                            }
                            else{
                                $b_col = " col-sm-12 col-md-3";
                            }
                            ?>
                            <div class="<?php echo $b_col;?>">
                                <div class="blog-item">
                                    <?php get_template_part( 'template-parts/content', 'recents' );?>
                                </div>
                            </div>
                            <?php
                            if( 0 == $i % $column_number ){
                                echo "<div class='clearfix'></div>";
                            }
                            $i++;
                        endwhile;
                    endif;
                    if( !empty( $button_url )){
                        ?>
                        <div class="clearfix"></div>
                        <div class="at-btn-wrap col-sm-12">
                            <div class="btn-wrapper clearfix">
                                <div class="btn-icon-box">
                                    <div class="btn-data">
                                        <a class="btn-links" href="<?php echo $button_url;?>">
                                            <?php echo $button_text; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </section>
            <?php
            echo $args['after_widget'];
        }
    } // Class read_more_posts_col ends here
}

if ( ! function_exists( 'read_more_posts_col' ) ) :
    /**
     * Function to Register and load the widget
     *
     * @since 1.0.0
     *
     * @param null
     * @return void
     *
     */
    function read_more_posts_col() {
        register_widget( 'Read_more_posts_col' );
    }
endif;
add_action( 'widgets_init', 'read_more_posts_col' );