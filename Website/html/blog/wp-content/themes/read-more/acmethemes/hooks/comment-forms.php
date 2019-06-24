<?php
/**
 * Comment Form
 *
 * @since Read More 1.0.0
 *
 * @param array $form
 * @return array $form
 *
 */
if ( !function_exists('read_more_alter_comment_form') ) :

    function read_more_alter_comment_form($form) {

        $required = get_option('require_name_email');
        $req = $required ? 'aria-required="true"' : '';
        $form['fields']['author'] = '<p class="comment-form-author"><label for="author"></label><input id="author" name="author" type="text" placeholder="'.esc_attr__( 'Name', 'read-more' ).'" value="" size="30" ' . $req . '/></p>';
        $form['fields']['email'] = '<p class="comment-form-email"><label for="email"></label> <input id="email" name="email" type="email" value="" placeholder="'.esc_attr__( 'Email', 'read-more' ).'" size="30" ' . $req . ' /></p>';
        $form['fields']['url'] = '<p class="comment-form-url"><label for="url"></label> <input id="url" name="url" placeholder="'.esc_attr__( 'Website URL', 'read-more' ).'" type="url" value="" size="30" /></p>';
        $form['comment_field'] = '<p class="comment-form-comment"><label for="comment"></label> <textarea id="comment" name="comment" placeholder="'.esc_attr__( 'Comment', 'read-more' ).'" cols="45" rows="8" aria-required="true"></textarea></p>';
        $form['comment_notes_before'] = '';
        $form['label_submit'] = __( 'Add Comment', 'read-more' );
        $form['title_reply'] = sprintf( __( '%s Leave a Comment', 'read-more' ), '<span></span>' );
        return $form;
    }
endif;
add_filter('comment_form_defaults', 'read_more_alter_comment_form');