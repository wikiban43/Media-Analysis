<?php
/**
 * Template part for author info
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Read More
 */
?>
<div class="authorbox <?php echo ( 1 != get_option( 'show_avatars' ) ) ? 'no-author-avatar' : ''; ?>">
  <?php if ( 1 == get_option('show_avatars') ): ?>
  <div class="author-avatar">
    <?php echo get_avatar( get_the_author_meta( 'user_email' ), '80', '' ); ?>
  </div>
  <?php endif ?>
  <div class="author-info">
    <h4 class="author-header"><?php _e( 'Written by', 'read-more' ); ?>&nbsp;<?php  the_author_posts_link(); ?></h4>
    <p class="author-content"><?php the_author_meta('description'); ?></p>
  </div>
</div>