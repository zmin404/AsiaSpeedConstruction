<?php

class Framework {
    protected $prefix='anps_';
    
    protected function set_option($arr=array(), $option_name=null) { 
        $arr_save=array(); 

        foreach($arr as $name=>$value) { 
            if($option_name=='google_fonts') {
                $arr_save[] = array('value'=>urlencode($value['family']), 'name'=>$value['family'], 'variants'=>$value['variants'], 'subsets'=>$value['subsets']);
            } else {
                $arr_save[] = array('value'=>$value, 'name'=>$name);
            }
        } 
        update_option($this->prefix.$option_name, $arr_save);
    }

    public function anps_create_textarea($name, $value='', $rows=5, $description='', $additionalclass='') {
        if(!isset($name)){return;} 
        $output = '';
        $output .= '<div class="anps-textarea ' . $additionalclass . '">';
        $output .= "<textarea id='$name' name='$name' rows='$rows'>";
        $output .= $value;
        $output .= '</textarea>';
        $output .= '</div>';
        echo wp_kses($output, array(
            'div' => array(
                'class' => array()
            ),
            'textarea' => array(
                'name' => array(),
                'id' => array(),
                'rows' => array()
            )
        ));
    }
}