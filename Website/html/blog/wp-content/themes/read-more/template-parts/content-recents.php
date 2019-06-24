<?php
/**
 * Template part for displaying recent posts from widgets.
 *
 * @package Acme Themes
 * @subpackage Read More
 */
global $read_more_read_more_text,
       $read_more_image_size_options,
       $read_more_content_length_options;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="content-wrapper">
        <?php
        if ( has_post_thumbnail() ) {
            ?>
            <!--post thumbnal options-->
            <a href="<?php the_permalink(); ?>" class="full-image">
                <?php
                the_post_thumbnail( $read_more_image_size_options, array( 'class' => 'aligncenter' ) );
                ?>
            </a>
            <?php
        }
        ?>
        <?php read_more_entry_cats(); ?>
        <header class="entry-header">
            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        </header><!-- .entry-header -->
        <div class="row">
            <div class="col-md-12">
                <div class="entry-content">
                    <?php
                    $excerpt = read_more_excerpt( $read_more_content_length_options);
                    echo wpautop( $excerpt );
                    if( !empty( $read_more_read_more_text ) ){
                        ?>
                        <div class="btn-wrapper clearfix">
                            <div class="btn-icon-box">
                                <div class="btn-data">
                                    <a class="btn-links" href="<?php the_permalink(); ?> ">
                                        <?php echo $read_more_read_more_text; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div><!-- .entry-content -->
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</article><!-- #post-## -->