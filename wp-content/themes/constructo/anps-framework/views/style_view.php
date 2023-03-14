<?php
include_once get_template_directory() . '/anps-framework/classes/Style.php';
wp_enqueue_script('font_subsets');
/* Save form */
if(isset($_GET['save_style'])) {
    $style->save();
}
/* get all fonts */
$fonts = $style->all_fonts();
?>
<div class="content">
    <form action="themes.php?page=theme_options&save_style" method="post">
        <div class="content-top">
            <input type="submit" value="<?php esc_html_e("Save all changes", 'constructo'); ?>">
            <div class="clear"></div>
        </div>
        <div class="content-inner">
            <h3><?php esc_html_e("Font family", 'constructo'); ?></h3>
            <h4>Custom font styles</h4>
            <p>If subsets are not active please update google fonts <a href="themes.php?page=theme_options&sub_page=theme_style_google_font">here</a>.</p>
            <div class="input onethird">
                <label for="font_type_1">Font type 1</label>
                <select name="font_type_1" id="font_type_1">
                    <?php foreach($fonts as $name=>$value) : ?>
                    <optgroup label="<?php echo esc_attr($name); ?>">
                    <?php foreach ($value as $font) :
                            $selected = '';
                            if ($font['value'] == get_option('font_type_1', 'Montserrat')) {
                                $selected = ' selected';
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
                <div id="font_subsets_1" class="font_subsets">
                    <?php if($subsets) :
                        $i=0;
                        foreach($subsets as $item) :
                            if(is_array(get_option("font_type_1_subsets"))&&in_array($item, get_option("font_type_1_subsets"))) {
                                $checked = " checked";
                            } else {
                                $checked = "";
                            }
                            ?>
                        <input type="checkbox" name="font_type_1_subsets[]" value="<?php echo esc_html($item); ?>" <?php echo esc_attr($checked);?> /><?php echo esc_html($item); ?><br />
                        <?php $i++;
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
            <div class="input onethird">
                <label for="font_type_2"><?php esc_html_e("Font type 2", 'constructo'); ?></label>
                <select name="font_type_2" id="font_type_2">
                    <?php foreach($fonts as $name=>$value) : ?>
                    <optgroup label="<?php echo esc_attr($name); ?>">
                    <?php foreach ($value as $font) :
                            $selected = '';
                            if ($font['value'] == get_option('font_type_2', "PT+Sans")) {
                                $selected = ' selected';
                                if($name=="Google fonts") {
                                    $subsets2 = $font['subsets'];
                                } else {
                                    $subsets2 = "";
                                }
                            }
                            ?>
                            <option value="<?php echo esc_attr($font['value'])."|".esc_attr($name); ?>" <?php echo esc_attr($selected); ?> <?php if(esc_attr($name=="Google fonts")) {echo "data-font='gfonts'";} ?>><?php echo esc_attr($font['name']); ?></option>
                    <?php endforeach; ?>
                    </optgroup>
                    <?php endforeach; ?>
                </select>
                <div id="font_subsets_2" class="font_subsets">
                    <?php if($subsets2) :
                        $i=0;
                        foreach($subsets2 as $item) :
                            if(is_array(get_option("font_type_2_subsets"))&&in_array($item, get_option("font_type_2_subsets"))) {
                                $checked = " checked";
                            } else {
                                $checked = "";
                            }
                            ?>
                        <input type="checkbox" name="font_type_2_subsets[]" value="<?php echo esc_html($item); ?>" <?php echo esc_attr($checked);?> /><?php echo esc_html($item); ?><br />
                        <?php $i++;
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
            <div class="input onethird">
                <label for="font_type_navigation"><?php esc_html_e("Navigation font type", 'constructo'); ?></label>
                <select name="font_type_navigation" id="font_type_navigation">
                    <?php foreach($fonts as $name=>$value) : ?>
                    <optgroup label="<?php echo esc_attr($name); ?>">
                    <?php foreach ($value as $font) :
                            $selected = '';
                            if ($font['value'] == get_option('font_type_navigation', 'Montserrat')) {
                                $selected = 'selected';
                                if($name=="Google fonts") {
                                    $subsets3 = $font['subsets'];
                                } else {
                                    $subsets3 = "";
                                }
                            }
                            ?>
                            <option value="<?php echo esc_attr($font['value'])."|".esc_attr($name); ?>" <?php echo esc_attr($selected); ?> <?php if(esc_attr($name=="Google fonts")) {echo "data-font='gfonts'";} ?>><?php echo esc_attr($font['name']); ?></option>
                    <?php endforeach; ?>
                    </optgroup>
                    <?php endforeach; ?>
                </select>
                <div id="font_subsets_navigation" class="font_subsets">
                    <?php if($subsets3) :
                        $i=0;
                        foreach($subsets3 as $item) :
                            if(is_array(get_option("font_type_navigation_subsets"))&&in_array($item, get_option("font_type_navigation_subsets"))) {
                                $checked = " checked";
                            } else {
                                $checked = "";
                            }
                            ?>
                        <input type="checkbox" name="font_type_navigation_subsets[]" value="<?php echo esc_html($item); ?>" <?php echo esc_attr($checked);?> /><?php echo esc_html($item); ?><br />
                        <?php $i++;
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
            <div class="clear"></div>

            <h3><?php esc_html_e("Font sizes", 'constructo'); ?></h3>
            <div class="input onequarter">
                <label for="anps_body_font_size"><?php esc_html_e("Body Font Size", 'constructo'); ?></label>
                <input class="size" type="text" name="anps_body_font_size" value="<?php echo esc_attr(anps_get_option('', '14', 'body_font_size')); ?>" id="anps_body_font_size" placeholder="14"/><span>px</span>
            </div>
            <div class="input onequarter">
                <label for="anps_menu_font_size"><?php esc_html_e("Menu Font Size", 'constructo'); ?></label>
                <input class="size" type="text" name="anps_menu_font_size" value="<?php echo esc_attr(anps_get_option('', '14', 'menu_font_size')); ?>" id="anps_menu_font_size" placeholder="14"/><span>px</span>
            </div>
            <div class="input onequarter">
                <label for="anps_submenu_font_size"><?php esc_html_e("Submenu Font Size", 'constructo'); ?></label>
                <input class="size" type="text" name="anps_submenu_font_size" value="<?php echo get_option('anps_submenu_font_size', '12'); ?>" id="anps_submenu_font_size" placeholder="12"/><span>px</span>
            </div>
            <div class="input onequarter">
                <label for="anps_h1_font_size"><?php esc_html_e("Content Heading 1 Font Size", 'constructo'); ?></label>
                <input class="size" type="text" name="anps_h1_font_size" value="<?php echo esc_attr(anps_get_option('', '31', 'h1_font_size')); ?>" id="anps_h1_font_size" placeholder="31"/><span>px</span>
            </div>
            <div class="input onequarter">
                <label for="anps_h2_font_size"><?php esc_html_e("Content Heading 2 Font Size", 'constructo'); ?></label>
                <input class="size" type="text" name="anps_h2_font_size" value="<?php echo esc_attr(anps_get_option('', '24', 'h2_font_size')); ?>" id="anps_h2_font_size" placeholder="24"/><span>px</span>
            </div>
            <div class="input onequarter">
                <label for="anps_h3_font_size"><?php esc_html_e("Content Heading 3 Font Size", 'constructo'); ?></label>
                <input class="size" type="text" name="anps_h3_font_size" value="<?php echo esc_attr(anps_get_option('', '21', 'h3_font_size')); ?>" id="anps_h3_font_size" placeholder="21" /><span>px</span>
            </div>
            <div class="input onequarter">
                <label for="anps_h4_font_size"><?php esc_html_e("Content Heading 4 Font Size", 'constructo'); ?></label>
                <input class="size" type="text" name="anps_h4_font_size" value="<?php echo esc_attr(anps_get_option('', '18', 'h4_font_size')); ?>" id="anps_h4_font_size" placeholder="18"/><span>px</span>
            </div>
            <div class="input onequarter">
                <label for="anps_h5_font_size"><?php esc_html_e("Content Heading 5 Font Size", 'constructo'); ?></label>
                <input class="size" type="text" name="anps_h5_font_size" value="<?php echo esc_attr(anps_get_option('', '16', 'h5_font_size')); ?>" id="anps_h5_font_size" placeholder="16"/><span>px</span>
            </div>
            <div class="input onequarter">
                <label for="anps_page_heading_h1_font_size"><?php esc_html_e("Page Heading 1 Font Size", 'constructo'); ?></label>
                <input class="size" type="text" name="anps_page_heading_h1_font_size" value="<?php echo esc_attr(anps_get_option('', '24', 'page_heading_h1_font_size')); ?>" id="anps_page_heading_h1_font_size" placeholder="24"/><span>px</span>
            </div>
            <div class="input onequarter">
                <label for="anps_blog_heading_h1_font_size"><?php esc_html_e("Single blog page heading 1 Font Size", 'constructo'); ?></label>
                <input class="size" type="text" name="anps_blog_heading_h1_font_size" value="<?php echo esc_attr(anps_get_option('', '28', 'blog_heading_h1_font_size')); ?>" id="anps_blog_heading_h1_font_size" placeholder="28"/><span>px</span>
            </div>
            <div class="input onequarter">
                <label for="anps_top_bar_font_size"><?php esc_html_e('Top bar font size', 'constructo'); ?></label>
                <input class="size" type="text" name="anps_top_bar_font_size" value="<?php echo esc_attr(get_option('anps_top_bar_font_size', '14')); ?>" id="anps_top_bar_font_size" placeholder="14"/><span>px</span>
            </div>
            <div class="input onequarter">
                <label for="anps_portfolio_title_font_size"><?php esc_html_e('Portfolio title font size', 'constructo'); ?></label>
                <input class="size" type="text" name="anps_portfolio_title_font_size" value="<?php echo esc_attr(get_option('anps_portfolio_title_font_size', '16')); ?>" id="anps_portfolio_title_font_size" placeholder="16"/><span>px</span>
            </div>
            <div class="clear"></div>
            <h3><?php esc_html_e("Predefined color Scheme", 'constructo'); ?></h3>
            <h4>Choose a predefined colour scheme</h4>
            <p><?php esc_html_e("Selecting one of this schemes will import the predefined colors below, which you can then edit as you like.", 'constructo'); ?></p>
            <div class="clear" ></div>
            <div class="fullwidth" id="predefined_colors">
                <label class="onequarter palette">
                    <input class="hidden" type="radio" name="predefined_colors" value="default" />
                    <div class="wninety"><span class="colorspan floatleft" style="background:#d54900;"></span><span class="colorspantext">Default</span></div>
                </label>
                <label class="onequarter palette">
                    <input class="hidden" type="radio" name="predefined_colors" value="yellow" />
                    <div class="wninety"><span class="colorspan floatleft" style="background:#f9e60d;"></span><span class="colorspantext">Yellow</span></div>
                </label>
                <label class="onequarter palette">
                    <input class="hidden" type="radio" name="predefined_colors" value="blue" />
                    <div class="wninety"><span class="colorspan floatleft" style="background:#3aaedf;"></span><span class="colorspantext">Blue</span></div>
                </label>
                <label class="onequarter palette">
                    <input class="hidden" type="radio" name="predefined_colors" value="green" />
                    <div class="wninety"><span class="colorspan floatleft" style="background:#43b425;"></span><span class="colorspantext">Green</span></div>
                </label>
                <div class="clear"></div>
            </div>
            <h3><?php esc_html_e('Main theme colors', 'constructo'); ?></h3>
            <h4><?php esc_html_e('Set your custom colors', 'constructo'); ?></h4>
            <p><?php esc_html_e('Not satisfied with the premade color schemes? Here you can set your custom colors.', 'constructo'); ?></p>
            <div class="input onequarter">
                <label for="anps_text_color"><?php esc_html_e('Text color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(anps_get_option('', '#727272', 'text_color')); ?>" readonly style="background: <?php echo esc_attr(anps_get_option('', '#727272', 'text_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_text_color" value="<?php echo esc_attr(anps_get_option('', '#727272', 'text_color')); ?>" id="anps_text_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_primary_color"><?php esc_html_e('Primary color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(anps_get_option('', '#292929', 'primary_color')); ?>" readonly style="background: <?php echo esc_attr(anps_get_option('', '#292929', 'primary_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_primary_color" value="<?php echo esc_attr(anps_get_option('', '#292929', 'primary_color')); ?>" id="anps_primary_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_hovers_color"><?php esc_html_e('Hovers color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(anps_get_option('', '#d54900', 'hovers_color')); ?>" readonly style="background: <?php echo esc_attr(anps_get_option('', '#d54900', 'hovers_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_hovers_color" value="<?php echo esc_attr(anps_get_option('', '#d54900', 'hovers_color')); ?>" id="anps_hovers_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_headings_color"><?php esc_html_e('Headings color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(anps_get_option('', '#000', 'headings_color')); ?>" readonly style="background: <?php echo esc_attr(anps_get_option('', '#000', 'headings_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_headings_color" value="<?php echo esc_attr(anps_get_option('', '#000', 'headings_color')); ?>" id="anps_headings_color" />
            </div>

            <div class="input onequarter">
                <label for="anps_main_divider_color"><?php esc_html_e('Main divider color', 'constructo'); ?></label>
                <input data-value="<?php echo get_option('anps_main_divider_color', '#d54900'); ?>" readonly style="background: <?php echo get_option('anps_main_divider_color', '#d54900'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_main_divider_color" value="<?php echo get_option('anps_main_divider_color', '#d54900'); ?>" id="anps_main_divider_color" />
            </div>

            <div class="input onequarter">
                <label for="anps_side_submenu_background_color"><?php esc_html_e('Side submenu background color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(anps_get_option('', '', 'side_submenu_background_color')); ?>" readonly style="background: <?php echo esc_attr(anps_get_option('', '', 'side_submenu_background_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_side_submenu_background_color" value="<?php echo esc_attr(anps_get_option('', '', 'side_submenu_background_color')); ?>" id="anps_side_submenu_background_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_side_submenu_text_color"><?php esc_html_e('Side submenu text color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(anps_get_option('', '', 'side_submenu_text_color')); ?>" readonly style="background: <?php echo esc_attr(anps_get_option('', '', 'side_submenu_text_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_side_submenu_text_color" value="<?php echo esc_attr(anps_get_option('', '', 'side_submenu_text_color')); ?>" id="anps_side_submenu_text_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_side_submenu_text_hover_color"><?php esc_html_e('Side submenu text hover color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(anps_get_option('', '', 'side_submenu_text_hover_color')); ?>" readonly style="background: <?php echo esc_attr(anps_get_option('', '', 'side_submenu_text_hover_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_side_submenu_text_hover_color" value="<?php echo esc_attr(anps_get_option('', '', 'side_submenu_text_hover_color')); ?>" id="anps_side_submenu_text_hover_color" />
            </div>
            <p>&nbsp;</p>
            <div class="clear"></div>

            <h3><?php esc_html_e('Header colors', 'constructo'); ?></h3>
            <div class="input onequarter">
                <label for="anps_menu_text_color"><?php esc_html_e('Menu text color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(anps_get_option('', '#000', 'menu_text_color')); ?>" readonly style="background: <?php echo esc_attr(anps_get_option('', '#000', 'menu_text_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_menu_text_color" value="<?php echo esc_attr(anps_get_option('', '#000', 'menu_text_color')); ?>" id="anps_menu_text_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_top_bar_color"><?php esc_html_e('Top bar text color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(anps_get_option('', '#c1c1c1', 'top_bar_color')); ?>" readonly style="background: <?php echo esc_attr(anps_get_option('', '#c1c1c1', 'top_bar_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_top_bar_color" value="<?php echo esc_attr(anps_get_option('', '#c1c1c1', 'top_bar_color')); ?>" id="anps_top_bar_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_top_bar_bg_color"><?php esc_html_e('Top bar background color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(anps_get_option('', '#f9f9f9', 'top_bar_bg_color')); ?>" readonly style="background: <?php echo esc_attr(anps_get_option('', '#f9f9f9', 'top_bar_bg_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_top_bar_bg_color" value="<?php echo esc_attr(anps_get_option('', '#f9f9f9', 'top_bar_bg_color')); ?>" id="anps_top_bar_bg_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_nav_background_color"><?php esc_html_e('Page header background color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(anps_get_option('', '#fff', 'nav_background_color')); ?>" readonly style="background: <?php echo esc_attr(anps_get_option('', '#fff', 'nav_background_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_nav_background_color" value="<?php echo esc_attr(anps_get_option('', '#fff', 'nav_background_color')); ?>" id="anps_nav_background_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_submenu_background_color"><?php esc_html_e('Submenu background color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(anps_get_option('', '#fff', 'submenu_background_color')); ?>" readonly style="background: <?php echo esc_attr(anps_get_option('', '#fff', 'submenu_background_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_submenu_background_color" value="<?php echo esc_attr(anps_get_option('', '#fff', 'submenu_background_color')); ?>" id="anps_submenu_background_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_submenu_divider_color"><?php esc_html_e('Submenu divider color', 'constructo'); ?></label>
                <input data-value="<?php echo get_option('anps_submenu_divider_color', '#ececec'); ?>" readonly style="background: <?php echo get_option('anps_submenu_divider_color', '#ececec'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_submenu_divider_color" value="<?php echo get_option('anps_submenu_divider_color', '#ececec'); ?>" id="anps_submenu_divider_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_curent_menu_color"><?php esc_html_e('Selected main menu color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(get_option('anps_curent_menu_color', '#d54900')); ?>" readonly style="background: <?php echo esc_attr(get_option('anps_curent_menu_color', '#d54900')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_curent_menu_color" value="<?php echo esc_attr(get_option('anps_curent_menu_color', '#d54900')); ?>" id="anps_curent_menu_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_submenu_text_color"><?php esc_html_e('Submenu text color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(anps_get_option('', '#000', 'submenu_text_color')); ?>" readonly style="background: <?php echo esc_attr(anps_get_option('', '#000', 'submenu_text_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_submenu_text_color" value="<?php echo esc_attr(anps_get_option('', '#000', 'submenu_text_color')); ?>" id="anps_submenu_text_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_woo_cart_items_number_bg_color"><?php esc_html_e('Cart number background color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(get_option('anps_woo_cart_items_number_bg_color', '#d54900')); ?>" readonly style="background: <?php echo esc_attr(get_option('anps_woo_cart_items_number_bg_color', '#d54900')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_woo_cart_items_number_bg_color" value="<?php echo esc_attr(get_option('anps_woo_cart_items_number_bg_color', '#d54900')); ?>" id="anps_woo_cart_items_number_bg_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_woo_cart_items_number_color"><?php esc_html_e('Cart number text color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(get_option('anps_woo_cart_items_number_color', '#fff')); ?>" readonly style="background: <?php echo esc_attr(get_option('anps_woo_cart_items_number_color', '#fff')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_woo_cart_items_number_color" value="<?php echo esc_attr(get_option('anps_woo_cart_items_number_color', '#fff')); ?>" id="anps_woo_cart_items_number_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_logo_bg_color"><?php esc_html_e('Logo background color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(get_option('anps_logo_bg_color')); ?>" readonly style="background: <?php echo esc_attr(get_option('anps_logo_bg_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_logo_bg_color" value="<?php echo esc_attr(get_option('anps_logo_bg_color')); ?>" id="anps_logo_bg_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_above_menu_bg_color"><?php esc_html_e('Above menu background color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(get_option('anps_above_menu_bg_color')); ?>" readonly style="background: <?php echo esc_attr(get_option('anps_above_menu_bg_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_above_menu_bg_color" value="<?php echo esc_attr(get_option('anps_above_menu_bg_color')); ?>" id="anps_above_menu_bg_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_page_heading_bg_color"><?php esc_html_e('Page heading background color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(get_option('anps_page_heading_bg_color')); ?>" readonly style="background: <?php echo esc_attr(get_option('anps_page_heading_bg_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_page_heading_bg_color" value="<?php echo esc_attr(get_option('anps_page_heading_bg_color')); ?>" id="anps_page_heading_bg_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_page_heading_text_color"><?php esc_html_e('Page heading text color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(get_option('anps_page_heading_text_color')); ?>" readonly style="background: <?php echo esc_attr(get_option('anps_page_heading_text_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_page_heading_text_color" value="<?php echo esc_attr(get_option('anps_page_heading_text_color')); ?>" id="anps_page_heading_text_color" />
            </div>
            <p>&nbsp;</p>
            <div class="clear"></div>

            <h3><?php esc_html_e('Footer colors', 'constructo'); ?></h3>
            <div class="input onequarter">
                <label for="anps_footer_bg_color"><?php esc_html_e('Footer background color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(anps_get_option('', '#242424', 'footer_bg_color')); ?>" readonly style="background: <?php echo esc_attr(anps_get_option('', '#242424', 'footer_bg_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_footer_bg_color" value="<?php echo esc_attr(anps_get_option('', '#242424', 'footer_bg_color')); ?>" id="anps_footer_bg_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_footer_text_color"><?php esc_html_e('Footer text color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(anps_get_option('', '#d9d9d9', 'footer_text_color')); ?>" readonly style="background: <?php echo esc_attr(anps_get_option('', '#d9d9d9', 'footer_text_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_footer_text_color" value="<?php echo esc_attr(anps_get_option('', '#d9d9d9', 'footer_text_color')); ?>" id="anps_footer_text_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_heading_text_color"><?php esc_html_e('Footer heading text color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(get_option('anps_heading_text_color', '#fff')); ?>" readonly style="background: <?php echo esc_attr(get_option('anps_heading_text_color', '#fff')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_heading_text_color" value="<?php echo esc_attr(get_option('anps_heading_text_color', '#fff')); ?>" id="anps_heading_text_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_footer_selected_color"><?php esc_html_e('Footer selected color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(get_option('anps_footer_selected_color', '')); ?>" readonly style="background: <?php echo esc_attr(get_option('anps_footer_selected_color', '')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_footer_selected_color" value="<?php echo esc_attr(get_option('anps_footer_selected_color', '')); ?>" id="anps_footer_selected_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_footer_hover_color"><?php esc_html_e('Footer hover color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(get_option('anps_footer_hover_color', '')); ?>" readonly style="background: <?php echo esc_attr(get_option('anps_footer_hover_color', '')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_footer_hover_color" value="<?php echo esc_attr(get_option('anps_footer_hover_color', '')); ?>" id="anps_footer_hover_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_footer_divider_color"><?php esc_html_e('Footer divider color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(get_option('anps_footer_divider_color', '#fff')); ?>" readonly style="background: <?php echo esc_attr(get_option('anps_footer_divider_color', '#fff')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_footer_divider_color" value="<?php echo esc_attr(get_option('anps_footer_divider_color', '#fff')); ?>" id="anps_footer_divider_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_copyright_footer_text_color"><?php esc_html_e('Copyright footer text color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(get_option('anps_copyright_footer_text_color', '#c4c4c4')); ?>" readonly style="background: <?php echo esc_attr(get_option('anps_copyright_footer_text_color', '#242424')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_copyright_footer_text_color" value="<?php echo esc_attr(get_option('anps_copyright_footer_text_color', '#c4c4c4')); ?>" id="anps_copyright_footer_text_color" />
            </div>
            <div class="input onequarter">
                <label for="anps_copyright_footer_bg_color"><?php esc_html_e('Copyright footer background color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(anps_get_option('', '#0f0f0f', 'copyright_footer_bg_color')); ?>" readonly style="background: <?php echo esc_attr(anps_get_option('', '#0f0f0f', 'copyright_footer_bg_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_copyright_footer_bg_color" value="<?php echo esc_attr(anps_get_option('', '#0f0f0f', 'copyright_footer_bg_color')); ?>" id="anps_copyright_footer_bg_color" />
            </div>
        <p>&nbsp;</p>
        <div class="clear"></div>

        <h3><?php esc_html_e("Button styles", 'constructo'); ?></h3>
            <div class="input fullwidth">
                <p>Button styles will refresh after clicking "Save all changes".</p>
                <hr>
                <div class="fullwidth">
                    <h4>Default button</h4>
                    <a class="btn btn-sm btn--default" data-button="default" href="#">Button</a>
                </div>
                <div class="input onequarter">
                    <label for="anps_default_button_bg"><?php esc_html_e("Default button background", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#292929', 'default_button_bg')); ?>" data-bg="default" readonly style="background: <?php echo esc_attr(anps_get_option('', '#292929', 'default_button_bg')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_default_button_bg" value="<?php echo esc_attr(anps_get_option('', '#292929', 'default_button_bg')); ?>" id="anps_default_button_bg" />
                </div>
                <div class="input onequarter">
                    <label for="anps_default_button_color"><?php esc_html_e("Default button color", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#fff', 'default_button_color')); ?>" data-color="default" readonly style="background: <?php echo esc_attr(anps_get_option('', '#fff', 'default_button_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_default_button_color" value="<?php echo esc_attr(anps_get_option('', '#fff', 'default_button_color')); ?>" id="anps_default_button_color" />
                </div>
                <div class="input onequarter">
                    <label for="anps_default_button_hover_bg"><?php esc_html_e("Default button hover background", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#d54900', 'default_button_hover_bg')); ?>" data-bgHover="default" readonly style="background: <?php echo esc_attr(anps_get_option('', '#d54900', 'default_button_hover_bg')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_default_button_hover_bg" value="<?php echo esc_attr(anps_get_option('', '#d54900', 'default_button_hover_bg')); ?>" id="anps_default_button_hover_bg" />
                </div>
                <div class="input onequarter">
                    <label for="anps_default_button_hover_color"><?php esc_html_e("Default button hover color", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#fff', 'default_button_hover_color')); ?>" data-colorHover="default" readonly style="background: <?php echo esc_attr(anps_get_option('', '#fff', 'default_button_hover_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_default_button_hover_color" value="<?php echo esc_attr(anps_get_option('', '#fff', 'default_button_hover_color')); ?>" id="anps_default_button_hover_color" />
                </div>
                <div class="clear"></div>
                <hr>
            </div>
            <div class="clear"></div>
            <div class="input fullwidth">
                <div class="fullwidth">
                    <h4><?php esc_html_e("Button style-1", 'constructo');?></h4>
                    <a class="btn btn-sm style-1 btn--style-1" data-button="style-1" href="#">Button</a>
                </div>
                <div class="input onequarter">
                    <label for="anps_style_1_button_bg"><?php esc_html_e("button background", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#292929', 'style_1_button_bg')); ?>" data-bg="style-1" readonly style="background: <?php echo esc_attr(anps_get_option('', '#292929', 'style_1_button_bg')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_1_button_bg" value="<?php echo esc_attr(anps_get_option('', '#292929', 'style_1_button_bg')); ?>" id="anps_style_1_button_bg" />
                </div>
                <div class="input onequarter">
                    <label for="anps_style_1_button_color"><?php esc_html_e("button color", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#fff', 'style_1_button_color')); ?>" data-color="style-1" readonly style="background: <?php echo esc_attr(anps_get_option('', '#fff', 'style_1_button_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_1_button_color" value="<?php echo esc_attr(anps_get_option('', '#fff', 'style_1_button_color')); ?>" id="anps_style_1_button_color" />
                </div>
                <div class="input onequarter">
                    <label for="anps_style_1_button_hover_bg"><?php esc_html_e("button hover background", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#d54900', 'style_1_button_hover_bg')); ?>" data-bgHover="style-1" readonly style="background: <?php echo esc_attr(anps_get_option('', '#d54900', 'style_1_button_hover_bg')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_1_button_hover_bg" value="<?php echo esc_attr(anps_get_option('', '#d54900', 'style_1_button_hover_bg')); ?>" id="anps_style_1_button_hover_bg" />
                </div>
                <div class="input onequarter">
                    <label for="anps_style_1_button_hover_color"><?php esc_html_e("button hover color", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#fff', 'style_1_button_hover_color')); ?>" data-colorHover="style-1" readonly style="background: <?php echo esc_attr(anps_get_option('', '#fff', 'style_1_button_hover_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_1_button_hover_color" value="<?php echo esc_attr(anps_get_option('', '#fff', 'style_1_button_hover_color')); ?>" id="anps_style_1_button_hover_color" />
                </div>
                <div class="clear"></div>
                <hr>
            </div>
            <div class="clear"></div>
            <div class="input fullwidth">
                <div class="fullwidth">
                    <h4><?php esc_html_e("Button style-2", 'constructo');?></h4>
                    <a class="btn btn-sm style-2 btn--style-2" data-button="style-2" href="#">Button</a>
                </div>
                <div class="input onequarter">
                    <label for="anps_style_2_button_bg"><?php esc_html_e("button background", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#292929', 'style_2_button_bg')); ?>" data-bg="style-2" data-border="style-2" readonly style="background: <?php echo esc_attr(anps_get_option('', '#292929', 'style_2_button_bg')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_2_button_bg" value="<?php echo esc_attr(anps_get_option('', '#292929', 'style_2_button_bg')); ?>" id="anps_style_2_button_bg" />
                </div>
                <div class="input onequarter">
                    <label for="anps_style_2_button_color"><?php esc_html_e("button color", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#fff', 'style_2_button_color')); ?>" data-color="style-2" readonly style="background: <?php echo esc_attr(anps_get_option('', '#fff', 'style_2_button_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_2_button_color" value="<?php echo esc_attr(anps_get_option('', '#fff', 'style_2_button_color')); ?>" id="anps_style_2_button_color" />
                </div>
                <div class="input onequarter">
                    <label for="anps_style_2_button_hover_bg"><?php esc_html_e("button hover background", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#d54900', 'style_2_button_hover_bg')); ?>" data-bgHover="style-2" readonly style="background: <?php echo esc_attr(anps_get_option('', '#d54900', 'style_2_button_hover_bg')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_2_button_hover_bg" value="<?php echo esc_attr(anps_get_option('', '#d54900', 'style_2_button_hover_bg')); ?>" id="anps_style_2_button_hover_bg" />
                </div>
                <div class="input onequarter">
                    <label for="anps_style_2_button_hover_color"><?php esc_html_e("button hover color", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#fff', 'style_2_button_hover_color')); ?>" data-colorHover="style-2" readonly style="background: <?php echo esc_attr(anps_get_option('', '#fff', 'style_2_button_hover_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_2_button_hover_color" value="<?php echo esc_attr(anps_get_option('', '#fff', 'style_2_button_hover_color')); ?>" id="anps_style_2_button_hover_color" />
                </div>
                <div class="clear"></div>
                <hr>
            </div>
            <div class="input fullwidth">
                <div class="fullwidth">
                    <h4><?php esc_html_e("Button style-3", 'constructo');?></h4>
                    <a class="btn btn-sm style-3 btn--style-3" data-button="style-3" href="#">Button</a>
                </div>
                <div class="input onequarter">
                    <label for="anps_style_3_button_color"><?php esc_html_e("button color", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#000', 'style_3_button_color')); ?>" data-color="style-3" readonly style="background: <?php echo esc_attr(anps_get_option('', '#000', 'style_3_button_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_3_button_color" value="<?php echo esc_attr(anps_get_option('', '#000', 'style_3_button_color')); ?>" id="anps_style_3_button_color" />
                </div>
                <div class="input onequarter">
                    <label for="anps_style_3_button_hover_bg"><?php esc_html_e("button hover background", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#fafafa', 'style_3_button_hover_bg')); ?>" data-bgHover="style-3" readonly style="background: <?php echo esc_attr(anps_get_option('', '#fafafa', 'style_3_button_hover_bg')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_3_button_hover_bg" value="<?php echo esc_attr(anps_get_option('', '#fafafa', 'style_3_button_hover_bg')); ?>" id="anps_style_3_button_hover_bg" />
                </div>
                <div class="input onequarter">
                    <label for="anps_style_3_button_hover_color"><?php esc_html_e("button hover color", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#000', 'style_3_button_hover_color')); ?>" data-colorHover="style-3" readonly style="background: <?php echo esc_attr(anps_get_option('', '#000', 'style_3_button_hover_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_3_button_hover_color" value="<?php echo esc_attr(anps_get_option('', '#000', 'style_3_button_hover_color')); ?>" id="anps_style_3_button_hover_color" />
                </div>
                <div class="input onequarter">
                    <label for="anps_style_3_button_border_color"><?php esc_html_e("button border color", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#000', 'style_3_button_border_color')); ?>" data-border="style-3" readonly style="background: <?php echo esc_attr(anps_get_option('', '#000', 'style_3_button_border_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_3_button_border_color" value="<?php echo esc_attr(anps_get_option('', '#000', 'style_3_button_border_color')); ?>" id="anps_style_3_button_border_color" />
                </div>
                <div class="clear"></div>
                <hr>
            </div>
            <div class="input fullwidth">
                <div class="fullwidth">
                    <h4><?php esc_html_e("Button style-4", 'constructo');?></h4>
                    <a class="btn btn-sm style-4 btn--style-4" data-button="style-4" href="#">Button</a>
                </div>
                <div class="input onequarter">
                    <label for="anps_style_4_button_color"><?php esc_html_e("button color", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#d54900', 'style_4_button_color')); ?>" data-color="style-4" readonly style="background: <?php echo esc_attr(anps_get_option('', '#d54900', 'style_4_button_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_4_button_color" value="<?php echo esc_attr(anps_get_option('', '#d54900', 'style_4_button_color')); ?>" id="anps_style_4_button_color" />
                </div>
                <div class="input onequarter">
                    <label for="anps_style_4_button_hover_color"><?php esc_html_e("button hover color", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#000', 'style_4_button_hover_color')); ?>" data-colorHover="style-4" readonly style="background: <?php echo esc_attr(anps_get_option('', '#000', 'style_4_button_hover_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_4_button_hover_color" value="<?php echo esc_attr(anps_get_option('', '#000', 'style_4_button_hover_color')); ?>" id="anps_style_4_button_hover_color" />
                </div>
                <div class="clear"></div>
                <hr>
            </div>
            <div class="input fullwidth">
                <div class="fullwidth">
                    <h4><?php esc_html_e("Button slider", 'constructo');?></h4>
                    <a class="btn btn-sm slider btn--slider" data-button="slider" href="#">Button</a>
                </div>
                <div class="input onequarter">
                    <label for="anps_style_slider_button_bg"><?php esc_html_e("button background", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#292929', 'style_slider_button_bg')); ?>" data-bg="slider" readonly style="background: <?php echo esc_attr(anps_get_option('', '#292929', 'style_slider_button_bg')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_slider_button_bg" value="<?php echo esc_attr(anps_get_option('', '#292929', 'style_slider_button_bg')); ?>" id="anps_style_slider_button_bg" />
                </div>
                <div class="input onequarter">
                    <label for="anps_style_slider_button_color"><?php esc_html_e("button color", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#fff', 'style_slider_button_color')); ?>" data-color="slider" readonly style="background: <?php echo esc_attr(anps_get_option('', '#fff', 'style_slider_button_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_slider_button_color" value="<?php echo esc_attr(anps_get_option('', '#fff', 'style_slider_button_color')); ?>" id="anps_style_slider_button_color" />
                </div>
                <div class="input onequarter">
                    <label for="anps_style_slider_button_hover_bg"><?php esc_html_e("button hover background", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#d54900', 'style_slider_button_hover_bg')); ?>" data-bgHover="slider" readonly style="background: <?php echo esc_attr(anps_get_option('', '#d54900', 'style_slider_button_hover_bg')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_slider_button_hover_bg" value="<?php echo esc_attr(anps_get_option('', '#d54900', 'style_slider_button_hover_bg')); ?>" id="anps_style_slider_button_hover_bg" />
                </div>
                <div class="input onequarter">
                    <label for="anps_style_slider_button_hover_color"><?php esc_html_e("button hover color", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#fff', 'style_slider_button_hover_color')); ?>" data-colorHover="slider" readonly style="background: <?php echo esc_attr(anps_get_option('', '#fff', 'style_slider_button_hover_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_slider_button_hover_color" value="<?php echo esc_attr(anps_get_option('', '#fff', 'style_slider_button_hover_color')); ?>" id="anps_style_slider_button_hover_color" />
                </div>
                <div class="clear"></div>
                <hr>
            </div>
            <div class="input fullwidth">
                <div class="fullwidth">
                    <h4><?php esc_html_e("Button style-5", 'constructo');?></h4>
                    <a class="btn btn-sm style-5 btn--style-5" data-button="style-5" href="#">Button</a>
                </div>
                <div class="input onequarter">
                    <label for="anps_style_style_5_button_bg"><?php esc_html_e("button background", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#c3c3c3', 'style_style_5_button_bg')); ?>" data-bg="style-5" readonly style="background: <?php echo esc_attr(anps_get_option('', '#c3c3c3', 'style_style_5_button_bg')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_style_5_button_bg" value="<?php echo esc_attr(anps_get_option('', '#c3c3c3', 'style_style_5_button_bg')); ?>" id="anps_style_style_5_button_bg" />
                </div>
                <div class="input onequarter">
                    <label for="anps_style_style_5_button_color"><?php esc_html_e("button color", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#fff', 'style_style_5_button_color')); ?>" data-color="style-5" readonly style="background: <?php echo esc_attr(anps_get_option('', '#fff', 'style_style_5_button_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_style_5_button_color" value="<?php echo esc_attr(anps_get_option('', '#fff', 'style_style_5_button_color')); ?>" id="anps_style_style_5_button_color" />
                </div>
                <div class="input onequarter">
                    <label for="anps_style_style_5_button_hover_bg"><?php esc_html_e("button hover background", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#737373', 'style_style_5_button_hover_bg')); ?>" data-bgHover="style-5" readonly style="background: <?php echo esc_attr(anps_get_option('', '#737373', 'style_style_5_button_hover_bg')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_style_5_button_hover_bg" value="<?php echo esc_attr(anps_get_option('', '#737373', 'style_style_5_button_hover_bg')); ?>" id="anps_style_style_5_button_hover_bg" />
                </div>
                <div class="input onequarter">
                    <label for="anps_style_style_5_button_hover_color"><?php esc_html_e("button hover color", 'constructo'); ?></label>
                    <input data-value="<?php echo esc_attr(anps_get_option('', '#fff', 'style_style_5_button_hover_color')); ?>" data-colorHover="style-5" readonly style="background: <?php echo esc_attr(anps_get_option('', '#fff', 'style_style_5_button_hover_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_style_style_5_button_hover_color" value="<?php echo esc_attr(anps_get_option('', '#fff', 'style_style_5_button_hover_color')); ?>" id="anps_style_style_5_button_hover_color" />
                </div>
                <div class="clear"></div>
                <hr>
            </div>
        </div>
        <div class="clear"></div>
        <?php anps_admin_save_buttons(); ?>
    </form>
    <div class="clear"></div>
</div>
