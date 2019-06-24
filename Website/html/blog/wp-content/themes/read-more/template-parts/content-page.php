<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Read More
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$sidebar_layout = read_more_sidebar_selection();
	if( has_post_thumbnail() ):
		$thumbnail = 'full';
		echo '<div class="single-feat clearfix"><figure class="single-thumb single-thumb-full">';
		the_post_thumbnail( $thumbnail );
		echo "</figure></div>";/*figure, .single-feat*/
	endif;
	?>
	<div class="content-wrapper">
		<div class="entry-content">
			<?php
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'read-more' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->
		<footer class="entry-footer">
			<?php
            if( get_edit_post_link()){
	            edit_post_link(
		            sprintf(
		            /* translators: %s: Name of current post */
			            esc_html__( 'Edit %s', 'read-more' ),
			            the_title( '<span class="screen-reader-text">"', '"</span>', false )
		            ),
		            '<span class="edit-link">',
		            '</span>'
	            );
            }
			?>
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->