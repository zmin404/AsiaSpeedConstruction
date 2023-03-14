<?php
/** Register sidebars by running widebox_widgets_init() on the widgets_init hook. */
add_action('widgets_init', 'anps_widgets_init');
function anps_widgets_init() {
    // Area 1, located at the top of the sidebar.
    register_sidebar(array(
        'name' => __('Sidebar', 'constructo'),
        'id' => 'primary-widget-area',
        'description' => __('The primary widget area', 'constructo'),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Secondary Sidebar', 'constructo'),
        'id' => 'secondary-widget-area',
        'description' => __('Secondary widget area', 'constructo'),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Top bar left', 'constructo'),
        'id' => 'top-bar-left',
        'description' => __('Can only contain Text, Search, Custom menu and WPML Languge selector widgets', 'constructo'),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Top bar right', 'constructo'),
        'id' => 'top-bar-right',
        'description' => __('Can only contain Text, Search, Custom menu and WPML Languge selector widgets', 'constructo'),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Above navigation bar', 'constructo'),
        'id' => 'above-navigation-bar',
        'description' => __('This is a bar above main navigation. Can only contain Text, Search, Custom menu and WPML Languge selector widgets', 'constructo'),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    /* Large above menu */
    register_sidebar(array(
        'name' => esc_html__('Large above menu', 'constructo'),
        'id' => 'large-above-menu',
        'description' => esc_html__('Large above menu.', 'constructo'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    if (anps_get_option('', '', 'vertical_menu') != '') {
        //var_dump($anps_options_data['vertical_menu']);
        register_sidebar(array(
            'name' => __('Vertical menu bottom widget', 'constructo'),
            'id' => 'vertical-bottom-widget',
            'description' => __('This widget displays only on desktop mode in vertical menu.', 'constructo'),
            'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    }

    $prefooter = anps_get_option('', '', 'prefooter');
    if($prefooter!="") {
        $prefooter_columns = anps_get_option('', '4', 'prefooter_style');
        if($prefooter_columns=='2' || $prefooter_columns=='5' || $prefooter_columns=='6') {
            register_sidebar(array(
                'name' => __('Prefooter 1', 'constructo'),
                'id' => 'prefooter-1',
                'description' => __('Prefooter 1', 'constructo'),
                'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
                'after_widget' => '</li>',
                'before_title' => '<h3 class="widget-title">',
                'after_title' => '</h3>',
            ));
            register_sidebar(array(
                'name' => __('Prefooter 2', 'constructo'),
                'id' => 'prefooter-2',
                'description' => __('Prefooter 2', 'constructo'),
                'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
                'after_widget' => '</li>',
                'before_title' => '<h3 class="widget-title">',
                'after_title' => '</h3>',
            ));
        } elseif($prefooter_columns=='3') {
            register_sidebar(array(
                'name' => __('Prefooter 1', 'constructo'),
                'id' => 'prefooter-1',
                'description' => __('Prefooter 1', 'constructo'),
                'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
                'after_widget' => '</li>',
                'before_title' => '<h3 class="widget-title">',
                'after_title' => '</h3>',
            ));
            register_sidebar(array(
                'name' => __('Prefooter 2', 'constructo'),
                'id' => 'prefooter-2',
                'description' => __('Prefooter 2', 'constructo'),
                'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
                'after_widget' => '</li>',
                'before_title' => '<h3 class="widget-title">',
                'after_title' => '</h3>',
            ));
            register_sidebar(array(
                'name' => __('Prefooter 3', 'constructo'),
                'id' => 'prefooter-3',
                'description' => __('Prefooter 3', 'constructo'),
                'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
                'after_widget' => '</li>',
                'before_title' => '<h3 class="widget-title">',
                'after_title' => '</h3>',
            ));
        } elseif($prefooter_columns=='4' || $prefooter_columns=='0') {
            register_sidebar(array(
                'name' => __('Prefooter 1', 'constructo'),
                'id' => 'prefooter-1',
                'description' => __('Prefooter 1', 'constructo'),
                'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
                'after_widget' => '</li>',
                'before_title' => '<h3 class="widget-title">',
                'after_title' => '</h3>',
            ));
            register_sidebar(array(
                'name' => __('Prefooter 2', 'constructo'),
                'id' => 'prefooter-2',
                'description' => __('Prefooter 2', 'constructo'),
                'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
                'after_widget' => '</li>',
                'before_title' => '<h3 class="widget-title">',
                'after_title' => '</h3>',
            ));
            register_sidebar(array(
                'name' => __('Prefooter 3', 'constructo'),
                'id' => 'prefooter-3',
                'description' => __('Prefooter 3', 'constructo'),
                'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
                'after_widget' => '</li>',
                'before_title' => '<h3 class="widget-title">',
                'after_title' => '</h3>',
            ));
            register_sidebar(array(
                'name' => __('Prefooter 4', 'constructo'),
                'id' => 'prefooter-4',
                'description' => __('Prefooter 4', 'constructo'),
                'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
                'after_widget' => '</li>',
                'before_title' => '<h3 class="widget-title">',
                'after_title' => '</h3>',
            ));
        }
    }
    $footer_columns = anps_get_option('', '4', 'footer_style');
    if($footer_columns=='1') {
        register_sidebar(array(
            'name' => __('Footer 1', 'constructo'),
            'id' => 'footer-1',
            'description' => __('Footer 1', 'constructo'),
            'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    } else if($footer_columns=='2') {
        register_sidebar(array(
            'name' => __('Footer 1', 'constructo'),
            'id' => 'footer-1',
            'description' => __('Footer 1', 'constructo'),
            'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        register_sidebar(array(
            'name' => __('Footer 2', 'constructo'),
            'id' => 'footer-2',
            'description' => __('Footer 2', 'constructo'),
            'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    } elseif($footer_columns=='3') {
        register_sidebar(array(
            'name' => __('Footer 1', 'constructo'),
            'id' => 'footer-1',
            'description' => __('Footer 1', 'constructo'),
            'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        register_sidebar(array(
            'name' => __('Footer 2', 'constructo'),
            'id' => 'footer-2',
            'description' => __('Footer 2', 'constructo'),
            'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        register_sidebar(array(
            'name' => __('Footer 3', 'constructo'),
            'id' => 'footer-3',
            'description' => __('Footer 3', 'constructo'),
            'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    } elseif($footer_columns=='4' || $footer_columns=='0') {
        register_sidebar(array(
            'name' => __('Footer 1', 'constructo'),
            'id' => 'footer-1',
            'description' => __('Footer 1', 'constructo'),
            'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        register_sidebar(array(
            'name' => __('Footer 2', 'constructo'),
            'id' => 'footer-2',
            'description' => __('Footer 2', 'constructo'),
            'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        register_sidebar(array(
            'name' => __('Footer 3', 'constructo'),
            'id' => 'footer-3',
            'description' => __('Footer 3', 'constructo'),
            'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        register_sidebar(array(
            'name' => __('Footer 4', 'constructo'),
            'id' => 'footer-4',
            'description' => __('Footer 4', 'constructo'),
            'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    }
    $copyright_footer = anps_get_option('', '1', 'copyright_footer');
    if($copyright_footer=="1" || $copyright_footer=="0") {
        register_sidebar(array(
            'name' => __('Copyright footer 1', 'constructo'),
            'id' => 'copyright-1',
            'description' => __('Copyright footer 1', 'constructo'),
            'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    } elseif($copyright_footer=="2") {
        register_sidebar(array(
            'name' => __('Copyright footer 1', 'constructo'),
            'id' => 'copyright-1',
            'description' => __('Copyright footer 1', 'constructo'),
            'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        register_sidebar(array(
            'name' => __('Copyright footer 2', 'constructo'),
            'id' => 'copyright-2',
            'description' => __('Copyright footer 2', 'constructo'),
            'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    }
}
