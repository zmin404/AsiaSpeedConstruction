<?php
include_once get_template_directory() . '/anps-framework/classes/Options.php';
if (isset($_GET['save_woocommerce'])) {
    $options->save_page_setup('woocommerce');
}
?>
<form action="themes.php?page=theme_options&sub_page=woocommerce&save_woocommerce" method="post">
    <div class="content-top">
        <input type="submit" value="<?php esc_html_e("Save all changes", 'constructo'); ?>" />
        <div class="clear"></div>
    </div>
    <div class="content-inner">
        <h3><?php esc_html_e("WooCommerce", 'constructo'); ?></h3>
        <div class="input onethird">
            <label for="anps_shopping_cart_header"><?php esc_html_e("Display shopping cart icon in header?", 'constructo'); ?></label>
            <select name="anps_shopping_cart_header" id="anps_shopping_cart_header">
                    <?php $pages = array("hide"=>esc_html__('Never display', 'constructo'), "shop_only"=>esc_html__('only on Woo pages', 'constructo'), "always"=>esc_html__('Display everywhere', 'constructo'));
                    foreach ($pages as $key => $item) :
                        $selected = '';
                        if (anps_get_option('', 'shop_only', 'shopping_cart_header') == $key) {
                            $selected = ' selected';
                        }
                        ?>
                        <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_attr($item); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <!-- WooCommerce columns -->
        <div class="input onethird">
            <label for="anps_products_columns"><?php esc_html_e('How many products in row?', 'constructo'); ?></label>
            <select name="anps_products_columns">
                    <?php $pages = array('4'=>esc_html__('4 products', 'constructo'), '3'=>esc_html__('3 products', 'constructo'));
                    foreach ($pages as $key => $item) :
                        $selected = '';
                        if (get_option('anps_products_columns', '4') == $key) {
                            $selected = ' selected';
                        }
                        ?>
                        <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_attr($item); ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <!-- WooCommerce products per page -->
        <div class='input onethird'>
            <label for='anps_products_per_page'><?php esc_html_e("Products per page", 'constructo'); ?></label>
            <input type='text' value='<?php echo get_option('anps_products_per_page', '12'); ?>' name='anps_products_per_page' id='anps_products_per_page' />
        </div>
        <div class="clear"></div>
        <!-- WooCommerce Product Zoom -->
        <div class="input onethird">
            <label for="anps_product_zoom"><?php esc_html_e('Product image zoom', 'constructo'); ?></label>
            <input type='hidden' value='' name='anps_product_zoom'/>
            <input id="anps_product_zoom" class="small_input" value="1" style="margin-left: 25px" type="checkbox" name="anps_product_zoom" <?php if(get_option('anps_product_zoom', '1')=="1") {echo esc_attr('checked');} else {echo '';} ?> />
        </div>
        <!-- WooCommerce Product image lightbox -->
        <div class="input onethird">
            <label for="anps_product_lightbox"><?php esc_html_e('Product image lightbox', 'constructo'); ?></label>
            <input type='hidden' value='' name='anps_product_lightbox'/>
            <input id="anps_product_lightbox" class="small_input" value="1" style="margin-left: 25px" type="checkbox" name="anps_product_lightbox" <?php if(get_option('anps_product_lightbox', '1')=="1") {echo esc_attr('checked');} else {echo '';} ?> />
        </div>
        <div class="clear"></div>
    </div>
    <?php anps_admin_save_buttons(); ?>
</form>
