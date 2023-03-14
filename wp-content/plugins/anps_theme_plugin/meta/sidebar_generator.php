<?php
class anps_sidebar_generator {
    function __construct() {
        add_action('init',array('anps_sidebar_generator','init'));

        if (current_user_can('manage_options')) {
            add_action('admin_menu',array('anps_sidebar_generator','admin_menu'));
            add_action('admin_print_scripts', array('anps_sidebar_generator','admin_print_scripts'));
            add_action('wp_ajax_add_sidebar', array('anps_sidebar_generator','add_sidebar') );
            add_action('wp_ajax_remove_sidebar', array('anps_sidebar_generator','remove_sidebar') );

            //edit posts/pages
            add_action('edit_form_advanced', array('anps_sidebar_generator', 'edit_form'));
            add_action('edit_page_form', array('anps_sidebar_generator', 'edit_form'));;

            //save posts/pages
            add_action('edit_post', array('anps_sidebar_generator', 'save_form'));
            add_action('publish_post', array('anps_sidebar_generator', 'save_form'));
            add_action('save_post', array('anps_sidebar_generator', 'save_form'));
            add_action('edit_page_form', array('anps_sidebar_generator', 'save_form'));
        }
    }

    public static function init() {
        $sidebars = anps_sidebar_generator::get_sidebars();
        foreach ($sidebars as $sidebar) {
            $sidebar_slug = anps_sidebar_generator::name_to_slug($sidebar);
            register_sidebar(array(
                'name'          => $sidebar,
                'id'            => $sidebar_slug,
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            ));
        }
    }

    public static function admin_print_scripts() {
        wp_enqueue_script('anps_sidebar_generator_js');
        wp_enqueue_style('anps_sidebar_generator_css');
    }

    public static function add_sidebar() {
        $retrieved_nonce = $_POST['security'];
        if (!wp_verify_nonce($retrieved_nonce, 'anps_sidebar_generator')) die('Failed security check');

        $sidebars = anps_sidebar_generator::get_sidebars();
        $name = sanitize_text_field($_POST['sidebar_name']);

        $arr = array();

        if (!$name) {
            $arr['error'] = esc_html__('Invalid sidebar name.', 'constructo');
            die(json_encode($arr));
        }

        $id = anps_sidebar_generator::name_to_slug($name);

        if (isset($sidebars[$id])) {
            $arr['error'] = esc_html__('Sidebar already exists, please use a different name.', 'constructo');
        } else {
            $arr['name'] = $name;
            $arr['ID'] = $id;
            $sidebars[$id] = $name;
            anps_sidebar_generator::update_sidebars($sidebars);
        }

        die(json_encode($arr));
    }

    public static function remove_sidebar() {
        $retrieved_nonce = $_POST['security'];
        if (!wp_verify_nonce($retrieved_nonce, 'anps_sidebar_generator')) die('Failed security check');

        $slug = sanitize_text_field($_POST['sidebar_slug']);
        $row_num = sanitize_text_field($_POST['row_num']);

        $arr = array();

        if (!$slug) {
            $arr['error'] = esc_html__('No sidebar specified.', 'constructo');
            die(json_encode($arr));
        }

        $sidebars = anps_sidebar_generator::get_sidebars();

        if(!isset($sidebars[$slug])){
            $arr['error'] = esc_html__( 'Sidebar does not exist.', 'constructo');
        } else {
            unset($sidebars[$slug]);
            anps_sidebar_generator::update_sidebars($sidebars);
            $arr['rowNum'] = $row_num;
        }

        die(json_encode($arr));
    }

    public static function admin_menu(){
        add_theme_page('Sidebars', 'Sidebars', 'manage_options', 'anps_sidebar_generator', array('anps_sidebar_generator','admin_page'));
    }

    static function admin_page() {
        ?>
        <div class="wrap">
            <h2><?php esc_html_e('Sidebar Generator', 'constructo'); ?></h2>
            <?php wp_nonce_field('anps_sidebar_generator'); ?>
            <table class="widefat page striped sbg-table" id="sbg_table" data-remove="<?php esc_html_e('Remove', 'constructo'); ?>" data-none="<?php esc_html_e('No sidebars found', 'constructo'); ?>" data-prompt="<?php esc_html_e('Sidebar Name:', 'constructo'); ?>" data-confirm="Are you sure you want to remove %s?">
                <thead>
                    <tr>
                        <th><?php esc_html_e('Name', 'constructo'); ?></th>
                        <th><?php esc_html_e('Slug', 'constructo'); ?></th>
                        <th><?php esc_html_e('Remove', 'constructo'); ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sidebars = anps_sidebar_generator::get_sidebars();
                if (!empty($sidebars)) :
                    $cnt=0;
                    foreach($sidebars as $sidebar) :
                        $alt = $cnt % 2 === 0 ? 'alternate' : '';
                    ?>
                    <tr class="<?php echo esc_attr($alt);?>">
                        <td data-sidebar="name"><?php echo esc_html($sidebar); ?></td>
                        <td data-sidebar="slug"><?php echo esc_html(anps_sidebar_generator::name_to_slug($sidebar)); ?></td>
                        <td><button data-sidebar="remove" class="remove-sidebar"><?php esc_html_e('Remove', 'constructo'); ?></button></td>
                    </tr>
                    <?php
                        $cnt++;
                    endforeach;
                else :
                    ?>
                    <tr class="no-items">
                        <td class="colspanchange" colspan="3"><?php esc_html_e('No sidebars found', 'constructo'); ?></td>
                    </tr>
                    <?php
                endif;
                ?>
                </tbody>
            </table>
            <div class="sbg-add">
                <button data-sidebar="add" class="button button-primary" title="<?php esc_html_e('Add a sidebar', 'constructo'); ?>"><?php esc_html_e('Add Sidebar', 'constructo'); ?></button>
            </div>
        </div>
        <?php
    }

