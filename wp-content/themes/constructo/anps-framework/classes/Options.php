<?php
include_once 'Framework.php';
class Options extends Framework {
    /* Save page layout data (page layout, copyright, top menu) */
    public function save_page() {
        foreach($_POST as $name=>$value) {  
            update_option($name, $value);
        } 
        header("Location: themes.php?page=theme_options&sub_page=options");
    }

    /* Get page layout data */
    public function get_page_data() {
        return get_option($this->prefix.'acc_info');
    }

    /* Get shop data */
    public function get_shop_setup_data() {
        return get_option($this->prefix.'shop_setup');
    }
    /* Save page setup data (error, blog, portfolio page) */
    public function save_page_setup($site = '') {
        foreach($_POST as $name=>$value) {  
            update_option($name, $value);
        }
        header("Location: themes.php?page=theme_options&sub_page=$site");
    }

    /* Get page setup data */
    public function get_page_setup_data() {
        return get_option($this->prefix.'page_setup');
    }

    /* Save social account data */
    public function save_social() {
        update_option($this->prefix.'social_info', $_POST);
        header("Location: themes.php?page=theme_options&sub_page=options_social_accounts");
    }

    /* Save page setup data (error, blog, portfolio page) */
    public function save_shop_setup() {
        $anps_page_data = $this->get_shop_setup_data();
        update_option($this->prefix.'shop_setup',$_POST);
        header("Location: themes.php?page=theme_options&sub_page=shop_settings");
    }

    /* Get social account data */
    public function get_social() {
        return get_option($this->prefix."social_info");
    }

    /* Save media*/
    public function save_media() {
        $fonts = explode("|", $_POST['anps_text_logo_font']);
        update_option('anps_text_logo_font',$fonts[0]);
        update_option('anps_text_logo_source_1',$fonts[1]);
        foreach($_POST as $name=>$value) {  
            update_option($name, $value);
        }
        header("Location: themes.php?page=theme_options&sub_page=options_media");
    }

    /* Get media */
    public function get_media() {
        return get_option($this->prefix.'media_info');
    }
}
$options = new Options();
