<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Blogdot
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>
	<div class="row larger-gutter align-items-center be-single-header justify-content-center">
		<div class="col-md-8 <?php if ( get_theme_mod( 'blogdot_sidebar_position', 'right' ) === 'hide' ) : echo "text-center"; endif; ?>">
			<?php the_title( '<h1 class="entry-title h4">', '</h1>' ); ?>
			<div class="entry-meta">
				<?php
					blogdot_posted_on();
					blogdot_posted_by();
				?>
			</div><!-- .entry-meta -->
		</div>
		<?php if ( get_theme_mod( 'blogdot_sidebar_position', 'right' ) != 'hide' ) : ?>
			<div class="col-md-4 text-right">
				<div class="entry-meta">
					<?php if ( ! get_theme_mod( 'blogdot_hide_breadcrumb' ) ) : ?>
						<?php blogdot_breadcrumb_trail(); ?>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
<?php endwhile; ?>

<div class="row larger-gutter be-single-page justify-content-center">

	<?php if ( get_theme_mod( 'blogdot_sidebar_position', 'right' ) === 'left' ) : ?>
		<div class="col-md-3 be-sidebar-width">
			<?php get_sidebar(); ?>
		</div>
	<?php endif; ?>

	<div id="primary" class="col-md-9 content-area be-content-width">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation( array(
				'next_text' => '<span class="be-post-nav-label btn btn-sm cont-btn no-underl">' . esc_html__( 'Next', 'blogdot' ) . '<small class="fas fa-chevron-right ml-2"></small></span>',
				'prev_text' => '<span class="be-post-nav-label btn btn-sm cont-btn no-underl"><small class="fas fa-chevron-left mr-2"></small>' . esc_html__( 'Previous', 'blogdot' ) . '</span>',
			) );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php if ( get_theme_mod( 'blogdot_sidebar_position', 'right' ) === 'right' ) : ?>
		<div class="col-md-3 be-sidebar-width">
			<?php get_sidebar(); ?>
		</div>
	<?php endif; ?>
</div>
<?php
get_footer();
