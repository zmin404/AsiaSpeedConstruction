<?php
add_action('add_meta_boxes', 'anps_menu_add_custom_box');
add_action('save_post', 'anps_menu_save_postdata');

function anps_menu_add_custom_box() { 
    $screens = array( 'page' );
    foreach($screens as $screen) {
        add_meta_box('anps_menu_meta', __('Menu in separate page', 'constructo'), 'display_meta_box_menu', $screen, 'normal', 'high');
    }
}

function display_meta_box_menu( $post ) { 
    $value2 = get_post_meta($post->ID, $key ='anps_menu_separate', $single = true ); 
    $checked = '';
    if($value2=='1') {
        $checked = 'checked';
    }
    echo "Yes <input type='checkbox' name='anps_menu_separate' value='1' $checked />";
}

function anps_menu_save_postdata($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    if (empty($_POST))
        return;

    $post_ID = $_POST['post_ID'];

    if (!isset($_POST['anps_menu_separate'])) {
        $_POST['anps_menu_separate'] = '0';
    }

    $mydata2 = $_POST['anps_menu_separate']; 

    add_post_meta($post_ID, 'anps_menu_separate', $mydata2, true) or update_post_meta($post_ID, 'anps_menu_separate', $mydata2);
}
