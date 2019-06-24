<?php
/**
 * Read More sidebar layout options
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return array
 *
 */
if ( !function_exists('read_more_sidebar_layout_options') ) :
    function read_more_sidebar_layout_options() {
        $read_more_sidebar_layout_options = array(
	        'default-sidebar' => array(
		        'value'     => 'default-sidebar',
		        'thumbnail' => get_template_directory_uri() . '/acmethemes/images/default-sidebar.png'
	        ),
	        'left-sidebar' => array(
		        'value'     => 'left-sidebar',
		        'thumbnail' => get_template_directory_uri() . '/acmethemes/images/left-sidebar.png'
	        ),
	        'right-sidebar' => array(
		        'value' => 'right-sidebar',
		        'thumbnail' => get_template_directory_uri() . '/acmethemes/images/right-sidebar.png'
	        ),
	        'both-sidebar' => array(
		        'value' => 'both-sidebar',
		        'thumbnail' => get_template_directory_uri() . '/acmethemes/images/both-sidebar.png'
	        ),
	        'middle-col' => array(
		        'value'     => 'middle-col',
		        'thumbnail' => get_template_directory_uri() . '/acmethemes/images/middle-col.png'
	        ),
	        'no-sidebar' => array(
		        'value'     => 'no-sidebar',
		        'thumbnail' => get_template_directory_uri() . '/acmethemes/images/no-sidebar.png'
	        )
        );
        return apply_filters( 'read_more_sidebar_layout_options', $read_more_sidebar_layout_options );
    }
endif;

/**
 * Custom Metabox
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return void
 *
 */
if( !function_exists( 'read_more_add_metabox' )):
    function read_more_add_metabox() {
        add_meta_box(
            'read_more_sidebar_layout', // $id
            __( 'Sidebar Layout', 'read-more' ), // $title
            'read_more_sidebar_layout_callback', // $callback
            'post', // $page
            'normal', // $context
            'high'
        ); // $priority

        add_meta_box(
            'read_more_sidebar_layout', // $id
            __( 'Sidebar Layout', 'read-more' ), // $title
            'read_more_sidebar_layout_callback', // $callback
            'page', // $page
            'normal', // $context
            'high'
        ); // $priority
    }
endif;
add_action('add_meta_boxes', 'read_more_add_metabox');

/**
 * Callback function for metabox
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('read_more_sidebar_layout_callback') ) :
    function read_more_sidebar_layout_callback(){
        global $post;
        $read_more_sidebar_layout_options = read_more_sidebar_layout_options();
        $read_more_sidebar_layout = 'default-sidebar';
        $read_more_sidebar_meta_layout = get_post_meta( $post->ID, 'read_more_sidebar_layout', true );
        if( !read_more_is_null_or_empty($read_more_sidebar_meta_layout) ){
            $read_more_sidebar_layout = $read_more_sidebar_meta_layout;
        }
        wp_nonce_field( basename( __FILE__ ), 'read_more_sidebar_layout_nonce' );
        ?>
        <style>
            .hide-radio{
                position: relative;
                margin-bottom: 6px;
            }

            .hide-radio img, .hide-radio label{
                display: block;
            }

            .hide-radio input[type="radio"]{
                position: absolute;
                left: 50%;
                top: 50%;
                opacity: 0;
            }

            .hide-radio input[type=radio] + label {
                border: 3px solid #F1F1F1;
            }

            .hide-radio input[type=radio]:checked + label {
                border: 3px solid #F88C00;
            }
        </style>
        <table class="form-table page-meta-box">
            <tr>
                <td colspan="4"><h4><?php _e( 'Choose Sidebar Template', 'read-more' ); ?></h4></td>
            </tr>
            <tr>
                <td>
                    <?php
                    foreach ($read_more_sidebar_layout_options as $field) {
                        ?>
                        <div class="hide-radio radio-image-wrapper" style="float:left; margin-right:30px;">
                            <input id="<?php echo $field['value']; ?>" type="radio" name="read_more_sidebar_layout" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $read_more_sidebar_layout ); ?>/>
                            <label class="description" for="<?php echo $field['value']; ?>">
                                <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="" />
                            </label>
                        </div>
                    <?php } // end foreach
                    ?>
                    <div class="clear"></div>
                </td>
            </tr>
            <tr>
                <td><em class="f13"><?php _e( 'You can set up the sidebar content', 'read-more' ); ?> <a href="<?php echo admin_url('/widgets.php'); ?>"><?php _e( 'here', 'read-more' ); ?></a></em></td>
            </tr>
        </table>
    <?php
}
endif;

/**
 * save the custom metabox data
 * @hooked to save_post hook
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('read_more_save_sidebar_layout') ) :
    function read_more_save_sidebar_layout( $post_id ) {

        /*
          * A Guide to Writing Secure Themes – Part 4: Securing Post Meta
          *https://make.wordpress.org/themes/2015/06/09/a-guide-to-writing-secure-themes-part-4-securing-post-meta/
          * */
        if (
            !isset( $_POST[ 'read_more_sidebar_layout_nonce' ] ) ||
            !wp_verify_nonce( $_POST[ 'read_more_sidebar_layout_nonce' ], basename( __FILE__ ) ) || /*Protecting against unwanted requests*/
            ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || /*Dealing with autosaves*/
            ! current_user_can( 'edit_post', $post_id )/*Verifying access rights*/
        ){
            return;
        }

        //Execute this saving function
        if(isset($_POST['read_more_sidebar_layout'])){
            $old = get_post_meta( $post_id, 'read_more_sidebar_layout', true);
            $new = sanitize_text_field($_POST['read_more_sidebar_layout']);
            if ($new && $new != $old) {
                update_post_meta($post_id, 'read_more_sidebar_layout', $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id,'read_more_sidebar_layout', $old);
            }
        }
    }
