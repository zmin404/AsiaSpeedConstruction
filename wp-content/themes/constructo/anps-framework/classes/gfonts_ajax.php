<?php 
add_action( 'admin_enqueue_scripts', 'anps_font_enqueue' );
function anps_font_enqueue($hook) { 
    wp_register_script( 'font_subsets', get_template_directory_uri().'/anps-framework/js/font_subsets.js', array('jquery') );
    wp_localize_script( 'font_subsets', 'ajax_font_object', array( 'ajax_font_url' => admin_url( 'admin-ajax.php' ) ) ); 
}
add_action( 'wp_ajax_font_subsets', 'font_subsets_callback' );
function font_subsets_callback() {     
    $font_value = explode("|", $_POST['font_value']);
    if($font_value[1]=="Google fonts") {
        $fonts = get_option('anps_google_fonts');
        foreach($fonts as $item) {
            if($font_value[0]==$item['value']) {
                $json = $item['subsets'];
            }
        }
    } else {
        $json = 0;
    } 
    echo json_encode($json);
    die();
}