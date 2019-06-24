<?php
/**
 * Callback functions for comments
 *
 * @since Read More 1.0.0
 *
 * @param $comment
 * @param $args
 * @param $depth
 * @return void
 *
 */
if ( !function_exists('read_more_commment_list') ) :

    function read_more_commment_list($comment, $args, $depth) {
        extract($args, EXTR_SKIP);
        if ('div' == $args['style']) {
            $tag = 'div';
            $add_below = 'comment';
        }
        else {
            $tag = 'li';
            $add_below = 'div-comment';
        }
        ?>
        <<?php echo $tag ?>
        <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
        <?php if ('div' != $args['style']) : ?>
            <div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
        <?php endif; ?>
        <div class="comment-author vcard">
            <?php
            if ($args['avatar_size'] != 0) echo get_avatar($comment, '64');
            printf(__('<cite class="fn">%s</cite>', 'read-more' ), get_comment_author_link());
            ?>
        </div>
        <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'read-more'); ?></em>
            <br/>
        <?php endif; ?>
        <div class="comment-meta commentmetadata">
            <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                <i class="fa fa-clock-o"></i>
                <?php
                /* translators: 1: date, 2: time */
                printf(__('%1$s at %2$s', 'read-more'), get_comment_date(), get_comment_time()); ?>
            </a>
            <?php edit_comment_link(__('(Edit)', 'read-more'), '  ', ''); ?>
        </div>
        <?php comment_text(); ?>
        <div class="reply">
            <?php comment_reply_link( array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>
        <?php if ('div' != $args['style']) : ?>
            </div>
        <?php endif;
    }
endif;

/**
 * BreadCrumb Settings
 */
if( ! function_exists( 'read_more_breadcrumbs' ) ):
    function read_more_breadcrumbs() {

        if ( ! function_exists( 'breadcrumb_trail' ) ) {
            require read_more_file_directory('acmethemes/library/breadcrumbs/breadcrumbs.php');
        }
        $breadcrumb_args = array(
            'container'   => 'div',
            'show_browse' => false,
            'show_on_front'   => false
        );
        echo "<div id='read-more-breadcrumbs'><div class='breadcrumb-container'>";
        breadcrumb_trail( $breadcrumb_args );
        echo "</div></div>";
    }
endif;

/**
 * Return content of fixed length
 *
 * @since Read More 1.0.0
 *
 * @param string $read_more_content
 * @param int $length
 * @return string
 *
 */
if ( ! function_exists( 'read_more_words_count' ) ) :
    function read_more_words_count( $read_more_content = null, $length = 16 ) {
        $length = absint( $length );
        if ( 0 === $length  ) {
            return '';
        }
        $source_content = preg_replace( '`\[[^\]]*\]`', '', $read_more_content );
        $trimmed_content = wp_trim_words( $source_content, $length, '...' );
        return $trimmed_content;
    }
endif;

/**
 * Generate excerpt.
 *
 * @since Read More 1.1.0
 *
 * @param int     $length Excerpt length in words.
 * @param WP_Post $post_obj WP_Post instance (Optional).
 * @return string Excerpt.
 */
if ( ! function_exists( 'read_more_excerpt' ) ) :
    
    function read_more_excerpt( $length = 50, $post_obj = null ) {

        global $post;
        if ( is_null( $post_obj ) ) {
            $post_obj = $post;
        }

        $length = absint( $length );

        if ( 0 === $length  ) {
            return '';
        }

        $source_content = $post_obj->post_content;
        if ( ! empty( $post_obj->post_excerpt ) ) {
            $source_content = $post_obj->post_excerpt;
        }

        $source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
        $trimmed_content = wp_trim_words( $source_content, $length, '...' );
        return $trimmed_content;
    }
endif;

/**
 * Utility function to check if a gravatar exists for a given email or id
 * @param int|string|object $id_or_email A user ID,  email address, or comment object
 * @return bool if the gravatar exists or not
 * https://gist.github.com/justinph/5197810#file-validate_gravatar-php
 */

function read_more_validate_gravatar($id_or_email) {
	//id or email code borrowed from wp-includes/pluggable.php
	$email = '';
	if ( is_numeric($id_or_email) ) {
		$id = (int) $id_or_email;
		$user = get_userdata($id);
		if ( $user )
			$email = $user->user_email;
	} elseif ( is_object($id_or_email) ) {
		// No avatar for pingbacks or trackbacks
		$allowed_comment_types = apply_filters( 'get_avatar_comment_types', array( 'comment' ) );
		if ( ! empty( $id_or_email->comment_type ) && ! in_array( $id_or_email->comment_type, (array) $allowed_comment_types ) )
			return false;

		if ( !empty($id_or_email->user_id) ) {
			$id = (int) $id_or_email->user_id;
			$user = get_userdata($id);
			if ( $user)
				$email = $user->user_email;
		} elseif ( !empty($id_or_email->comment_author_email) ) {
			$email = $id_or_email->comment_author_email;
		}
	} else {
		$email = $id_or_email;
	}

	$hashkey = md5(strtolower(trim($email)));
	$uri = 'http://www.gravatar.com/avatar/' . $hashkey . '?d=404';

	$data = wp_cache_get($hashkey);
	if (false === $data) {
		$response = wp_remote_head($uri);
		if( is_wp_error($response) ) {
			$data = 'not200';
		} else {
			$data = $response['response']['code'];
		}
		wp_cache_set($hashkey, $data, $group = '', $expire = 60*5);
	}
	if ($data == '200'){
		return true;
	} else {
		return false;
	}
}


/**
 * check if WooCommerce activated
 */
function read_more_is_woocommerce_active() {
	return class_exists( 'WooCommerce' ) ? true : false;
}