endif;
add_action('save_post', 'read_more_save_sidebar_layout');

/**
 * Video meta box
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return void
 *
 */
if( !function_exists( 'read_more_add_video_metabox' )):
    function read_more_add_video_metabox() {
        add_meta_box(
            'read_more_video_meta', // $id
            __( 'Featured Video', 'read-more' ), // $title
            'read_more_featured_video_callback', // $callback
            'post', // $page
            'side', // $context
            'low'
        ); // $priority
    }
endif;
add_action('add_meta_boxes', 'read_more_add_video_metabox');

/**
 * Callback function for metabox
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('read_more_featured_video_callback') ) :
    function read_more_featured_video_callback(){
        global $post;
        $read_more_video_url = get_post_meta( $post->ID, 'read_more_video_url', true );
        $read_more_replace_featured_image = get_post_meta( $post->ID, 'read_more_replace_featured_image', true );
        $read_more_video_autoplay = get_post_meta( $post->ID, 'read_more_video_autoplay', true );
        wp_nonce_field( basename( __FILE__ ), 'read_more_video_url_nonce' );
        ?>
        <style>
            #read_more_video_meta{
                word-wrap: break-word;
                -ms-word-wrap: break-word;
                word-break: break-all;
            }
        </style>
        <table class="form-table page-meta-box">
            <tr>
                <td>
                    <label class="description" for="read_more_video_url">
                        <?php _e( 'Enter Video URL', 'read-more' ); ?>
                    </label>
                    <input id="read_more_video_url" type="text" class="widefat" name="read_more_video_url" value="<?php echo esc_url( $read_more_video_url );?>" />
                    <br />
                    <small>
                        <?php
                        printf(__('Please enter youtube or vimeo video url with video ID. Youtube Example %1$s or Vimeo Example %2$s', 'read-more'),
                            "https://www.youtube.com/embed/[video-id] eg: <br /><code>https://www.youtube.com/embed/tyFzhpyHnUI</code><br />",
                            "https://player.vimeo.com/video/[video-id] eg: <br /><code>https://player.vimeo.com/video/152773407</code>")
                        ?>
                    </small>
                </td>
            </tr>
            <tr>
                <td>
                    <input id="read_more_replace_featured_image" type="checkbox" name="read_more_replace_featured_image" <?php checked( 1, $read_more_replace_featured_image ); ?> />
                    <label class="description" for="read_more_replace_featured_image">
                        <?php _e( 'Replace Featured Image In Single Post', 'read-more' ); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <input id="read_more_video_autoplay" type="checkbox" name="read_more_video_autoplay" <?php checked( 1, $read_more_video_autoplay ); ?> />
                    <label class="description" for="read_more_video_autoplay">
                        <?php _e( 'Autoplay Video', 'read-more' ); ?>
                    </label>
                </td>
            </tr>
        </table>
    <?php
    }
endif;

/**
 * save the custom metabox data
 * @hooked to save_post hook
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('read_more_save_video_url') ) :
    function read_more_save_video_url( $post_id ) {
        /*
        * A Guide to Writing Secure Themes – Part 4: Securing Post Meta
        *https://make.wordpress.org/themes/2015/06/09/a-guide-to-writing-secure-themes-part-4-securing-post-meta/
        * */
        if (
            !isset( $_POST[ 'read_more_video_url_nonce' ] ) ||
            !wp_verify_nonce( $_POST[ 'read_more_video_url_nonce' ], basename( __FILE__ ) ) || /*Protecting against unwanted requests*/
            ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || /*Dealing with autosaves*/
            ! current_user_can( 'edit_post', $post_id )/*Verifying access rights*/
        ){
            return;
        }
        //Execute this saving function
        if(isset($_POST['read_more_video_url'])){
            $old = get_post_meta( $post_id, 'read_more_video_url', true);
            $new = esc_url_raw( $_POST['read_more_video_url'] );
            if ($new && $new != $old) {
                update_post_meta($post_id, 'read_more_video_url', $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id,'read_more_video_url', $old);
            }
        }
        if( isset( $_POST['read_more_replace_featured_image'] ) && !empty( $_POST['read_more_replace_featured_image'] )){
            update_post_meta($post_id, 'read_more_replace_featured_image', 1);
        }
        else{
            update_post_meta($post_id, 'read_more_replace_featured_image', '');
        }
        if( isset( $_POST['read_more_video_autoplay'] ) && !empty( $_POST['read_more_video_autoplay'] )){
            update_post_meta($post_id, 'read_more_video_autoplay', 1);
        }
        else{
            update_post_meta($post_id, 'read_more_video_autoplay', '');
        }
    }
