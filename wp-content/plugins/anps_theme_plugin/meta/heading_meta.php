<?php
add_action('add_meta_boxes', 'anps_heading_add_custom_box');
add_action('save_post', 'anps_heading_save_postdata');

function anps_heading_add_custom_box() {
    $screens = array('page', 'post');
    foreach($screens as $screen) {
        if($screen=="product") {
            $anps_priority = "low";
        } else {
            $anps_priority = "high";
        }
        add_meta_box('anps_heading_meta', __('Page title and breadcrumbs', 'constructo'), 'display_meta_box_heading', $screen, 'normal', $anps_priority);
    }
    add_meta_box('anps_heading_meta', __('Page title and breadcrumbs', 'constructo'), 'display_meta_box_heading', 'portfolio', 'normal', 'core');
}

function display_meta_box_heading( $post ) {
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script("wp_colorpicker");
    wp_enqueue_script("wp_backend_js");

    $value2 = get_post_meta($post->ID, $key ='anps_disable_heading', $single = true );
    $heading_value = get_post_meta($post->ID, $key ='heading_bg', $single = true );
    $page_heading_full = get_post_meta($post->ID, $key ='anps_page_heading_full', $single = true );
    $full_color_top_bar = get_post_meta($post->ID, $key ='anps_full_color_top_bar', $single = true );
    $full_color_title = get_post_meta($post->ID, $key ='anps_full_color_title', $single = true );
    $full_hover_color = get_post_meta($post->ID, $key ='anps_full_hover_color', $single = true );
    $full_screen_logo = get_post_meta($post->ID, $key ='anps_full_screen_logo', $single = true );
    $checked = '';
    if($value2=='1') {
        $checked = 'checked';
    }
    $checked_full_screen = "";
    if($page_heading_full=='on') {
        $checked_full_screen = 'checked';
    }
    ?>
   <p></p>
    <table class="page-title min300">
        <tr>
            <td>Disable heading </td>
            <td>
                <input class="hideall-trigger" type='checkbox' name='anps_disable_heading' value='1' <?php echo esc_attr($checked); ?>/>
            </td>
        </tr>
    </table>
    <table class="page-title hideall min300">
        <tr>
            <td>
                <label for="heading_bg"><?php _e("Page heading background", 'constructo'); ?></label>
            </td>
            <td>
                <input id="heading_bg" type="text" size="36" name="heading_bg" value="<?php echo esc_attr($heading_value); ?>" />
                <input id="_btn" class="upload_image_button button" type="button" value="Upload" />
            </td>
        </tr>
        <?php if (get_option('anps_menu_type', '2')!='5' && get_option('anps_menu_type', '2')!='6') : ?>
        <tr>
            <td>
                <?php _e("Full screen heading", 'constructo'); ?>
            </td>
            <td>
                <input class="showhide-trigger" type="checkbox" name="anps_page_heading_full" <?php echo esc_attr($checked_full_screen); ?>/>
            </td>
        </tr>
        <?php endif; ?>
    </table>
<table class="page-title showhide hideall min300">
    <tr>
        <td>
            <label for="anps_full_color_top_bar"><?php _e("Color top bar", 'constructo'); ?></label>
        </td>
        <td>
            <input class='color-field' type='text' id='anps_full_color_top_bar' value='<?php echo esc_attr($full_color_top_bar); ?>' name='anps_full_color_top_bar' data-default-color='#f4f3ee' />
        </td>
    </tr>
    <tr>
        <td>
            <label for="anps_full_color_title"><?php _e("Color menu, title and breadcrumbs", 'constructo'); ?></label>
        </td>
        <td>
            <input class='color-field' type='text' id='anps_full_color_title' value='<?php echo esc_attr($full_color_title); ?>' name='anps_full_color_title' data-default-color='#f4f3ee' />
        </td>
    </tr>
    <tr>
        <td>
            <label for="anps_full_hover_color"><?php _e("Hover color", 'constructo'); ?></label>
        </td>
        <td>
            <input class='color-field' type='text' id='anps_full_hover_color' name='anps_full_hover_color' value='<?php echo esc_attr($full_hover_color); ?>' data-default-color='#f4f3ee' />
        </td>
    </tr>
    <tr>
        <td>
                <?php $images = get_children('post_type=attachment&post_mime_type=image'); ?>
                <select id="anps_full_screen_logo" name="anps_full_screen_logo">
                    <option value="0">Select logo</option>
                    <?php foreach ($images as $item) : ?>
                        <option <?php if ($item->guid == $full_screen_logo) {
                            echo 'selected="selected"';
                        } ?> value="<?php echo esc_attr($item->guid); ?>"><?php echo esc_html($item->post_title); ?></option>
                <?php endforeach; ?>
                </select>
        </td>
        <td>

        </td>
    </tr>
    </table>


    <script>
        jQuery(document).ready(function() {
    var formfield;
    jQuery('.upload_image_button').click(function() {
        jQuery('html').addClass('Image');
        formfield = jQuery(this).prev().attr('name');
        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        return false;
    });
    window.original_send_to_editor = window.send_to_editor;
    window.send_to_editor = function(html){
        if (formfield) {
            fileurl = jQuery('img','<div>' + html + '</div>').attr('src');
            jQuery('#'+formfield).val(fileurl);
            tb_remove();
            jQuery('html').removeClass('Image');
            formfield = '';
        } else {
            window.original_send_to_editor(html);
        }
    };

});
    </script>
<?php
}

