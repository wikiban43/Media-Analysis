<?php
/**
 * Main include functions ( to support child theme ) that child theme can override file too
 *
 * @since Read More 1.0.0
 *
 * @param string $file_path, path from the theme
 * @return string full path of file inside theme
 *
 */
if( !function_exists('read_more_file_directory') ){

    function read_more_file_directory( $file_path ){
        if( file_exists( trailingslashit( get_stylesheet_directory() ) . $file_path) ) {
            return trailingslashit( get_stylesheet_directory() ) . $file_path;
        }
        else{
            return trailingslashit( get_template_directory() ) . $file_path;
        }
    }
}

/**
 * Check empty or null
 *
 * @since  Education Base 1.0.0
 *
 * @param string $str, string
 * @return boolean
 *
 */
if( !function_exists('read_more_is_null_or_empty') ){
	function read_more_is_null_or_empty( $str ){
		return ( !isset($str) || trim($str)==='' );
	}
}
/*file for library*/
require read_more_file_directory('acmethemes/library/tgm/class-tgm-plugin-activation.php');
/*
* file for customizer theme options
*/
require read_more_file_directory('acmethemes/customizer/customizer.php');

/*
* file for additional functions files
*/
require read_more_file_directory('acmethemes/functions.php');

require read_more_file_directory('acmethemes/functions/sidebar-selection.php');

/*
* files for hooks
*/
require read_more_file_directory('acmethemes/hooks/tgm.php');

require read_more_file_directory('acmethemes/hooks/front-page.php');

require read_more_file_directory('acmethemes/hooks/slider-selection.php');

require read_more_file_directory('acmethemes/hooks/header.php');

require read_more_file_directory('acmethemes/hooks/social-links.php');

require read_more_file_directory('acmethemes/hooks/dynamic-css.php');

require read_more_file_directory('acmethemes/hooks/footer.php');

require read_more_file_directory('acmethemes/hooks/comment-forms.php');

require read_more_file_directory('acmethemes/hooks/excerpts.php');

require read_more_file_directory('acmethemes/hooks/related-posts.php');

require read_more_file_directory('acmethemes/hooks/navigation.php');

require read_more_file_directory('acmethemes/hooks/siteorigin-panels.php');

require read_more_file_directory('acmethemes/hooks/acme-demo-setup.php');

/*
* file for sidebar and widgets
*/
require read_more_file_directory('acmethemes/sidebar-widget/acme-col-posts.php');

require read_more_file_directory('acmethemes/sidebar-widget/acme-feature-col-posts.php');

require read_more_file_directory('acmethemes/sidebar-widget/acme-ad.php');

require read_more_file_directory('acmethemes/sidebar-widget/acme-author.php');

require read_more_file_directory('acmethemes/sidebar-widget/sidebar.php');

/*file for metaboxes*/
require read_more_file_directory('acmethemes/metabox/metabox-defaults.php');

/*
* file for core functions imported from functions.php while downloading Underscores
*/
require read_more_file_directory('acmethemes/core.php');
require read_more_file_directory('acmethemes/gutenberg/gutenberg-init.php');

/*themes info*/
require read_more_file_directory('acmethemes/at-theme-info/class-at-theme-info.php');