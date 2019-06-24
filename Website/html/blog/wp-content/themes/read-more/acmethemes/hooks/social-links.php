<?php
/**
 * Display Social Links
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return void
 *
 */

if ( !function_exists('read_more_social_links') ) :

    function read_more_social_links( ) {

        global $read_more_customizer_all_values;
        ?>
        <ul class="socials">
            <?php
            if ( !empty( $read_more_customizer_all_values['read-more-facebook-url'] ) ) { ?>
                <li class="facebook">
                    <a href="<?php echo esc_url( $read_more_customizer_all_values['read-more-facebook-url'] ); ?>" title="<?php esc_attr_e( 'Facebook','read-more');?>" target="_blank"><i class="fa fa-facebook"></i></a>
                </li>
            <?php }
            if ( !empty( $read_more_customizer_all_values['read-more-twitter-url'] ) ) { ?>
                <li class="twitter">
                    <a href="<?php echo esc_url( $read_more_customizer_all_values['read-more-twitter-url'] ); ?>" title="<?php esc_attr_e( 'Twitter','read-more');?>" target="_blank"><i class="fa fa-twitter"></i></a>
                </li>
            <?php }
            if ( !empty( $read_more_customizer_all_values['read-more-youtube-url'] ) ) { ?>
                <li class="youtube">
                    <a href="<?php echo esc_url( $read_more_customizer_all_values['read-more-youtube-url'] ); ?>" title="<?php esc_attr_e( 'Youtube','read-more');?>" target="_blank"><i class="fa fa-youtube"></i></a>
                </li>
            <?php }
            if ( !empty( $read_more_customizer_all_values['read-more-google-plus-url'] ) ) {
                ?>
                <li class="google-plus">
                    <a href="<?php echo esc_url( $read_more_customizer_all_values['read-more-google-plus-url'] ); ?>" title="<?php esc_attr_e( 'Google Plus','read-more');?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                </li>
                <?php
            }
            ?>
        </ul>
        <?php
    }
endif;
add_filter( 'read_more_action_social_links', 'read_more_social_links', 10 );