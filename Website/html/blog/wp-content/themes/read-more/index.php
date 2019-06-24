<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Read More
 */
get_header();
global $read_more_customizer_all_values;
$read_more_enable_feature = $read_more_customizer_all_values['read-more-enable-feature'];
$read_more_blog_archive_layout = $read_more_customizer_all_values['read-more-blog-archive-layout'];
$read_more_blog_index_title = $read_more_customizer_all_values['read-more-blog-index-title'];
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
				<?php
				read_more_featured_section();
				?>
				<div class="wrapper inner-main-title">
					<?php
					if( !empty( $read_more_blog_index_title ) ){
						?>
						<header class="entry-header">
							<h1 class="page-title">
								<?php echo esc_html( $read_more_blog_index_title );  ?>
							</h1>
						</header>
						<?php
					}
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
						get_template_part( 'template-parts/content', $read_more_content_part);

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