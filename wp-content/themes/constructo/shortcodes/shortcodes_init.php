<?php

function add_onehalf_button() {
    // Don't bother doing this stuff if the current user lacks permissions
    if (!current_user_can('edit_posts') && !current_user_can('edit_pages'))
        return;

    // Add only in Rich Editor mode
    if (get_user_option('rich_editing') == 'true') {
        add_filter("mce_external_plugins", "add_onehalf_tinymce_plugin");
        add_filter('mce_buttons', 'register_onehalf_button');
    }
}

function register_onehalf_button($buttons) {
    array_push($buttons, "theme_shortcodes");
    return $buttons;
}

// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function add_onehalf_tinymce_plugin($plugin_array) {
    $plugin_array['theme_shortcodes'] = get_template_directory_uri() . '/shortcodes/editor_plugin.js';
    return $plugin_array;
}

function loadScripts() {
    if(isset($_GET["page"]) && $_GET["page"] != "codestyling-localization/codestyling-localization.php") {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox'); 
        wp_register_script('my-upload', get_template_directory_uri() . '/slider.js', array('jquery', 'media-upload', 'thickbox'));
        wp_enqueue_script('my-upload');
    }
}

add_action('init', 'add_onehalf_button');
add_action('init', 'loadScripts');
