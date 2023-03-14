<?php
include_once get_template_directory() . '/anps-framework/classes/Options.php';
$anps_options_data = $options->get_page_data();
wp_enqueue_script('thickbox');
wp_register_script('my-upload', get_template_directory_uri() . 'anps-framework/upload_image.js', array('jquery', 'media-upload', 'thickbox'));
wp_enqueue_script('my-upload');
wp_enqueue_style('thickbox');
if (isset($_GET['save_page'])) {
    $options->save_page();
}
?>
<form action="themes.php?page=theme_options&sub_page=options_page&save_page" method="post">

    <div class="content-top"><input type="submit" value="<?php _e("Save all changes", 'constructo'); ?>" /><div class="clear"></div></div>

    <div class="content-inner">
        <!-- Page layout -->
        <h3><?php esc_html_e('Page layout:', 'constructo'); ?></h3>
        <p><?php esc_html_e('Here you can change all the settings about responsive layout and will your site be boxed (when checked you will have more options).', 'constructo'); ?></p>
        <div class="info">
            <!-- Boxed -->
            <?php
            $checked = '';
            if(anps_get_option($anps_options_data, 'boxed')=='1') {
                $checked = 'checked';
            }
            ?>
            <div class="clear"></div>
            <div class="input onehalf">
                <label for="anps_boxed"><?php esc_html_e('Boxed', 'constructo'); ?></label>
                <input type='hidden' value='' name='anps_boxed'/>
                <input id="is-boxed" class="small_input" value="1" type="checkbox" name="anps_boxed" <?php if(anps_get_option($anps_options_data, 'boxed')=='1') {echo esc_attr('checked');} else {echo '';} ?> />
            </div>

            <!-- Pattern -->
            <div <?php if ($checked == "") echo 'style="display:none"'; ?> class="input fullwidth" id="pattern-select-wrapper">
                <label for="anps_pattern"><?php _e("Pattern", 'constructo'); ?></label>
                <div class="admin-patern-radio">
                    <?php for ($i = 0; $i < 10; $i++) :
                        ?>
                        <input type="radio" id="anps_pattern" name="anps_pattern" value="<?php echo esc_attr($i); ?>" <?php if (anps_get_option($anps_options_data, 'pattern') == $i){echo 'checked';}else{echo '';} ?>/>
                    <?php endfor; ?>
                </div>
                <div class="admin-patern-select fullwidth">
                    <?php for ($i = 0; $i < 10; $i++) : ?>
                        <?php if (anps_get_option($anps_options_data, 'pattern') == $i): ?>
                            <img id="selected-pattern" src="<?php echo get_template_directory_uri(); ?>/css/boxed/pattern-<?php echo esc_attr($i); ?>.png" />
                        <?php else: ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/css/boxed/pattern-<?php echo esc_attr($i); ?>.png" />
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
                <div style="clear: both"></div>
            </div>
            <!-- Custom background -->
            <div class="input fullwidth" <?php if (anps_get_option($anps_options_data, 'boxed')=='' || anps_get_option($anps_options_data, 'pattern')!='0') echo 'style="display: none"'; ?> id="patern-type-wrapper">
                <label for="pattern"><?php esc_html_e('Custom background type', 'constructo'); ?></label>
                <div class="patern-type">
                    <?php $types = array(esc_html__('stretched', 'constructo'), esc_html__('tilled', 'constructo'), esc_html__('custom color', 'constructo'));

                    foreach ($types as $type) :
                        $checked = '';
                        if(anps_get_option($anps_options_data, 'type') == $type) {
                            $checked = 'checked';
                        }
                    ?>
                    <span class="onethird">
                        <input style="display: inline-block;" type="radio" id="back-type-<?php echo esc_attr($type); ?>" name="anps_type" value="<?php echo esc_attr($type); ?>" <?php echo esc_attr($checked); ?>/>
                        <label style="font-weight: normal;display: inline; margin: 0; cursor: pointer" for="back-type-<?php echo esc_attr($type); ?>"><?php echo esc_attr($type); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- Custom pattern -->
            <div class="input fullwidth"  <?php if ((anps_get_option($anps_options_data, 'boxed')=='' || anps_get_option($anps_options_data, 'pattern')!='0') || (anps_get_option($anps_options_data, 'type')!="stretched") && anps_get_option($anps_options_data, 'type')!= "tilled" ) echo 'style="display: none"'; ?> id="custom-patern-wrapper">
                <label for="anps_custom_pattern"><?php esc_html_e('Custom background image/pattern', 'constructo'); ?></label>
                <input class="wninety" id="anps_custom_pattern" type="text" size="36" name="anps_custom_pattern" value="<?php echo esc_attr(anps_get_option($anps_options_data, 'custom_pattern')); ?>" />
                <input id="_btn" class="upload_image_button" type="button" value="Upload" />
            </div>
            <!-- Custom background color -->
            <div id="custom-background-color-wrapper" class="input" <?php if ((anps_get_option($anps_options_data, 'boxed')=='' || anps_get_option($anps_options_data, 'pattern')!='0') || (anps_get_option($anps_options_data, 'type')=='' || anps_get_option($anps_options_data, 'type')!= "custom color") ) echo 'style="display: none"'; ?>>
                <label for="anps_bg_color"><?php esc_html_e('Custom background color', 'constructo'); ?></label>
                <input data-value="<?php echo esc_attr(anps_get_option($anps_options_data, 'bg_color')); ?>" readonly style="background: <?php echo esc_attr(anps_get_option($anps_options_data, 'bg_color')); ?>" class="color-pick-color"><input class="color-pick" type="text" name="anps_bg_color" value="<?php echo esc_attr(anps_get_option($anps_options_data, 'bg_color')); ?>" id="anps_bg_color" />
            </div>
    </div>
    <div class="clear"></div>
       <!-- Container width -->
        <h3><?php esc_html_e('Desktop Container Width', 'constructo'); ?></h3>
        <div class="input onequarter two-line-label">
            <input class="size" type="text" name="anps_container_width" value="<?php echo esc_attr(get_option('anps_container_width', '1170')); ?>" id="anps_container_width" placeholder="1170"/><span>px</span>
        </div>

        <div class="clear"></div>
       <!-- Page Sidebars (global settings) -->
        <?php global $wp_registered_sidebars;  ?>

        <h3><?php esc_html_e('Page Sidebars', 'constructo'); ?></h3>
        <p><?php esc_html_e('This will change the default sidebar value on all pages. It can be changed on each page individually.', 'constructo'); ?></p>

        <!-- Left Sidebar -->
        <div class="input onehalf" style="padding-top: 0;">
            <label for="page-sidebar-left"><?php esc_html_e('Left Sidebar', 'constructo'); ?></label>
            <select name="anps_page_sidebar_left" id="page-sidebar-left">
                <option value="0"></option>
            <?php
                global $wp_registered_sidebars;
                $sidebars = $wp_registered_sidebars;

                if( is_array($sidebars) && !empty($sidebars) ) {
                    foreach( $sidebars as $sidebar ) {
                        if(anps_get_option($anps_options_data, 'page_sidebar_left') == esc_attr($sidebar['name']) ) {
                            echo '<option value="' . esc_attr($sidebar['name']) . '" selected>' . esc_attr($sidebar['name']) . '</option>';
                        } else {
                            echo '<option value="' . esc_attr($sidebar['name']) . '">' . esc_attr($sidebar['name']) . '</option>';
                        }
                    }
                }
            ?>
            </select>
        </div>

        <!-- Right Sidebar -->
        <div class="input onehalf" style="padding-top: 0;">
            <label for="page-sidebar-right"><?php esc_html_e('Right Sidebar', 'constructo'); ?></label>
            <select name="anps_page_sidebar_right" id="page-sidebar-right">
                <option value="0"></option>
            <?php
                global $wp_registered_sidebars;
                $sidebars = $wp_registered_sidebars;

                if( is_array($sidebars) && !empty($sidebars) ) {
                    foreach( $sidebars as $sidebar ) {
                        if( anps_get_option($anps_options_data, 'page_sidebar_right') == esc_attr($sidebar['name']) ) {
                            echo '<option value="' . esc_attr($sidebar['name']) . '" selected>' . esc_attr($sidebar['name']) . '</option>';
                        } else {
                            echo '<option value="' . esc_attr($sidebar['name']) . '">' . esc_attr($sidebar['name']) . '</option>';
                        }
                    }
                }
            ?>
            </select>
        </div>

       <div class="clear"></div>
        <!-- Post Sidebars (global settings) -->
        <?php global $wp_registered_sidebars;  ?>

        <h3><?php esc_html_e('Post Sidebars', 'constructo'); ?></h3>
        <p><?php esc_html_e('This will change the default sidebar value on all posts. It can be changed on each post individually.', 'constructo'); ?></p>

        <!-- Left Sidebar -->
        <div class="input onehalf" style="padding-top: 0;">
            <label for="post-sidebar-left"><?php _e("Left Sidebar", 'constructo'); ?></label>
            <select name="anps_post_sidebar_left" id="post-sidebar-left">
                <option value="0"></option>
            <?php
                global $wp_registered_sidebars;
                $sidebars = $wp_registered_sidebars;

                if( is_array($sidebars) && !empty($sidebars) ) {
                    foreach( $sidebars as $sidebar ) {
                        if(anps_get_option($anps_options_data, 'post_sidebar_left') == esc_attr($sidebar['name']) ) {
                            echo '<option value="' . esc_attr($sidebar['name']) . '" selected>' . esc_attr($sidebar['name']) . '</option>';
                        } else {
                            echo '<option value="' . esc_attr($sidebar['name']) . '">' . esc_attr($sidebar['name']) . '</option>';
                        }
                    }
                }
            ?>
            </select>
        </div>

        <!-- Right Sidebar -->
        <div class="input onehalf" style="padding-top: 0;">
            <label for="post-sidebar-right"><?php esc_html_e('Right Sidebar', 'constructo'); ?></label>
            <select name="anps_post_sidebar_right" id="post-sidebar-right">
                <option value="0"></option>
            <?php
                global $wp_registered_sidebars;
                $sidebars = $wp_registered_sidebars;

                if( is_array($sidebars) && !empty($sidebars) ) {
                    foreach( $sidebars as $sidebar ) {
                        if(anps_get_option($anps_options_data, 'post_sidebar_right') == esc_attr($sidebar['name']) ) {
                            echo '<option value="' . esc_attr($sidebar['name']) . '" selected>' . esc_attr($sidebar['name']) . '</option>';
                        } else {
                            echo '<option value="' . esc_attr($sidebar['name']) . '">' . esc_attr($sidebar['name']) . '</option>';
                        }
                    }
                }
            ?>
            </select>
        </div>


        <div class="clear"></div>
        <h3><?php esc_html_e('Heading', 'constructo'); ?></h3>
            <!-- Title & Breadcrumbs style -->
            <div class="input onehalf">
                <label for="anps_title_breadcrumbs"><?php esc_html_e('Page title and breadcrumbs style', 'constructo'); ?></label>
                <select name="anps_title_breadcrumbs" id="anps_title_breadcrumbs">
                    <?php
                    $pages = array('1'=>esc_html__('Style 1', 'constructo'), '2'=>esc_html__('Style 2', 'constructo'));
                    foreach ($pages as $key=>$item) : ?>
                    <option value="<?php echo esc_attr($key); ?>" <?php if(get_option('anps_title_breadcrumbs', '1')==$key) {echo esc_attr('selected');}else {echo '';} ?>><?php echo esc_html($item); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Disable page title, breadcrumbs and background -->
            <div class="input onehalf">
                <label for="disable_heading"><?php esc_html_e('Disable page title, breadcrumbs and background', 'constructo'); ?></label>
                <input type='hidden' value='' name='anps_disable_heading'/>
                <input id="disable_heading" class="small_input" value="1" type="checkbox" name="anps_disable_heading" <?php if(anps_get_option($anps_options_data, 'disable_heading')=='1') {echo esc_attr('checked');} else {echo '';} ?> />
            </div>

            <!-- END Disable page title, breadcrumbs and background -->
            <!-- Breadcrumbs disable -->
            <div class="input onehalf">
                <label for="breadcrumbs"><?php esc_html_e('Disable breadcrumbs', 'constructo'); ?></label>
                <input type='hidden' value='' name='anps_breadcrumbs'/>
                <input id="breadcrumbs" class="small_input" value="1" type="checkbox" name="anps_breadcrumbs" <?php if(anps_get_option($anps_options_data, 'breadcrumbs')=="1") {echo esc_attr('checked');} else {echo '';} ?> />
            </div>
            <!-- END Breadcrumbs disable -->
            <div class="clear"></div>

    <h3><?php esc_html_e('Vertical menu', 'constructo'); ?></h3>
    <p><?php esc_html_e('This option overrides other menu options', 'constructo'); ?></p>
    <div class="clear"></div>

        <div class="input onehalf anps_upload">
        <?php
        $checked = '';
        if(get_option('anps_vertical_menu')=='1') {
            $checked = 'checked';
        }
        ?>
            <label for="vertical_menu"><?php esc_html_e('Enable Vertical menu', 'constructo'); ?></label>
            <input type='hidden' value='' name='anps_vertical_menu'/>
            <input id="vertical_menu" class="small_input" value="1" type="checkbox" name="anps_vertical_menu" <?php echo esc_attr($checked);?> />
        </div>

    <!-- Custom menu background -->
    <div class="input fullwidth" id="custom-header-bg-vertical-wrap">
        <label for="anps_custom-header-bg-vertical"><?php esc_html_e('Custom vertical menu background image', 'constructo'); ?></label>
        <input class="wninety" id="anps_custom-header-bg-vertical" type="text" size="36" name="anps_custom-header-bg-vertical" value="<?php echo get_option('anps_custom-header-bg-vertical'); ?>" />
        <input id="_btn" class="upload_image_button" type="button" value="Upload" />
    </div>
    <!-- END Vertical menu -->
    <div class="clear"></div>
    <!-- Page comments -->
    <h3><?php esc_html_e('Page comments', 'constructo'); ?></h3>
    <?php
    $checked = '';
    if(get_option('anps_page_comments')=='1') {
        $checked = 'checked';
    }
    ?>
    <div class="input onehalf anps_upload">
        <label for="anps_page_comments"><?php esc_html_e('Disable page comments', 'constructo'); ?></label>
        <input type='hidden' value='' name='anps_page_comments'/>
        <input id="anps_page_comments" class="small_input" value="1" style="margin-left: 25px" type="checkbox" name="anps_page_comments" <?php echo esc_attr($checked);?> />
    </div>
    <div class="clear"></div>
    <h3><?php esc_html_e('Mobile layout', 'constructo'); ?></h3>
    <select name="anps_footer_columns">
        <option value="0"><?php esc_html_e('*** Select ***', 'constructo'); ?></option>
        <?php
        $pages = array('1'=>esc_html__('1 column', 'constructo'), '2'=>esc_html__('2 columns', 'constructo'));
        foreach ($pages as $key=>$item) : ?>
            <option value="<?php echo esc_attr($key); ?>" <?php if(anps_get_option($anps_options_data, 'footer_columns')==$key) {echo esc_attr('selected');}else {echo '';} ?>><?php echo esc_html($item); ?></option>
        <?php endforeach; ?>
    </select>
    <div class="clear"></div>
</div>
<?php anps_admin_save_buttons(); ?>
</form>
