<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Read More
 */
get_header();
global $read_more_customizer_all_values;
?>
    <div id="content" class="site-content container clearfix">
	    <?php
	    $sidebar_layout = read_more_sidebar_selection(get_the_ID());
	    if( 'both-sidebar' == $sidebar_layout ) {
		    echo '<div id="primary-wrap" class="clearfix">';
	    }
	    ?>
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <div class="wrapper inner-main-title">
                    <header class="entry-header">
                        <h1 class="entry-title">
                            <?php _e('Store','read-more')?>
                        </h1>
                    </header><!-- .entry-header -->
                    <?php
                    if( 1 == $read_more_customizer_all_values['read-more-show-breadcrumb'] ){
                        read_more_breadcrumbs();
                    }
                    ?>
                </div>
                <?php if ( have_posts() ) :
                    woocommerce_content();
                endif;
                ?>
            </main><!-- #main -->
        </div><!-- #primary -->
        <?php
        get_sidebar( 'left' );
        get_sidebar();
        if( 'both-sidebar' == $sidebar_layout ) {
	        echo '</div>';
        }
        ?>
    </div><!-- #content -->
<?php get_footer();