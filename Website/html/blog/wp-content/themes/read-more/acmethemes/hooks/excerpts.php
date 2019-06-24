<?php
/**
 * Add ... for more view
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return null
 *
 */

if ( !function_exists('read_more_excerpt_more') ) :
    function read_more_excerpt_more($more) {
		if( is_admin() ){
			return $more;
		}
        return '&hellip;';
    }
endif;
add_filter('excerpt_more', 'read_more_excerpt_more');