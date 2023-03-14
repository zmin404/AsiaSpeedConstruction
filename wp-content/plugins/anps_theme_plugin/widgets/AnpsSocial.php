<?php
class AnpsSocial extends WP_Widget {
    public function __construct() {
        parent::__construct(
                'AnpsSocial', __('AnpsThemes - Social icons', 'constructo'), array('description' => __('Enter social icons to show on page', 'constructo'),)
        );
        add_action( 'admin_enqueue_scripts', array( $this, 'anps_enqueue_scripts' ) );
    }

    public static function anps_register_widget() {
        return register_widget("AnpsSocial");
    }

    function anps_enqueue_scripts( $hook_suffix ) {
        wp_enqueue_style('fontawesome');
    }


    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => '',
            'icon_color'=>'',
            'sidebar_content' => '',
            'icon_0' => '',
            'icon_1' => '',
            'icon_2' => '',
            'icon_3' => '',
            'icon_4' => '',
            'icon_5' => '',
            'icon_6' => '',
            'icon_7' => '',
            'icon_8' => '',
            'icon_9' => '',
            'icon_10' => '',
            'icon_11' => '',
            'url_0'=>'',
            'url_1'=>'',
            'url_2'=>'',
            'url_3'=>'',
            'url_4'=>'',
            'url_5'=>'',
            'url_6'=>'',
            'url_7'=>'',
            'url_8'=>'',
            'url_9'=>'',
            'url_10'=>'',
            'url_11'=>'',
            'social' => '',
            'target'=>''
        ));

        $socials = array();
        $social_text = $instance['social'];

        /* Legacy */
        if( $instance['social'] == '' ) {
            for($i=0;$i<12;$i++) {
                if( $instance['icon_' . $i] ) {
                    $temp = 'fa-' . $instance['icon_' . $i] . ';' . $instance['url_' . $i];

                    $socials[] = $temp;
                    if( $social_text != '' ) {
                        $social_text .= '|';
                    }
                    $social_text .= $temp;
                }
            }

            if( $social_text == '' ) {
                $socials = explode('|', $instance['social']);
            }
        } else {
            $socials = explode('|', $instance['social']);
        }
        ?>
         <!-- Title -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e("Title", 'constructo'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" class="widefat" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>

        <!-- Icon color -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('icon_color')); ?>"><?php _e("Icon color", 'constructo'); ?></label><br />
            <input class="anps-color-picker" id="<?php echo esc_attr($this->get_field_id('icon_color')); ?>" name="<?php echo esc_attr($this->get_field_id('icon_color')); ?>" type="text" value="<?php echo esc_attr($instance['icon_color']); ?>" />
        </p>
        <?php
        $checked = '';
        if($instance['sidebar_content']=="on") {
            $checked = "checked";
        }
        ?>
        <p>
            <input id="<?php echo esc_attr($this->get_field_id('sidebar_content')); ?>" name="<?php echo esc_attr($this->get_field_name('sidebar_content')); ?>" type="checkbox" <?php echo $checked; ?> />
            <label for="<?php echo esc_attr($this->get_field_id('sidebar_content')); ?>"><?php _e("Sidebar content", 'constructo'); ?></label>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('target')); ?>"><?php _e("Target", 'constructo'); ?></label>
            <?php $target_array = array("_self", "_blank", "_parent", "_top");?>
            <select id="<?php echo esc_attr($this->get_field_id('target')); ?>" name="<?php echo esc_attr($this->get_field_name('target')); ?>">
                <?php foreach($target_array as $key=>$item) : ?>
                <option <?php if ($key == $instance['target']) {
                        echo 'selected="selected"';
                    } ?> value="<?php echo esc_attr($key); ?>"><?php echo $item; ?></option>
                <?php endforeach; ?>
            </select>
        </p>

               <?php for($i=0; $i<12; $i++) : ?>
        <div style="display: none;">

            <?php $anps_select_id_social = $this->get_field_id('icon_'.$i);?>
            <div class="anps-iconpicker">
                <?php
                    $icon = 'fa-' . $instance['icon_'.$i];
                    $icon = str_replace('fa-fa-', 'fa-', $icon);
                ?>
                <i class="fa <?php echo $icon; ?>"></i>
                <input type="text" value="<?php echo $instance['icon_'.$i]; ?>" id="<?php echo esc_attr($this->get_field_id('icon_'.$i)); ?>" name="<?php echo esc_attr($this->get_field_name('icon_'.$i)); ?>">
                <button type="button"><?php _e('Select icon', 'constructo'); ?></button>
            </div>
        </div>
        <p style="display: none;">
            <input id="<?php echo esc_attr($this->get_field_id('url_'.$i)); ?>" name="<?php echo esc_attr($this->get_field_name('url_'.$i)); ?>" type="text" class="widefat" value="<?php echo esc_attr($instance['url_'.$i]); ?>" />
        </p>
        <?php endfor; ?>

        <!-- Social Iconpickers -->
        <div data-anps-repeat>
            <!-- Social Icons field (hidden) -->
            <input data-anps-repeat-field id="<?php echo esc_attr($this->get_field_id('social')); ?>" name="<?php echo esc_attr($this->get_field_name('social')); ?>" type="hidden" value="<?php echo esc_attr($social_text); ?>">

            <!-- Repeater items wrapper -->
            <div class="anps-repeat-items" data-anps-repeat-items>
                <?php foreach($socials as $social) : ?>
                <div class="anps-repeat-item" data-anps-repeat-item>
                    <!-- Fields -->
                    <p>

                        <?php
                            $social = explode(';', $social);
                            $social_icon = '';
                            $social_url = '';
                            $social_title = '';

                            if( isset($social[0]) ) {
                                 $social_icon = $social[0];
                            }

                            if (strpos($social_icon, 'fa-') !== false)  {
                                $social_icon = 'fa ' . $social_icon;
                            }

                            if( isset($social[1]) ) {
                                 $social_url = $social[1];
                            }

                            if( isset($social[2]) ) {
                                 $social_title = $social[2];
                            }
                        ?>
                        <div class="anps-iconpicker">
                            <i class="<?php echo esc_attr($social_icon); ?>"></i>
                            <input type="text" value="<?php echo esc_attr($social_icon); ?>">
                            <button type="button"><?php esc_html_e('Select icon', 'constructo'); ?></button>
                        </div>
                    </p>
                    <p>
                        <label><?php _e('URL', 'constructo'); ?></label>
                        <input type="text" class="widefat" value="<?php echo esc_attr($social_url); ?>" />
                    </p>

                    <p>
                        <label><?php _e('Title', 'constructo'); ?></label>
                        <input type="text" class="widefat" value="<?php echo esc_attr($social_title); ?>" />
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
        for ($i=0; $i<12; $i++) {
            $instance['icon_'.$i] = isset($new_instance['icon_'.$i]) ? $new_instance['icon_'.$i] : '';
            $instance['url_'.$i] = isset($new_instance['url_'.$i]) ? $new_instance['url_'.$i] : '';
        }
        $instance['icon_color'] = isset($new_instance['icon_color']) ? $new_instance['icon_color'] : '';
        $instance['title'] = isset($new_instance['title']) ? $new_instance['title'] : '';
        $instance['target'] = isset($new_instance['target']) ? $new_instance['target'] : '';
        $instance['sidebar_content'] = isset($new_instance['sidebar_content']) ? $new_instance['sidebar_content'] : '';
        $instance['social'] = isset($new_instance['social']) ? $new_instance['social'] : '';
        return $instance;
    }
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $icon = "";
        if( isset($instance['icon']) ) {
            $icon = $instance['icon'];
        }
        $url = '';
        if( isset($instance['url']) ) {
            $url = $instance['url'];
        }
        $title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
        $sidebar_content = '';
        if( isset($instance['sidebar_content']) ) {
            $sidebar_content = $instance['sidebar_content'];
        }
        if($sidebar_content=="on") {
            $class = "social";
        } else {
            $class = "socialize";
        }
        $target = "";
        if(isset($instance['target'] )) {
            $instance['target'] = $instance['target'] ;
        } else {
            $instance['target'] = "";
        }
        switch($instance['target']) {
            case 0 :
                $target = "_self";
                break;
            case 1 :
                $target = "_blank";
                break;
            case 2 :
                $target = "_parent";
                break;
            case 3 :
                $target = "_top";
                break;
            default :
                $target = "_self";
        }

        $socials = array();

        /* Legacy */
        if(!isset($instance['social']) || $instance['social'] == '' ) {
            for($i=0;$i<12;$i++) {
                if(isset($instance['icon_' . $i])&&$instance['icon_' . $i]!='') {
                    $socials[] = $instance['icon_' . $i] . ';' . $instance['url_' . $i];
                }
            }
        } else {
            $socials = explode('|', $instance['social']);
        }

        echo $before_widget;
        ?>
        <?php if($title) : ?>
        <h3 class="widget-title"><?php echo esc_html($title); ?></h3>
        <?php endif; ?>
        <ul class="<?php echo esc_attr($class); ?>">
            <?php foreach($socials as $social): ?>
                <?php
                    $social = explode(';', $social);
                    $social_icon = '';
                    $social_url = '';
                    $social_title = '';
                    $title_attribute = '';

                    if( isset($social[0]) ) {
                        $social_icon = $social[0];

                        if( strpos($social_icon, 'fa-') === false &&
                            strpos($social_icon, 'typcn-') === false &&
                            strpos($social_icon, 'vc_') === false &&
                            strpos($social_icon, 'vc-') === false &&
                            strpos($social_icon, 'anps-') === false ) {
                            $social_icon = 'fa-' . $social_icon;
                        }

                        anps_load_vc_icons($social[0]);
                    }

                    if( isset($social[1]) ) {
                        $social_url = $social[1];
                    }

                    if( isset($social[2]) ) {
                        $social_title = $social[2];
                        $title_attribute = ' title="' . $social[2] . '"';
                    }
                ?>
            <li>
                <?php if($social_url!="") : ?>
                <a<?php echo $title_attribute; ?> href="<?php echo esc_url($social_url); ?>" target="<?php echo $target; ?>"<?php if(isset($instance['icon_color'])&&$instance['icon_color']!=''):?> style="color: <?php echo esc_attr($instance['icon_color']);?>"<?php endif; ?>>
                <?php if (strpos($social_icon, 'anps-') !== false): ?>
                     <span class="fa"><?php echo file_get_contents(get_template_directory_uri() . '/images/construction-icons/' . str_replace('anps-icon-', '', $social_icon) . '.svg'); ?></span>
                <?php else: ?>
                    <i class="fa <?php echo $social_icon; ?>" aria-hidden="true"></i>
                <?php endif; ?>

                <span class="sr-only"><?php echo $social_title; ?></span>
                </a>
                <?php else : ?>
                <span <?php if(isset($instance['icon_color'])&&$instance['icon_color']!=''):?> style="color: <?php echo esc_attr($instance['icon_color']);?>"<?php endif; ?>>
                    <i class="fa <?php echo $social_icon; ?>" aria-hidden="true"></i>
                    <span class="sr-only"><?php echo $social_title; ?></span>
                </span>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php
        echo $after_widget;
    }
}
add_action( 'widgets_init', array('AnpsSocial', 'anps_register_widget'));