    /**
    * for saving the pages/post
    */
    public static function save_form($post_id) {
        $is_saving = isset($_POST['sbg_edit']) && !empty($_POST['sbg_edit']);
        if (!$is_saving) return;
        if (isset($_POST['sbg_selected_sidebar'])) {
            $val = sanitize_text_field($_POST['sbg_selected_sidebar']);
            update_post_meta($post_id, 'sbg_selected_sidebar', $val);
        }
        if (isset($_POST['sbg_selected_sidebar_replacement'])) {
            $val = sanitize_text_field($_POST['sbg_selected_sidebar_replacement']);
            update_post_meta($post_id, 'sbg_selected_sidebar_replacement', $val);
        }
    }

    public static function edit_form() {
        global $post;
        $post_id = $post->ID;
        if (!$post_id) return; // $post_id will be 0 at worst and this will exit

        $left_sidebar = get_post_meta($post_id, 'sbg_selected_sidebar', true);
        $right_sidebar = get_post_meta($post_id, 'sbg_selected_sidebar_replacement', true);
        global $wp_registered_sidebars;
    ?>
    <div id="sbg-sortables" class="meta-box-sortables">
        <div id="sbg_box" class="postbox">
            <div class="handlediv" title="Click to toggle"><br /></div>
            <h3 class="hndle"><span><?php esc_html_e('Sidebars', 'constructo'); ?></span></h3>
            <div class="inside">
                <div class="sbg_container">
                    <input name="sbg_edit" type="hidden" value="sbg_edit" />
                    <p>
                        <?php esc_html_e('Select the sidebar you wish to display. If no value is selected, then the global sidebar will be used. Any other value will overwrite the global option. Use "None" to remove the global sidebar for a specific post/page.', 'constructo'); ?>
                    </p>
                    <table class="anps-sidebars">
                        <tr>
                            <td><?php esc_html_e('Left sidebar', 'constructo'); ?>:</td>
                            <td>
                                <select name="sbg_selected_sidebar">
                                    <option value="0"></option>
                                    <option value="-1"<?php if ($left_sidebar === '-1') : ?> selected<?php endif; ?>><?php esc_html_e('None', 'constructo'); ?></option>
                                    <?php
                                        if (is_array($wp_registered_sidebars)) :
                                            foreach ($wp_registered_sidebars as $sidebar) :
                                                $val = esc_attr($sidebar['name']);
                                                ?><option value="<?php echo $val; ?>"<?php if ($left_sidebar === $sidebar['name']) : ?> selected<?php endif; ?>><?php echo $val; ?></option><?php
                                            endforeach;
                                        endif;
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><?php esc_html_e('Right sidebar', 'constructo'); ?>:</td>
                            <td>
                                <select name="sbg_selected_sidebar_replacement">
                                    <option value="0"></option>
                                    <option value="-1"<?php if ($right_sidebar === '-1') : ?> selected<?php endif; ?>><?php esc_html_e('None', 'constructo'); ?></option>
                                    <?php
                                        if (is_array($wp_registered_sidebars)) :
                                            foreach ($wp_registered_sidebars as $sidebar) :
                                                $val = esc_attr($sidebar['name']);
                                                ?><option value="<?php echo $val; ?>"<?php if ($right_sidebar === $sidebar['name']) : ?> selected<?php endif; ?>><?php echo $val; ?></option><?php
                                            endforeach;
                                        endif;
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
    }

    /**
     * replaces array of sidebar names
     */
    public static function update_sidebars($sidebar_array){
        $sidebars = update_option('sbg_sidebars', $sidebar_array);
    }

    /**
     * gets the generated sidebars
     */
    public static function get_sidebars(){
        $sidebars = get_option('sbg_sidebars') ?: array();
        return $sidebars;
    }

    public static function name_to_slug($name){
        $slug = str_replace(array(',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',), '', $name);
        $slug = str_replace(' ', '-', $slug);
        $slug = strtolower($slug);
        return $slug;
    }
}

$anps_sbg = new anps_sidebar_generator();
