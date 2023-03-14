<?php
/* Header image, video, gallery (blog, portfolio) */
function anps_header_media($id, $image_class = "")
{
    if (has_post_thumbnail($id)) {
        $header_media = get_the_post_thumbnail($id, $image_class);
    } elseif (get_post_meta($id, $key = 'anps_featured_video', $single = true)) {
        $header_media = do_shortcode(get_post_meta($id, $key = 'anps_featured_video', $single = true));
    } else {
        $header_media = "";
    }
    return $header_media;
}
/* Header image, video, gallery (single blog) */
function anps_header_media_single($id, $image_class = "")
{
    if (has_post_thumbnail($id) && !get_post_meta($id, $key = 'gallery_images', $single = true)) {
        $header_media = get_the_post_thumbnail($id, $image_class);
    } elseif (get_post_meta($id, $key = 'anps_featured_video', $single = true)) {
        $header_media = do_shortcode(get_post_meta($id, $key = 'anps_featured_video', $single = true));
    } elseif (get_post_meta($id, $key = 'gallery_images', $single = true)) {
        $gallery_images = explode(",", get_post_meta($id, $key = 'gallery_images', $single = true));

        foreach ($gallery_images as $key => $item) {
            if ($item == '') {
                unset($gallery_images[$key]);
            }
        }
        $number_images = count($gallery_images);
        $header_media = "";
        $header_media .= "<div id='carousel' class='carousel slide'>";
        if ($number_images > "1") {
            $header_media .= "<ol class='carousel-indicators'>";
            for ($i = 0; $i < count($gallery_images); $i++) {
                if ($i == 0) {
                    $active_class = "active";
                } else {
                    $active_class = "";
                }
                $header_media .= "<li data-target='#carousel' data-interval='false' data-slide-to='" . $i . "' class='" . $active_class . "'></li>";
            }
            $header_media .= "</ol>";
        }
        $header_media .= "<div class='carousel-inner'>";
        $j = 0;
        foreach ($gallery_images as $item) {
            $image_src = wp_get_attachment_image_src($item, $image_class);

            $image_title = get_the_title($item);
            if ($j == 0) {
                $active_class = " active";
            } else {
                $active_class = "";
            }
            $header_media .= "<div class='item$active_class'>";
            $header_media .= "<img alt='" . $image_title . "'  src='" . $image_src[0] . "'>";
            $header_media .= "</div>";
            $j++;
        }
        $header_media .= "</div>";
        if ($number_images > "1") {
            $header_media .= "<a class='left carousel-control' href='#carousel' data-slide='prev'>
                                <span class='fa fa-chevron-left'></span>
                              </a>
                              <a class='right carousel-control' href='#carousel' data-slide='next'>
                                <span class='fa fa-chevron-right'></span>
                              </a>";
        }
        $header_media .= "</div>";
    } else {
        $header_media = "";
    }
    return $header_media;
}
if (!function_exists('anps_header_media_portfolio_single')) {
    function anps_header_media_portfolio_single($id, $style = 'style-1')
    {
        if (get_post_meta($id, $key = 'gallery_images', $single = true)) {
            $gallery_images = explode(",", get_post_meta($id, $key = 'gallery_images', $single = true));

            foreach ($gallery_images as $key => $item) {
                if ($item == '') {
                    unset($gallery_images[$key]);
                }
            }

            if ($style == 'style-1') {
                $header_media = "<div class='gallery'>";
                $header_media .= "<div class='gallery-inner'>";
                $j = 0;

                $atts = "rel='lightbox'";

                if (!function_exists('Responsive_Lightbox')) {
                    wp_enqueue_script('prettyphoto');
                    wp_enqueue_style('prettyphoto');
                    $atts = "class='prettyphoto' data-rel='prettyPhoto[portfolio]'";
                }

                foreach ($gallery_images as $item) {
                    $image_src = wp_get_attachment_image_src($item, "full");
                    $image_title = get_the_title($item);
                    $header_media .= "<div class='item'>";
                    $header_media .= "<a {$atts} href='" . $image_src[0] . "'>";
                    $header_media .= "<img alt='" . $image_title . "'  src='" . $image_src[0] . "'>";
                    $header_media .= "</a>";
                    $header_media .= "</div>";
                    $j++;
                }
                $header_media .= "</div>";
                $header_media .= "</div>";
            } else {
                $header_media = "<div id='carousel' class='carousel slide'>";
                if (count($gallery_images) > 1) {
                    $header_media .= "<ol class='carousel-indicators'>";
                    for ($i = 0; $i < count($gallery_images); $i++) {
                        if ($i == 0) {
                            $active_class = "active";
                        } else {
                            $active_class = "";
                        }
                        $header_media .= "<li data-target='#carousel' data-slide-to='" . $i . "' class='" . $active_class . "'></li>";
                    }
                    $header_media .= "</ol>";
                }
                $header_media .= "<div class='carousel-inner'>";
                $j = 0;
                foreach ($gallery_images as $item) {
                    $image_src = wp_get_attachment_image_src($item, "blog-full");
                    $image_title = get_the_title($item);
                    if ($j == 0) {
                        $active_class = " active";
                    } else {
                        $active_class = "";
                    }
                    $header_media .= "<div class='item$active_class'>";
                    $header_media .= "<img alt='" . $image_title . "'  src='" . $image_src[0] . "'>";
                    $header_media .= "</div>";
                    $j++;
                }
                $header_media .= "</div>";
                if (count($gallery_images) > 1) {
                    $header_media .= "<a class='left carousel-control' href='#carousel' data-slide='prev'>
                        <div class='tp-leftarrow tparrows default round'></div>
                      </a>
                      <a class='right carousel-control' href='#carousel' data-slide='next'>
                        <div class='tp-rightarrow tparrows default round'></div>
                      </a>";
                }
                $header_media .= "</div>";
            }
        } elseif (has_post_thumbnail($id)) {
            $header_media = get_the_post_thumbnail($id, "full");
        } elseif (get_post_meta($id, $key = 'anps_featured_video', $single = true)) {
            $header_media = do_shortcode(get_post_meta($id, $key = 'anps_featured_video', $single = true));
        } else {
            $header_media = "";
        }
        return $header_media;
    }
}
if (!function_exists('anps_get_header')) {
    function anps_get_header()
    {
        global $anps_page_data, $anps_options_data;
        /* Get fullscreen page option */
        $page_heading_full = '';
        if (get_option('anps_menu_type', '2') != '5' && get_option('anps_menu_type', '2') != '6') {
            $page_heading_full = get_post_meta(get_queried_object_id(), $key = 'anps_page_heading_full', $single = true);
        }
        if (is_404()) {
            $page_heading_full = get_post_meta(anps_get_option($anps_page_data, 'error_page'), $key = 'anps_page_heading_full', $single = true);
        }
        //Let's get menu type
        $anps_menu_type = '2';
        if (anps_get_option('', '0', 'vertical-menu') != '0') {
            $anps_menu_type = "2";
        } else if (is_front_page()) {
            $anps_menu_type = get_option('anps_menu_type', '2');
        }

        $anps_full_screen = get_option('anps_full_screen', '');

        $menu_type_class = ' site-header-style-normal';
        $header_position_class = '';
        $header_bg_style_class = '';
        $absoluteheader = 'false';

        $dropdown_style = ' site-header-dropdown-' . get_option('anps_dropdown_style', '1');

        //Header classes and variables
        if ($anps_menu_type == "1" || (isset($page_heading_full) && $page_heading_full == "on")) {
            $menu_type_class = "";
            $header_position_class = "";
            $header_bg_style_class = " site-header-style-transparent";
            $absoluteheader = "true";
        } elseif ($anps_menu_type == "3") {
            $menu_type_class = "";
            $header_position_class = " site-header-position-bottom";
            $header_bg_style_class = " site-header-style-transparent";
            $absoluteheader = "true";
        } elseif ($anps_menu_type == "4") {
            $menu_type_class = " site-header-style-normal";
            $header_position_class = "";
            $header_bg_style_class = "";
            $absoluteheader = "false";
        }

        if (get_option('anps_menu_type', '2') == '5') {
            $menu_type_class = " site-header-style-full-width";
            $header_position_class = "";
            $anps_menu_type = '5';
        }
        if (get_option('anps_menu_type', '2') == '6') {
            $menu_type_class = " site-header-style-boxed";
            $header_position_class = "";
            $anps_menu_type = '6';
        }

        if (get_option('anps_menu_type', '2') == '7') {
            $anps_menu_type = '7';
        }

        //Top menu style
        $topmenu_style = anps_get_option('', '1', 'topmenu_style');

        //left, right and center menu styles:
        $menu_center = get_option('anps_menu_center', 0);
        if ($menu_center == "1" && ($anps_menu_type == "2" || $anps_menu_type == "4")) {
            $menu_type_class .= " site-header-layout-center";
        } elseif ($menu_center == "2" && ($anps_menu_type == "1" || $anps_menu_type == "2" || $anps_menu_type == "3" || $anps_menu_type == "4")) {
            $menu_type_class .= " site-header-layout-menu-left";
        } else if ($anps_menu_type == "5") {
            $menu_type_class .= "";
        } else if ($anps_menu_type == "7") {
            $menu_type_class .= " site-header-layout-logo-center";
        } else {
            $menu_type_class .= " site-header-layout-normal";
        }

        //sticky menu
        $sticky_menu = anps_get_option('', '', 'sticky_menu');
        $sticky_menu_class = "";
        if ($sticky_menu == "1" || $sticky_menu == "on") {
            $sticky_menu_class = " site-header-sticky";
        }
        //if coming soon page is enabled
        $coming_soon = anps_get_option('', '0', 'coming_soon');
        if ($coming_soon == "0" || is_super_admin()) :

            //check for topmenu_style and add class depends on that value (mobile/desktop on/off)
            $hide_topmenu = '';
            if ($topmenu_style == '4') {
                $hide_topmenu = ' hidden-xs hidden-sm';
            } elseif ($topmenu_style == '2') {
                $hide_topmenu .= ' hidden-md hidden-lg';
            }
            /* Single page top bar on/off */
            $top_bar_site = get_post_meta(get_queried_object_id(), $key = 'anps_header_options_top_bar', $single = true);
            //added option for transparent top bar menu type 1 (24.2.2015)
            if (($anps_menu_type == '1' || (isset($page_heading_full) && $page_heading_full != ''))
                && ((anps_get_option('', '', 'topmenu_style') != '3' && isset($top_bar_site) && $top_bar_site != '1')
                    || (anps_get_option('', '', 'topmenu_style') == '3' && isset($top_bar_site) && $top_bar_site == '2'))
            ) :
                $top_bar_bg_color = get_option('anps_front_topbar_bg_color', '');
                $transparent_class = '';
                if ((!isset($top_bar_bg_color) || $top_bar_bg_color == '')
                    || (isset($page_heading_full) && $page_heading_full != '')
                ) {
                    $transparent_class = 'transparent ';
                } ?>
                <div class="<?php echo esc_attr($transparent_class); ?>top-bar<?php echo esc_attr($hide_topmenu); ?>"><?php anps_get_top_bar(); ?></div>
            <?php endif;
            //topmenu
            if (
                $anps_menu_type != '1'
                && ((anps_get_option('', '', 'topmenu_style') != '3' && isset($top_bar_site) && $top_bar_site != '1')
                    || (anps_get_option('', '', 'topmenu_style') == '3' && isset($top_bar_site) && $top_bar_site == '2'))
                && (!isset($page_heading_full) || $page_heading_full == '')
            ) : ?>
                <div class="top-bar<?php echo esc_attr($hide_topmenu); ?>"><?php anps_get_top_bar(); ?></div>
            <?php endif;
            // load shortcode from theme options textarea if needed
            if ($anps_menu_type == '3' || $anps_menu_type == '4') {
                echo do_shortcode($anps_full_screen);
            }

            global $anps_media_data;
            $has_sticky_class = '';

            $anps_header_styles = esc_attr($sticky_menu_class) . esc_attr($menu_type_class) . esc_attr($header_position_class) . esc_attr($header_bg_style_class) . esc_attr($has_sticky_class) . esc_attr($dropdown_style);
            /* Check for vertical */
            $is_vertical = anps_get_option($anps_options_data, 'vertical_menu') == '1';
            $header_style = '';
            if ($is_vertical) {
                $anps_header_styles = ' site-header-vertical-menu';
            }
            $header_bg_image = '';
            if (anps_get_option($anps_options_data, 'custom-header-bg-vertical') != "") {
                $header_bg_image = esc_attr(anps_get_option($anps_options_data, 'custom-header-bg-vertical'));
                $header_style = ' style= "background: transparent url(' . $header_bg_image . ') no-repeat scroll center 0 / 100% auto;"';
            }
            ?>
            <header class="site-header<?php echo esc_attr($anps_header_styles); ?><?php if (get_option('anps_main_menu_selection', '0') == '0' && !$is_vertical) {
                                                                                        echo ' site-header-divider';
                                                                                    } ?>" <?php echo esc_attr($header_style); ?>>
                <?php if (get_option('anps_menu_type', '2') == '7') : ?>
                    <div class="nav-wrap">
                        <div class="container"><?php anps_get_site_header_center(); ?>
                        </div>
                    </div>
                <?php elseif (get_option('anps_menu_type', '2') != '5' && get_option('anps_menu_type', '2') != '6' || $is_vertical) : ?>
                    <div class="nav-wrap">
                        <div class="container"><?php anps_get_site_header(); ?>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="container preheader-wrap">
                        <div class="site-logo"><?php anps_get_logo(); ?></div>
                        <?php if ((is_active_sidebar('large-above-menu')) && !$is_vertical) : ?>
                            <?php
                            $class = 'large-above-menu';

                            $class .= ' large-above-menu-style-' . get_option('anps_large_above_menu_style', '1');
                            ?>
                            <div class="<?php echo esc_attr($class); ?>"><?php do_shortcode(dynamic_sidebar('large-above-menu')); ?></div>
                        <?php endif;
                        if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
                            $shopping_cart_header = anps_get_option('', 'shop_only', 'shopping_cart_header');
                            if (($shopping_cart_header == 'shop_only' &&  is_woocommerce()) || $shopping_cart_header == 'always') {
                                echo "<div class='hidden-md hidden-lg cartwrap'>";
                                anps_woocommerce_header();
                                echo "</div>";
                            }
                        }
                        ?>
                    </div>
                    <div class="header-wrap">
                        <div class="container">
                            <?php echo anps_get_menu(); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php
                if (($is_vertical != '') && (is_active_sidebar('vertical-bottom-widget'))) : ?>
                    <div class="vertical-bottom-sidebar">
                        <div class="vertical-bottom">
                            <?php do_shortcode(dynamic_sidebar('vertical-bottom-widget')); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </header>
            <?php
            $disable_single_page = get_post_meta(get_queried_object_id(), $key = 'anps_disable_heading', $single = true);
            if (!$disable_single_page == "1" && (!isset($page_heading_full) || $page_heading_full == "")) :
                if (is_front_page() == false && anps_get_option($anps_options_data, 'disable_heading') != "1") :
                    global $anps_media_data;
                    $style = "";
                    $class = "";
                    $single_page_bg = get_post_meta(get_queried_object_id(), $key = 'heading_bg', $single = true);

                    /* Single page BG color */
                    $single_page_bg_color = get_post_meta(get_queried_object_id(), $key = 'anps_heading_bg_color', $single = true);
                    if ($single_page_bg_color != '') {
                        $single_page_bg_color = ' background-color: ' . $single_page_bg_color . ';';
                    }

                    /* Theme Options BG color */
                    $anps_heading_bg_color = get_option('anps_page_heading_bg_color', '');
                    if ($anps_heading_bg_color != '') {
                        $anps_heading_bg_color = ' background-color: ' . $anps_heading_bg_color . ';';
                    }

                    if (is_search()) {
                        if (anps_get_option($anps_media_data, 'search_heading_bg')) {
                            $style = ' style="background-image: url(' . esc_url(anps_get_option($anps_media_data, 'search_heading_bg')) . ');' . $anps_heading_bg_color . '"';
                        } elseif ($anps_heading_bg_color != '') {
                            $style = ' style="' . $anps_heading_bg_color . '"';
                        } else {
                            $class = "style-2";
                        }
                    } else if (is_404()) {
                        $error_page_bg = get_post_meta(anps_get_option($anps_page_data, 'error_page'), $key = 'heading_bg', $single = true);
                        $error_page_bg_color = get_post_meta(anps_get_option($anps_page_data, 'error_page'), $key = 'anps_heading_bg_color', $single = true);

                        if ($error_page_bg_color != '') {
                            $error_page_bg_color = ' background-color: ' . $error_page_bg_color . ';';
                        } else if ($anps_heading_bg_color != '') {
                            $error_page_bg_color = $anps_heading_bg_color;
                        }

                        $style = ' style="background-image: url(' . esc_url($error_page_bg) . ');' . $error_page_bg_color . '"';
                    } else {
                        $anps_heading_bg = anps_get_option($anps_media_data, 'heading_bg');

                        if ($single_page_bg_color != '') {
                            $anps_heading_bg_color = $single_page_bg_color;
                        }

                        if ($single_page_bg) {
                            $style = ' style="background-image: url(' . esc_url($single_page_bg) . ');' . $anps_heading_bg_color . '"';
                        } elseif ($anps_heading_bg && isset($anps_heading_bg)) {
                            $style = ' style="background-image: url(' . esc_url($anps_heading_bg) . ');' . $anps_heading_bg_color . '"';
                        } elseif ($anps_heading_bg_color != '') {
                            $style = ' style="' . $anps_heading_bg_color . '"';
                        } else {
                            $class = "style-2";
                        }
                    }

                    if (get_option('anps_title_breadcrumbs', '1') == '1') : ?>
                        <div class='page-heading <?php echo esc_attr($class); ?>' <?php echo $style; //escaped above
                                                                                    ?>>
                            <div class='container'>
                                <?php echo anps_site_title(); ?>
                                <?php if (anps_get_option($anps_options_data, 'breadcrumbs') != '1') {
                                    echo anps_the_breadcrumb();
                                } ?>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="page-header text-center page-header-sm" <?php echo $style; //escaped above 
                                                                            ?>">
                            <?php echo anps_site_title(); ?>
                        </div>
                        <?php if (anps_get_option($anps_options_data, 'breadcrumbs') != '1') : ?>
                            <div class="row breadcrumb">
                                <div class="container text-left">
                                    <?php echo anps_the_breadcrumb(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php if (isset($page_heading_full) && $page_heading_full == 'on') : ?>
                <?php
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
                    $anps_heading_bg_color = ' background-color: ' . $anps_heading_bg_color . ';';
                }
                ?>

                <?php if (get_option('anps_menu_type', '2') == '5' || get_option('anps_menu_type', '2') == '6') : ?>
                    <?php
                    $height_value = get_post_meta(get_queried_object_id(), $key = 'anps_full_height', $single = true);

                    if ($height_value) {
                        $height_value = 'height: ' . $height_value . 'px; ';
                    }
                    ?>

                    <div class="paralax-header parallax-window" data-type="background" data-speed="2" style="<?php echo esc_attr($height_value); ?>background-image: url(<?php echo esc_url($heading_value); ?>);<?php echo esc_attr($anps_heading_bg_color); ?>">
                    <?php endif; ?>

                    <div class='page-heading'>
                        <div class='container'>
                            <?php echo anps_site_title(); ?>
                            <?php if (anps_get_option($anps_options_data, 'breadcrumbs') != '1') {
                                echo anps_the_breadcrumb();
                            } ?>
                        </div>
                    </div>
                    </div>
                <?php endif; ?>
        <?php
        endif;
    }
}

