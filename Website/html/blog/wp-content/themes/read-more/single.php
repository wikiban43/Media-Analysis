<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
				<?php
				if( has_category( ) ){
					echo "<div class='cat-wrap'>";
					read_more_entry_cats();
					echo "</div>";
				}
				?>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
				<?php
				if( 1 == $read_more_customizer_all_values['read-more-show-breadcrumb'] ){
					read_more_breadcrumbs();
				}
				?>
			</div>
			<?php
			while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', 'single' );
				if ( is_singular( 'attachment' ) ) {
					// Parent post navigation.
					the_post_navigation( array(
						'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'read-more' ),
						) );
				} elseif ( is_singular( 'post' ) ) {
					// Previous/next post navigation.
					the_post_navigation( array(
						'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'read-more' ) . ':</span> ' .
							'<span class="screen-reader-text">' . __( 'Next post:', 'read-more' ) . '</span> ' .
							'<span class="post-title">%title</span>',
						'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'read-more' ) . ':</span> ' .
							'<span class="screen-reader-text">' . __( 'Previous post:', 'read-more' ) . '</span> ' .
							'<span class="post-title">%title</span>',
						) );
				}
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			endwhile; // End of the loop.
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