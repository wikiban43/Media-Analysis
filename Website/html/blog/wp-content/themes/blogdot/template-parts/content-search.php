<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogdot
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'be-one-post' ); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title h4"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
			blogdot_posted_on();
			blogdot_posted_by();
			?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php blogdot_post_thumbnail(); ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
		<div class="mt-4 mb-4">
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-sm cont-btn"><?php esc_html_e( 'Continue Reading', 'blogdot' ); ?> <small class="fas fa-arrow-right ml-1"></small></a>
		</div>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php blogdot_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
