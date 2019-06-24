<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Acme Themes
 * @subpackage Read More
 */
get_header();
global $read_more_customizer_all_values;
$read_more_blog_archive_layout = $read_more_customizer_all_values['read-more-blog-archive-layout'];
$read_more_content_part = get_post_format();
if( 'full-image' == $read_more_blog_archive_layout ) {
	$read_more_content_part = 'full';
}
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
						<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'read-more' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					</header>
					<?php
					if( 1 == $read_more_customizer_all_values['read-more-show-breadcrumb'] ){
						read_more_breadcrumbs();
					}
					?>
				</div>
				<?php
				if ( have_posts() ) :
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
						get_template_part( 'template-parts/content', $read_more_content_part );

					endwhile;

					/**
					 * read_more_action_navigation hook
					 * @since Read More 1.0.0
					 *
					 * @hooked: read_more_posts_navigation - 10
					 *
					 */
					do_action( 'read_more_action_navigation' );
				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>
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