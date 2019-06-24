<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Acme Themes
 * @subpackage Read More
 */

if ( ! function_exists( 'read_more_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time, author, comment and edit.
 */
function read_more_posted_on( $avatar_size = 60 ) {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		'%s',
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><i class="fa fa-clock-o"></i>' . $time_string . '</a>'
	);
	if( read_more_validate_gravatar (get_the_author_meta( 'user_email' ))){
		$avatar = get_avatar( get_the_author_meta( 'user_email' ), $avatar_size, '' );
		$author_wrap = 'has-avatar';
	}
	else{
		$avatar = '<i class="fa fa-user"></i>';
		$author_wrap = 'no-avatar';
	}
	$byline = sprintf(
		'%s',
		'<span class="author vcard '.$author_wrap.'"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">'. $avatar . "<span class='author-name'>".esc_html( get_the_author() ) . '</span></a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span><span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link"><i class="fa fa-comment-o"></i>';
		comments_popup_link( esc_html__( 'Leave a comment', 'read-more' ), esc_html__( '1 Comment', 'read-more' ), esc_html__( '% Comments', 'read-more' ) );
		echo '</span>';
	}

	if( get_edit_post_link()){
		edit_post_link(
			sprintf(
			/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'read-more' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link"><i class="fa fa-edit "></i>',
			'</span>'
		);
	}
}
endif;

if ( ! function_exists( 'read_more_entry_footer' ) ) :
/**
 * Prints HTML with meta information for tags.
 */
function read_more_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ' ', 'read-more' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">%1$s</span>', $tags_list ); // WPCS: XSS OK.
		}
	}
}
endif;

if ( ! function_exists( 'read_more_entry_cats' ) ) :
	/**
	 * Prints HTML with meta information for the categories.
	 */
	function read_more_entry_cats() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'read-more' ) );
			if ( $categories_list && read_more_categorized_blog() ) {
				printf( '<span class="cat-links">%1$s</span>', $categories_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if ( ! function_exists( 'read_more_categorized_blog' ) ) :
	function read_more_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'read_more_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,

				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'read_more_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so read_more_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so read_more_categorized_blog should return false.
			return false;
		}
	}
endif;

/**
 * Flush out the transients used in read_more_categorized_blog.
 */
if ( ! function_exists( 'read_more_category_transient_flusher' ) ) :
	function read_more_category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'read_more_categories' );
	}
endif;
add_action( 'edit_category', 'read_more_category_transient_flusher' );
add_action( 'save_post',     'read_more_category_transient_flusher' );