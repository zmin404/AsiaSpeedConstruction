<?php 
include_once 'Framework.php';

class Contact extends Framework {    
    public function get_data() {
        return get_option($this->prefix.'contact');
    }
    public function save_data() {
        update_option($this->prefix.'contact', $_POST);
        header("Location: themes.php?page=theme_options&sub_page=contact_form");
    }
}
$contact = new Contact();