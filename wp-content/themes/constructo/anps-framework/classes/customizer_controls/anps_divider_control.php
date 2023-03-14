<?php
class Anps_Divider_Control extends WP_Customize_Control {
    public $type = 'anps_divider';
    public function render_content() { 
    ?>
        <label>
            <div class="anps-divider"></div>
        </label>
    <?php
    }
}