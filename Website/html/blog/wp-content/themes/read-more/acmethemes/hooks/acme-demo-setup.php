<?php
if( !function_exists( 'read_more_demo_nav_data') ){
    function read_more_demo_nav_data(){
        $demo_navs = array(
            'top-menu' => 'Top',
            'primary'  => 'Primary Menu'
        );
        return $demo_navs;
    }
}
add_filter('acme_demo_setup_nav_data','read_more_demo_nav_data');

if( !function_exists( 'read_more_demo_wp_options_data') ){
    function read_more_demo_wp_options_data(){
        $wp_options = array(
            'blogname'       => 'Read More'
        );
        return $wp_options;
    }
}
add_filter('acme_demo_setup_wp_options_data','read_more_demo_wp_options_data');