/* New header type, logo in the middle */
function anps_get_site_header_center()
{
    $locations = get_theme_mod('nav_menu_locations');
        ?>
        <div class="nav-bar-wrapper nav-bar-wrapper-left">
            <nav class="site-navigation site-navigation-left">
                <?php
                $location_left = '';
                if ($locations && isset($locations['primary'])) {
                    $location_left = $locations['primary'];
                }

                $walker = '';
                $locations = get_theme_mod('nav_menu_locations');

                if ($locations && isset($locations['primary']) && $locations['primary']) {
                    $menu = $locations['primary'];
                    if ((isset($_GET['page']) && $_GET['page'] == 'one-page')) {
                        $menu = 21;
                    }
                    $walker = new description_walker();
                }

                wp_nav_menu(array(
                    'container' => false,
                    'menu_class' => 'main-menu',
                    'menu_id' => 'left-menu',
                    'echo' => true,
                    'before' => '',
                    'after' => '',
                    'link_before' => '',
                    'link_after' => '',
                    'depth' => 0,
                    'menu' => $location_left,
                    'walker' => $walker,
                ));
                ?>
            </nav>
        </div>
        <div class="site-logo"><?php anps_get_logo(); ?></div>
        <div class="nav-bar-wrapper nav-bar-wrapper-right">
            <nav class="site-navigation site-navigation-right">
                <?php
                $location_right = '';
                if ($locations && isset($locations['anps_right'])) {
                    $location_right = $locations['anps_right'];
                }
                wp_nav_menu(array(
                    'container' => false,
                    'menu_class' => 'main-menu',
                    'menu_id' => 'right-menu',
                    'echo' => true,
                    'before' => '',
                    'after' => '',
                    'link_before' => '',
                    'link_after' => '',
                    'depth' => 0,
                    'menu' => $location_right,
                    'walker' => $walker,
                ));
                ?>
            </nav>
            <?php if (anps_get_option('', '1', 'search_icon') != '' || anps_get_option('', '1', 'search_icon_mobile') != '') :
                $search_class = '';

                if (anps_get_option('', '1', 'anps_search_icon') == '') {
                    $search_class = ' hidden-md hidden-lg';
                }

                if (anps_get_option('', '1', 'search_icon_mobile') == '') {
                    $search_class = ' hidden-xs hidden-sm';
                }
            ?>
                <div class="site-search-toggle<?php echo esc_attr($search_class); ?>">
                    <button class="fa fa-search"><span class="sr-only"><?php esc_html_e('Search', 'constructo'); ?></span></button>
                    <?php if (get_option('anps_search_style', 'default') == 'minimal') : ?>
                        <?php anps_get_search_minimal(); ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php
            if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

                $shopping_cart_header = get_option('shopping_cart_header', 'shop_only');
                if (($shopping_cart_header == 'shop_only' &&  is_woocommerce()) || $shopping_cart_header == 'always') {
                    echo "<div class='show-md cartwrap'>";
                    anps_woocommerce_header();
                    echo "</div>";
                }
            } ?>
            <button class="navbar-toggle" type="button">
                <span class="sr-only"><?php _e('Toggle navigation', 'constructo'); ?></span>
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
        </div>
    <?php
}

