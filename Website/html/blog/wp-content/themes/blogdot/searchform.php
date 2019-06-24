<form role="search" method="get" class="searchform blogdot-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" class="s form-control" name="s" placeholder="<?php esc_attr_e( 'Search&hellip;', 'blogdot' ); ?>" value="<?php the_search_query(); ?>" >
</form>
