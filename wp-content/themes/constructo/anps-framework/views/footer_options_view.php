<?php
include_once get_template_directory() . '/anps-framework/classes/Options.php';
if (isset($_GET['footer_options'])) {
    $options->save_page_setup('footer_options');
}
?>
<form action="themes.php?page=theme_options&sub_page=footer_options&footer_options" method="post">
        <div class="content-top">
                <input type="submit" value="<?php esc_html_e("Save all changes", 'constructo'); ?>" />
                <div class="clear"></div>
        </div>
    <div class="content-inner">
        <!-- Prefooter -->
        <h3><?php esc_html_e("Prefooter", 'constructo'); ?></h3>
        <!-- Prefooter -->
        <div class="input onehalf">
            <?php
            $checked = '';
            if(anps_get_option('', '', 'prefooter') != "") {
                $checked='checked';
            }
            ?>
            <label for="anps_prefooter"><?php esc_html_e("Prefooter", 'constructo'); ?></label>
            <input type="hidden" value="" name="anps_prefooter"/>
            <input id="anps_prefooter" class="small_input" style="margin-left: 25px" type="checkbox" name="anps_prefooter" <?php echo esc_attr($checked); ?> />
        </div>
        <div class="input onehalf">
            <label for="anps_prefooter_style"><?php esc_html_e("Prefooter style", 'constructo'); ?></label>
            <select name="anps_prefooter_style" id="anps_prefooter_style">
                <option value="0"><?php esc_html_e('*** Select ***', 'constructo'); ?></option>
                    <?php $pages = array(
                        '5' => esc_html__("2/3 + 1/3", 'constructo'),
                        '6' => esc_html__("1/3 + 2/3", 'constructo'),
                        '2' => esc_html__('2 columns', 'constructo'),
                        '3' => esc_html__('3 columns', 'constructo'),
                        '4' => esc_html__('4 columns', 'constructo')
                        );
                    foreach ($pages as $key => $item) :
                        $selected = '';
                        if (anps_get_option('', '', 'prefooter_style') == $key) {
                            $selected = ' selected';
                        }
                        ?>
                    <option value="<?php echo esc_attr($key); ?>" <?php echo esc_html($selected); ?>><?php echo esc_attr($item); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <div class="clear"></div>
        <h3><?php esc_html_e("Footer", 'constructo'); ?></h3>
        <!-- Disable footer -->
        <div class="input onethird">
            <?php
            $checked = '';
            if(anps_get_option('', '', 'footer_disable') != '') {
                $checked = 'checked';
            }
            ?>
            <label for="anps_footer_disable"><?php esc_html_e("Disable footer", 'constructo'); ?></label>
            <input type="hidden" value="" name="anps_footer_disable"/>
            <input id="anps_footer_disable" value="1" class="small_input" style="margin-left: 37px" type="checkbox" name="anps_footer_disable" <?php echo esc_attr($checked); ?> />
        </div>
        <!-- Footer columns -->
        <div class="input onethird">
            <label for="anps_footer_style"><?php esc_html_e('Footer columns', 'constructo'); ?></label>
            <select name="anps_footer_style" id="anps_footer_style">
                    <?php $pages = array(
                        '1' => esc_html__('1 column', 'constructo'),
                        '2' => esc_html__('2 columns', 'constructo'),
                        '3' => esc_html__('3 columns', 'constructo'),
                        '4' => esc_html__('4 columns', 'constructo')
                        );
                    foreach ($pages as $key => $item) :
                        $selected = '';
                        if (anps_get_option('', '4', 'footer_style') == $key) {
                            $selected = ' selected';
                        }?>
                <option value="<?php echo esc_attr($key); ?>" <?php echo esc_html($selected); ?>><?php echo esc_attr($item); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <!-- Footer style -->
        <div class="input onethird">
            <label for="anps_footer_widget_style"><?php esc_html_e('Footer style', 'constructo'); ?></label>
            <select name="anps_footer_widget_style" id="anps_footer_widget_style">
                <?php $pages = array(
                    '1' => esc_html__('Style 1', 'constructo'),
                    '2' => esc_html__('Style 2', 'constructo'),
                    '3' => esc_html__('Style 3', 'constructo'),
                    '4' => esc_html__('Style 4', 'constructo')
                );
                foreach ($pages as $key => $item) : ?>
                    <option value="<?php echo esc_attr($key); ?>" <?php if (get_option('anps_footer_widget_style', '1') == $key) {echo esc_attr('selected');} else {echo '';} ?>><?php echo esc_attr($item); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Copyright footer -->
        <div class="input onethird">
            <label for="anps_copyright_footer"><?php esc_html_e("Copyright footer", 'constructo'); ?></label>
            <select name="anps_copyright_footer" id="anps_copyright_footer">
                <option value="0"><?php esc_html_e('*** Select ***', 'constructo'); ?></option>
                    <?php $pages = array('1' => esc_html__('1 column', 'constructo'), '2' => esc_html__('2 columns', 'constructo'));
                    foreach ($pages as $key => $item) :
                        $selected = '';
                        if (anps_get_option('', '', 'copyright_footer') == $key) {
                            $selected = ' selected';
                        }
                        ?>
                    <option value="<?php echo esc_attr($key); ?>" <?php echo esc_html($selected); ?>><?php echo esc_attr($item); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <!-- Parallax footer -->
        <div class="input onehalf">
            <?php
            $checked = '';
            if(get_option('anps_footer_parallax', '') != "") {
                $checked='checked';
            }
            ?>
            <label for="anps_footer_parallax"><?php esc_html_e("Parallax footer", 'constructo'); ?></label>
            <input type="hidden" value="" name="anps_footer_parallax"/>
            <input id="anps_footer_parallax" class="small_input" style="margin-left: 25px" type="checkbox" name="anps_footer_parallax" <?php echo esc_attr($checked); ?> />
        </div>
        <div class="clear"></div>
    </div>
    <?php anps_admin_save_buttons(); ?>
</form>
