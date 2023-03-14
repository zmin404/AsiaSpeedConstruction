<?php
include_once get_template_directory() . '/anps-framework/classes/Options.php';
wp_enqueue_script('thickbox');
wp_register_script('my-upload', get_template_directory_uri() . 'anps-framework/upload_image.js', array('jquery', 'media-upload', 'thickbox'));
wp_enqueue_script('my-upload');
wp_enqueue_style('thickbox');
if (isset($_GET['header_options'])) {
    $options->save_page_setup('header_options');
}
?>
<form action="themes.php?page=theme_options&sub_page=header_options&header_options" method="post">
        <div class="content-top">
                <input type="submit" value="<?php esc_html_e("Save all changes", 'constructo'); ?>" />
                <div class="clear"></div>
        </div>
    <div class="content-inner">
        <!-- Menu -->
        <h3><?php esc_html_e("Front page Top Menu", 'constructo'); ?></h3>
        <!-- Menu -->
        <div class="input fullwidth" id="headerstyle">
            <?php
                $i=1;
                $images_array = array(
                    'top-transparent-menu',
                    'top-background-menu',
                    'bottom-transparent-menu',
                    'bottom-background-menu',
                    'full-length-menu',
                    'boxed-menu',
                    'logo-middle-menu',
                );
                foreach($images_array as $item) :
                    $checked = '';
                    if(get_option('anps_menu_type', 2)==$i) {
                        $checked = " checked";
                    }
            ?>
            <label class="onequarter" id="head-<?php echo esc_attr($i); ?>"><input type="radio" name="anps_menu_type" value="<?php echo esc_attr($i); ?>"<?php echo esc_attr($checked); ?>>
                <img src="<?php echo get_template_directory_uri(); ?>/anps-framework/images/<?php echo esc_html($item); ?>.jpg">
            </label>
            <?php $i++; endforeach; ?>
        </div>
        <!-- Hidden -->
        <div class="anps_menu_type_font fullwidth ">
            <div class="input onethird onoff head-1 head-3" >
                <label for="anps_front_text_color"><?php esc_html_e("Transparent text color", 'constructo'); ?></label>
                <input data-value="<?php echo get_option('anps_front_text_color'); ?>" readonly style="background: <?php echo get_option('anps_front_text_color'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_front_text_color" value="<?php echo get_option('anps_front_text_color'); ?>" id="anps_front_text_color" />
            </div>
            <div class="input onethird onoff head-1 head-3" >
                <label for="anps_front_text_hover_color"><?php esc_html_e("Transparent text hover color", 'constructo'); ?></label>
                <input data-value="<?php echo get_option('anps_front_text_hover_color'); ?>" readonly style="background: <?php echo get_option('anps_front_text_hover_color'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_front_text_hover_color" value="<?php echo get_option('anps_front_text_hover_color'); ?>" id="anps_front_text_hover_color" />
            </div>
            <div class="input onethird onoff head-1 head-3">
                <label for="anps_front_curent_menu_color"><?php esc_html_e('Transparent selected main menu color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(get_option('anps_front_curent_menu_color', '')); ?>" readonly style="background: <?php echo esc_attr(get_option('anps_front_curent_menu_color', '')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_front_curent_menu_color" value="<?php echo esc_attr(get_option('anps_front_curent_menu_color', '')); ?>" id="anps_curent_menu_color" />
            </div>
            <div class="onoff input head-2 head-4 head-5 head-6 head-7 onethird" >
                <label for="anps_front_bg_color"><?php esc_html_e("Background color", 'constructo'); ?></label>
                <input data-value="<?php echo get_option('anps_front_bg_color'); ?>" readonly style="background: <?php echo get_option('anps_front_bg_color'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_front_bg_color" value="<?php echo get_option('anps_front_bg_color'); ?>" id="anps_front_bg_color" />
            </div>
            <div class="onoff input head-1 head-3 onethird" >
                <label for="anps_front_topbar_color"><?php esc_html_e("Transparent top bar color", 'constructo'); ?></label>
                <input data-value="<?php echo get_option('anps_front_topbar_color'); ?>" readonly style="background: <?php echo get_option('anps_front_topbar_color'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_front_topbar_color" value="<?php echo get_option('anps_front_topbar_color'); ?>" id="anps_front_topbar_color" />
            </div>
            <div class="onoff input head-1 head-3 onethird" >
                <label for="anps_front_topbar_bg_color"><?php esc_html_e('Transparent top bar background color', 'constructo'); ?></label>
                <input data-value="<?php echo get_option('anps_front_topbar_bg_color'); ?>" readonly style="background: <?php echo get_option('anps_front_topbar_bg_color'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_front_topbar_bg_color" value="<?php echo get_option('anps_front_topbar_bg_color'); ?>" id="anps_front_topbar_bg_color" />
            </div>
            <div class="onoff input head-1 head-3 onethird" >
                <label for="anps_front_topbar_hover_color"><?php esc_html_e("Transparent top bar link hover color", 'constructo'); ?></label>
                <input data-value="<?php echo get_option('anps_front_topbar_hover_color'); ?>" readonly style="background: <?php echo get_option('anps_front_topbar_hover_color'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_front_topbar_hover_color" value="<?php echo get_option('anps_front_topbar_hover_color'); ?>" id="anps_front_topbar_hover_color" />
            </div>

            <div class="onoff input head-1 head-3 twothird">
                <label for="anps_front_logo"><?php esc_html_e("Front page logo", 'constructo'); ?></label>
                <input id="anps_front_logo" type="text" size="36" name="anps_front_logo" value="<?php echo esc_attr(get_option('anps_front_logo')); ?>" />
                <input id="_btn" class="upload_image_button width-105" type="button" value="Upload" />
                <p class="fullwidth"><?php esc_html_e("This option is ment for logo color adjustments if needed. Please make sure, the logo is exact same size as logo on other pages.", 'constructo'); ?></p>
                <div class="clear"></div>
            </div>

            <div class="onoff input head-5 head-6 onethird">
                <label for="anps_large_above_menu_style"><?php esc_html_e('Large above menu style', 'constructo'); ?></label>
                <select name="anps_large_above_menu_style" id="anps_above_nav_bar">
                    <?php $items = array(
                        '1' => esc_html__('Style 1', 'constructo'),
                        '2' => esc_html__('Style 2', 'constructo'),
                        '3' => esc_html__('Style 3', 'constructo'),
                        '4' => esc_html__('Style 4', 'constructo'),
                        '5' => esc_html__('Style 5', 'constructo')
                    );
                    foreach ($items as $key => $item) : ?>
                        <option value="<?php echo esc_attr($key); ?>" <?php if(get_option('anps_large_above_menu_style') == $key) {echo esc_attr('selected');} else {echo '';} ?>><?php echo esc_attr($item); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Above menu height -->
            <div class="onoff input head-5 head-6 onethird">
                <label for='anps_above_menu_height'><?php esc_html_e('Above menu height in pixels', 'constructo'); ?></label>
                <input type='text' value='<?php echo get_option('anps_above_menu_height', ''); ?>' name='anps_above_menu_height' id='anps_above_menu_height' />
            </div>

            <div class="onoff input head-6 fullwidth">
                <div class="onethird dimm-master">
                    <label for="anps_menu_button"><?php esc_html_e('Menu button', 'constructo'); ?></label>
                    <input type="hidden" value="" name="anps_menu_button"/>
                    <input id="anps_menu_button" value="1" class="small_input" type="checkbox" name="anps_menu_button" <?php if(get_option('anps_menu_button')!='') {echo esc_attr('checked');} else {echo '';} ?> />
                </div>
                <div class="onethird dimm">
                    <label for="anps_menu_button_text"><?php esc_html_e('Menu button text', 'constructo'); ?></label>
                    <input type="text" name="anps_menu_button_text" id="anps_menu_button_text" value="<?php echo get_option('anps_menu_button_text', ''); ?>" />
                </div>
                <div class="onethird dimm">
                    <label for="anps_menu_button_url"><?php esc_html_e('Menu button url', 'constructo'); ?></label>
                    <input type="text" name="anps_menu_button_url" id="anps_menu_button_url" value="<?php echo get_option('anps_menu_button_url', ''); ?>" />
                </div>
            </div>
        </div>
        <div class="onoff anps_full_screen input fullwidth head-3 head-4" >
            <label for="anps_full_screen"><?php esc_html_e("Full screen content", 'constructo'); ?></label>
            <?php $value2 = get_option('anps_full_screen', '');
            wp_editor(str_replace('\\"', '"', $value2), 'anps_full_screen', array(
                                                'wpautop' => true,
                                                'media_buttons' => false,
                                                'textarea_name' => 'anps_full_screen',
                                                'textarea_rows' => 10,
                                                'teeny' => true )); ?>
            <p style="margin-top: 20px;"><h2>Important!</h2>The textarea above is ment for the slider shortcode. It will be shown on the home page before the rest of the site. Add slider shortcode inside the content area above for tis menu type to work. <br/>If you imported our demo, you will also need to remove the slider on your homepage and remove the negative margin on first row (check the screenshot below).<br/><img src="<?php echo get_template_directory_uri(); ?>/anps-framework/images/home-changes.jpg"></p>
        </div>
        <!-- END Hidden -->
        <div class="clearfix"></div>
        <h3><?php esc_html_e("General Top Menu Settings", 'constructo'); ?></h3>
        <!-- Top menu -->
        <div class="input onequarter">
            <label for="anps_topmenu_style"><?php esc_html_e("Display top bar?", 'constructo'); ?></label>
            <select name="anps_topmenu_style" id="anps_topmenu_style">
                    <?php
                    $pages = array(
                        '1'=>esc_html__('Yes', 'constructo'),
                        '2'=>esc_html__('Only on tablet/mobile', 'constructo'),
                        '4'=>esc_html__('Only on desktop', 'constructo'),
                        '3'=>esc_html__('No', 'constructo'),
                    );
                    foreach ($pages as $key => $item) :
                        $selected = '';
                        if (anps_get_option('', '', 'topmenu_style') == $key) {
                            $selected = ' selected';
                        }
                        ?>
                        <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($item); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <!-- Top bar height -->
        <div class='input onequarter'>
            <label for='anps_top_bar_height'><?php esc_html_e('Top bar height in pixels', 'constructo'); ?></label>
            <input type='text' value='<?php echo get_option('anps_top_bar_height', '60'); ?>' name='anps_top_bar_height' id='anps_top_bar_height' />
        </div>
        <div class="input onequarter">
            <label for="anps_above_nav_bar"><?php esc_html_e("Display above menu bar?", 'constructo'); ?></label>
            <select name="anps_above_nav_bar">
                    <?php $pages = array("1"=>'Yes', "0"=>'No');
                    foreach ($pages as $key => $item) :
                         ?>
                <option value="<?php echo esc_attr($key); ?>" <?php if (get_option('anps_above_nav_bar') == $key) {echo 'selected="selected"';} else {echo '';} ?>><?php echo esc_attr($item); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <div class="input onequarter">
            <label for="anps_menu_style"><?php esc_html_e("Menu", 'constructo'); ?></label>
            <select name="anps_menu_style" id="anps_menu_style">
                    <?php $pages = array("1"=>esc_html__('Normal', 'constructo'), "2"=>esc_html__('Description', 'constructo'));
                    foreach ($pages as $key => $item) :
                        $selected = '';
                        if (anps_get_option('', '', 'menu_style') == $key) {
                            $selected = ' selected';
                        }
                        ?>
                        <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($item); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <!-- Menu centered -->
        <div class="input onequarter">
            <?php
                $menu_positions = array(
                    2 => esc_html__('Left', 'constructo'),
                    1 => esc_html__('Center', 'constructo'),
                    3 => esc_html__('Right', 'constructo'),
                );
            ?>
            <label for="anps_menu_center"><?php esc_html_e("Menu position", 'constructo'); ?></label>
            <select name="anps_menu_center" id="anps_menu_center">
                <option value="0"><?php esc_html_e('*** Select ***', 'constructo'); ?></option>
                <?php
                foreach($menu_positions as $key => $item) :
                    $selected = '';
                    if(get_option('anps_menu_center', 0) == $key) {
                        $selected = ' selected';
                    }
                ?>
                    <option value="<?php echo esc_attr($key); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_html($item); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Sticky menu -->
        <div class="input onequarter">
            <?php
            $checked = '';
            if(anps_get_option('', '', 'sticky_menu') != '') {
                $checked='checked';
            }
            ?>
            <label for="anps_sticky_menu"><?php esc_html_e("Sticky menu", 'constructo'); ?></label>
            <input type="hidden" value="" name="anps_sticky_menu"/>
            <input id="anps_sticky_menu" value="1" class="small_input" style="margin-left: 37px" type="checkbox" name="anps_sticky_menu" <?php echo esc_attr($checked); ?> />
        </div>
        <div class="input onequarter">
            <label for="anps_search_style"><?php esc_html_e("Search style", 'constructo'); ?></label>
            <select name="anps_search_style" id="anps_search_style">
                <?php
                $pages = array(
                    "default" => esc_html__('Default', 'constructo'),
                    "minimal" => esc_html__('Minimal', 'constructo')
                );

                foreach ($pages as $key => $item) :
                    $selected = '';
                    if (get_option('anps_search_style', 'default') == $key) {
                        $selected = ' selected';
                    }
                    ?>
                    <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($item); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="input onequarter">
            <?php
            $checked = '';
            if(anps_get_option('', 'on', 'search_icon') != "") {
                $checked='checked';
            }
            ?>
            <label for="anps_search_icon"><?php esc_html_e("Display search icon in menu (desktop)?", 'constructo'); ?></label>
            <input type="hidden" value="" name="anps_search_icon"/>
            <input id="anps_search_icon" value="1" class="small_input" style="margin-left: 37px" type="checkbox" name="anps_search_icon" <?php echo esc_attr($checked); ?> />
        </div>
        <div class="input onequarter">
            <?php
            $checked = '';
            if(anps_get_option('', 'on', 'search_icon_mobile') != "") {
                $checked='checked';
            }
            ?>
            <label for="anps_search_icon_mobile"><?php esc_html_e("Display search on mobile and tablets?", 'constructo'); ?></label>
            <input type="hidden" value="" name="anps_search_icon_mobile"/>
            <input id="anps_search_icon_mobile" value="1" class="small_input" style="margin-left: 37px" type="checkbox" name="anps_search_icon_mobile" <?php echo esc_attr($checked); ?> />
        </div>
        <!-- Enable walker -->
        <div class="input onequarter">
            <label for="anps_global_menu_walker"><?php esc_html_e('Enable menu walker (mega menu)', 'constructo'); ?></label>
            <input type="hidden" value="" name="anps_global_menu_walker"/>
            <input id="anps_global_menu_walker" value="1" class="small_input" type="checkbox" name="anps_global_menu_walker" <?php if(get_option('anps_global_menu_walker', '1')!="") {echo esc_attr('checked');} else {echo '';} ?> />
        </div>
        <!-- Background behind logo -->
        <div class="input onequarter">
            <label for="anps_logo_background"><?php esc_html_e('Display background color behind logo', 'constructo'); ?></label>
            <input type="hidden" value="" name="anps_logo_background"/>
            <input id="anps_logo_background" value="1" class="small_input" type="checkbox" name="anps_logo_background" <?php if(get_option('anps_logo_background', '1')!="") {echo esc_attr('checked');} else {echo '';} ?> />
        </div>
        <div class="clear"></div>
        <!-- Main menu settings -->
        <h3><?php esc_html_e('Main menu settings', 'constructo'); ?></h3>
        <div class='input onequarter'>
            <label for='anps_main_menu_height'><?php esc_html_e('Main menu height in pixels', 'constructo'); ?></label>
            <input type='text' value='<?php echo get_option('anps_main_menu_height', ''); ?>' name='anps_main_menu_height' id='anps_main_menu_height' />
        </div>
        <div class="input onequarter">
            <label for="anps_main_menu_selection"><?php esc_html_e('Dropdown selection states', 'constructo'); ?></label>
            <select id="anps_main_menu_selection" name="anps_main_menu_selection">
                <option value="0"<?php if(get_option('anps_main_menu_selection', '0')=='0'){echo ' '.esc_attr('selected');}?>><?php esc_html_e('Hover color & bottom border', 'constructo'); ?></option>
                <option value="1"<?php if(get_option('anps_main_menu_selection', '0')=='1'){echo ' '.esc_attr('selected');}?>><?php esc_html_e('Hover color', 'constructo'); ?></option>
            </select>
        </div>
        <div class="input onequarter">
            <label for="anps_dropdown_style"><?php esc_html_e('Dropdown style', 'constructo'); ?></label>
            <select id="anps_dropdown_style" name="anps_dropdown_style">
                <option value="1"<?php if(get_option('anps_dropdown_style', '1')=='1'){echo ' '.esc_attr('selected');}?>><?php esc_html_e('Normal', 'constructo'); ?></option>
                <option value="2"<?php if(get_option('anps_dropdown_style', '1')=='2'){echo ' '.esc_attr('selected');}?>><?php esc_html_e('Dividers', 'constructo'); ?></option>
                <option value="3"<?php if(get_option('anps_dropdown_style', '1')=='3'){echo ' '.esc_attr('selected');}?>><?php esc_html_e('Dividers style 2', 'constructo'); ?></option>
            </select>
        </div>
        <!-- Sticky menu -->
        <div class="input onequarter">
            <?php
            $checked = '';
            if(get_option('anps_menu_dividers', '1') != '') {
                $checked='checked';
            }
            ?>
            <label for="anps_menu_dividers"><?php esc_html_e("Menu dividers", 'constructo'); ?></label>
            <input type="hidden" value="" name="anps_menu_dividers"/>
            <input id="anps_menu_dividers" value="1" class="small_input" style="margin-left: 37px" type="checkbox" name="anps_menu_dividers" <?php echo esc_attr($checked); ?> />
        </div>
        <div class="clear"></div>
    </div>
    <?php anps_admin_save_buttons(); ?>
</form>
