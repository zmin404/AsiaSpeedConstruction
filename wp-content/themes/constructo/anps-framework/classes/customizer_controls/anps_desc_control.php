<?php
class Anps_Desc_Control extends WP_Customize_Control {
    public $type = 'anps_desc';
    public function render_content() { 
    ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <div class="anps-desc"><?php echo esc_html($this->description); ?></div>
        </label>
    <?php
    }
}