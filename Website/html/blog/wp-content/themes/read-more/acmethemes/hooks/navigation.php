<?php
/**
 * Post Navigation
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('read_more_posts_navigation') ) :
    function read_more_posts_navigation() {
        global $read_more_customizer_all_values;
        $read_more_pagination_option = $read_more_customizer_all_values['read-more-pagination-option'];
        if( 'default' == $read_more_pagination_option ){
            // Previous/next page navigation.
            the_posts_navigation( array(
                'prev_text'          => '&laquo; '.__( 'Previous page', 'read-more' ),
                'next_text'          => __( 'Next page', 'read-more' ).' &raquo;',
            ) );
        }
        elseif ( 'numeric' == $read_more_pagination_option){
            // Previous/next page navigation.
            the_posts_pagination( array(
                'prev_text'          => '&laquo; ',
                'next_text'          => ' &raquo;',
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'read-more' ) . ' </span>',
            ) );
        }
        else{
            $read_more_ajax_show_more = $read_more_customizer_all_values['read-more-ajax-show-more'];

            $page_number = get_query_var('paged');
            if( $page_number == 0 ){
                $output_page = 2;
            }
            else{
                $output_page = $page_number + 1;
            }
            echo "</main><div class='clearfix'></div><div class='show-more' data-number='$output_page'>".$read_more_ajax_show_more."</div><div id='read-more-temp-post'></div><main>";
        }
    }
endif;
add_action( 'read_more_action_navigation', 'read_more_posts_navigation', 10 );
