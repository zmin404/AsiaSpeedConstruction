<?php
class Anps_Sidebar_Control extends WP_Customize_Control {
    public $type = 'anps_sidebar';
    public function render_content() { 
    ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <div class="anps-sidebar">
                <select <?php $this->link(); ?>>
                    <option value="0">*** Select ***</option>
                    <?php 
                    global $wp_registered_sidebars;     
                    $sidebars = $wp_registered_sidebars;
                    if( is_array($sidebars) && !empty($sidebars) ) :
                        foreach( $sidebars as $sidebar ) :
                            if($this->value() == $sidebar['name']) { 
                                $selected = ' selected';
                            } else {
                                $selected = '';
                            } ?>
                    <option value="<?php echo esc_attr($sidebar['name']); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_attr($sidebar['name']); ?></option>
                    <?php endforeach;
                    endif;
                    ?>
                </select>
            </div>
        </label>
    <?php
    }
}