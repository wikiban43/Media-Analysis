<?php
/**
 * Adds Read More Theme Widgets in SiteOrigin Pagebuilder Tabs
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return null
 *
 */
function read_more_widgets($widgets) {
    $theme_widgets = array(
        'read_more_ad_widget',
        'read_more_author_widget',
        'Read_more_posts_col',
        'read_more_feature_post_number'
    );
    foreach($theme_widgets as $theme_widget) {
        if( isset( $widgets[$theme_widget] ) ) {
            $widgets[$theme_widget]['groups'] = array('read-more');
            $widgets[$theme_widget]['icon']   = 'dashicons dashicons-screenoptions';
        }
    }
    return $widgets;
}
add_filter('siteorigin_panels_widgets', 'read_more_widgets');

/**
 * Add a tab for the theme widgets in the page builder
 *
 * @since Read More 1.0.0
 *
 * @param null
 * @return null
 *
 */
function read_more_widgets_tab($tabs){
    $tabs[] = array(
        'title'  => __('AT Read More Widgets', 'read-more'),
        'filter' => array(
            'groups' => array('read-more')
        )
    );
    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'read_more_widgets_tab', 20);