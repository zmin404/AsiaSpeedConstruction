<?php
global $anps_options_data;
$page_heading_full = get_post_meta(get_queried_object_id(), $key = 'anps_page_heading_full', $single = true);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php anps_theme_after_styles(); ?>
    <?php if (isset($page_heading_full) && $page_heading_full == "on") {
        add_action("wp_head", 'anps_page_full_screen_style', 1000);
    } ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(anps_boxed_or_vertical() . anps_header_margin() . anps_footer() . anps_homepage_spacing()); ?><?php anps_body_style(); ?>>
    <?php wp_body_open(); ?>
    <div class="site-wrap">
        <?php
        $coming_soon = anps_get_option('', '0', 'coming_soon');
        if ($coming_soon == "0" || is_super_admin()) : ?>
            <div class="site-wrapper <?php if (get_option('anps_vc_legacy', "0") == "on") {
                                            echo "legacy";
                                        } ?>">
                <?php $anps_menu_type = get_option('anps_menu_type', '2'); ?>
                <?php if (get_option('anps_search_style', 'default') == 'default') : ?>
                    <div class="site-search" id="site-search"><?php anps_get_search(); ?></div>
                <?php endif; ?>
                <?php
                if (isset($page_heading_full) && $page_heading_full == "on") :
                    $heading_value = get_post_meta(get_queried_object_id(), $key = 'heading_bg', $single = true);

                    if (is_404()) {
                        $heading_value = get_post_meta(anps_get_option($anps_page_data, 'error_page'), $key = 'heading_bg', $single = true);
                    }

                    /* Page heading BG color */
                    $anps_heading_bg_color = get_option('anps_page_heading_bg_color', '');

                    if (is_404()) {
                        $anps_heading_meta_bg_color = get_post_meta(anps_get_option($anps_page_data, 'error_page'), $key = 'heading_bg', $single = true);
                    } else {
                        $anps_heading_meta_bg_color = get_post_meta(get_queried_object_id(), $key = 'anps_heading_bg_color', $single = true);
                    }

                    if ($anps_heading_meta_bg_color != '') {
                        $anps_heading_bg_color = $anps_heading_meta_bg_color;
                    }

                    if ($anps_heading_bg_color != '') {
                        $anps_heading_bg_color = ' background-color: ' . esc_attr($anps_heading_bg_color) . ';';
                    }
                    if (get_option('anps_menu_type', '2') != '5' && get_option('anps_menu_type', '2') != '6') :
                        $height_value = get_post_meta(get_queried_object_id(), $key = 'anps_full_height', $single = true);
                        if ($height_value) {
                            $height_value = 'height: ' . $height_value . 'px; ';
                        }
                ?>
                        <div class="paralax-header parallax-window" data-type="background" data-speed="2" style="<?php echo esc_attr($height_value); ?>background-image: url(<?php echo esc_url($heading_value); ?>);<?php echo $anps_heading_bg_color; ?>"> //escaped above
                <?php endif;
                endif;
            endif;
            anps_get_header();
