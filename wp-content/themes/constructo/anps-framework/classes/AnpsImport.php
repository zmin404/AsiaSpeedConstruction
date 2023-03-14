<?php
include_once(get_template_directory() . '/anps-framework/classes/Framework.php');
class AnpsImport extends Framework {        
    /* Get all anps theme options */
    public function get_theme_options() {
        $data = array();
        foreach(wp_load_alloptions() as $name => $value) {
            if(substr($name, 0, 5)=='anps_') {
                if(stristr($name, 'anps_custom_fonts', false) || stristr($name, 'anps_google_fonts', false)) {
                    continue;
                }
                $data[$name] = $value;
            }
        }
        return $data;
    }
    /* Get menu name from menu id */
    private function _get_menu_name($id) {
        $data = get_term_by('id', $id['nav_menu'], 'nav_menu'); 
        return $data->slug;
    }
    /* Get menu name from menu id */
    private function _get_menu_id($slug) { 
        $data = get_term_by('slug', $slug['nav_menu'], 'nav_menu'); 
        return $data->term_id;
    }
    /* Get all active anps widgets */
    private function get_anps_widgets() {
        /* Get all sidebar areas */
        $sidebars = get_option('sidebars_widgets'); 
        /* delete primary sidebar and inactive widgets from array */
        unset($sidebars['wp_inactive_widgets'], $sidebars['primary-widget-area'], $sidebars['array_version']);   
        foreach($sidebars as $key=>$items) {
            /* Delete empty sidebars from array */
            if(!isset($sidebars[$key])) {
                unset($sidebars[$key]);
            } 
            if(isset($items)&&!empty($items)) { 
                unset($items['_multiwidget']);  
                foreach($items as $key2=>$item) {  
                    $widget_explode = explode('-', $item);
                    $widget_explode_count = count($widget_explode);
                    $widget_name = '';
                    for($i=0;$i<$widget_explode_count-1;$i++) {
                        if($i==0) {
                            $widget_name .= $widget_explode[$i];
                        } else {
                            $widget_name .= '-'.$widget_explode[$i];
                        }             
                    } 
                    $widget_id = $widget_explode[$widget_explode_count-1]; 
                    $widgets_data = get_option('widget_'.$widget_name);                
                    foreach($widgets_data as $key3=>$item2) {
                        if($widget_id==$key3) {
                            if($widget_name=='nav_menu' || $widget_name=='anps_menu') {
                                $item2['nav_menu'] = $this->_get_menu_name($item2);
                            }
                            $sidebars[$key][$widget_name.'-'.$widget_id] = $item2;
                        }
                    }
                    unset($sidebars[$key][$key2], $sidebars[$key]['_multiwidget']);
                }   
            }            
        } 
        return serialize($sidebars);
    }
    /* Save file for widgets */
    public function save_file_widgets() {
        header('Content-disposition: attachment; filename=anps-widgets.txt');
        header('Content-Type: text/plain');   
        ob_clean();
        echo $this->get_anps_widgets();
        exit;
    }
    /* Save file */
    public function save_file() {
        header('Content-disposition: attachment; filename=anps-theme-options.json');
        header('Content-Type: application/json');   
        ob_clean();
        echo stripslashes($_POST['anps_export']);
        exit;
    }
    /* Import theme options */
    public function import_theme_options($filename='') { 
        if($_FILES['import_file']['name']!='') {
            $creds = request_filesystem_credentials(site_url() . '/wp-admin/', '', false, false, array());
            if(!WP_Filesystem($creds)){return false;}	
            global $wp_filesystem;
            $data = json_decode($wp_filesystem->get_contents($_FILES['import_file']['tmp_name'])); 
            foreach($data as $name=>$value) {
                update_option($name, $value);
            } 
            header("Location: themes.php?page=theme_options&sub_page=import_export");
        } elseif($filename!='') {
            $creds = request_filesystem_credentials(site_url() . '/wp-admin/', '', false, false, array());
            if(!WP_Filesystem($creds)){return false;}	
            global $wp_filesystem; 
            $data = json_decode($wp_filesystem->get_contents($filename)); 
            foreach($data as $name=>$value) {
                update_option($name, $value);
            } 
        } else {
            $data = json_decode(stripslashes($_POST['anps_import']), true);
            if(isset($data)) {
                foreach($data as $name => $value) {
                    update_option($name, $value);
                }
            }
            header("Location: themes.php?page=theme_options&sub_page=import_export");
        }
        
    }
    /* Import widgets data */
    public function import_widgets_data($filename='') {
        if($_FILES['import_file']['name']!='') {
            $creds = request_filesystem_credentials(site_url() . '/wp-admin/', '', false, false, array());
            if(!WP_Filesystem($creds)){return false;}	
            global $wp_filesystem;
            $data = unserialize($wp_filesystem->get_contents($_FILES['import_file']['tmp_name'])); 
            $this->save_widgets_data($data);
            header("Location: themes.php?page=theme_options&sub_page=import_export_widgets");
        } elseif($filename!='') {
            $creds = request_filesystem_credentials(site_url() . '/wp-admin/', '', false, false, array());
            if(!WP_Filesystem($creds)){return false;}	
            global $wp_filesystem;
            $data = unserialize($wp_filesystem->get_contents($filename)); 
            $this->save_widgets_data($data);
        }
    }
    /* Save widgets data to db */
    public function save_widgets_data($data) { 
        $sidebar_options = get_option('sidebars_widgets');
        foreach($data as $key_sidebar => $item_sidebar) { 
            if(empty($item_sidebar)){continue;}
            foreach($item_sidebar as $key_widget => $item_widget) {    
                $explode_widget_name = explode('-', $key_widget);
                $widget_explode_count = count($explode_widget_name);
                $widget_name = '';
                for($i=0;$i<$widget_explode_count-1;$i++) {
                    if($i==0) {
                        $widget_name .= $explode_widget_name[$i];
                    } else {
                        $widget_name .= '-'.$explode_widget_name[$i];
                    }             
                }
                if($widget_name=='nav_menu' || $widget_name=='anps_menu') {
                    $item_widget['nav_menu'] = $this->_get_menu_id($item_widget); 
                } 
                $widgets_data = get_option('widget_'.$widget_name);
                $widget_count = count($widgets_data)+1;
                $sidebar_options[$key_sidebar][] = $widget_name.'-'.$widget_count;
                $widgets_data[$widget_count] = $item_widget; 
                $widget_count++;
                update_option('widget_'.$widget_name, $widgets_data);
            }
        } 
        update_option('sidebars_widgets',$sidebar_options);     
    }
}
$anps_import_export = new AnpsImport();