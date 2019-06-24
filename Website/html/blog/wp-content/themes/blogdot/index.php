<?php
/**
 * The main template file
 */

get_header();
?>

<?php if ( is_home() && ! is_front_page() ) : ?>
	<div class="row larger-gutter align-items-center justify-content-center be-single-header">
		<div class="col-md-8 <?php if ( get_theme_mod( 'blogdot_sidebar_position', 'right' ) === 'hide' ) : echo "text-center"; endif; ?>">
			<header>
				<h1 class="page-title h4"><?php single_post_title(); ?></h1>
			</header>
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
<?php endif; ?>

<?php if ( is_home() && is_front_page() && get_theme_mod( 'blogdot_display_cover_section', true ) ) : ?>
	<section class="row align-items-center justify-content-center bd-cover-section">
		<div class="col-md-12">
			<div class="bd-cover-img" style="background-image: url('<?php echo get_theme_mod( 'blogdot_cover_img', get_template_directory_uri() . '/assets/images/cover-img.jpg' ); ?>')">
				<div class="bd-cover-content d-flex justify-content-center align-items-center">
					<div class="col-md-8 text-center">
						<h2 class="bd-cover-title"><?php echo get_theme_mod( 'blogdot_cover_title', __( 'Create A Beautiful Blog Easily.', 'blogdot' ) ); ?></h2>
						<p class="bd-cover-subtitle"><?php echo get_theme_mod( 'blogdot_cover_subtitle', __( 'Blogdot is simple and easy to use blog theme. It is designed and developed primarily to create professional blogging websites.', 'blogdot' ) ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<div class="row larger-gutter justify-content-center">

	<?php if ( get_theme_mod( 'blogdot_sidebar_position', 'right' ) === 'left' ) : ?>
		<div class="col-md-3 be-sidebar-width">
			<?php get_sidebar(); ?>
		</div>
	<?php endif; ?>

	<div id="primary" class="col-md-9 content-area be-content-width">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
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
