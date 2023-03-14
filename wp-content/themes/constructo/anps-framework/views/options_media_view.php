<?php
include_once get_template_directory() . '/anps-framework/classes/Options.php';
include_once get_template_directory() . '/anps-framework/classes/Style.php';
wp_enqueue_script('font_subsets');
$anps_media_data = $options->get_media();
if (isset($_GET['save_media'])) {
    if(!isset($_POST['auto_adjust_logo'])) {
        $_POST['auto_adjust_logo'] = '';
    }
    $options->save_media();
}
/* get all fonts */
$fonts = $style->all_fonts();
?>
<form action="themes.php?page=theme_options&sub_page=options_media&save_media" method="post">
    <div class="content-top"><input type="submit" value="<?php esc_html_e("Save all changes", 'constructo'); ?>" /><div class="clear"></div></div>
    <div class="content-inner">
        <h3><?php esc_html_e("Heading background:", 'constructo'); ?></h3>
        <!-- Heading background -->
        <div class="input floatleft onehalf anps_upload">
            <label for="anps_heading_bg"><?php esc_html_e("Page heading background", 'constructo'); ?></label>
            <input id="anps_heading_bg" type="text" size="36" name="anps_heading_bg" value="<?php echo anps_get_option($anps_media_data, 'heading_bg'); ?>" />
            <input id="_btn" class="upload_image_button" type="button" value="Upload" />
            <p class="fullwidth"><?php esc_html_e("Enter an URL or upload an image for the page heading background.", 'constructo'); ?></p>
            <div class="clear"></div>
        </div>
        <!-- Search heading background -->
        <div class="input onehalf anps_upload">
            <label for="anps_search_heading_bg"><?php esc_html_e("Search page heading background", 'constructo'); ?></label>
            <input id="anps_search_heading_bg" type="text" size="36" name="anps_search_heading_bg" value="<?php echo anps_get_option($anps_media_data, 'search_heading_bg'); ?>" />
            <input id="_btn" class="upload_image_button" type="button" value="Upload" />
            <p class="fullwidth"><?php esc_html_e("Enter an URL or upload an image for the search page heading background.", 'constructo'); ?></p>
            <div class="clear"></div>
        </div>
        <hr>
        <h3><?php esc_html_e("Favicon and logo:", 'constructo'); ?></h3>
        <p><?php esc_html_e("If you would like to use your logo and favicon, upload them to your theme here.", 'constructo'); ?></p>

        <!-- Logo -->
        <div class="input onehalf floatleft anps_upload">
            <label for="anps_logo"><?php esc_html_e("Logo", 'constructo'); ?></label>
            <?php
                $logo_width = 158;
                $logo_height = 33;

                $anps_logo_width = anps_get_option($anps_media_data, 'logo-width');
                $anps_logo_height = anps_get_option($anps_media_data, 'logo-height');

                if(isset($anps_logo_width) && $anps_logo_width!='') {
                    $logo_width = anps_get_option($anps_media_data, 'logo-width');
                }
                if(isset($anps_logo_height) && $anps_logo_height!='') {
                    $logo_height = anps_get_option($anps_media_data, 'logo-height');
                }

                $hasMedia = anps_get_option($anps_media_data, 'logo')!='';
            ?>
            <div class="preview <?php if(!$hasMedia) { echo 'hidden'; } ?>" data-preview="anps_logo">
                <?php if($hasMedia): ?>
                    <img width="<?php echo esc_attr($logo_width); ?>" height="<?php echo esc_attr($logo_height); ?>" src="<?php echo anps_get_option($anps_media_data, 'logo'); ?>">
                <?php endif; ?>
            </div>
            <input id="anps_logo" class="has-preview" type="text" size="36" name="anps_logo" value="<?php echo anps_get_option($anps_media_data, 'logo'); ?>" />
            <input id="_btn" class="upload_image_button" type="button" value="Upload" />
            <p class="fullwidth"><?php esc_html_e("Enter an URL or upload an image for the logo.", 'constructo'); ?></p>

            <div class="input fullwidth" style="min-height:0;">
                <?php
                if(get_option('auto_adjust_logo', 'on') == "on") {
                    $checked='checked';
                } else {
                    $checked = '';
                }
                ?>
                <label class="onehalf floatleft" for="auto_adjust_logo"><?php esc_html_e("Auto adjust logo size?", 'constructo'); ?></label>
                <div class="onehalf floatleft last" style="text-align:left; margin-top: 3px;">
                    <input id="auto_adjust_logo" class="small_input" style="margin-left: 0px; margin-top: 10px;" type="checkbox" name="auto_adjust_logo" <?php echo esc_attr($checked); ?> />
                </div>
            </div>

            <div class="input onehalf floatleft first addspace onoff">
                <label for="logo-width"><?php esc_html_e("Logo width", 'constructo'); ?></label>
                <input style="width: 100px;" id="anps_logo-width" type="text" name="anps_logo-width" value="<?php echo esc_attr($logo_width); ?>" /> px
            </div>

            <div class="input onehalf floatleft last addspace onoff">
                <label for="logo-height"><?php esc_html_e("Logo height", 'constructo'); ?></label>
                <input style="width: 100px;" id="anps_logo-height" type="text" name="anps_logo-height" value="<?php echo esc_attr($logo_height); ?>" /> px
            </div>
        </div>
        <!-- Sticky logo -->
        <div class="input onehalf stickylogo anps_upload">
            <label for="anps_sticky_logo"><?php esc_html_e("Sticky logo", 'constructo'); ?></label>

            <?php
                $hasMedia = anps_get_option($anps_media_data, 'sticky_logo') != '';
            ?>

            <div class="preview <?php if(!$hasMedia) { echo ' hidden'; } ?>" data-preview="anps_sticky_logo">
                <?php if($hasMedia): ?>
                    <img width="<?php echo esc_attr($logo_width); ?>" height="<?php echo esc_attr($logo_height); ?>" src="<?php echo anps_get_option($anps_media_data, 'sticky_logo'); ?>">
                <?php endif; ?>
            </div>

            <input class="wninety has-preview" id="anps_sticky_logo" type="text" size="36" name="anps_sticky_logo" value="<?php echo anps_get_option($anps_media_data, 'sticky_logo'); ?>" />
            <input id="_btn" class="upload_image_button" type="button" value="Upload" />
            <p clasS="fullwidth"><?php esc_html_e("Enter an URL or upload an image for the logo.", 'constructo'); ?></p>

            <!-- Sticky width, height -->

            <div class="input onehalf floatleft first addspace onoff">
                <label for="anps_sticky-logo-width"><?php esc_html_e("Sticky logo width", 'constructo'); ?></label>
                <input style="width: 100px;" id="anps_sticky-logo-width" type="text" name="anps_sticky-logo-width" value="<?php echo get_option('anps_sticky-logo-width', '158'); ?>" /> px
            </div>

            <div class="input onehalf floatleft last addspace onoff">
                <label for="anps_sticky-logo-height"><?php esc_html_e("Sticky logo height", 'constructo'); ?></label>
                <input style="width: 100px;" id="anps_sticky-logo-height" type="text" name="anps_sticky-logo-height" value="<?php echo get_option('anps_sticky-logo-height', '33'); ?>" /> px
            </div>
        </div>
        <div class="clear"></div>
        <!-- Mobile logo -->
        <div class="input onehalf floatleft anps_upload">
            <label for="anps_logo"><?php esc_html_e("Mobile logo", 'constructo'); ?></label>
            <?php
                $logo_mobile_width = 158;
                $logo_mobile_height = 33;

                $anps_logo_mobile_width = anps_get_option($anps_media_data, 'logo_mobile_width');
                $anps_logo_mobile_height = anps_get_option($anps_media_data, 'logo_mobile_height');

                if(isset($anps_logo_mobile_width) && $anps_logo_width!='') {
                    $logo_mobile_width = anps_get_option($anps_media_data, 'logo_mobile_width');
                }
                if(isset($anps_logo_mobile_height) && $anps_logo_height!='') {
                    $logo_mobile_height = anps_get_option($anps_media_data, 'logo_mobile_height');
                }

                $hasMedia = anps_get_option($anps_media_data, 'logo_mobile')!='';
            ?>
            <div class="preview <?php if(!$hasMedia) { echo 'hidden'; } ?>" data-preview="anps_logo_mobile">
                <?php if($hasMedia): ?>
                    <img width="<?php echo esc_attr($logo_mobile_width); ?>" height="<?php echo esc_attr($logo_mobile_height); ?>" src="<?php echo anps_get_option($anps_media_data, 'logo_mobile'); ?>">
                <?php endif; ?>
            </div>
            <input id="anps_logo_mobile" class="has-preview" type="text" size="36" name="anps_logo_mobile" value="<?php echo anps_get_option($anps_media_data, 'logo_mobile'); ?>" />
            <input id="_btn" class="upload_image_button" type="button" value="Upload" />
            <p class="fullwidth"><?php esc_html_e("Enter an URL or upload an image for the logo.", 'constructo'); ?></p>

            <div class="input onehalf floatleft first addspace onoff">
                <label for="logo_mobile_width"><?php esc_html_e("Logo mobile width", 'constructo'); ?></label>
                <input style="width: 100px;" id="anps_logo_mobile_width" type="text" name="anps_logo_mobile_width" value="<?php echo esc_attr($logo_mobile_width); ?>" /> px
            </div>

            <div class="input onehalf floatleft last addspace onoff">
                <label for="logo_mobile_height"><?php esc_html_e("Logo mobile height", 'constructo'); ?></label>
                <input style="width: 100px;" id="anps_logo_mobile_height" type="text" name="anps_logo_mobile_height" value="<?php echo esc_attr($logo_mobile_height); ?>" /> px
            </div>
        </div>
        <div class="clear"></div>
        <hr>
        <!-- Favicon -->
        <div class="input onehalf anps_upload">
            <label for="anps_favicon"><?php esc_html_e("Favicon", 'constructo'); ?></label>

            <?php $hasMedia = anps_get_option($anps_media_data, 'favicon') != ''; ?>

            <div class="preview<?php if(!$hasMedia) { echo ' hidden'; } ?>" data-preview="anps_favicon">
                <?php if($hasMedia): ?>
                    <img src="<?php echo anps_get_option($anps_media_data, 'favicon'); ?>">
                <?php endif; ?>
            </div>

            <input id="anps_favicon" class="has-preview" type="text" size="36" name="anps_favicon" value="<?php echo anps_get_option($anps_media_data, 'favicon'); ?>" />
            <input id="_btn" class="upload_image_button" type="button" value="Upload" />
            <p class="fullwidth"><?php esc_html_e("Enter an URL or upload an image for the favicon.", 'constructo'); ?></p>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <h3><?php esc_html_e("Text based logo", 'constructo'); ?></h3>
        <div class="input twothirds">
        <label for="anps_text_logo"><?php esc_html_e('Text based logo', 'constructo'); ?></label>
        <?php $value2 = get_option('anps_text_logo', '');
                wp_editor(str_replace('\\"', '"', $value2), 'anps_text_logo', array(
                            'wpautop' => true,
                            'media_buttons' => false,
                            'quicktags' => false,
                            'textarea_name' => 'anps_text_logo',
                            'tinymce' => array(
                                'toolbar1' => 'bold, italic, underline, forecolor, fontsizeselect',
                                'toolbar2' => ''
                            )
                            )); ?>
        </div>
        <div class="input onethird">
            <label for="anps_text_logo_font"><?php esc_html_e('Logo font', 'constructo'); ?></label>
            <select name="anps_text_logo_font" id="anps_text_logo_font">
                <?php foreach($fonts as $name=>$value) : ?>
                <optgroup label="<?php echo esc_attr($name); ?>">
                <?php foreach ($value as $font) :
                        $selected = '';
                        if ($font['value'] == get_option('anps_text_logo_font')) {
                            $selected = 'selected';
                            if($name=="Google fonts") {
                                $subsets = $font['subsets'];
                            } else {
                                $subsets = "";
                            }
                        }
                        ?>
                        <option value="<?php echo esc_attr($font['value'])."|".esc_attr($name); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_attr($font['name']); ?></option>
                <?php endforeach; ?>
                </optgroup>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    <?php anps_admin_save_buttons(); ?>
</form>
<?php wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_register_script('my-upload', get_template_directory_uri() . 'anps-framework/upload_image.js', array('jquery', 'media-upload', 'thickbox'));
    wp_enqueue_script('my-upload');
    wp_enqueue_style('thickbox');
