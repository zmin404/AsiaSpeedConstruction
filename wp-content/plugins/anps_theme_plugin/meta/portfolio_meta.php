<?php 
add_action('add_meta_boxes', 'anps_portfolio_content_add_custom_box');
add_action('save_post', 'anps_portfolio_content_save_postdata');
function anps_portfolio_content_add_custom_box() {
    $screens = array('portfolio');
    foreach ($screens as $screen) {
        add_meta_box('anps_portfolio_meta', __('Portfolio subtitle', 'constructo'), 'display_portfolio_meta_box_content', $screen, 'normal', 'high');
        add_meta_box('anps_hide_portfolio_meta', __('Hide portfolio image / video / gallery', 'constructo'), 'anps_hide_portolio', $screen, 'side', 'core');
    }
    $pages = array('portfolio', 'post');
    foreach($pages as $screen) {
        add_meta_box('anps_portfolio_side_meta', __('Breadcrumbs parent page', 'constructo'), 'display_portfolio_breadcrumbs_meta_box', $screen, 'side', 'core');
    }
}
function display_portfolio_meta_box_content( $post ) {
        $value2 = get_post_meta( $post -> ID, $key = 'anps_subtitle', $single = true );
        //$portfolio_shorttext = get_post_meta( $post -> ID, $key = 'anps_portfolio_shorttext', $single = true );
        //echo '<label for="anps_portfolio_shorttext">Portfolio Shorttext</label>';
        /*wp_editor($portfolio_shorttext, 'portfolio_single_footer', array(
                                                        'wpautop' => true,                
                                                        'media_buttons' => false,                
                                                        'textarea_name' => 'anps_portfolio_shorttext',               
                                                        'textarea_rows' => 10,                
                                                        'teeny' => true ));*/
	echo "<p>
                <label for='anps_subtitle'>Portfolio subtitle</label>
                <input type='text' name='anps_subtitle' value='$value2' style='width: 350px' />
               </p>";
}
function anps_hide_portolio($post) {
    $value2 = get_post_meta($post->ID, $key ='anps_hide_portfolio_img', $single = true ); 
    $checked = '';
    if($value2=='1') {
        $checked = 'checked';
    }
    echo "Hide <input type='checkbox' name='anps_hide_portfolio_img' value='1' $checked />"; 
}
function display_portfolio_breadcrumbs_meta_box($post) {
    $custom_breadcrumbs = get_post_meta( $post -> ID, $key = 'custom_breadcrumbs', $single = true );
    ?>
    <select name="custom_breadcrumbs">
            <option value="0">*** Select ***</option>
            <?php 
                    $pages = get_pages();
                    foreach ($pages as $item) :
                            if ($custom_breadcrumbs == $item->ID) {
                                    $selected = 'selected="selected"';
                            }
                            else {         
                                    $selected = '';
                            }
            ?>      <option value="<?php echo esc_attr($item->ID); ?>" <?php echo $selected; ?>><?php echo esc_html($item->post_title); ?></option>                 
            <?php endforeach; ?>            
    </select> 
<?php }
function anps_portfolio_content_save_postdata($post_id) { 
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (empty($_POST)) {
        return;
    }
    if(!isset($_POST['post_ID'])) {
        if(!$post_id) {
            return;
        } else {
            $_POST['post_ID'] = $post_id;
        }
    }
    if(!isset($_POST['post_type'])) {
        return;
    }
    // Check permissions
    if ('portfolio' == $_POST['post_type']) { 
        if (!current_user_can('edit_page', $post_id))
            return;
    }
    else {
        if (!current_user_can('edit_post', $post_id))
            return;
    }
    $post_ID = $_POST['post_ID'];
    if (!isset($_POST['anps_subtitle'])) {
        $_POST['anps_subtitle'] = '';
    }
    if (!isset($_POST['anps_portfolio_shorttext'])) {
        $_POST['anps_portfolio_shorttext'] = '';
    }
    if (!isset($_POST['custom_breadcrumbs'])) {
        $_POST['custom_breadcrumbs'] = '';
    }
    if (!isset($_POST['anps_hide_portfolio_img'])) {
        $_POST['anps_hide_portfolio_img'] = '0';
    }
    $hide_img = $_POST['anps_hide_portfolio_img'];
    $mydata2 = $_POST['anps_subtitle'];
    $portfolio_shorttext = $_POST['anps_portfolio_shorttext'];
    $custom_breadcrumbs = $_POST['custom_breadcrumbs'];
    add_post_meta($post_ID, 'anps_subtitle', $mydata2, true) or update_post_meta($post_ID, 'anps_subtitle', $mydata2);
    add_post_meta($post_ID, 'anps_portfolio_shorttext', $portfolio_shorttext, true) or update_post_meta($post_ID, 'anps_portfolio_shorttext', $portfolio_shorttext);
    add_post_meta($post_ID, 'custom_breadcrumbs', $custom_breadcrumbs, true) or update_post_meta($post_ID, 'custom_breadcrumbs', $custom_breadcrumbs);
    add_post_meta($post_ID, 'anps_hide_portfolio_img', $hide_img, true) or update_post_meta($post_ID, 'anps_hide_portfolio_img', $hide_img);
}
