<?php
include_once get_template_directory() . '/anps-framework/classes/Options.php';
$anps_page_data = $options->get_page_setup_data();
wp_enqueue_script('thickbox');
wp_register_script('my-upload', get_template_directory_uri() . 'anps-framework/upload_image.js', array('jquery', 'media-upload', 'thickbox'));
wp_enqueue_script('my-upload');
wp_enqueue_style('thickbox');
if (isset($_GET['save_page_setup'])) {
    $options->save_page_setup('options_page_setup');
}
?>
<form action="themes.php?page=theme_options&sub_page=options_page_setup&save_page_setup" method="post">
        <div class="content-top">
                <input type="submit" value="<?php esc_html_e("Save all changes", 'constructo'); ?>" />
                <div class="clear"></div>
        </div>
        <div class="content-inner">
        <!-- Page setup -->
        <h3><?php esc_html_e("Page setup", 'constructo'); ?></h3>
        <!-- Coming soon page -->
        <div class="input onehalf">
            <label for="anps_coming_soon"><?php esc_html_e("Coming soon page", 'constructo'); ?></label>
            <select name="anps_coming_soon" id="anps_coming_soon">
                    <option value="0"><?php esc_html_e('*** Select ***', 'constructo'); ?></option>
                    <?php
                        $pages = get_pages();
                        foreach ($pages as $item) :
                            $selected = '';
                            if (anps_get_option($anps_page_data, 'coming_soon') == $item->ID) {
                                $selected = ' selected';
                            }
                    ?>
                    <option value="<?php echo esc_attr($item->ID); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($item->post_title); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <!-- Error page -->
        <div class="input onehalf">
            <label for="anps_error_page"><?php esc_html_e("404 error page", 'constructo'); ?></label>
            <select name="anps_error_page" id="anps_error_page">
                    <option value="0"><?php esc_html_e('*** Select ***', 'constructo'); ?></option>
                    <?php
                        $pages = get_pages();
                        foreach ($pages as $item) :
                            $selected = '';
                            if (anps_get_option($anps_page_data, 'error_page') == $item->ID) {
                                    $selected = ' selected';
                            }
                    ?>
                    <option value="<?php echo esc_attr($item->ID); ?>" <?php echo esc_html($selected); ?>><?php echo esc_html($item->post_title); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <div class="clear"></div>
        <h3><?php esc_html_e("Portfolio", 'constructo'); ?></h3>
        <!-- Portfolio single style -->
        <div class='input fullwidth'>
            <label for='anps_portfolio_slug'><?php esc_html_e("Portfolio slug", 'constructo'); ?></label>
            <input type='text' value='<?php echo get_option('anps_portfolio_slug'); ?>' name='anps_portfolio_slug' id='anps_portfolio_slug' />
        </div>
        <div class="input onethird">
            <label for="anps_portfolio_single"><?php esc_html_e("Portfolio single style", 'constructo'); ?></label>
            <select name="anps_portfolio_single" id="anps_portfolio_single">
                    <?php $pages = array("style-1"=>esc_html__('Style 1', 'constructo'), "style-2"=>esc_html__('Style 2', 'constructo'), "style-3"=>esc_html__('Style 3', 'constructo'));
                    foreach ($pages as $key => $item) :
                        $selected = '';
                        if (anps_get_option('', '', 'portfolio_single') == $key) {
                            $selected = 'selected="selected"';
                        }
                        ?>
                        <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_attr($item); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <!-- Portfolio single footer -->
        <div class="input twothird">
        <label for="anps_portfolio_single_footer"><?php esc_html_e("Portfolio single footer", 'constructo'); ?></label>
        <?php $value2 = anps_get_option('', '', 'portfolio_single_footer');
                wp_editor(str_replace('\\"', '"', $value2), 'anps_portfolio_single_footer', array(
                            'wpautop' => true,
                            'media_buttons' => false,
                            'textarea_name' => 'anps_portfolio_single_footer',
                            'textarea_rows' => 10,
                            'teeny' => true )); ?>
        </div>
        <div class="clear"></div>
        <!-- Visual composer legacy -->
        <h3><?php esc_html_e("Visual composer", 'constructo'); ?></h3>
        <p>Only for backwards compatibility. Do not use on fresh install.</p>
        <!-- Legacy mode -->
        <div class="input onethird">
            <?php
            $checked = '';
            if(get_option('anps_vc_legacy')=="on") {
                $checked='checked';
            }
            ?>
            <label for="anps_vc_legacy"><?php esc_html_e("Legacy mode", 'constructo'); ?></label>
            <input type="hidden" value="" name="anps_vc_legacy"/>
            <input id="anps_vc_legacy" class="small_input" style="margin-left: 37px" type="checkbox" name="anps_vc_legacy" <?php echo esc_attr($checked); ?> />
        </div>
        <!-- END Legacy mode -->
        <div class="clear"></div>
        <!-- Post meta enable/disable -->
        <h3><?php esc_html_e("Disable Post meta elements", 'constructo'); ?></h3>
        <p><?php esc_html_e('This allows you to disable post meta on all blog elements and pages. By default no field is checked, so that all meta elements are displayed.', 'constructo'); ?></p>
        <?php
            $post_meta_arr = array(
                "anps_post_meta_comments"   => "Comments",
                "anps_post_meta_categories" => "Categories",
                "anps_post_meta_author"     => "Author",
                "anps_post_meta_date"       => "Date"
            );
        ?>
        <?php foreach($post_meta_arr as $key=>$item) : ?>
        <div class="input onequarter">
            <label for="<?php echo esc_attr($key); ?>"><?php echo esc_attr($item); ?></label>
            <input type='hidden' value='' name='<?php echo esc_attr($key); ?>'/>
            <input style="margin-left: 37px;" type="checkbox" value="1" name="<?php echo esc_attr($key); ?>" id="<?php echo esc_attr($key); ?>" <?php checked(get_option($key), "1") ?>/>
        </div>
        <?php endforeach; ?>
        <div class="clear"></div>
    </div>
    <?php anps_admin_save_buttons(); ?>
</form>