function anps_page_full_screen_style()
{
    $full_color_top_bar = get_post_meta(get_queried_object_id(), $key = 'anps_full_color_top_bar', $single = true);
    $full_color_title = get_post_meta(get_queried_object_id(), $key = 'anps_full_color_title', $single = true);
    $full_hover_color = get_post_meta(get_queried_object_id(), $key = 'anps_full_hover_color', $single = true);
    if (!isset($full_color_top_bar) || $full_color_top_bar == "") {
        $top_bar_color = get_option("top_bar_color");
    } else {
        $top_bar_color = $full_color_top_bar;
    }
    if (!isset($full_color_title) || $full_color_title == "") {
        $title_color = get_option("menu_text_color");
    } else {
        $title_color = $full_color_title;
    }
    if (!isset($full_hover_color) || $full_hover_color == "") {
        $hover_color = get_option("hovers_color");
    } else {
        $hover_color = $full_hover_color;
    }
    ?>
        <style>
            .paralax-header>.page-heading .breadcrumbs li a::after,
            .paralax-header>.page-heading h1,
            .paralax-header>.page-heading ul.breadcrumbs,
            .paralax-header>.page-heading ul.breadcrumbs a,
            .site-navigation>ul>li.menu-item>a,
            .woo-header-cart .cart-contents>i {
                color: <?php echo esc_attr($title_color); ?>;
            }

            .transparent.top-bar,
            .transparent.top-bar a {
                color: <?php echo esc_attr($top_bar_color); ?>;
            }

            .transparent.top-bar a:hover,
            .paralax-header>.page-heading ul.breadcrumbs a:hover,
            .site-navigation>ul>li.current-menu-item>a,
            .site-navigation>ul>li.menu-item>a:hover {
                color: <?php echo esc_attr($hover_color); ?>;
            }

            @media (min-width: 992px) {
                .nav-wrap:not(.sticky) .fa-search {
                    color: <?php echo esc_attr($title_color); ?>;
                }
            }
        </style>

        <?php
    }

    function anps_site_title()
    {
        get_template_part('includes/site_title');
    }

    function anps_append_unit($value, $unit = 'px')
    {
        return intval($value) . '' === $value ? esc_html("{$value}{$unit}") : esc_html($value);
    }

    function anps_get_mobile_logo()
    {
        global $anps_media_data;

        $style = anps_style_attr(array(
            'height' => anps_append_unit(get_option('anps_logo_mobile_height', '33')),
            'width'  => anps_append_unit(get_option('anps_logo_mobile_width', '158')),
        ));

        if (anps_get_option($anps_media_data, 'logo_mobile') != '') : ?>
            <img<?php echo strip_tags($style); ?> class="logo-mobile" alt="<?php bloginfo('name'); ?>" src="<?php echo esc_url(anps_get_option($anps_media_data, 'logo_mobile')); ?>">
            <?php else : ?>
                <img<?php echo strip_tags($style); ?> class="logo-mobile" alt="<?php bloginfo('name'); ?>" src="<?php echo esc_url(anps_get_option($anps_media_data, 'logo')); ?>">
                <?php endif;
        }

        function anps_get_sticky_logo()
        {
            global $anps_media_data;

            $style = anps_style_attr(array(
                'height' => anps_append_unit(get_option('anps_sticky-logo-height', '33')),
                'width'  => anps_append_unit(get_option('anps_sticky-logo-width', '158')),
            ));

            if (anps_get_option($anps_media_data, 'sticky_logo') != '') : ?>
                    <img<?php echo strip_tags($style); ?> class="logo-sticky" alt="Site logo" src="<?php echo esc_url(anps_get_option($anps_media_data, 'sticky_logo')); ?>">
                    <?php endif;
            }

            /* Breadcrumbs */
            if (!function_exists('anps_the_breadcrumb')) {
                function anps_the_breadcrumb()
                {
                    global $anps_page_data, $post;
                    $return_val = "<ul class='breadcrumbs'>";

                    $return_val .= '<li><a href="' . home_url() . '">' . __("Home", 'constructo') . '</a></li>';
                    if (is_home() && !is_front_page()) {
                        $return_val .= "<li>" . get_the_title(get_option('page_for_posts')) . "</li>";
                    } else {
                        if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) && is_woocommerce()) {
                            $return_val = "<ul class='breadcrumbs'>";
                            ob_start();
                            woocommerce_breadcrumb();
                            $return_val .= ob_get_clean();
                        } elseif (is_category() || is_single()) {
                            if (is_single()) {
                                if (get_post_type() != "portfolio" && get_post_type() != "post") {
                                    $obj = get_post_type_object(get_post_type());
                                    if ($obj->has_archive) {
                                        $return_val .= '<li><a href="' . get_post_type_archive_link(get_post_type()) . '">' . $obj->labels->name . '</a></li>';
                                    }
                                    $return_val .= '<li>' . get_the_title() . '</li>';
                                } else {
                                    $custom_breadcrumbs = get_post_meta(get_the_ID(), $key = 'custom_breadcrumbs', $single = true);
                                    if ($custom_breadcrumbs != "" && $custom_breadcrumbs != "0") {
                                        $return_val .= "<li><a href='" . get_permalink($custom_breadcrumbs) . "'>" . get_the_title($custom_breadcrumbs) . "</a></li>";
                                    }
                                    $return_val .= "<li>" . get_the_title() . "</li>";
                                }
                            }
                        } elseif (is_page()) {
                            if (isset($post->post_parent) && ($post->post_parent != 0 || $post->post_parent != "")) {
                                $parent_id  = $post->post_parent;
                                while ($parent_id) {
                                    $page = get_page($parent_id);
                                    $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
                                    $parent_id  = $page->post_parent;
                                }
                                for ($i = count($breadcrumbs); $i >= 0; $i--) {
                                    $return_val .= isset($breadcrumbs[$i]) ? $breadcrumbs[$i] : null;
                                }
                                $return_val .= "<li>" . get_the_title() . "</li>";
                            } else {
                                $return_val .= "<li>" . get_the_title() . "</li>";
                            }
                        } elseif (is_archive()) {
                            if (is_author()) {
                                $author = get_the_author_meta('display_name', get_query_var("author"));
                                $return_val .= "<li>" . $author . "</li>";
                            } elseif (is_tag()) {
                                $cat = get_tag(get_queried_object_id());
                                $return_val .= "<li>" . $cat->name . "</li>";
                            } else {
                                if (get_post_type() == 'post') {
                                    $return_val .= "<li>" . __("Archives for", 'constructo') . " " . get_the_date('F') . ' ' . get_the_date('Y') . "</li>";
                                } else {
                                    $obj = get_post_type_object(get_post_type());
                                    if ($obj->has_archive) {
                                        $return_val .= '<li><a href="' . get_post_type_archive_link(get_post_type()) . '">' . $obj->labels->name . '</a></li>';
                                    }
                                }
                            }
                        } else {
                            if (get_search_query() != "") {
                            } else {
                                if (isset($anps_page_data['error_page']) && $anps_page_data['error_page'] != '' && $anps_page_data['error_page'] != '0') {
                                    query_posts('post_type=page&p=' . $anps_page_data['error_page']);

                                    while (have_posts()) {
                                        the_post();
                                        $return_val .= "<li>" . get_the_title() . "</li>";
                                    }

                                    wp_reset_query();
                                } else {
                                    $return_val .= "<li>" . __("Error 404", 'constructo') . "</li>";
                                }
                            }
                        }
                    }
                    if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) && is_woocommerce()) {
                    } elseif (single_cat_title("", false) != "" && !is_tag()) {
                        $return_val .= "<li>" . single_cat_title("", false) . "</li>";
                    }
                    $return_val .= "</ul>";
                    return $return_val;
                }
            }
            /* search container */
            function anps_get_search_minimal()
            {
                    ?>
                    <div class="site-search-minimal">
                        <form role="search" method="get" class="site-search-minimal__form" action="<?php echo esc_url(home_url('/')); ?>">
                            <input name="s" type="text" class="site-search-minimal__input" placeholder="<?php _e("type and press &#8216;enter&#8217;", 'constructo'); ?>">
                        </form>
                    </div>
                <?php
            }
            function anps_get_search()
            {
                ?>
                    <div class="container">
                        <form role="search" method="get" class="site-search-form" action="<?php echo esc_url(home_url('/')); ?>">
                            <input name="s" type="text" class="site-search-input" placeholder="<?php _e("type and press &#8216;enter&#8217;", 'constructo'); ?>">
                        </form>
                        <button class="site-search-close">&times;</button>
                    </div>
                <?php
            }
            /* top bar menu */
            function anps_get_top_bar()
            {
                if (is_active_sidebar('top-bar-left') || is_active_sidebar('top-bar-right')) {
                    echo '<div class="container">';
                    echo '<div class="top-bar-left">';
                    do_shortcode(dynamic_sidebar('top-bar-left'));
                    echo '</div>';
                    echo '<div class="top-bar-right">';
                    do_shortcode(dynamic_sidebar('top-bar-right'));
                    echo '</div>';
                    echo '</div>';
                }
                ?>
                    <button class="top-bar-close">
                        <i class="fa fa-chevron-down"></i>
                        <span class="sr-only"><?php _e('Close top bar', 'constructo'); ?></span>
                    </button>
                    <?php
                }

                /* Style attribute helper functions */
                function anps_style_bg_color($color)
                {
                    return anps_style_attr(array('background-color' => $color));
                }

                function anps_style_color($color)
                {
                    return anps_style_attr(array('color' => $color));
                }

                function anps_style_attr($styles)
                {
                    $return = '';

                    foreach ($styles as $property => $value) {
                        if ($value !== '') {
                            $return .= $property . ': ' . $value . '; ';
                        }
                    }

                    if ($return !== '') {
                        $return = ' style="' . $return . '"';
                    }

                    return $return;
                }

                function anps_body_style()
                {
                    global $anps_options_data;

                    if (anps_get_option($anps_options_data, 'pattern') == '0' && anps_get_option($anps_options_data, 'boxed') == '1') {
                        if (anps_get_option($anps_options_data, 'type') == "custom color") {
                            echo ' style="background-color: ' . esc_attr(anps_get_option($anps_options_data, 'bg_color')) . ';"';
                        } else if (anps_get_option($anps_options_data, 'type') == "stretched") {
                            echo ' style="background: url(' . esc_url(anps_get_option($anps_options_data, 'custom_pattern')) . ') center center fixed;background-size: cover;     -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"';
                        } else {
                            echo ' style="background: url(' . esc_url(anps_get_option($anps_options_data, 'custom_pattern')) . ')"';
                        }
                    }
                }
                function anps_theme_after_styles()
                {
                    if (is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply');

                    get_template_part("includes/shortcut_icon");
                }
                /* Return site logo */
                if (!function_exists('anps_get_logo')) {
                    function anps_get_logo()
                    {
                        global $anps_media_data, $anps_options_data;
                        $first_page_logo = get_option('anps_front_logo', '');
                        $menu_type = get_option('anps_menu_type');
                        $page_heading_full = get_post_meta(get_queried_object_id(), $key = 'anps_page_heading_full', $single = true);
                        $full_screen_logo = get_post_meta(get_queried_object_id(), $key = 'anps_full_screen_logo', $single = true);
                        $text_logo = get_option('anps_text_logo', '');
                        $size_sticky = array(120, 120);
                        if (!$size_sticky) {
                            $size_sticky = array(120, 120);
                        }
                        $logo_width = '158';
                        $logo_height = '33';
                        if (anps_get_option($anps_media_data, 'logo-width') != '') {
                            $logo_width = anps_append_unit(anps_get_option($anps_media_data, 'logo-width'));
                        }

                        if (anps_get_option($anps_media_data, 'logo-height') != '') {
                            $logo_height = anps_append_unit(anps_get_option($anps_media_data, 'logo-height'));
                        }
                        if (get_option('auto_adjust_logo', 'on') != '') {
                            $logo_height = 'auto';
                            $logo_width = 'auto';
                        }

                        echo '<a href="' . esc_url(home_url("/")) . '">';
                        if (anps_get_option($anps_options_data, 'vertical_menu') != '1') {
                            anps_get_sticky_logo();
                        }

                        anps_get_mobile_logo();

                        if (isset($page_heading_full) && $page_heading_full == "on" && isset($full_screen_logo) && $full_screen_logo != "0") : ?>
                            <img class="logo-desktop" style="width: <?php echo esc_attr($logo_width); ?>; height: <?php echo esc_attr($logo_height); ?>" alt="Site logo" src="<?php echo esc_url($full_screen_logo); ?>">
                            <?php else :
                            if (($menu_type == 1 || $menu_type == 3) && $first_page_logo && (is_front_page())) : ?>
                                <img class="logo-desktop" style="width: <?php echo esc_attr($logo_width); ?>; height: <?php echo esc_attr($logo_height); ?>" alt="Site logo" src="<?php echo esc_url($first_page_logo); ?>">
                            <?php
                            elseif (anps_get_option($anps_media_data, 'logo') != '') : ?>
                                <img class="logo-desktop" style="width: <?php echo esc_attr($logo_width); ?>; height: <?php echo esc_attr($logo_height); ?>" alt="Site logo" src="<?php echo esc_url(anps_get_option($anps_media_data, 'logo')); ?>">
                            <?php elseif (isset($text_logo) && $text_logo != '') : ?>
                                <?php echo str_replace('\\"', '"', $text_logo); ?></a>
                            <?php else : ?>
                                <img class="logo-desktop" style="width: <?php echo esc_attr($logo_width); ?>; height: <?php echo esc_attr($logo_height); ?>" alt="Site logo" src="http://anpsthemes.com/constructo/wp-content/uploads/2014/12/constructo-logoV4.png">
                    <?php endif;
                        endif;
                        echo '</a>';
                    }
                }
                /* Tags and author */
                function anps_tagsAndAuthor()
                {
                    ?>
                    <div class="tags-author">
                        <?php echo __('posted by', 'constructo'); ?> <?php echo get_the_author(); ?>
                        <?php
                        $posttags = get_the_tags();
                        if ($posttags) {
                            echo " &nbsp;|&nbsp; ";
                            echo __('Taged as', 'constructo') . " - ";
                            $first_tag = true;
                            foreach ($posttags as $tag) {
                                if (!$first_tag) {
                                    echo ', ';
                                }
                                echo '<a href="' . esc_url(home_url('/')) . 'tag/' . esc_html($tag->slug) . '/">';
                                echo esc_html($tag->name);
                                echo '</a>';
                                $first_tag = false;
                            }
                        }
                        ?>
                    </div>
                    <?php
                }
                /* Gravatar */
                add_filter('avatar_defaults', 'anps_newgravatar');
                function anps_newgravatar($avatar_defaults)
                {
                    $myavatar = get_template_directory_uri() . '/images/move_default_avatar.jpg';
                    $avatar_defaults[$myavatar] = "Anps default avatar";
                    return $avatar_defaults;
                }
                /* Get post thumbnail src */
                function anps_get_the_post_thumbnail_src($img)
                {
                    return (preg_match('~\bsrc="([^"]++)"~', $img, $matches)) ? $matches[1] : '';
                }
                if (!function_exists('anps_get_menu')) {
                    function anps_get_menu()
                    {
                        $menu_center = anps_get_option('', '', 'menu_center');
                        if (isset($_GET['header']) && $_GET['header'] == 'type-3') {
                            $menu_center = 'on';
                        }

                        $menu_description = '';
                        $menu_style = anps_get_option('', '1', 'menu_style');
                        if (isset($_GET['header']) && $_GET['header'] == 'type-2') {
                            $menu_style = '2';
                        }

                        if ($menu_style == '2') {
                            $menu_description = ' description';
                        }
                        global $anps_options_data;
                        //above nav bar && single above nav bar
                        $above_nav_bar = get_option('anps_above_nav_bar', '');
                        $above_nav_bar_site = get_post_meta(get_queried_object_id(), $key = 'anps_header_options_above_menu', $single = true);

                        /* Max mega menu */
                        $menu_class = 'site-navigation';
                        if (class_exists('Mega_Menu')) {
                            $menu_class = '';
                        }
                        /* END Max mega menu */

                    ?>
                        <div class="nav-bar-wrapper">
                            <div class="nav-bar">
                                <?php if ((($above_nav_bar == '1' && isset($above_nav_bar_site) && $above_nav_bar_site != '1') || ($above_nav_bar == '0' && isset($above_nav_bar_site) && $above_nav_bar_site == '2'))
                                    && (is_active_sidebar('above-navigation-bar'))
                                    && (anps_get_option($anps_options_data, 'vertical_menu') == '')
                                    && (get_option('anps_menu_type', '2') != '5' && get_option('anps_menu_type', '2') != '6')
                                ) : ?>
                                    <div class="above-nav-bar">
                                        <?php do_shortcode(dynamic_sidebar('above-navigation-bar')); ?>
                                    </div>
                                <?php endif; ?>
                                <nav class="<?php echo esc_attr($menu_class); ?><?php echo esc_attr($menu_description); ?>">
                                    <?php
                                    $locations = get_theme_mod('nav_menu_locations');
                                    /* Check if menu is selected */
                                    $walker = '';
                                    $menu = '';
                                    $locations = get_theme_mod('nav_menu_locations');

                                    if ($locations && isset($locations['primary']) && $locations['primary']) {
                                        $menu = $locations['primary'];
                                        if ((isset($_GET['page']) && $_GET['page'] == 'one-page')) {
                                            $menu = 21;
                                        }
                                        if (get_option('anps_global_menu_walker', '1') != '') {
                                            $walker = new description_walker();
                                        }
                                    }
                                    $check_for_menu = wp_get_nav_menu_items($menu);
                                    if (empty($check_for_menu)) {
                                        echo '<p class="nav-empty">' . esc_html__('No menu items found.', 'constructo') . '</p>';
                                    } else {
                                        wp_nav_menu(array(
                                            'container' => false,
                                            'menu_class' => '',
                                            'echo' => true,
                                            'before' => '',
                                            'after' => '',
                                            'link_before' => '',
                                            'link_after' => '',
                                            'depth' => 0,
                                            'walker' => $walker,
                                            'menu' => $menu,
                                            'theme_location' => 'primary'
                                        ));
                                    }
                                    ?>
                                </nav>
                                <?php if (anps_get_option('', '1', 'search_icon') != '' || anps_get_option('', '1', 'search_icon_mobile') != '') :
                                    $search_class = '';

                                    if (anps_get_option('', '1', 'anps_search_icon') == '') {
                                        $search_class = ' hidden-md hidden-lg';
                                    }

                                    if (anps_get_option('', '1', 'search_icon_mobile') == '') {
                                        $search_class = ' hidden-xs hidden-sm';
                                    }
                                ?>
                                    <div class="site-search-toggle<?php echo esc_attr($search_class); ?>">
                                        <button class="fa fa-search"><span class="sr-only"><?php esc_html_e('Search', 'constructo'); ?></span></button>
                                        <?php if (get_option('anps_search_style', 'default') == 'minimal') : ?>
                                            <?php anps_get_search_minimal(); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif;
                                if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
                                    $shopping_cart_header = anps_get_option('', 'shop_only', 'shopping_cart_header');
                                    if (($shopping_cart_header == 'shop_only' &&  is_woocommerce()) || $shopping_cart_header == 'always') {
                                        echo "<div class='show-md cartwrap'>";
                                        anps_woocommerce_header();
                                        echo "</div>";
                                    }
                                } ?>
                                <button class="navbar-toggle" type="button">
                                    <span class="sr-only"><?php _e('Toggle navigation', 'constructo'); ?></span>
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                </button>
                            </div>
                            <?php if (get_option('anps_menu_type', '2') == '6' && get_option('anps_menu_button') == 1 && anps_get_option($anps_options_data, 'vertical_menu') != '1') : ?>
                                <a href="<?php echo get_option('anps_menu_button_url', '#'); ?>" class="menu-button">
                                    <?php echo get_option('anps_menu_button_text', 'button'); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php
                    }
                }
                if (!function_exists('anps_get_site_header')) {
                    function anps_get_site_header()
                    {
                        $menu_center = anps_get_option('', '', 'menu_center');
                        if (isset($_GET['header']) && $_GET['header'] == 'type-3') {
                            $menu_center = 'on';
                        }
                    ?>

                        <div class="site-logo"><?php anps_get_logo(); ?></div>
                    <?php anps_get_menu();
                    }
                }
                add_filter("the_content", "anps_the_content_filter");
                function anps_the_content_filter($content)
                {
                    // array of custom shortcodes requiring the fix
                    $block = join("|", array("recent_blog", "section", "contact", "form_item", "services", "service", "tabs", "tab", "accordion", "accordion_item", "progress", "quote", "statement", "color", "google_maps", "vimeo", "youtube", "contact_info", "contact_info_item", "logos", "logo", "button", "error_404", "icon", "icon_group", "content_half", "content_third", "content_two_third", "content_quarter", "content_two_quarter", "content_three_quarter", "twitter", "social_icons", "social_icon", "data_tables", "data_thead", "data_tbody", "data_tfoot", "data_row", "data_th", "data_td", "testimonials", "testimonial"));
                    // opening tag
                    $rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content);
                    // closing tag
                    $rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep);

                    return $rep;
                }
                /* Post gallery */

                // Add new image sizes
                function anps_insert_custom_image_sizes($image_sizes)
                {
                    // get the custom image sizes
                    global $_wp_additional_image_sizes;
                    // if there are none, just return the built-in sizes
                    if (empty($_wp_additional_image_sizes))
                        return $image_sizes;

                    // add all the custom sizes to the built-in sizes
                    foreach ($_wp_additional_image_sizes as $id => $data) {
                        // take the size ID (e.g., 'my-name'), replace hyphens with spaces,
                        // and capitalise the first letter of each word
                        if (!isset($image_sizes[$id]))
                            $image_sizes[$id] = ucfirst(str_replace('-', ' ', $id));
                    }

                    return $image_sizes;
                }
                add_filter('image_size_names_choose', 'anps_insert_custom_image_sizes');


                //depreciated, left for reference
                //add_filter( 'post_gallery', 'anps_my_post_gallery', 10, 2 );
                function anps_my_post_gallery($output, $attr)
                {
                    global $post, $wp_locale;
                    static $instance = 0;
                    $instance++;
                    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
                    if (isset($attr['orderby'])) {
                        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
                        if (!$attr['orderby'])
                            unset($attr['orderby']);
                    }
                    extract(shortcode_atts(array(
                        'order'      => 'ASC',
                        'orderby'    => 'menu_order ID',
                        'id'         => $post->ID,
                        'itemtag'    => 'dl',
                        'icontag'    => 'dt',
                        'captiontag' => 'dd',
                        'columns'    => 3,
                        'size'       => 'thumbnail',
                        'include'    => '',
                        'exclude'    => ''
                    ), $attr));

                    $id = intval($id);
                    if ('RAND' == $order)
                        $orderby = 'none';
                    if (!empty($include)) {
                        $include = preg_replace('/[^0-9,]+/', '', $include);
                        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
                        $attachments = array();
                        foreach ($_attachments as $key => $val) {
                            $attachments[$val->ID] = $_attachments[$key];
                        }
                    } elseif (!empty($exclude)) {
                        $exclude = preg_replace('/[^0-9,]+/', '', $exclude);
                        $attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
                    } else {
                        $attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
                    }
                    if (empty($attachments))
                        return '';
                    if (is_feed()) {
                        $output = "\n";
                        foreach ($attachments as $att_id => $attachment)
                            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
                        return $output;
                    }

                    $size = 100 / $columns;

                    $output = '<div class="gallery recent-posts clearfix">';
                    foreach ($attachments as $id => $attachment) {
                        $image_full = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_image_src($id, 'full', false) : wp_get_attachment_image_src($id, 'full', false);
                        $image_full = $image_full[0];

                        $image_thumb = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_image_src($id, 'post-thumb', false) : wp_get_attachment_image_src($id, 'post-thumb', false);
                        $image_thumb = $image_thumb[0];

                        $output .= '
            <article class="post col-md-3" style="width: ' . $size . '%;">
                <header>
                    <a rel="lightbox" class="post-hover" href="' . $image_full . '">
                        <img src="' . $image_thumb . '" alt="blog-8m">
                    </a>
                </header>
            </article>';
                    }
                    $output .= '</div>';
                    return $output;
                }
                //get post_type
                function get_current_post_type()
                {
                    if (is_admin()) {
                        global $post, $typenow, $current_screen;
                        //we have a post so we can just get the post type from that
                        if ($post && $post->post_type)
                            return $post->post_type;
                        //check the global $typenow - set in admin.php
                        elseif ($typenow)
                            return $typenow;
                        //check the global $current_screen object - set in sceen.php
                        elseif ($current_screen && $current_screen->post_type)
                            return $current_screen->post_type;
                        //lastly check the post_type querystring
                        elseif (isset($_REQUEST['post_type']))
                            return sanitize_key($_REQUEST['post_type']);
                        elseif (isset($_REQUEST['post']))
                            return get_post_type($_REQUEST['post']);
                        //we do not know the post type!
                        return null;
                    }
                }
                /* hide sidebar generator on testimonials and portfolio */
                if (get_current_post_type() != 'testimonials') {
                    if (function_exists('anps_portfolio')) {
                        //add sidebar generator
                        include_once WP_PLUGIN_DIR . '/anps_theme_plugin/meta/sidebar_generator.php';
                    }
                }
                function anps_admin_save_buttons()
                {
                    ?>
                    <div class="content-top" style="border-style: solid none; margin-top: 70px">
                        <input type="submit" value="<?php esc_html_e("Save all changes", 'constructo'); ?>">
                        <div class="clear"></div>
                    </div>
                    <div class="submit-right">
                        <button type="submit" class="fixsave fixed fontawesome"><i class="fa fa-floppy-o"></i></button>
                        <div class="clear"></div>
                        <?php
                    }
                    /* Admin/backend styles */
                    add_action('admin_head', 'backend_styles');
                    function backend_styles()
                    {
                        echo '<style type="text/css">
        .mceListBoxMenu {
            height: auto !important;
        }
        .wp_themeSkin .mceListBoxMenu {
            overflow: visible;
            overflow-x: visible;
        }
    </style>';
                    }
                    add_action('admin_head', 'show_hidden_customfields');
                    function show_hidden_customfields()
                    {
                        echo "<input type='hidden' value='" . get_template_directory_uri() . "' id='hidden_url'/>";
                    }
                    if (!function_exists('anps_admin_header_style')) :
                        /*
     * Styles the header image displayed on the Appearance > Header admin panel.
     * Referenced via add_custom_image_header() in widebox_setup().
     */
                        function anps_admin_header_style()
                        {
                        ?>
                            <style type="text/css">
                                /* Shows the same border as on front end */
                                #headimg {
                                    border-bottom: 1px solid #000;
                                    border-top: 4px solid #000;
                                }
                            </style>
                        <?php
                        }
                    endif;
                    /* Filter wp title */
                    add_filter('wp_title', 'anps_filter_wp_title', 10, 2);
                    function anps_filter_wp_title($title, $separator)
                    {
                        // Don't affect wp_title() calls in feeds.
                        if (is_feed())
                            return $title;
                        // The $paged global variable contains the page number of a listing of posts.
                        // The $page global variable contains the page number of a single post that is paged.
                        // We'll display whichever one applies, if we're not looking at the first page.
                        global $paged, $page;
                        if (is_search()) {
                            // If we're a search, let's start over:
                            $title = sprintf(__('Search results for %s', 'constructo'), '"' . get_search_query() . '"');
                            // Add a page number if we're on page 2 or more:
                            if ($paged >= 2)
                                $title .= " $separator " . sprintf(__('Page %s', 'constructo'), $paged);
                            // Add the site name to the end:
                            $title .= " $separator " . get_bloginfo('name', 'display');
                            // We're done. Let's send the new title back to wp_title():
                            return $title;
                        }
                        // Otherwise, let's start by adding the site name to the end:
                        $title .= get_bloginfo('name', 'display');
                        // If we have a site description and we're on the home/front page, add the description:
                        $site_description = get_bloginfo('description', 'display');
                        if ($site_description && (is_home() || is_front_page()))
                            $title .= " $separator " . $site_description;

                        // Add a page number if necessary:
                        if ($paged >= 2 || $page >= 2)
                            $title .= " $separator " . sprintf(__('Page %s', 'constructo'), max($paged, $page));
                        // Return the new title to wp_title():
                        return $title;
                    }
                    /* Page menu show home */
                    add_filter('wp_page_menu_args', 'anps_page_menu_args');
                    function anps_page_menu_args($args)
                    {
                        $args['show_home'] = true;
                        return $args;
                    }
                    /* Sets the post excerpt length to 40 characters. */
                    add_filter('excerpt_length', 'anps_excerpt_length');
                    function anps_excerpt_length($length)
                    {
                        return 40;
                    }
                    /* Returns a "Continue Reading" link for excerpts */
                    function anps_continue_reading_link()
                    {
                        return ' <a href="' . get_permalink() . '">' . __('Continue reading <span class="meta-nav">&rarr;</span>', 'constructo') . '</a>';
                    }
                    /* Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and widebox_continue_reading_link(). */
                    add_filter('excerpt_more', 'anps_auto_excerpt_more');
                    function anps_auto_excerpt_more($more)
                    {
                        return ' &hellip;' . anps_continue_reading_link();
                    }
                    /* Adds a pretty "Continue Reading" link to custom post excerpts. */
                    add_filter('get_the_excerpt', 'anps_custom_excerpt_more');
                    function anps_custom_excerpt_more($output)
                    {
                        if (has_excerpt() && !is_attachment()) {
                            $output .= anps_continue_reading_link();
                        }
                        return $output;
                    }
                    /* Remove inline styles printed when the gallery shortcode is used. */
                    add_filter('gallery_style', 'anps_remove_gallery_css');
                    function anps_remove_gallery_css($css)
                    {
                        return preg_replace("#<style type='text/css'>(.*?)</style>#s", '', $css);
                    }
                    /* Prints HTML with meta information for the current post-date/time and author. */
                    if (!function_exists('widebox_posted_on')) :
                        function widebox_posted_on()
                        {
                            printf(__('<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'constructo'), 'meta-prep meta-prep-author', sprintf('<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>', get_permalink(), esc_attr(get_the_time()), get_the_date()), sprintf('<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>', get_author_posts_url(get_the_author_meta('ID')), sprintf(esc_attr__('View all posts by %s', 'constructo'), get_the_author()), get_the_author()));
                        }
                    endif;
                    /* Prints HTML with meta information for the current post (category, tags and permalink).*/
                    if (!function_exists('widebox_posted_in')) :
                        function widebox_posted_in()
                        {
                            // Retrieves tag list of current post, separated by commas.
                            $tag_list = get_the_tag_list('', ', ');
                            if ($tag_list) {
                                $posted_in = __('This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'constructo');
                            } elseif (is_object_in_taxonomy(get_post_type(), 'category')) {
                                $posted_in = __('This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'constructo');
                            } else {
                                $posted_in = __('Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'constructo');
                            }
                            // Prints the string, replacing the placeholders.
                            printf($posted_in, get_the_category_list(', '), $tag_list, get_permalink(), the_title_attribute('echo=0'));
                        }
                    endif;
                    /* After setup theme */
                    add_action('after_setup_theme', 'anps_setup');
                    if (!function_exists('anps_setup')) :
                        function anps_setup()
                        {
                            // This theme styles the visual editor with editor-style.css to match the theme style.
                            add_editor_style();
                            // This theme uses post thumbnails
                            add_theme_support('post-thumbnails');
                            // Add default posts and comments RSS feed links to head
                            add_theme_support('automatic-feed-links');
                            // Make theme available for translation
                            // Translations can be filed in the /languages/ directory
                            load_theme_textdomain('constructo', get_template_directory() . '/languages');
                            $locale = get_locale();
                            $locale_file = get_template_directory() . "/languages/$locale.php";
                            if (is_readable($locale_file))
                                require_once($locale_file);
                            // This theme uses wp_nav_menu() in one location.
                            if (get_option('anps_menu_type', 2) == 7) {
                                register_nav_menus(array(
                                    'primary' => esc_html__('Left Navigation', 'constructo'),
                                    'anps_right' => esc_html__('Right Navigation', 'constructo'),
                                ));
                            } else {
                                register_nav_menus(array(
                                    'primary' => esc_html__('Primary Navigation', 'constructo'),
                                ));
                            }

                            set_post_thumbnail_size(190, 54, true);

                            // Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
                            register_default_headers(array(
                                'berries' => array(
                                    'url' => '%s/images/headers/logo.png',
                                    'thumbnail_url' => '%s/images/headers/logo.png',
                                    /* translators: header image description */
                                    'description' => __('Move default logo', 'constructo')
                                )
                            ));
                            if (!isset($_GET['stylesheet']))
                                $_GET['stylesheet'] = '';
                            $theme = wp_get_theme($_GET['stylesheet']);
                            if (!isset($_GET['activated']))
                                $_GET['activated'] = '';
                            if ($_GET['activated'] == 'true' && $theme->get_template() == 'widebox132') {

                                $arr = array(
                                    0 => array('label' => 'e-mail', 'input_type' => 'text', 'is_required' => 'on', 'placeholder' => 'email', 'validation' => 'email'),
                                    1 => array('label' => 'subject', 'input_type' => 'text', 'is_required' => 'on', 'placeholder' => 'subject', 'validation' => 'none'),
                                    2 => array('label' => 'contact number', 'input_type' => 'text', 'is_required' => '', 'placeholder' => 'contact number', 'validation' => 'phone'),
                                    3 => array('label' => 'lorem ipsum', 'input_type' => 'text', 'is_required' => '', 'placeholder' => 'lorem ipsum', 'validation' => 'none'),
                                    4 => array('label' => 'message', 'input_type' => 'textarea', 'is_required' => 'on', 'placeholder' => 'message', 'validation' => 'none'),
                                );
                                update_option('anps_contact', $arr);
                            }
                        }
                    endif;
                    /* theme options init */
                    add_action('admin_init', 'anps_theme_options_init');
                    function anps_theme_options_init()
                    {
                        register_setting('sample_options', 'sample_theme_options');
                    }
                    /* If user is admin, he will see theme options */
                    add_action('admin_menu', 'anps_theme_options_add_page');
                    function anps_theme_options_add_page()
                    {
                        global $current_user;
                        if ($current_user->user_level == 10) {
                            add_theme_page('Theme Options', 'Theme Options', 'read', 'theme_options', 'theme_options_do_page');
                        }
                    }
                    function theme_options_do_page()
                    {
                        include_once "admin_view.php";
                    }
                    /* Comments */
                    function anps_comment($comment, $args, $depth)
                    {
                        $email = $comment->comment_author_email;
                        $user_id = -1;
                        if (email_exists($email)) {
                            $user_id = email_exists($email);
                        }
                        $GLOBALS['comment'] = $comment;
                        // time difference
                        $today = new DateTime(date("Y-m-d H:i:s"));
                        $pastDate = $today->diff(new DateTime(get_comment_date("Y-m-d H:i:s")));
                        if ($pastDate->y > 0) {
                            if ($pastDate->y == "1") {
                                $text = __("year ago", 'constructo');
                            } else {
                                $text = __("years ago", 'constructo');
                            }
                            $comment_date = $pastDate->y . " " . $text;
                        } elseif ($pastDate->m > 0) {
                            if ($pastDate->m == "1") {
                                $text = __("month ago", 'constructo');
                            } else {
                                $text = __("months ago", 'constructo');
                            }
                            $comment_date = $pastDate->m . " " . $text;
                        } elseif ($pastDate->d > 0) {
                            if ($pastDate->d == "1") {
                                $text = __("day ago", 'constructo');
                            } else {
                                $text = __("days ago", 'constructo');
                            }
                            $comment_date = $pastDate->d . " " . $text;
                        } elseif ($pastDate->h > 0) {
                            if ($pastDate->h == "1") {
                                $text = __("hour ago", 'constructo');
                            } else {
                                $text = __("hours ago", 'constructo');
                            }
                            $comment_date = $pastDate->h . " " . $text;
                        } elseif ($pastDate->i > 0) {
                            if ($pastDate->i == "1") {
                                $text = __("minute ago", 'constructo');
                            } else {
                                $text = __("minutes ago", 'constructo');
                            }
                            $comment_date = $pastDate->i . " " . $text;
                        } elseif ($pastDate->s > 0) {
                            if ($pastDate->s == "1") {
                                $text = __("second ago", 'constructo');
                            } else {
                                $text = __("seconds ago", 'constructo');
                            }
                            $comment_date = $pastDate->s . " " . $text;
                        }
                        ?>
                        <li <?php comment_class(); ?>>
                            <article id="comment-<?php comment_ID(); ?>">
                                <header>
                                    <h1><?php comment_author(); ?></h1>
                                    <span class="date"><?php echo esc_html($comment_date); ?></span>
                                    <?php echo comment_reply_link(array('depth' => $depth, 'max_depth' => $args['max_depth'])); ?>
                                </header>
                                <div class="comment-content"><?php comment_text(); ?></div>
                            </article>
                        </li>
                    <?php }
                    add_filter('comment_reply_link', 'replace_reply_link_class');
                    function replace_reply_link_class($class)
                    {
                        $class = str_replace("class='comment-reply-link", "class='comment-reply-link btn", $class);
                        return $class;
                    }
                    /* Remove Excerpt text */
                    function sbt_auto_excerpt_more($more)
                    {
                        return '...';
                    }
                    add_filter('excerpt_more', 'sbt_auto_excerpt_more', 20);
                    function sbt_custom_excerpt_more($output)
                    {
                        return preg_replace('/<a[^>]+>Continue reading.*?<\/a>/i', '', $output);
                    }
                    add_filter('get_the_excerpt', 'sbt_custom_excerpt_more', 20);
                    function anps_getFooterTwitter()
                    {
                        $twitter_user = get_option('footer_twitter_acc', 'twitter');
                        $settings = array(
                            'oauth_access_token' => "1485322933-3Xfq0A59JkWizyboxRBwCMcnrIKWAmXOkqLG5Lm",
                            'oauth_access_token_secret' => "aFuG3JCbHLzelXCGNmr4Tr054GY5wB6p1yLd84xdMuI",
                            'consumer_key' => "D3xtlRxe9M909v3mrez3g",
                            'consumer_secret' => "09FiAL70fZfvHtdOJViKaKVrPEfpGsVCy0zKK2SH8E"
                        );
                        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
                        $getfield = '?screen_name=' . $twitter_user . '&count=1';
                        $requestMethod = 'GET';
                        $twitter = new TwitterAPIExchange($settings);
                        $twitter_json = $twitter->setGetfield($getfield)
                            ->buildOauth($url, $requestMethod)
                            ->performRequest();
                        $twitter_json = json_decode($twitter_json, true);
                        $twitter_user_url = "https://twitter.com/" . $twitter_user;
                        $twitter_text = $twitter_json[0]["text"];
                        $twitter_tweet_url = "https://twitter.com/" . $twitter_user . "/status/" . $twitter_json[0]["id_str"];
                    ?>
                        <div class="twitter-footer">
                            <div class="container"><a href="<?php echo esc_url($twitter_user_url); ?>" target="_blank" class="tw-icon"></a><a href="<?php echo esc_url($twitter_user_url); ?>" target="_blank" class="tw-heading"><?php _e("twitter feed", 'constructo'); ?></a><a href="<?php echo esc_url($twitter_tweet_url); ?>" target="_blank" class="tw-content"><?php echo esc_html($twitter_text); ?></a></div>
                        </div>
                    <?php
                    }
                    function get_excerpt()
                    {
                        $excerpt = get_the_content();
                        $excerpt = preg_replace(" (\[.*?\])", '', $excerpt);
                        $excerpt = strip_shortcodes($excerpt);
                        $excerpt = strip_tags($excerpt);
                        $excerpt = substr($excerpt, 0, 100);
                        $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
                        $excerpt = trim(preg_replace('/\s+/', ' ', $excerpt));
                        if ($excerpt != "") {
                            $excerpt = $excerpt . '...';
                        }
                        return $excerpt;
                    }
                    add_filter('widget_tag_cloud_args', 'set_cloud_tag_size');
                    function set_cloud_tag_size($args)
                    {
                        $args['smallest'] = 12;
                        $args['largest'] = 12;
                        return $args;
                    }
                    function anps_boxed()
                    {
                        global $anps_options_data;
                        if (anps_get_option($anps_options_data, 'boxed') != '') {
                            return ' boxed';
                        }
                    }

                    function anps_boxed_or_vertical()
                    {
                        global $anps_options_data;
                        $anps_classes = "";
                        if (anps_get_option($anps_options_data, 'boxed') != '') {
                            $anps_classes .= ' boxed';
                        }
                        if (anps_get_option($anps_options_data, 'vertical_menu') != '') {
                            $anps_classes .= ' vertical-menu';
                        }
                        return $anps_classes;
                    }

                    /* Custom font extenstion */

                    function anps_getExtCustomFonts($font)
                    {
                        $dir = get_template_directory() . '/fonts';
                        if ($handle = opendir($dir)) {
                            $arr = array();
                            // Get all files and store it to array
                            while (false !== ($entry = readdir($handle))) {
                                $explode_font = explode('.', $entry);
                                if (strtolower($font) == strtolower($explode_font[0]))
                                    $arr[] = $entry;
                            }
                            closedir($handle);
                            // Remove . and ..
                            unset($arr['.'], $arr['..']);
                            return $arr;
                        }
                    }
                    if (!function_exists('anps_footer')) {
                        function anps_footer()
                        {
                            $class = '';
                            if (get_option('anps_footer_parallax', '') != '') {
                                $class = ' footer-parallax';
                            }

                            return $class;
                        }
                    }
                    /* Check for header/footer margin */
                    if (!function_exists('anps_header_margin')) {
                        function anps_header_margin()
                        {
                            $class = '';
                            $header_margin = get_post_meta(get_queried_object_id(), $key = 'anps_header_options_header_margin', $single = true);
                            $footer_margin = get_post_meta(get_queried_object_id(), $key = 'anps_header_options_footer_margin', $single = true);
                            if (isset($header_margin) && $header_margin == 'on') {
                                $class .= ' header-spacing-off';
                            }
                            if (isset($footer_margin) && $footer_margin == 'on') {
                                $class .= ' footer-spacing-off';
                            }
                            return $class;
                        }
                    }

                    /* Load custom font (CSS) */

                    function anps_custom_font($font)
                    {
                        $font_family = esc_attr($font);
                        $font_src    = get_template_directory_uri() . '/fonts/' . $font_family . '.eot';
                        $font_count  = count(anps_getExtCustomFonts($font));
                        $i           = 0;
                        $prefix      = 'url("' . get_template_directory_uri() . '/fonts/';
                        $font_srcs   = '';

                        foreach (anps_getExtCustomFonts($font) as $item) {
                            $explode_item = explode('.', $item);

                            $name = $explode_item[0];
                            $extension = $explode_item[1];
                            $separator = ',';

                            if (++$i == $font_count) {
                                $separator = ';';
                            }

                            switch ($extension) {
                                case 'eot':
                                    $font_srcs .= $prefix . $name . '.eot?#iefix") format("embedded-opentype")' . $separator;
                                    break;
                                case 'woff':
                                    $font_srcs .= $prefix . $name . '.woff") format("woff")' . $separator;
                                    break;
                                case 'otf':
                                    $font_srcs .= $prefix . $name . '.otf") format("opentype")' . $separator;
                                    break;
                                case 'ttf':
                                    $font_srcs .= $prefix . $name . '.ttf") format("ttf")' . $separator;
                                    break;
                                case 'woff2':
                                    $font_srcs .= $prefix . $name . '.woff2") format("woff2")' . $separator;
                                    break;
                            }
                        } /* end foreach */
                    ?>
                        @font-face {
                        font-family: "<?php echo esc_attr($font_family); ?>";
                        src: url("<?php echo esc_url($font_src); ?>");
                        src: <?php echo $font_srcs; ?>
                        }
                    <?php
                    }

                    function anps_homepage_spacing()
                    {
                        global $post;
                        if (in_array('revslider/revslider.php', apply_filters('active_plugins', get_option('active_plugins'))) && has_shortcode($post->post_content, 'rev_slider')) {
                            return ' header-spacing-off';
                        }
                    }

                    include('custom_styles.php');
