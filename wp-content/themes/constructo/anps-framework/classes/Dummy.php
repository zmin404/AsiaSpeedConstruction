<?php
include_once(get_template_directory() . '/anps-framework/classes/Framework.php');
class Dummy extends Framework {

    public function select() {
        return get_option('anps_dummy');
    }

    public function save() {
        include_once(get_template_directory() . '/anps-framework/classes/AnpsImport.php');
        $date = explode("/",date("Y/m"));
        $dummy_xml = "dummy1";
        if(isset($_POST['dummy1'])) {
            $dummy_xml = "dummy1";
        } elseif(isset($_POST['dummy2'])) {
            $dummy_xml = "dummy2";
        } elseif(isset($_POST['dummy3'])) {
            $dummy_xml = "dummy3";
        } elseif(isset($_POST['dummy4'])) {
            $dummy_xml = "dummy4";
        } elseif(isset($_POST['dummy5'])) {
            $dummy_xml = "dummy5";
        } elseif(isset($_POST['dummy6'])) {
            $dummy_xml = "dummy6";
        } elseif(isset($_POST['dummy7'])) {
            $dummy_xml = "dummy7";
        } elseif(isset($_POST['dummy8'])) {
            $dummy_xml = "dummy8";
        } elseif(isset($_POST['dummy9'])) {
            $dummy_xml = "dummy9";
        } elseif(isset($_POST['dummy10'])) {
            $dummy_xml = "dummy10";
        } elseif(isset($_POST['dummy11'])) {
            $dummy_xml = "dummy11";
        }

        /* Set dummy to 1 */
        update_option('anps_dummy', '1');

        /* Import theme options */
        $anps_import_export->import_theme_options(get_template_directory() . '/anps-framework/classes/importer/' . $dummy_xml . '/anps-theme-options.json');
        
        /* Fonts for demo 11 */
        if($dummy_xml == 'dummy11') {
            update_option('font_source_1', 'Google fonts');
            update_option('font_source_2', 'Google fonts');
            update_option('font_source_navigation', 'Google fonts');
            update_option('font_type_1', 'Work+Sans');
            update_option('font_type_2', 'Work+Sans');
            update_option('font_type_navigation', 'Work+Sans');
        }

        /* Import dummy xml */
        include_once WP_PLUGIN_DIR.'/anps_theme_plugin/importer/wordpress-importer.php';
        $parse = new WP_Import();
        $parse->import(get_template_directory() . "/anps-framework/classes/importer/$dummy_xml/dummy.xml");
        global $wp_rewrite;
        $blog_id = get_page_by_title("Blog")->ID;
        $first_id = get_page_by_title("Home")->ID;

        /* Post meta on blog */
        update_option('anps_post_meta_categories', '');
        update_option('anps_post_meta_author', '');

        update_option('page_for_posts', $blog_id);
        update_option('page_on_front', $first_id);
        update_option('show_on_front', 'page');
        update_option('permalink_structure', '/%postname%/');
        $wp_rewrite->set_permalink_structure('/%postname%/');
        $wp_rewrite->flush_rules();

        /* Set menu as primary */
        $menu_id = wp_get_nav_menus();
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $menu_id[0]->term_id;
        set_theme_mod('nav_menu_locations', $locations);
        update_option('menu_check', true);

        /* Install all widgets */
        $anps_import_export->import_widgets_data(get_template_directory() . "/anps-framework/classes/importer/$dummy_xml/anps-widgets.txt");

        /* Add revolution slider demo data */
        if($dummy_xml == 'dummy11') {
            $this->__add_revslider($dummy_xml, 'home');
        } else {
            $this->__add_revslider($dummy_xml);
            if($dummy_xml == 'dummy10') {
                $this->__add_revslider($dummy_xml, 'content-slider');
            }
        }
    }
    protected function __add_revslider($dummy_xml, $slider_name = 'main-slider') {
        /* Check if slider is installed */
        if(function_exists('set_revslider_as_theme')) {
            $slider = new RevSlider();
            $slider->importSliderFromPost(true, true, get_template_directory() . "/anps-framework/classes/importer/$dummy_xml/$slider_name.zip");
        } else {
            echo "Revolution slider is not active. Demo data for revolution slider can't be inserted.";
        }
    }
}
$dummy = new Dummy();
