<?php

/**
 * Read More functions.
 * @package Read More
 * @since 2.0.0
 */

/**
 * check if WooCommerce activated
 */
function read_more_is_woocommerce_active() {
	return class_exists( 'WooCommerce' ) ? true : false;
}
add_action( 'init', 'read_more_remove_wc_breadcrumbs' );
function read_more_remove_wc_breadcrumbs() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
}


/**
 * Woo Commerce Number of row filter Function
 */
if (!function_exists('read_more_loop_columns')) {
	function read_more_loop_columns() {
		$read_more_customizer_all_values = read_more_get_theme_options();
		$read_more_wc_product_column_number = $read_more_customizer_all_values['read-more-wc-product-column-number'];
		if ($read_more_wc_product_column_number) {
			$column_number = $read_more_wc_product_column_number;
		}
		else {
			$column_number = 3;
		}
		return $column_number;
	}
}
add_filter('loop_shop_columns', 'read_more_loop_columns');

function read_more_loop_shop_per_page( $cols ) {
	// $cols contains the current number of products per page based on the value stored on Options -> Reading
	// Return the number of products you wanna show per page.
	$read_more_customizer_all_values = read_more_get_theme_options();
	$read_more_wc_product_total_number = $read_more_customizer_all_values['read-more-wc-shop-archive-total-product'];
	if ($read_more_wc_product_total_number) {
		$cols = $read_more_wc_product_total_number;
	}
	return $cols;
}
add_filter( 'loop_shop_per_page', 'read_more_loop_shop_per_page', 20 );