endif;
add_action('save_post', 'read_more_save_video_url');

/**
 * Read More  Other options
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return array
 *
 */
if ( !function_exists('read_more_featured_image_display_options') ) :
    function read_more_featured_image_display_options() {
        $read_more_featured_image_display_options = array(
            'default-featured-image' => array(
                'value'     => 'default-featured-image',
                'title' => __( 'Default As Global Option', 'read-more' )
            ),
            'show-featured-image' => array(
                'value'     => 'show-featured-image',
                'title' => __( 'Show Featured Section', 'read-more' )
            ),
            'hide-featured-image' => array(
                'value'     => 'hide-featured-image',
                'title' => __( 'Hide Featured Section', 'read-more' )
            )
        );
        return apply_filters( 'read_more_featured_image_display_options', $read_more_featured_image_display_options );
    }
endif;

/**
 * Custom Metabox
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return void
 *
 */
if( !function_exists( 'read_more_others_metabox' )):
    function read_more_others_metabox() {
        add_meta_box(
            'read_more_others_metabox', // $id
            __( ' Other Options', 'read-more' ), // $title
            'read_more_others_metabox_callback', // $callback
            'post', // $page
            'normal', // $context
            'high'
        ); // $priority

        add_meta_box(
            'read_more_others_metabox', // $id
            __( ' Other Options ', 'read-more' ), // $title
            'read_more_others_metabox_callback', // $callback
            'page', // $page
            'normal', // $context
            'high'
        ); // $priority
    }
endif;
add_action('add_meta_boxes', 'read_more_others_metabox');

/**
 * Callback function for metabox
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('read_more_others_metabox_callback') ) :
    function read_more_others_metabox_callback(){
        global $post;
        $read_more_featured_image_display_options = read_more_featured_image_display_options();
        $read_more_featured_image_display_option = 'default-featured-image';
        $read_more_featured_image_display_option_meta = get_post_meta( $post->ID, 'read_more_featured_image_display_option', true );
        if( !read_more_is_null_or_empty($read_more_featured_image_display_option_meta) ){
            $read_more_featured_image_display_option = $read_more_featured_image_display_option_meta;
        }
        wp_nonce_field( basename( __FILE__ ), 'read_more_others_meta_nonce' );
        ?>
        <table class="form-table page-meta-box">
            <tr>
                <td colspan="4"><h4><?php _e( ' Feature Section/Image Option', 'read-more' ); ?></h4></td>
            </tr>
            <tr>
                <td>
                    <?php
                    foreach ($read_more_featured_image_display_options as $key=>$field) {
                        ?>
                        <div>
                            <input class="read_more_featured_image_display_option" id="<?php echo esc_attr($key); ?>" type="radio" name="read_more_featured_image_display_option" value="<?php echo esc_attr($key); ?>" <?php checked( $key, $read_more_featured_image_display_option ); ?> />
                            <label class="description" for="<?php echo esc_attr($key); ?>">
                                <?php echo esc_attr( $field['title']); ?>
                            </label>
                        </div>
                    <?php } // end foreach
                    ?>
                    <div class="clear"></div>
                </td>
            </tr>
        </table>
    <?php
}
endif;

/**
 * save the custom metabox data
 * @hooked to save_post hook
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('read_more_save_others_meta') ) :
    function read_more_save_others_meta( $post_id ) {

        if (
            !isset( $_POST[ 'read_more_others_meta_nonce' ] ) ||
            !wp_verify_nonce( $_POST[ 'read_more_others_meta_nonce' ], basename( __FILE__ ) ) || /*Protecting against unwanted requests*/
            ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || /*Dealing with autosaves*/
            ! current_user_can( 'edit_post', $post_id )/*Verifying access rights*/
        ){
            return;
        }
        if ('page' == $_POST['post_type']) {
            if (!current_user_can( 'edit_page', $post_id ) )
                return $post_id;
        } elseif (!current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }

        //Execute this saving function
        if( isset( $_POST['read_more_featured_image_display_option'] )){
            $old = get_post_meta( $post_id, 'read_more_featured_image_display_option', true );
            $new = esc_attr( $_POST['read_more_featured_image_display_option'] );
            if ($new && $new != $old) {
                update_post_meta( $post_id, 'read_more_featured_image_display_option', $new );
            } elseif ('' == $new && $old) {
                delete_post_meta( $post_id,'read_more_featured_image_display_option', $old );
            }
        }
    }
endif;
add_action('save_post', 'read_more_save_others_meta');