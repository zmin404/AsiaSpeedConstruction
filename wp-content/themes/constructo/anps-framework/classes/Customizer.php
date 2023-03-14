<?php
class Anps_Customizer {
    public static function customizer_register($wp_customize) {
        /* Include custom controls */
        include_once 'customizer_controls/anps_divider_control.php';
        include_once 'customizer_controls/anps_desc_control.php';
        include_once 'customizer_controls/anps_sidebar_control.php';
        /* Add theme options panel */
        $wp_customize->add_panel('anps_customizer', array('title' =>esc_html__('Theme options', 'constructo'), 'description' => esc_html__('Theme options', 'constructo')));
        /* Theme options sections (categories) */
        $wp_customize->add_section('anps_colors', array('title' =>esc_html__('Main theme colors', 'constructo'), 'description' => esc_html__('Not satisfied with the premade color schemes? Here you can set your custom colors.', 'constructo'), 'panel'=>'anps_customizer'));
        $wp_customize->add_section('anps_button_colors', array('title' =>esc_html__('Button colors', 'constructo'), 'description' => esc_html__('Button colors', 'constructo'), 'panel'=>'anps_customizer'));
        $wp_customize->add_section('anps_typography', array('title' =>esc_html__('Typography', 'constructo'), 'description' => esc_html__('Typography', 'constructo'), 'panel'=>'anps_customizer'));
        $wp_customize->add_section('anps_page_layout', array('title' =>esc_html__('Page layout', 'constructo'), 'description' => esc_html__('Page layout', 'constructo'), 'panel'=>'anps_customizer'));
        $wp_customize->add_section('anps_page_setup', array('title' =>esc_html__('Page setup', 'constructo'), 'description' => esc_html__('Page setup', 'constructo'), 'panel'=>'anps_customizer'));
        $wp_customize->add_section('anps_header', array('title' =>esc_html__('Header options', 'constructo'), 'description' => esc_html__('Header options', 'constructo'), 'panel'=>'anps_customizer'));
        $wp_customize->add_section('anps_footer', array('title' =>esc_html__('Footer options', 'constructo'), 'description' => esc_html__('Footer options', 'constructo'), 'panel'=>'anps_customizer'));
        $wp_customize->add_section('anps_woocommerce', array('title' =>esc_html__('Woocommerce', 'constructo'), 'description' => esc_html__('Woocommerce', 'constructo'), 'panel'=>'anps_customizer'));
        $wp_customize->add_section('anps_logos', array('title' =>esc_html__('Logos', 'constructo'), 'description' => esc_html__('If you would like to use your logo and favicon, upload them to your theme here', 'constructo'), 'panel'=>'anps_customizer'));
        /* END Theme options sections (categories) */
        //Color management (main theme and buttons) settings
        Anps_Customizer::color_management($wp_customize);
        //Typography settings
        Anps_Customizer::typography($wp_customize);
        //Page layout settings
        Anps_Customizer::page_layout($wp_customize);
        //Page layout settings
        Anps_Customizer::page_setup($wp_customize);
        //Header options
        Anps_Customizer::header_options($wp_customize);
        //Footer options
        Anps_Customizer::footer_options($wp_customize);
        //Woocommerce
        Anps_Customizer::woocommerce($wp_customize);
        //Logos
        Anps_Customizer::logos($wp_customize);
    }
    /* Color management settings */
    private static function color_management($wp_customize) {
        /* Main theme colors */
        //text color
        $wp_customize->add_setting('anps_text_color', array('default'=>anps_get_option('', '#727272', 'text_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_text_color', array('label' => esc_html__('Text color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_text_color')));
        //primary color
        $wp_customize->add_setting('anps_primary_color', array('default'=>anps_get_option('', '#292929', 'primary_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_primary_color', array('label' => esc_html__('Primary color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_primary_color')));
        //hovers color
        $wp_customize->add_setting('anps_hovers_color', array('default'=>anps_get_option('', '#1874c1', 'hovers_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_hovers_color', array('label' => esc_html__('Hovers color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_hovers_color')));
        //menu text color
        $wp_customize->add_setting('anps_menu_text_color', array('default'=>anps_get_option('', '#000', 'menu_text_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_menu_text_color', array('label' => esc_html__('Menu text color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_menu_text_color')));
        //headings color
        $wp_customize->add_setting('anps_headings_color', array('default'=>anps_get_option('', '#000', 'headings_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_headings_color', array('label' => esc_html__('Headings color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_headings_color')));
        //Top bar text color
        $wp_customize->add_setting('anps_top_bar_color', array('default'=>anps_get_option('', '#c1c1c1', 'top_bar_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_top_bar_color', array('label' => esc_html__('Top bar color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_top_bar_color')));
        //Top bar background color
        $wp_customize->add_setting('anps_top_bar_bg_color', array('default'=>anps_get_option('', '#f9f9f9', 'top_bar_bg_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_top_bar_bg_color', array('label' => esc_html__('Top bar background color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_top_bar_bg_color')));
        //Footer background color
        $wp_customize->add_setting('anps_footer_bg_color', array('default'=>anps_get_option('', '#0f0f0f', 'footer_bg_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_footer_bg_color', array('label' => esc_html__('Footer background color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_footer_bg_color')));
        //Copyright footer text color
        $wp_customize->add_setting('anps_copyright_footer_text_color', array('default'=>get_option('anps_copyright_footer_text_color', '#c4c4c4'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_copyright_footer_text_color', array('label' => esc_html__('Copyright footer text color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_copyright_footer_text_color')));
        //Copyright footer background color
        $wp_customize->add_setting('anps_copyright_footer_bg_color', array('default'=>anps_get_option('', '#242424', 'copyright_footer_bg_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_copyright_footer_bg_color', array('label' => esc_html__('Copyright footer background color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_copyright_footer_bg_color')));
        //Footer text color
        $wp_customize->add_setting('anps_footer_text_color', array('default'=>anps_get_option('', '#c4c4c4', 'footer_text_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_footer_text_color', array('label' => esc_html__('Footer text color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_footer_text_color')));
        //Footer heading text color
        $wp_customize->add_setting('anps_heading_text_color', array('default'=>get_option('anps_heading_text_color', '#fff'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_heading_text_color', array('label' => esc_html__('Footer heading text color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_heading_text_color')));
        //Footer selected color
        $wp_customize->add_setting('anps_footer_selected_color', array('default'=>get_option('anps_footer_selected_color', ''), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_footer_selected_color', array('label' => esc_html__('Footer selected color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_footer_selected_color')));
        //Footer hover color
        $wp_customize->add_setting('anps_footer_hover_color', array('default'=>get_option('anps_footer_hover_color', ''), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_footer_hover_color', array('label' => esc_html__('Footer hover color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_footer_hover_color')));
        //Footer divider color
        $wp_customize->add_setting('anps_footer_divider_color', array('default'=>get_option('anps_footer_divider_color', '#fff'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_footer_divider_color', array('label' => esc_html__('Footer divider color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_footer_divider_color')));
        //Page header background color
        $wp_customize->add_setting('anps_nav_background_color', array('default'=>anps_get_option('', '#fff', 'nav_background_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_nav_background_color', array('label' => esc_html__('Page header background color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_nav_background_color')));
        //Submenu background color
        $wp_customize->add_setting('anps_submenu_background_color', array('default'=>anps_get_option('', '#fff', 'submenu_background_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_submenu_background_color', array('label' => esc_html__('Submenu background color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_submenu_background_color')));
        //Selected main menu color
        $wp_customize->add_setting('anps_curent_menu_color', array('default'=>get_option('anps_curent_menu_color', '#153d5c'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_curent_menu_color', array('label' => esc_html__('Selected main menu color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_curent_menu_color')));
        //Submenu text color
        $wp_customize->add_setting('anps_submenu_text_color', array('default'=>anps_get_option('', '#000', 'submenu_text_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_submenu_text_color', array('label' => esc_html__('Submenu text color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_submenu_text_color')));
        //Side submenu background color
        $wp_customize->add_setting('anps_side_submenu_background_color', array('default'=>anps_get_option('', '', 'side_submenu_background_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_side_submenu_background_color', array('label' => esc_html__('Side submenu background color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_side_submenu_background_color')));
        //Side submenu text color
        $wp_customize->add_setting('anps_side_submenu_text_color', array('default'=>anps_get_option('', '', 'side_submenu_text_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_side_submenu_text_color', array('label' => esc_html__('Side submenu text color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_side_submenu_text_color')));
        //Side submenu text hover color
        $wp_customize->add_setting('anps_side_submenu_text_hover_color', array('default'=>anps_get_option('', '', 'side_submenu_text_hover_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_side_submenu_text_hover_color', array('label' => esc_html__('Side submenu text hover color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_side_submenu_text_hover_color')));
        //Logo bg color
        $wp_customize->add_setting('anps_logo_bg_color', array('default'=>get_option('anps_logo_bg_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_logo_bg_color', array('label' => esc_html__('Logo background color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_logo_bg_color')));
        //Above menu background color
        $wp_customize->add_setting('anps_above_menu_bg_color', array('default'=>get_option('anps_above_menu_bg_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_above_menu_bg_color', array('label' => esc_html__('Above menu background color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_above_menu_bg_color')));
        //Shopping cart item number background color
        $wp_customize->add_setting('anps_woo_cart_items_number_bg_color', array('default'=>get_option('anps_woo_cart_items_number_bg_color', '#26507a'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_woo_cart_items_number_bg_color', array('label' => esc_html__('Shopping cart item number background color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_woo_cart_items_number_bg_color')));
        //Shoping cart item number text color
        $wp_customize->add_setting('anps_woo_cart_items_number_color', array('default'=>get_option('anps_woo_cart_items_number_color', ''), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_woo_cart_items_number_color', array('label' => esc_html__('Shoping cart item number text color', 'constructo'), 'section' => 'anps_colors', 'settings'=>'anps_woo_cart_items_number_color')));

        /* END Main theme colors */
        /* Button colors */
        /* Default button description */
        $wp_customize->add_setting('anps_normal_button_desc', array('type'=>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control(new Anps_Desc_Control($wp_customize, 'anps_normal_button_desc', array('section' => 'anps_button_colors', 'settings'=>'anps_normal_button_desc', 'label'=>esc_html__('Normal button', 'constructo'), 'description'=>esc_html__('Next 4 colors define normal button.', 'constructo'))));
        //Default button background
        $wp_customize->add_setting('anps_default_button_bg', array('default'=>anps_get_option('', '#1874c1', 'default_button_bg'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_default_button_bg', array('label' => esc_html__('Normal button background', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_default_button_bg')));
        //Default button color
        $wp_customize->add_setting('anps_default_button_color', array('default'=>anps_get_option('', '#fff', 'default_button_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_default_button_color', array('label' => esc_html__('Normal button color', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_default_button_color')));
        //Default button hover background
        $wp_customize->add_setting('anps_default_button_hover_bg', array('default'=>anps_get_option('', '#292929', 'default_button_hover_bg'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_default_button_hover_bg', array('label' => esc_html__('Normal button hover background', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_default_button_hover_bg')));
        //Default button hover color
        $wp_customize->add_setting('anps_default_button_hover_color', array('default'=>anps_get_option('', '#fff', 'default_button_hover_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_default_button_hover_color', array('label' => esc_html__('Normal button hover color', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_default_button_hover_color')));
        /* END Default button */

        /* Button style-1 */
        $wp_customize->add_setting('anps_button_style_1_desc', array('type'=>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control(new Anps_Desc_Control($wp_customize, 'anps_button_style_1_desc', array('section' => 'anps_button_colors', 'settings'=>'anps_button_style_1_desc', 'label'=>esc_html__('Button style 1', 'constructo'), 'description'=>esc_html__('Next 4 colors define button style 1.', 'constructo'))));
        //Button style 1 background
        $wp_customize->add_setting('anps_style_1_button_bg', array('default'=>anps_get_option('', '#1874c1', 'style_1_button_bg'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_1_button_bg', array('label' => esc_html__('Button style 1 background', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_1_button_bg')));
        //Button style 1 color
        $wp_customize->add_setting('anps_style_1_button_color', array('default'=>anps_get_option('', '#fff', 'style_1_button_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_1_button_color', array('label' => esc_html__('Button style 1 color', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_1_button_color')));
        //Button style 1 hover background
        $wp_customize->add_setting('anps_style_1_button_hover_bg', array('default'=>anps_get_option('', '#000', 'style_1_button_hover_bg'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_1_button_hover_bg', array('label' => esc_html__('Button style 1 hover background', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_1_button_hover_bg')));
        //Button style 1 hover color
        $wp_customize->add_setting('anps_style_1_button_hover_color', array('default'=>anps_get_option('', '#fff', 'style_1_button_hover_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_1_button_hover_color', array('label' => esc_html__('Button style 1 hover color', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_1_button_hover_color')));
        /* END Button style-1 */

        /* Button style-2 */
        $wp_customize->add_setting('anps_button_style_2_desc', array('type'=>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control(new Anps_Desc_Control($wp_customize, 'anps_button_style_2_desc', array('section' => 'anps_button_colors', 'settings'=>'anps_button_style_2_desc', 'label'=>esc_html__('Button style 2', 'constructo'), 'description'=>esc_html__('Next 4 colors define button style 2.', 'constructo'))));
        //Button style 2 background
        $wp_customize->add_setting('anps_style_2_button_bg', array('default'=>anps_get_option('', '#000', 'style_2_button_bg'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_2_button_bg', array('label' => esc_html__('Button style 2 background', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_2_button_bg')));
        //Button style 2 color
        $wp_customize->add_setting('anps_style_2_button_color', array('default'=>anps_get_option('', '#fff', 'style_2_button_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_2_button_color', array('label' => esc_html__('Button style 2 color', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_2_button_color')));
        //Button style 2 hover background
        $wp_customize->add_setting('anps_style_2_button_hover_bg', array('default'=>anps_get_option('', '#fff', 'style_2_button_hover_bg'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_2_button_hover_bg', array('label' => esc_html__('Button style 2 hover background', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_2_button_hover_bg')));
        //Button style 2 hover color
        $wp_customize->add_setting('anps_style_2_button_hover_color', array('default'=>anps_get_option('', '#000', 'style_2_button_hover_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_2_button_hover_color', array('label' => esc_html__('Button style 2 hover color', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_2_button_hover_color')));
        /* END Button style-2 */

        /* Button style-3 */
        $wp_customize->add_setting('anps_button_style_3_desc', array('type'=>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control(new Anps_Desc_Control($wp_customize, 'anps_button_style_3_desc', array('section' => 'anps_button_colors', 'settings'=>'anps_button_style_3_desc', 'label'=>esc_html__('Button style 3', 'constructo'), 'description'=>esc_html__('Next 4 colors define button style 3.', 'constructo'))));
        //Button style 3 background
        $wp_customize->add_setting('anps_style_3_button_color', array('default'=>anps_get_option('', '#fff', 'style_3_button_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_3_button_color', array('label' => esc_html__('Button style 3 color', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_3_button_color')));
        //Button style 3 color
        $wp_customize->add_setting('anps_style_3_button_hover_bg', array('default'=>anps_get_option('', '#fff', 'style_3_button_hover_bg'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_3_button_hover_bg', array('label' => esc_html__('Button style 3 hover background', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_3_button_hover_bg')));
        //Button style 3 hover background
        $wp_customize->add_setting('anps_style_3_button_hover_color', array('default'=>anps_get_option('', '#1874c1', 'style_3_button_hover_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_3_button_hover_color', array('label' => esc_html__('Button style 3 hover color', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_3_button_hover_color')));
        //Button style 3 hover color
        $wp_customize->add_setting('anps_style_3_button_border_color', array('default'=>anps_get_option('', '#fff', 'style_3_button_border_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_3_button_border_color', array('label' => esc_html__('Button style 3 border color', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_3_button_border_color')));
        /* END Button style-3 */

        /* Button style-4 */
        $wp_customize->add_setting('anps_button_style_4_desc', array('type'=>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control(new Anps_Desc_Control($wp_customize, 'anps_button_style_4_desc', array('section' => 'anps_button_colors', 'settings'=>'anps_button_style_4_desc', 'label'=>esc_html__('Button style 4', 'constructo'), 'description'=>esc_html__('Next 2 colors define button style 4.', 'constructo'))));
        //Button style 4 color
        $wp_customize->add_setting('anps_style_4_button_color', array('default'=>anps_get_option('', '#1874c1', 'style_4_button_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_4_button_color', array('label' => esc_html__('Button style 4 color', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_4_button_color')));
        //Button style 4 hover color
        $wp_customize->add_setting('anps_style_4_button_hover_color', array('default'=>anps_get_option('', '#94cfff', 'style_4_button_hover_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_4_button_hover_color', array('label' => esc_html__('Button style 4 hover color', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_4_button_hover_color')));
        /* END Button style-4 */

        /* Button slider */
        $wp_customize->add_setting('anps_button_slider_desc', array('type'=>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control(new Anps_Desc_Control($wp_customize, 'anps_button_slider_desc', array('section' => 'anps_button_colors', 'settings'=>'anps_button_slider_desc', 'label'=>esc_html__('Button slider', 'constructo'), 'description'=>esc_html__('Next 4 colors define button slider.', 'constructo'))));
        //Button slider background
        $wp_customize->add_setting('anps_style_slider_button_bg', array('default'=>anps_get_option('', '#1874c1', 'style_slider_button_bg'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_slider_button_bg', array('label' => esc_html__('Button slider background', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_slider_button_bg')));
        //Button slider color
        $wp_customize->add_setting('anps_style_slider_button_color', array('default'=>anps_get_option('', '#fff', 'style_slider_button_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_slider_button_color', array('label' => esc_html__('Button slider color', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_slider_button_color')));
        //Button slider hover background
        $wp_customize->add_setting('anps_style_slider_button_hover_bg', array('default'=>anps_get_option('', '#000', 'style_slider_button_hover_bg'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_slider_button_hover_bg', array('label' => esc_html__('Button slider hover background', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_slider_button_hover_bg')));
        //Button slider hover color
        $wp_customize->add_setting('anps_style_slider_button_hover_color', array('default'=>anps_get_option('', '#fff', 'style_slider_button_hover_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_slider_button_hover_color', array('label' => esc_html__('Button slider hover color', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_slider_button_hover_color')));
        /* END Button slider */

        /* Button style-5 */
        $wp_customize->add_setting('anps_button_style_5_desc', array('type'=>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control(new Anps_Desc_Control($wp_customize, 'anps_button_style_5_desc', array('section' => 'anps_button_colors', 'settings'=>'anps_button_style_5_desc', 'label'=>esc_html__('Button style 5', 'constructo'), 'description'=>esc_html__('Next 4 colors define button style 5.', 'constructo'))));
        //Button style 5 background
        $wp_customize->add_setting('anps_style_style_5_button_bg', array('default'=>anps_get_option('', '#c3c3c3', 'style_style_5_button_bg'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_style_5_button_bg', array('label' => esc_html__('Button style 5 background', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_style_5_button_bg')));
        //Button style 5 color
        $wp_customize->add_setting('anps_style_style_5_button_color', array('default'=>anps_get_option('', '#fff', 'style_style_5_button_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_style_5_button_color', array('label' => esc_html__('Button style 5 color', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_style_5_button_color')));
        //Button style 5 hover background
        $wp_customize->add_setting('anps_style_style_5_button_hover_bg', array('default'=>anps_get_option('', '#737373', 'style_style_5_button_hover_bg'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_style_5_button_hover_bg', array('label' => esc_html__('Button style 5 hover background', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_style_5_button_hover_bg')));
        //Button style 5 hover color
        $wp_customize->add_setting('anps_style_style_5_button_hover_color', array('default'=>anps_get_option('', '#fff', 'style_style_5_button_hover_color'), 'type'=>'option', 'sanitize_callback'=>'sanitize_hex_color', 'sanitize_js_callback'=>'maybe_hash_hex_color', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'anps_style_style_5_button_hover_color', array('label' => esc_html__('Button style 5 hover color', 'constructo'), 'section' => 'anps_button_colors', 'settings'=>'anps_style_style_5_button_hover_color')));
        /* END Button style-5 */
        /* END Button colors */
    }
    /* Typography settings */
    private static function typography($wp_customize) {
        /* še manjka za izbiranje fontov */
        //Body font size
        $wp_customize->add_setting('anps_body_font_size', array('default'=>anps_get_option('', '14', 'body_font_size'), 'type' =>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control('anps_body_font_size', array('label'=>esc_html__('Body font size', 'constructo'), 'settings' => 'anps_body_font_size', 'section' => 'anps_typography'));
        //Menu font size
        $wp_customize->add_setting('anps_menu_font_size', array('default'=>anps_get_option('', '14', 'menu_font_size'), 'type' =>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control('anps_menu_font_size', array('label'=>esc_html__('Menu font size', 'constructo'), 'settings' => 'anps_menu_font_size', 'section' => 'anps_typography'));
        //Content heading 1 font size
        $wp_customize->add_setting('anps_h1_font_size', array('default'=>anps_get_option('', '31', 'h1_font_size'), 'type' =>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control('anps_h1_font_size', array('label'=>esc_html__('Content heading 1 font size', 'constructo'), 'settings' => 'anps_h1_font_size', 'section' => 'anps_typography'));
        //Content heading 2 font size
        $wp_customize->add_setting('anps_h2_font_size', array('default'=>anps_get_option('', '24', 'h2_font_size'), 'type' =>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control('anps_h2_font_size', array('label'=>esc_html__('Content heading 2 font size', 'constructo'), 'settings' => 'anps_h2_font_size', 'section' => 'anps_typography'));
        //Content heading 3 font size
        $wp_customize->add_setting('anps_h3_font_size', array('default'=>anps_get_option('', '21', 'h3_font_size'), 'type' =>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control('anps_h3_font_size', array('label'=>esc_html__('Content heading 3 font size', 'constructo'), 'settings' => 'anps_h3_font_size', 'section' => 'anps_typography'));
        //Content heading 4 font size
        $wp_customize->add_setting('anps_h4_font_size', array('default'=>anps_get_option('', '18', 'h4_font_size'), 'type' =>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control('anps_h4_font_size', array('label'=>esc_html__('Content heading 4 font size', 'constructo'), 'settings' => 'anps_h4_font_size', 'section' => 'anps_typography'));
        //Content heading 5 font size
        $wp_customize->add_setting('anps_h5_font_size', array('default'=>anps_get_option('', '16', 'h5_font_size'), 'type' =>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control('anps_h5_font_size', array('label'=>esc_html__('Content heading 5 font size', 'constructo'), 'settings' => 'anps_h5_font_size', 'section' => 'anps_typography'));
        //Page heading 1 font size
        $wp_customize->add_setting('anps_page_heading_h1_font_size', array('default'=>anps_get_option('', '48', 'page_heading_h1_font_size'), 'type' =>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control('anps_page_heading_h1_font_size', array('label'=>esc_html__('Page heading 1 font size', 'constructo'), 'settings' => 'anps_page_heading_h1_font_size', 'section' => 'anps_typography'));
        //Single blog page heading 1 font size
        $wp_customize->add_setting('anps_blog_heading_h1_font_size', array('default'=>anps_get_option('', '28', 'blog_heading_h1_font_size'), 'type' =>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control('anps_blog_heading_h1_font_size', array('label'=>esc_html__('Single blog page heading 1 font size', 'constructo'), 'settings' => 'anps_blog_heading_h1_font_size', 'section' => 'anps_typography'));
        //Top bar font size font size
        $wp_customize->add_setting('anps_top_bar_font_size', array('default'=>get_option('anps_top_bar_font_size', '28'), 'type' =>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control('anps_top_bar_font_size', array('label'=>esc_html__('Top bar font size font size', 'constructo'), 'settings' => 'anps_top_bar_font_size', 'section' => 'anps_typography'));      
    }
    /* Page layout settings */
    private static function page_layout($wp_customize) {
        $anps_data = get_option('anps_acc_info');
        //Page sidebar description
        $wp_customize->add_setting('anps_page_sidebar_desc', array('type'=>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control(new Anps_Desc_Control($wp_customize, 'anps_page_sidebar_desc', array('section' => 'anps_page_layout', 'settings'=>'anps_page_sidebar_desc', 'label'=>esc_html__('Page Sidebars', 'constructo'), 'description'=>esc_html__('This will change the default sidebar value on all pages. It can be changed on each page individually.', 'constructo'))));
        //Page left sidebar
        $wp_customize->add_setting('anps_page_sidebar_left', array('type'=>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control(new Anps_Sidebar_Control($wp_customize, 'anps_page_sidebar_left', array('section' => 'anps_page_layout', 'settings'=>'anps_page_sidebar_left', 'label'=>esc_html__('Page sidebar left', 'constructo'))));
        //Page right sidebar
        $wp_customize->add_setting('anps_page_sidebar_right', array('type'=>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control(new Anps_Sidebar_Control($wp_customize, 'anps_page_sidebar_right', array('section' => 'anps_page_layout', 'settings'=>'anps_page_sidebar_right', 'label'=>esc_html__('Page sidebar right', 'constructo'))));
        //Post sidebar description
        $wp_customize->add_setting('anps_post_sidebar_desc', array('type'=>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control(new Anps_Desc_Control($wp_customize, 'anps_post_sidebar_desc', array('section' => 'anps_page_layout', 'settings'=>'anps_post_sidebar_desc', 'label'=>esc_html__('Post Sidebars', 'constructo'), 'description'=>esc_html__('This will change the default sidebar value on all posts. It can be changed on each post individually.', 'constructo'))));
        //Post left sidebar
        $wp_customize->add_setting('anps_post_sidebar_left', array('type'=>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control(new Anps_Sidebar_Control($wp_customize, 'anps_post_sidebar_left', array('section' => 'anps_page_layout', 'settings'=>'anps_post_sidebar_left', 'label'=>esc_html__('Post sidebar left', 'constructo'))));
        //Post right sidebar
        $wp_customize->add_setting('anps_post_sidebar_right', array('type'=>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control(new Anps_Sidebar_Control($wp_customize, 'anps_post_sidebar_right', array('section' => 'anps_page_layout', 'settings'=>'anps_post_sidebar_right', 'label'=>esc_html__('Post sidebar right', 'constructo'))));
        //Disable page title, breadcrumbs and background
        $wp_customize->add_setting('anps_disable_heading', array('default'=>anps_get_option($anps_data, 'disable_heading'), 'type' =>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control('anps_disable_heading', array('section'=>'anps_page_layout', 'type'=>'checkbox', 'label'=>esc_html__('Disable page title, breadcrumbs and background', 'constructo'), 'settings'=>'anps_disable_heading'));
        //divider heading
        $wp_customize->add_setting('anps_heading_divider', array('type'=>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control(new Anps_Divider_Control($wp_customize, 'anps_heading_divider', array('section' => 'anps_page_layout', 'settings'=>'anps_heading_divider')));
        //Breadcrumbs
        $wp_customize->add_setting('anps_breadcrumbs', array('default'=>anps_get_option($anps_data, 'breadcrumbs'), 'type' =>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control('anps_breadcrumbs', array('section'=>'anps_page_layout', 'type'=>'checkbox', 'label'=>esc_html__('Enable Bredcrumbs', 'constructo'), 'settings'=>'anps_breadcrumbs'));
    }
    /* Page setup */
    private static function page_setup($wp_customize) {
        //Excerpt length
        $wp_customize->add_setting('anps_coming_soon', array('default'=>get_option('anps_coming_soon'), 'type' =>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control('anps_coming_soon', array('label'=>esc_html__('Coming soon page', 'constructo'), 'type'=>'dropdown-pages', 'settings' => 'anps_coming_soon', 'section' => 'anps_page_setup'));
        //404 error page
        $wp_customize->add_setting('anps_error_page', array('default'=>get_option('anps_error_page'), 'type' =>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control('anps_error_page', array('label'=>esc_html__('404 error page', 'constructo'), 'type'=>'dropdown-pages', 'settings' => 'anps_error_page', 'section' => 'anps_page_setup'));

        /* Portfolio */
        $wp_customize->add_setting('anps_portfolio_desc', array('type'=>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control(new Anps_Desc_Control($wp_customize, 'anps_portfolio_desc', array('section' => 'anps_page_setup', 'settings'=>'anps_portfolio_desc', 'label'=>esc_html__('Portfolio settings', 'constructo'), 'description'=>esc_html__('Here you can select single portfolio style.', 'constructo'))));
        //Portfolio single style
        $wp_customize->add_setting('anps_portfolio_single', array('default'=>anps_get_option('', '', 'portfolio_single'), 'type' =>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control('anps_portfolio_single', array(
            'label'=>esc_html__('Portfolio single style', 'constructo'),
            'type'=>'select',
            'settings' =>'anps_portfolio_single',
            'section' =>'anps_page_setup',
            'choices' =>array(
                'style-1'=>esc_html__('Style 1', 'constructo'),
                'style-2'=>esc_html__('Style 2', 'constructo')
            )
        ));
        /* END Portfolio*/

        //Post meta title and description
        $wp_customize->add_setting('anps_post_meta_desc', array('type'=>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control(new Anps_Desc_Control($wp_customize, 'anps_post_meta_desc', array('section' => 'anps_page_setup', 'settings'=>'anps_post_meta_desc', 'label'=>esc_html__('Disable Post meta elements', 'constructo'), 'description'=>esc_html__('This allows you to disable post meta on all blog elements and pages. By default no field is checked, so that all meta elements are displayed.', 'constructo'))));
        //comments checkbox
        $wp_customize->add_setting('anps_post_meta_comments', array('default'=>get_option('anps_post_meta_comments', '1'), 'type' =>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control('anps_post_meta_comments', array('section'=>'anps_page_setup', 'type'=>'checkbox', 'label'=>esc_html__('Comments', 'constructo'), 'settings'=>'anps_post_meta_comments'));
        //categories checkbox
        $wp_customize->add_setting('anps_post_meta_categories', array('default'=>get_option('anps_post_meta_categories', '1'), 'type' =>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control('anps_post_meta_categories', array('section'=>'anps_page_setup', 'type'=>'checkbox', 'label'=>esc_html__('Categories', 'constructo'), 'settings'=>'anps_post_meta_categories'));
        //author checkbox
        $wp_customize->add_setting('anps_post_meta_author', array('default'=>get_option('anps_post_meta_author', '1'), 'type' =>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control('anps_post_meta_author', array('section'=>'anps_page_setup', 'type'=>'checkbox', 'label'=>esc_html__('Author', 'constructo'), 'settings'=>'anps_post_meta_author'));
        //date checkbox
        $wp_customize->add_setting('anps_post_meta_date', array('default'=>get_option('anps_post_meta_date', '1'), 'type' =>'option', 'sanitize_callback' => 'esc_html', 'transport'=>'refresh'));
        $wp_customize->add_control('anps_post_meta_date', array('section'=>'anps_page_setup', 'type'=>'checkbox', 'label'=>esc_html__('Date', 'constructo'), 'settings'=>'anps_post_meta_date'));
    }
    /* Header options */
    private static function header_options($wp_customize) {
        /* General top menu settings */
        $wp_customize->add_setting('anps_general_top_menu_settings', array('type'=>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control(new Anps_Desc_Control($wp_customize, 'anps_general_top_menu_settings', array('section' => 'anps_header', 'settings'=>'anps_general_top_menu_settings', 'label'=>esc_html__('General Top Menu Settings', 'constructo'), 'description'=>esc_html__('Here you can set top bar, above menu bar, sticky menu and other settings.', 'constructo'))));
        //Display top bar?
        $wp_customize->add_setting('anps_topmenu_style', array('default'=>anps_get_option('', '', 'topmenu_style'),'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_topmenu_style', array(
            'label' => esc_html__('Display top bar?', 'constructo'),
            'section' => 'anps_header',
            'type' => 'select',
            'choices' => array(
                '1' => esc_html__('Yes', 'constructo'),
                '2' => esc_html__('Only on tablet/mobile', 'constructo'),
                '4' => esc_html__('Only on desktop', 'constructo'),
                '3' => esc_html__('No', 'constructo')
            )
        ));
        //Top bar height in pixels
        $wp_customize->add_setting('anps_top_bar_height', array('default'=>get_option('anps_top_bar_height', '60'), 'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_top_bar_height', array('label'=>esc_html__('Top bar height in pixels', 'constructo'), 'settings' => 'anps_top_bar_height', 'section' => 'anps_header'));
        //Above nav bar
        $wp_customize->add_setting('anps_above_nav_bar', array('default'=>get_option('anps_above_nav_bar'),'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_above_nav_bar', array(
            'label' => esc_html__('Display above menu bar?', 'constructo'),
            'section' => 'anps_header',
            'type' => 'select',
            'choices' => array(
                '1' => esc_html__('Yes', 'constructo'),
                '0' => esc_html__('No', 'constructo')
            )
        ));
        //Menu
        $wp_customize->add_setting('anps_menu_style', array('default'=>anps_get_option('', '', 'menu_style'),'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_menu_style', array(
            'label' => esc_html__('Menu', 'constructo'),
            'section' => 'anps_header',
            'type' => 'select',
            'choices' => array(
                '1' => esc_html__('Normal', 'constructo'),
                '2' => esc_html__('Description', 'constructo')
            )
        ));
        //Menu center
        $wp_customize->add_setting('anps_menu_center', array('default'=>get_option('anps_menu_center', 0), 'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_menu_center', array(
            'label' => 'Menu position',
            'section' => 'anps_header',
            'type' => 'select',
            'choices' => array(
                2 => esc_html__('Left', 'constructo'),
                1 => esc_html__('Center', 'constructo'),
                3 => esc_html__('Right', 'constructo'),
            )
        ));
        //Sticky menu
        $wp_customize->add_setting('anps_sticky_menu', array('default'=>anps_get_option('', '', 'sticky_menu'), 'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_sticky_menu', array('section'=>'anps_header', 'type'=>'checkbox', 'label'=>esc_html__('Sticky menu', 'constructo'), 'settings'=>'anps_sticky_menu'));
        //Display search icon in menu (desktop)?
        $wp_customize->add_setting('anps_search_icon', array('default'=>anps_get_option('', '1', 'search_icon'), 'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_search_icon', array('section'=>'anps_header', 'type'=>'checkbox', 'label'=>esc_html__('Display search icon in menu (desktop)?', 'constructo'), 'settings'=>'anps_search_icon'));
        //Display search on mobile and tablets?
        $wp_customize->add_setting('anps_search_icon_mobile', array('default'=>anps_get_option('', '1', 'search_icon_mobile'), 'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_search_icon_mobile', array('section'=>'anps_header', 'type'=>'checkbox', 'label'=>esc_html__('Display search on mobile and tablets?', 'constructo'), 'settings'=>'anps_search_icon_mobile'));
        //Enable menu walker (mega menu)
        $wp_customize->add_setting('anps_global_menu_walker', array('default'=>get_option('anps_global_menu_walker', '1'), 'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_global_menu_walker', array('section'=>'anps_header', 'type'=>'checkbox', 'label'=>esc_html__('Enable menu walker (mega menu)', 'constructo'), 'settings'=>'anps_global_menu_walker'));
        //Display background color behind logo
        $wp_customize->add_setting('anps_logo_background', array('default'=>get_option('anps_logo_background', '1'), 'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_logo_background', array('section'=>'anps_header', 'type'=>'checkbox', 'label'=>esc_html__('Display background color behind logo', 'constructo'), 'settings'=>'anps_logo_background'));
        /* Main menu settings */
        //Main menu height in pixels
        $wp_customize->add_setting('anps_main_menu_height', array('default'=>get_option('anps_main_menu_height'), 'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_main_menu_height', array('label'=>esc_html__('Main menu height in pixels', 'constructo'), 'settings' => 'anps_main_menu_height', 'section' => 'anps_header'));
        //Dropdown selection states
        $wp_customize->add_setting('anps_main_menu_selection', array('default'=>get_option('anps_main_menu_selection', '0'),'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_main_menu_selection', array(
            'label' => esc_html__('Dropdown selection states', 'constructo'),
            'section' => 'anps_header',
            'type' => 'select',
            'choices' => array(
                '0' => esc_html__('Hover color & bottom border', 'constructo'),
                '1' => esc_html__('Hover color', 'constructo')
            )
        ));
        /* END Main menu settings */
        /* END General top menu settings */
    }
    /* Footer options */
    private static function footer_options($wp_customize) {
        /* Prefooter description */
        $wp_customize->add_setting('anps_prefooter_desc', array('type'=>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control(new Anps_Desc_Control($wp_customize, 'anps_prefooter_desc', array('section' => 'anps_footer', 'settings'=>'anps_prefooter_desc', 'label'=>esc_html__('Prefooter options', 'constructo'), 'description'=>'')));
        //enable prefooter
        $wp_customize->add_setting('anps_prefooter', array('default'=>anps_get_option('', '', 'prefooter'), 'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_prefooter', array('section'=>'anps_footer', 'type'=>'checkbox', 'label'=>esc_html__('Enable prefooter', 'constructo'), 'settings'=>'anps_prefooter'));
        //PreFooter columns
        $wp_customize->add_setting('anps_prefooter_style', array('default'=>anps_get_option('', '', 'prefooter_style'),'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_prefooter_style', array(
            'label' => esc_html__('PreFooter columns', 'constructo'),
            'section' => 'anps_footer',
            'type' => 'select',
            'choices' => array(
                '0' => esc_html__('*** Select ***', 'constructo'),
                '5' => esc_html__('2/3 + 1/3', 'constructo'),
                '6' => esc_html__('1/3 + 2/3', 'constructo'),
                '2' => esc_html__('2 columns', 'constructo'),
                '3' => esc_html__('3 columns', 'constructo'),
                '4' => esc_html__('4 columns', 'constructo')
            )
        ));
        /* END Prefooter description */

        /* Footer description */
        $wp_customize->add_setting('anps_footer_desc', array('type'=>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control(new Anps_Desc_Control($wp_customize, 'anps_footer_desc', array('section' => 'anps_footer', 'settings'=>'anps_footer_desc', 'label'=>esc_html__('Footer options', 'constructo'), 'description'=>'')));
        //disable footer
        $wp_customize->add_setting('anps_footer_disable', array('default'=>anps_get_option('', '', 'footer_disable'), 'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_footer_disable', array('section'=>'anps_footer', 'type'=>'checkbox', 'label'=>esc_html__('Disable footer', 'constructo'), 'settings'=>'anps_footer_disable'));
        //Footer columns
        $wp_customize->add_setting('anps_footer_style', array('default'=>anps_get_option('', '4', 'footer_style'),'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_footer_style', array(
            'label' => esc_html__('Footer columns', 'constructo'),
            'section' => 'anps_footer',
            'type' => 'select',
            'choices' => array(
                '1' => esc_html__('1 column', 'constructo'),
                '2' => esc_html__('2 columns', 'constructo'),
                '3' => esc_html__('3 columns', 'constructo'),
                '4' => esc_html__('4 columns', 'constructo')
            )
        ));
        //Footer style
        $wp_customize->add_setting('anps_footer_widget_style', array('default'=>get_option('anps_footer_widget_style'),'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_footer_widget_style', array(
            'label' => esc_html__('Footer style', 'constructo'),
            'section' => 'anps_footer',
            'type' => 'select',
            'choices' => array(
                '1' => esc_html__('style 1', 'constructo'),
                '2' => esc_html__('style 2', 'constructo'),
                '3' => esc_html__('style 3', 'constructo')
            )
        ));
        //Copyright footer
        $wp_customize->add_setting('anps_copyright_footer', array('default'=>anps_get_option('', '', 'copyright_footer'),'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_copyright_footer', array(
            'label' => esc_html__('Copyright footer', 'constructo'),
            'section' => 'anps_footer',
            'type' => 'select',
            'choices' => array(
                '0' => esc_html__('*** Select ***', 'constructo'),
                '1' => esc_html__('1 columns', 'constructo'),
                '2' => esc_html__('2 columns', 'constructo')
            )
        ));
    }
        /* Woocommerce */
    private static function woocommerce($wp_customize) {
        //display shopping cart icon in header
        $wp_customize->add_setting('anps_shopping_cart_header', array('default'=>anps_get_option('', 'shop_only', 'shopping_cart_header'),'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_shopping_cart_header', array(
            'label' => esc_html__('Display shopping cart icon in header?', 'constructo'),
            'section' => 'anps_woocommerce',
            'type' => 'select',
            'choices' => array(
                'hide' => esc_html__('Never display', 'constructo'),
                'shop_only' => esc_html__('Only on Woo pages', 'constructo'),
                'always' => esc_html__('Display everywhere', 'constructo')
            )
        ));
        //display shop pages product columns
        $wp_customize->add_setting('anps_products_columns', array('default'=>get_option('anps_woo_columns', '4'),'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_products_columns', array(
            'label' => esc_html__('Shop pages product columns', 'constructo'),
            'section' => 'anps_woocommerce',
            'type' => 'select',
            'choices' => array(
                '2' => esc_html__('2 columns', 'constructo'),
                '3' => esc_html__('3 columns', 'constructo'),
                '4' => esc_html__('4 columns', 'constructo')
            )
        ));
        //WooCommerce products per page
        $wp_customize->add_setting('anps_products_per_page', array('default'=>get_option('anps_products_per_page', '12'), 'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_products_per_page', array('label'=>esc_html__('Products per page', 'constructo'), 'settings' => 'anps_products_per_page', 'section' => 'anps_woocommerce'));
        //Product image zoom
        $wp_customize->add_setting('anps_product_zoom', array('default'=>get_option('anps_product_zoom', '1'), 'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_product_zoom', array('section'=>'anps_woocommerce', 'type'=>'checkbox', 'label'=>esc_html__('Product image zoom', 'constructo'), 'settings'=>'anps_product_zoom'));
        //Product image lightbox
        $wp_customize->add_setting('anps_product_lightbox', array('default'=>get_option('anps_product_lightbox', '1'), 'type' =>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control('anps_product_lightbox', array('section'=>'anps_woocommerce', 'type'=>'checkbox', 'label'=>esc_html__('Product image lightbox', 'constructo'), 'settings'=>'anps_product_lightbox'));
    }
    /* Logos */
    private static function logos($wp_customize) {
        /* Get old data */
        $anps_media_data = get_option('anps_media_info');

        /* Heading background */
        $wp_customize->add_setting('anps_heading_bg_desc', array('type'=>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control(new Anps_Desc_Control($wp_customize, 'anps_heading_bg_desc', array('section' => 'anps_logos', 'settings'=>'anps_heading_bg_desc', 'label'=>esc_html__('Heading background', 'constructo'), 'description'=>esc_html__('Heading background on page and search page.', 'constructo'))));
        //Page heading bg
        $wp_customize->add_setting('anps_heading_bg', array('default'=>anps_get_option($anps_media_data, 'heading_bg'), 'type' =>'option', 'sanitize_callback' => 'esc_url_raw', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'anps_heading_bg', array('label'=>esc_html__('Page heading background', 'constructo'), 'section'=>'anps_logos', 'settings'=>'anps_heading_bg')));
        //Search page heading bg
        $wp_customize->add_setting('anps_search_heading_bg', array('default'=>anps_get_option($anps_media_data, 'search_heading_bg'), 'type' =>'option', 'sanitize_callback' => 'esc_url_raw', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'anps_search_heading_bg', array('label'=>esc_html__('Search page heading background', 'constructo'), 'section'=>'anps_logos', 'settings'=>'anps_search_heading_bg')));
        /* END Heading background */

        /* Favicon and logos */
        $wp_customize->add_setting('anps_logos_desc', array('type'=>'option', 'sanitize_callback' => 'esc_html'));
        $wp_customize->add_control(new Anps_Desc_Control($wp_customize, 'anps_logos_desc', array('section' => 'anps_logos', 'settings'=>'anps_logos_desc', 'label'=>esc_html__('Favicon and logos', 'constructo'), 'description'=>esc_html__('If you would like to use your logo and favicon, upload them to your theme here.', 'constructo'))));
        //Logo
        $wp_customize->add_setting('anps_logo', array('default'=>anps_get_option($anps_media_data, 'logo'), 'type' =>'option', 'sanitize_callback' => 'esc_url_raw', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'anps_logo', array('label'=>esc_html__('Logo', 'constructo'), 'section'=>'anps_logos', 'settings'=>'anps_logo')));
        //Sticky logo
        $wp_customize->add_setting('anps_sticky_logo', array('default'=>anps_get_option($anps_media_data, 'sticky_logo'), 'type' =>'option', 'sanitize_callback' => 'esc_url_raw', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'anps_sticky_logo', array('label'=>esc_html__('Sticky logo', 'constructo'), 'section'=>'anps_logos', 'settings'=>'anps_sticky_logo')));
        //Favicon
        $wp_customize->add_setting('anps_favicon', array('default'=>anps_get_option($anps_media_data, 'favicon'), 'type' =>'option', 'sanitize_callback' => 'esc_url_raw', 'transport'=>'refresh'));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'anps_favicon', array('label'=>esc_html__('Favicon', 'constructo'), 'section'=>'anps_logos', 'settings'=>'anps_favicon')));
        /* END Favicon and logos */
    }
}
add_action('customize_register', array('Anps_Customizer', 'customizer_register'));
