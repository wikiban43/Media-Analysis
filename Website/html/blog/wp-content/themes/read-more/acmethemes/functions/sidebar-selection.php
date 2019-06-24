<?php
/**
 * Select sidebar according to the options saved
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return string
 *
 */
if ( !function_exists('read_more_sidebar_selection') ) :
	function read_more_sidebar_selection( ) {
		wp_reset_postdata();
		$read_more_customizer_all_values = read_more_get_theme_options();
		global $post;
		if(
			isset( $read_more_customizer_all_values['read-more-single-sidebar-layout'] ) &&
			(
				'left-sidebar' == $read_more_customizer_all_values['read-more-single-sidebar-layout'] ||
				'both-sidebar' == $read_more_customizer_all_values['read-more-single-sidebar-layout'] ||
				'middle-col' == $read_more_customizer_all_values['read-more-single-sidebar-layout'] ||
				'no-sidebar' == $read_more_customizer_all_values['read-more-single-sidebar-layout']
			)
		){
			$read_more_body_global_class = $read_more_customizer_all_values['read-more-single-sidebar-layout'];
		}
		else{
			$read_more_body_global_class= 'right-sidebar';
		}

		if ( read_more_is_woocommerce_active() && ( is_product() || is_shop() || is_product_taxonomy() )) {
			if( is_product() ){
				$post_class = get_post_meta( $post->ID, 'read_more_sidebar_layout', true );
				$read_more_wc_single_product_sidebar_layout = $read_more_customizer_all_values['read-more-wc-single-product-sidebar-layout'];

				if ( 'default-sidebar' != $post_class ){
					if ( $post_class ) {
						$read_more_body_classes = $post_class;
					} else {
						$read_more_body_classes = $read_more_wc_single_product_sidebar_layout;
					}
				}
				else{
					$read_more_body_classes = $read_more_wc_single_product_sidebar_layout;

				}
			}
			else{
				if( isset( $read_more_customizer_all_values['read-more-wc-shop-archive-sidebar-layout'] ) ){
					$read_more_archive_sidebar_layout = $read_more_customizer_all_values['read-more-wc-shop-archive-sidebar-layout'];
					if(
						'right-sidebar' == $read_more_archive_sidebar_layout ||
						'left-sidebar' == $read_more_archive_sidebar_layout ||
						'both-sidebar' == $read_more_archive_sidebar_layout ||
						'middle-col' == $read_more_archive_sidebar_layout ||
						'no-sidebar' == $read_more_archive_sidebar_layout
					){
						$read_more_body_classes = $read_more_archive_sidebar_layout;
					}
					else{
						$read_more_body_classes = $read_more_body_global_class;
					}
				}
				else{
					$read_more_body_classes= $read_more_body_global_class;
				}
			}
		}
		elseif( is_front_page() ){
			if( isset( $read_more_customizer_all_values['read-more-front-page-sidebar-layout'] ) ){
				if(
					'right-sidebar' == $read_more_customizer_all_values['read-more-front-page-sidebar-layout'] ||
					'left-sidebar' == $read_more_customizer_all_values['read-more-front-page-sidebar-layout'] ||
					'both-sidebar' == $read_more_customizer_all_values['read-more-front-page-sidebar-layout'] ||
					'middle-col' == $read_more_customizer_all_values['read-more-front-page-sidebar-layout'] ||
					'no-sidebar' == $read_more_customizer_all_values['read-more-front-page-sidebar-layout']
				){
					$read_more_body_classes = $read_more_customizer_all_values['read-more-front-page-sidebar-layout'];
				}
				else{
					$read_more_body_classes = $read_more_body_global_class;
				}
			}
			else{
				$read_more_body_classes= $read_more_body_global_class;
			}
		}

		elseif ( is_singular() && isset( $post->ID ) ) {
			$post_class = get_post_meta( $post->ID, 'read_more_sidebar_layout', true );
			if ( 'default-sidebar' != $post_class ){
				if ( $post_class ) {
					$read_more_body_classes = $post_class;
				} else {
					$read_more_body_classes = $read_more_body_global_class;
				}
			}
			else{
				$read_more_body_classes = $read_more_body_global_class;
			}

		}
		elseif ( is_archive() ) {
			if( isset( $read_more_customizer_all_values['read-more-archive-sidebar-layout'] ) ){
				$read_more_archive_sidebar_layout = $read_more_customizer_all_values['read-more-archive-sidebar-layout'];
				if(
					'right-sidebar' == $read_more_archive_sidebar_layout ||
					'left-sidebar' == $read_more_archive_sidebar_layout ||
					'both-sidebar' == $read_more_archive_sidebar_layout ||
					'middle-col' == $read_more_archive_sidebar_layout ||
					'no-sidebar' == $read_more_archive_sidebar_layout
				){
					$read_more_body_classes = $read_more_archive_sidebar_layout;
				}
				else{
					$read_more_body_classes = $read_more_body_global_class;
				}
			}
			else{
				$read_more_body_classes= $read_more_body_global_class;
			}
		}
		else {
			$read_more_body_classes = $read_more_body_global_class;
		}
		return $read_more_body_classes;
	}
endif;