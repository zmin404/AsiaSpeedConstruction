<?php
class AnpsOpeningTime extends WP_Widget {
    public function __construct() {
        parent::__construct('AnpsOpeningTime', 'AnpsThemes - Opening time', array('description' => esc_html__('Enter opening time.', 'constructo')));
    }
    public static function anps_register_widget() {
        return register_widget("AnpsOpeningTime");
    }
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => '',
            'opening_times' => '',
        ));

        $opening_times = explode('|', $instance['opening_times']);
        ?>
        <!-- Title -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e("Title", 'constructo'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" class="widefat" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>

        <!-- Repeater -->
        <div data-anps-repeat>
            <!-- Opening Time field (hidden) -->
            <input data-anps-repeat-field id="<?php echo esc_attr($this->get_field_id('opening_times')); ?>" name="<?php echo esc_attr($this->get_field_name('opening_times')); ?>" type="hidden" value="<?php echo esc_attr($instance['opening_times']); ?>">

            <!-- Repeater items wrapper -->
            <div class="anps-repeat-items" data-anps-repeat-items>
                <?php foreach($opening_times as $opening_time): ?>
                <?php
                    $opening_time = explode(';', $opening_time);
                    $day = '';
                    $time = '';
                    $exposed = '';

                    if( isset($opening_time[0]) ) {
                        $day = $opening_time[0];
                    }

                    if( isset($opening_time[1]) ) {
                        $time = $opening_time[1];
                    }

                    if( isset($opening_time[2]) ) {
                        $exposed = $opening_time[2];
                    }
                ?>
                <div class="anps-repeat-item" data-anps-repeat-item>
                    <!-- Day -->
                    <p>
                        <label><?php esc_html_e('Day', 'constructo'); ?></label>
                        <input type="text" class="widefat" value="<?php echo esc_attr($day); ?>" />
                    </p>

                    <!-- Time -->
                    <p>
                        <label><?php esc_html_e('Time', 'constructo'); ?></label>
                        <input type="text" class="widefat" value="<?php echo esc_attr($time); ?>" />
                    </p>

                    <!-- Exposed -->
                    <p>
                        <label><?php esc_html_e('Exposed', 'constructo'); ?></label>
                        <input class="margin-l-5" type="checkbox" id="exposed" name="exposed" <?php if( $exposed == 'true' ) { echo 'checked'; } ?> />
                    </p>

                    <!-- Repeater buttons -->
                    <div class="anps-repeat-buttons">
                        <button class="anps-repeat-remove" type="button" data-anps-repeat-remove>-</button>
                        <button class="anps-repeat-add" type="button" data-anps-repeat-add>+</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['opening_times'] = $new_instance['opening_times'];
        return $instance;
    }
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        echo $before_widget;

        $opening_times = '';
        if( isset($instance['opening_times']) && $instance['opening_times'] != '' ) {
            $opening_times = explode('|', $instance['opening_times']);
        }
        $title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
        if( $title != '' ) {
            echo '<h3 class="widget-title">' . esc_html($title) . '</h3>';
        }

        ?>
        <table class="working-hours">
           <tbody>
                <?php foreach($opening_times as $opening_time): ?>
                    <?php
                        $opening_time = explode(';', $opening_time);
                        $day = '';
                        $time = '';
                        $exposed = '';

                        if( isset($opening_time[0]) ) {
                            $day = $opening_time[0];
                        }

                        if( isset($opening_time[1]) ) {
                            $time = $opening_time[1];
                        }

                        if( isset($opening_time[2]) ) {
                            $exposed = $opening_time[2];
                        }
                    ?>
                    <tr>
                        <th<?php if( $exposed == 'true' ) { echo ' class="important"'; } ?>><?php echo esc_html($day); ?></th>
                        <td<?php if( $exposed == 'true' ) { echo ' class="important"'; } ?>><?php echo esc_html($time); ?></td>
                    </tr>
                <?php endforeach; ?>
           </tbody>
        </table>
        <?php
        echo $after_widget;
    }
}
add_action('widgets_init', array('AnpsOpeningTime', 'anps_register_widget'));
