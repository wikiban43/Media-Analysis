<?php
/**
 * Dynamic css
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'read_more_dynamic_css' ) ) :

    function read_more_dynamic_css() {

        global $read_more_customizer_all_values;
        /*Color options */
        $read_more_primary_color = esc_attr( $read_more_customizer_all_values['read-more-primary-color'] );
        $read_more_button_design = esc_attr( $read_more_customizer_all_values['read-more-button-design'] );
        $custom_css = '';
        if( 'design-1' == $read_more_button_design ){
            $custom_css .="
           /*new button style*/
            .btn-wrapper{
                margin-left: 12px;
            }
            .slider-content .btn-icon-box .btn-data{
                margin-top: -1px;
            }
            .btn-icon-box,
            .btn-icon-box .btn-data::before,
            .btn-icon-box .btn-data::after {
                background-color: transparent;
                border: 1px solid #eee;
                bottom: auto;
                content: \"\";
                display: inline-block;
                font-size: 13px;
                left: auto;
                letter-spacing: 1px;
                margin: 0;
                outline: none;
                overflow: visible;
                padding: 0;
                position: relative;
                right: auto;
                text-decoration: none;
                text-overflow: clip;
                top: auto;
                transform-origin: 50% 50% 0;
                transition: all 150ms cubic-bezier(0.25, 0.25, 0.75, 0.75) 0s;
                white-space: normal;
                z-index: auto;
            }
            .btn-icon-box .btn-data::before,
            .btn-icon-box .btn-data::after {
                background-color: transparent;
                border: 1px solid #eee;
                content: \"\";
                display: block;
                height: calc(100% + 2px);
                position: absolute;
                top: -1px;
                transform: scaleX(1) scaleY(1) scaleZ(1) skewX(0deg);
                transform-origin: 50% 50% 0;
                width: 5px;
            }
            .btn-icon-box .btn-data::before,
            .btn-icon-box .btn-data::after {
                width: 3px;
            }
            .btn-icon-box .btn-data::before {
                left: -4px;
            }
            .btn-icon-box .btn-data::after {
                right: -4px;
            }
            .btn-icon-box .btn-data,
            .btn-icon-box .btn-data a,
            .btn-icon-box .btn-data:hover,
            .btn-icon-box .btn-data:hover a {
                color: #fff;
            }
            .btn-icon-box .btn-data:hover {
                background-color: #fff;
            }
            .btn-icon-box .btn-data:hover a {
                color: #242424;
            }
            .btn-icon-box .btn-data::before,
            .btn-icon-box .btn-data:hover::before {
                left: -8px;
            }
            .btn-icon-box .btn-data::after,
            .btn-icon-box .btn-data:hover::after {
                right: -8px;
            }
            
            .btn-icon-box .btn-data .btn-links {
                display: block;
                font-size: 13px;
                line-height: 24px;
                padding: 5px 13px;
            }
            .btn-icon-box,
            .btn-icon-box .btn-data {
                border-radius: 0;
            }
            .btn-icon-box .btn-data .btn-links {
                padding: 5px 15px;
            }
            .btn-icon-box .btn-data::before{
                background-color: transparent;
                height: calc(100% + 0px);
                top: 0;
                z-index: 99;
            }
            .btn-icon-box .btn-data::before {
                background-color: transparent;
                border-radius: 5px 0 0 5px;
                border-style: solid;
                border-width: 4px;
                display: inline-block;
                left: -12px;
                padding: 2px;
            }
            .btn-icon-box .btn-data::after {
                background-color: transparent;
                border-radius: 0 5px 5px 0;
                border-style: solid;
                border-width: 4px;
                display: inline-block;
                padding: 2px;
                right: -12px;
            }
            .btn-icon-box .btn-data:hover::before {
                left: -16px;
            }
            .btn-icon-box .btn-data:hover::after {
                right: -16px;
            }";
        }
        else{
            /*color*/
            $custom_css .= "
            .btn-icon-box {
                display: inline-block;
                padding: 6px 12px; 
                border-radius : 4px;
                background-color: {$read_more_primary_color};
            }";
        }
        /*color*/
        $custom_css .= "
            a:hover,
            a:active,
            a:focus,
            .btn-primary:hover,
            .wpcf7-form input.wpcf7-submit:hover,
            .widget li a:hover,
            .posted-on a:hover,
            .cat-links a:hover,
            .comments-link a:hover,
            article.post .entry-header .entry-title a:hover, 
            article.page .entry-header .entry-title a:hover,
            .edit-link a:hover,
            .tags-links a:hover,
            .byline a:hover,
            .nav-links a:hover,
             .primary-color,
             .page-numbers.current,
             #read-more-breadcrumbs .breadcrumb-container a:hover{
                color: {$read_more_primary_color};
            }";

        /*background color*/
        $custom_css .= "
            .navbar .navbar-toggle:hover,
            .comment-form .form-submit input,
            .read-more,
            .posts-navigation a,
            .post-navigation a 
            .btn-primary,
            .wpcf7-form input.wpcf7-submit,
            .breadcrumb,
            .top-header,
            .sm-up-container,
            .primary-bg-color,
            .show-more{
                background-color: {$read_more_primary_color};
                color:#fff;
            }";

        /*borders*/
        $custom_css .= "
            .comment-form .form-submit input,
            .read-more,
            .btn-primary,
            .btn-primary:hover,
            .posts-navigation a,
            .post-navigation a 
            .at-btn-wrap .btn-primary,
            .wpcf7-form input.wpcf7-submit,
            .btn-icon-box{
                border: 1px solid {$read_more_primary_color};
            }";
        $custom_css .= "
            .blog article.sticky{
                border-top: 2px solid {$read_more_primary_color};
            }";
        $custom_css .= "
            .main-navigation .current_page_item,
            .main-navigation .current-menu-item,
            .main-navigation .active ,
            .main-navigation .navbar-nav >li:hover{
                border-bottom: 2px solid {$read_more_primary_color};
            }";

        $custom_css .= "
             .breadcrumb::after {
                border-left: 5px solid {$read_more_primary_color};
            }
            .rtl .breadcrumb::after {
                border-right: 5px solid {$read_more_primary_color};
                border-left:medium none;
            }
            ";

        /*special button*/
        $custom_css .= "
        .btn-icon-box .btn-data{
            background-color: {$read_more_primary_color};
        }";
        $custom_css .= "
        .btn-icon-box .btn-data::before
        {
           	border-color: {$read_more_primary_color} transparent {$read_more_primary_color} {$read_more_primary_color};
        }";
        $custom_css .= "
        .btn-icon-box .btn-data::after
        {
        	border-color: {$read_more_primary_color} {$read_more_primary_color} {$read_more_primary_color} transparent;
        }";
        $custom_css .= "
        .slider-content .btn-icon-box {
            border: 1px solid {$read_more_primary_color};
        }";
        wp_add_inline_style( 'read-more-style', $custom_css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'read_more_dynamic_css', 99 );