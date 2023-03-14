<?php
add_action('add_meta_boxes', 'anps_team_content_add_custom_box');
add_action('save_post', 'anps_team_content_save_postdata');
function anps_team_content_add_custom_box() {
    $screens = array('team');
    foreach ($screens as $screen) {
        add_meta_box(
                'anps_breadcrumbs_sectionid', __('Team subtitle', 'constructo'), 'display_team_meta_box_content', $screen
        );
    }
}
function display_team_meta_box_content( $post ) {
        $value2 = get_post_meta( $post -> ID, $key = 'anps_team_subtitle', $single = true );
	echo "<input type='text' name='anps_team_subtitle' value='".esc_attr($value2)."' style='width: 350px' />";
}
function anps_team_content_save_postdata($post_id) { 
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (empty($_POST)) {
        return;
    }
    if(!isset($_POST['post_ID'])) {
        if(!$post_id) {
            return;
        } else {
            $_POST['post_ID'] = $post_id;
        }
    }
    if(!isset($_POST['post_type'])) {
        return;
    }
    // Check permissions
    if ('team' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return;
    }
    else {
        if (!current_user_can('edit_post', $post_id))
            return;
    }
    $post_ID = $_POST['post_ID'];
    if (!isset($_POST['anps_team_subtitle']))
        $_POST['anps_team_subtitle'] = '';
    $mydata2 = $_POST['anps_team_subtitle'];
    add_post_meta($post_ID, 'anps_team_subtitle', $mydata2, true) or update_post_meta($post_ID, 'anps_team_subtitle', $mydata2);
}
