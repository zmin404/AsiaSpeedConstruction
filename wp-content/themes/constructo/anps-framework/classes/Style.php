<?php
include_once 'Framework.php';
class Style extends Framework {
    
    /* Update google fonts */
    public function update_gfonts() {
        // Get google fonts
        $gfonts = wp_remote_get('http://astudio.si/preview/gfonts/get_fonts.php'); 
        if (is_wp_error($gfonts)) {
            return null;
        } else {
            $json_data = json_decode($gfonts['body'], true);
            $this->set_option($json_data['items'], 'google_fonts');
            header("Location: themes.php?page=theme_options&sub_page=theme_style_google_font");
        }       
    }
    
    public function update_gfonts_install() {
        $gfonts = wp_remote_get('http://astudio.si/preview/gfonts/get_fonts.php'); 
        if (is_wp_error($gfonts)) {
            return null;
        } else {
            $json_data = json_decode($gfonts['body'], true);
            $this->set_option($json_data['items'], 'google_fonts');
        }  
    }
    
    /* Upload custom font */
    public function upload_font() { 
        // Change upload directory
        add_filter('upload_dir', array('Style', 'upload_directory')); 
        $uploaded_file = $_FILES['font'];       
        /* If file not exists upload it */
        if(!file_exists(get_template_directory().'/fonts/'.$uploaded_file['name'])) {
            // Allowed file types
            $allowed_file_types = array('ttf'=>'application/octet-stream', 'eot'=>'application/octet-stream', 'svg'=>'application/octet-stream', 'woff'=>'application/octet-stream', 'otf'=>'application/octet-stream', 'zip'=>'application/force-download');
            $upload_overrides = array( 'test_form' => false, 'mimes'=>$allowed_file_types );    
            $movefile = wp_handle_upload($uploaded_file, $upload_overrides);
            if (!isset($movefile['error'])) {  
                // Save all files to options in database
                $explode_file_upload = explode(".",$uploaded_file['name']); 
                if($explode_file_upload[1]=='zip') {
                    $zip = new ZipArchive();
                    $x = $zip->open(get_template_directory().'/fonts/'.$uploaded_file['name']);
                    if ($x === true) {
                        $zip->extractTo(get_template_directory().'/fonts'); 
                        $zip->close();
                        unlink(get_template_directory().'/fonts/'.$uploaded_file['name']);
                    }
                }  
                $this->set_option($this->get_custom_fonts(), 'custom_fonts');
                remove_filter('upload_dir', array('Style', 'upload_directory'));
                header("Location: themes.php?page=theme_options&sub_page=theme_style_custom_font");
            } else { 
                echo esc_html($movefile['error']);
            }
        } else {
            echo 'File with same name already exists';
        }
    }
    
    /* Get all files and save it to options */
    public function get_custom_fonts() {
        $dir = get_template_directory().'/fonts';
        if ($handle = opendir($dir)) {
            $arr = array();
            // Get all files and store it to array
            while(false !== ($entry = readdir($handle))) {
               $arr[$entry] = $entry;
            }        
            closedir($handle); 
            // Remove . and ..
            unset($arr['.'], $arr['..'], $arr['justvectorv2'], $arr['glyphicons-halflings']); 
            
            // Prepare array to update options
            $fonts = array();
            foreach($arr as $item) {
                $exploded_item = explode(".", $item);
                $fonts[$exploded_item[0]] = $exploded_item[0];               
            } 
        } 
       return $fonts;
    }
    
    /* New upload directory */
    public function upload_directory($upload) {
        $upload['subdir'] = '/fonts';
        $upload['path'] = get_template_directory().$upload['subdir'];
        $upload['url'] = get_template_directory_uri().$upload['subdir'];
        $upload['error'] = $upload['error'];
        
        return $upload;
    }
    
    /* Get all fonts */
    public function all_fonts() {  
        $fonts['System fonts'] = array(
            array('value' => 'Arial, Helvetica, sans-serif', 'name' => 'Arial'),
            array('value' => 'Arial+Black, Gadget, sans-serif', 'name' => 'Arial black'),
            array('value' => 'Comic+Sans+MS, cursive, sans-serif', 'name' => 'Comic Sans MS'),
            array('value' => 'Courier+New, Courier, monospace', 'name'=> 'Courier New'),
            array('value' => 'Georgia, serif', 'name' => 'Georgia'),
            array('value' => 'Impact, Charcoal, sans-serif', 'name'=>'Impact'),
            array('value' => 'Lucida+Console, Monaco, monospace', 'name'=> 'Lucida Console'),
            array('value' => 'Lucida+Sans+Unicode, "Lucida Grande", sans-serif', 'name'=>'Lucida Sans Unicode'),
            array('value' => 'Palatino+Linotype, Book+Antiqua, Palatino, serif', 'name'=> 'Palatino Linotype'),
            array('value' => 'Tahoma, Geneva, sans-serif', 'name'=> 'Tahoma'),
            array('value' => 'Trebuchet+MS, Helvetica, sans-serif', 'name'=> 'Trebuchet MS'),
            array('value' => 'Times+New+Roman, Times, serif', 'name' => 'Times New Roman'),
            array('value' => 'Verdana, Geneva, sans-serif', 'name'=> 'Verdana')         
        );
        $fonts['Custom fonts'] = get_option($this->prefix.'custom_fonts'); 
        $fonts['Google fonts'] = get_option($this->prefix.'google_fonts'); 
        return $fonts;
    }   
    
    /* Save style options */
    public function save() { 
        $fonts = explode("|", $_POST['font_type_1']);
        $_POST['font_type_1'] = $fonts[0];
        $_POST['font_source_1'] = $fonts[1];
        $fonts2 = explode("|", $_POST['font_type_2']);
        $_POST['font_type_2'] = $fonts2[0];
        $_POST['font_source_2'] = $fonts2[1];
        $fonts3 = explode("|", $_POST['font_type_navigation']);
        $_POST['font_type_navigation'] = $fonts3[0];
        $_POST['font_source_navigation'] = $fonts3[1];
        foreach($_POST as $name=>$value) {  
            update_option($name, $value);
        }
        header("Location: themes.php?page=theme_options&sub_page=theme_style");
    }
        
}
$style = new Style();