function anps_heading_save_postdata($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    if (empty($_POST))
        return;

    $post_ID = $_POST['post_ID'];

    if (!isset($_POST['anps_disable_heading'])) {
        $_POST['anps_disable_heading'] = '0';
    }
    $mydata2 = $_POST['anps_disable_heading'];

    if (!isset($_POST['heading_bg'])) {
        $_POST['heading_bg'] = '';
    }
    $heading_data = $_POST['heading_bg'];

    if (!isset($_POST['anps_page_heading_full'])) {
        $_POST['anps_page_heading_full'] = '';
    }
    $page_heading_full = $_POST['anps_page_heading_full'];

    if (!isset($_POST['anps_full_color_top_bar'])) {
        $_POST['anps_full_color_top_bar'] = '';
    }
    $full_color_top_bar = $_POST['anps_full_color_top_bar'];

    if (!isset($_POST['anps_full_color_title'])) {
        $_POST['anps_full_color_title'] = '';
    }
    $full_color_title = $_POST['anps_full_color_title'];

    if (!isset($_POST['anps_full_hover_color'])) {
        $_POST['anps_full_hover_color'] = '';
    }
    $full_hover_color = $_POST['anps_full_hover_color'];

    if (!isset($_POST['anps_full_screen_logo'])) {
        $_POST['anps_full_screen_logo'] = '';
    }
    $full_screen_logo = $_POST['anps_full_screen_logo'];

    add_post_meta($post_ID, 'anps_disable_heading', $mydata2, true) or update_post_meta($post_ID, 'anps_disable_heading', $mydata2);
    add_post_meta($post_ID, 'heading_bg', $heading_data, true) or update_post_meta($post_ID, 'heading_bg', $heading_data);
    add_post_meta($post_ID, 'anps_page_heading_full', $page_heading_full, true) or update_post_meta($post_ID, 'anps_page_heading_full', $page_heading_full);
    add_post_meta($post_ID, 'anps_full_color_top_bar', $full_color_top_bar, true) or update_post_meta($post_ID, 'anps_full_color_top_bar', $full_color_top_bar);
    add_post_meta($post_ID, 'anps_full_color_title', $full_color_title, true) or update_post_meta($post_ID, 'anps_full_color_title', $full_color_title);
    add_post_meta($post_ID, 'anps_full_hover_color', $full_hover_color, true) or update_post_meta($post_ID, 'anps_full_hover_color', $full_hover_color);
    add_post_meta($post_ID, 'anps_full_screen_logo', $full_screen_logo, true) or update_post_meta($post_ID, 'anps_full_screen_logo', $full_screen_logo);
}
