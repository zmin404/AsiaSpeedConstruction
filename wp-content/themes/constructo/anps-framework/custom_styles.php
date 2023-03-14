<?php
/* Custom styles */

function anps_custom_styles() {
    /* Font Default Values */

    $font_1 = "Montserrat";
    $font_2 = 'PT Sans';
    $font_3 = "Montserrat";

    /* Font 1 */

    if( get_option('font_source_1') == 'System fonts' ||
        get_option('font_source_1') == 'Custom fonts' ||
        get_option('font_source_1') == 'Google fonts' ) {

        $font_1 = urldecode(get_option('font_type_1'));
    }

    if( get_option('font_source_1') == 'Custom fonts' ) {
        anps_custom_font($font_1);
    }

    /* Font 2 */

    if( get_option('font_source_2') == 'System fonts' ||
        get_option('font_source_2') == 'Custom fonts' ||
        get_option('font_source_2') == 'Google fonts' ) {

        $font_2 = urldecode(get_option('font_type_2'));
    }

    if( get_option('font_source_2') == 'Custom fonts' ) {
        anps_custom_font($font_2);
    }

    /* Font 3 (navigation) */

    if( get_option('font_source_navigation') == 'System fonts' ||
        get_option('font_source_navigation') == 'Custom fonts' ||
        get_option('font_source_navigation') == 'Google fonts' ) {

        $font_3 = urldecode(get_option('font_type_navigation'));
    }

    if( get_option('font_source_navigation') == 'Custom fonts' ) {
        anps_custom_font($font_3);
    }

    /* Logo font */
    $logo_font = urldecode(get_option('anps_text_logo_font'));

    if( get_option('anps_text_logo_source_1') == 'Custom fonts' ) {
        anps_custom_font($logo_font);
    }

    /* Main Theme Colors */

    $text_color = anps_get_option('', '#727272', 'text_color');
    $primary_color = anps_get_option('', '#292929', 'primary_color');
    $hovers_color = anps_get_option('', '#d54900', 'hovers_color');
    $headings_color = anps_get_option('', '#000000', 'headings_color');
    $main_divider_color = get_option('anps_main_divider_color', '#d54900');
    $side_submenu_background_color = anps_get_option('', '', 'side_submenu_background_color');
    $side_submenu_text_color = anps_get_option('', '', 'side_submenu_text_color');
    $side_submenu_text_hover_color = anps_get_option('', '', 'side_submenu_text_hover_color');

    /* Header Colors */

    $menu_text_color = anps_get_option('', '#000', 'menu_text_color');
    $top_bar_color = anps_get_option('', '#c1c1c1', 'top_bar_color');
    $top_bar_bg_color = anps_get_option('', '#f9f9f9', 'top_bar_bg_color');
    $nav_background_color = anps_get_option('', '#fff', 'nav_background_color');
    $submenu_background_color = anps_get_option('', '#fff', 'submenu_background_color');
    $anps_submenu_divider_color = get_option('anps_submenu_divider_color', '#ececec');
    $curent_menu_color = get_option('anps_curent_menu_color', '#d54900');
    $submenu_text_color = anps_get_option('', '#000', 'submenu_text_color');
    $anps_woo_cart_items_number_bg_color = get_option('anps_woo_cart_items_number_bg_color', $primary_color);
    $anps_woo_cart_items_number_color = get_option('anps_woo_cart_items_number_color', '#fff');
    $anps_logo_bg_color = get_option('anps_logo_bg_color', '');
    $anps_above_menu_bg_color = get_option('anps_above_menu_bg_color', '');
    $anps_heading_bg_color = get_option('anps_page_heading_bg_color', '');
    $page_heading_color = get_option('anps_page_heading_text_color', $headings_color);

    /* Footer Colors */

    $footer_bg_color = anps_get_option('', '#242424', 'footer_bg_color');
    $footer_text_color = anps_get_option('', '#d9d9d9', 'footer_text_color');
    $anps_heading_text_color = get_option('anps_heading_text_color', '#fff');
    $footer_selected_color = get_option('anps_footer_selected_color', '');
    $footer_hover_color = get_option('anps_footer_hover_color', '');
    $footer_divider_color = get_option('anps_footer_divider_color', '#fff');
    $copyright_footer_text_color = get_option('anps_copyright_footer_text_color', '#c4c4c4');
    $copyright_footer_bg_color = anps_get_option('', '#0f0f0f', 'copyright_footer_bg_color');

    /* Home Page Colors*/

    $anps_front_text_color = get_option('anps_front_text_color', '');
    $anps_front_text_hover_color = get_option('anps_front_text_hover_color');
    $anps_front_curent_menu_color = get_option('anps_front_curent_menu_color');
    $anps_front_bg_color = get_option('anps_front_bg_color');
    $anps_front_topbar_color = get_option('anps_front_topbar_color', '#fff');
    $anps_front_topbar_hover_color = get_option('anps_front_topbar_hover_color', '#d54900');
    $anps_front_topbar_bg_color = get_option('anps_front_topbar_bg_color', '');

    /* Font Size */

    $body_font_size = anps_get_option('', '14', 'body_font_size');
    $menu_font_size = anps_get_option('', '14', 'menu_font_size');
    $submenu_font_size = get_option('anps_submenu_font_size', '12');
    $h1_font_size = anps_get_option('', '31', 'h1_font_size');
    $h2_font_size = anps_get_option('', '24', 'h2_font_size');
    $h3_font_size = anps_get_option('', '21', 'h3_font_size');
    $h4_font_size = anps_get_option('', '18', 'h4_font_size');
    $h5_font_size = anps_get_option('', '16', 'h5_font_size');
    $page_heading_h1_font_size = anps_get_option('', '24', 'page_heading_h1_font_size');
    $blog_heading_h1_font_size = anps_get_option('', '28', 'blog_heading_h1_font_size');
    $top_bar_font_size = get_option('anps_top_bar_font_size', '14');
    $anps_portfolio_title_font_size = get_option('anps_portfolio_title_font_size', '16');

    /* Container width */
    $container_width = get_option('anps_container_width', '1170');
?>
body,
ol.list > li > *,
.recent-portfolio--modern-1 .recent-portfolio__excerpt,
.testimonial-modern__link,
.testimonial-modern__link:hover,
.testimonial-modern__link:focus,
.product_meta span span,
.f-content__content {
  color: <?php echo esc_attr($text_color); ?>;
}

@media (min-width: <?php echo esc_attr($container_width) + 30; ?>px) {
    .container {
      width: <?php echo esc_attr($container_width); ?>px;
    }

    .site-header-layout-normal .nav-bar-wrapper {
      width: <?php echo esc_attr($container_width) - 30; ?>px;
    }
}

/* Header colors */

.top-bar, .top-bar a {
    font-size: <?php echo esc_attr($top_bar_font_size);?>px;
}

@media(min-width: 992px) {
    .site-header-style-boxed,
    .site-header-style-full-width {
        background-color: <?php echo esc_attr($anps_above_menu_bg_color); ?>;
    }

    .woo-header-cart .cart-contents > i,
    .nav-wrap .site-search-toggle button,
    .nav-bar .site-search-toggle button {
        color: <?php echo esc_attr($menu_text_color); ?>;
    }

    .site-navigation a,
    .home .site-header-sticky-active .site-navigation .menu-item-depth-0 > a:not(:hover):not(:focus),
    .paralax-header .site-header-style-transparent.site-header-sticky-active .site-navigation .menu-item-depth-0 > a:not(:hover):not(:focus),
    .nav-empty {
      color: <?php echo esc_attr($menu_text_color); ?>;
    }

    .menu-button {
      color: <?php echo esc_attr($menu_text_color); ?> !important;
    }
}

.site-header-style-normal .nav-wrap {
  background-color: <?php echo esc_attr($nav_background_color); ?>;
}

@media(min-width: 992px) {
  .site-navigation .sub-menu {
    background-color: <?php echo esc_attr($submenu_background_color); ?>;
  }

  .site-navigation .sub-menu a {
    color: <?php echo esc_attr($submenu_text_color); ?>;
  }
}

.heading-left.divider-sm span:before,
.heading-middle.divider-sm span:before,
.heading-middle span:before,
.heading-left span:before,
.divider-modern:not(.heading-content) span:after,
.recent-portfolio__title::after,
.portfolio-modern__title::after,
.rp-modern__header::after {
  background-color: <?php echo esc_attr($main_divider_color); ?>;
}

.site-navigation .current-menu-item > a:not(:focus):not(:hover),
.home .site-navigation .current-menu-item > a:not(:focus):not(:hover),
.home .site-header.site-header-sticky-active .menu-item-depth-0.current-menu-item > a:not(:focus):not(:hover) {
   color: <?php echo esc_attr($curent_menu_color); ?> !important;
}

@media(min-width: 992px) {
    .site-search-toggle button:hover, .site-search-toggle button:focus, .site-navigation ul:not(.sub-menu) > li > a:hover,
    .site-navigation ul:not(.sub-menu) > li > a:focus {
        color: <?php echo esc_attr($hovers_color); ?>;
    }

  /* Boxed header style background color */
  .site-header-style-boxed .nav-bar-wrapper {
    background-color: <?php echo esc_attr($anps_front_bg_color); ?>;
  }
}

@media(max-width: 991px) {
  .site-search-toggle button:hover, .site-search-toggle button:focus,
  .navbar-toggle:hover, .navbar-toggle:focus {
    background-color: <?php echo esc_attr($hovers_color); ?>;
  }

  .site-search-toggle button,
  .navbar-toggle {
    background-color: <?php echo esc_attr($primary_color); ?>;
  }
}

<?php if( get_option('anps_menu_type', '2') == 1 || get_option('anps_menu_type', '2') == 3 ): ?>
/* Front Colors (transparent menus) */

@media(min-width: 992px) {
  .home .site-navigation .menu-item-depth-0 > a, .home header:not(.site-header-sticky-active) .site-search-toggle button:not(:hover):not(:focus),
  .nav-empty {
    color: <?php echo esc_attr($anps_front_text_color); ?>;
  }

  .home .site-navigation ul:not(.sub-menu) > li > a,
  .home .nav-empty,
  .home header:not(.site-header-sticky-active) .woo-header-cart .cart-contents > i,
  .home header:not(.site-header-sticky-active) .site-search-toggle button {
      color: <?php echo esc_attr($anps_front_text_color); ?>;
    }

    .home .site-header .menu-item-depth-0.current-menu-item > a {
        color: <?php echo esc_attr($anps_front_curent_menu_color); ?> !important;
    }

    .home .site-search-toggle button:focus,
    .home .site-search-toggle button:hover {
        color: <?php echo esc_attr($anps_front_text_hover_color); ?>;
    }
}

.home .site-header .menu-item-depth-0 > a:hover,
.home .site-header .menu-item-depth-0 > a:focus {
  color: <?php echo esc_attr($anps_front_text_hover_color); ?>;
}

.site-navigation a:hover,
.site-navigation a:focus,
.site-navigation .current-menu-item > a,
.home .site-navigation ul:not(.sub-menu) > li > a:hover,
.home .site-navigation ul:not(.sub-menu) > li > a:focus,
.home header:not(.site-header-sticky-active) .site-search-toggle button:hover {
  color: <?php echo esc_attr($anps_front_text_hover_color); ?>;
}
<?php else: ?>
/* Front-Global Colors */

.site-header-style-normal .nav-wrap {
  background-color: <?php echo esc_attr($anps_front_bg_color); ?>;
}

@media(min-width: 992px) {
  .site-header-style-full-width.site-header-sticky-active .header-wrap,
  .site-header-style-full-width .header-wrap {
    background-color: <?php echo esc_attr($anps_front_bg_color); ?>;
  }
}
<?php endif; ?>

/* Top bar colors */

.top-bar {
  background-color: <?php echo esc_html($top_bar_bg_color); ?>;
  color: <?php echo esc_html($top_bar_color); ?>;
}
<?php if( is_front_page() && $anps_front_topbar_color != '' && (get_option('anps_menu_type', '2') == 1 || get_option('anps_menu_type', '2') == 3) ): ?>
    .top-bar a:not(:hover) {
        color: <?php echo esc_html($anps_front_topbar_color); ?>;
    }
<?php else: ?>
    .top-bar a:not(:hover) {
        color: <?php echo esc_html($top_bar_color); ?>;
    }
<?php endif; ?>
<?php if( is_front_page() && $anps_front_topbar_hover_color != '' && (get_option('anps_menu_type', '2') == 1 || get_option('anps_menu_type', '2') == 3) ): ?>
  .top-bar a:hover,
  .top-bar a:focus {
    color: <?php echo esc_html($anps_front_topbar_hover_color); ?> !important;
  }

  .top-bar {
    color: <?php echo esc_html($anps_front_topbar_color); ?>;
  }

  .top-bar {
    background-color: <?php echo esc_html($anps_front_topbar_bg_color); ?>;
  }
<?php endif; ?>

<?php //top bar font size ?>
.top-bar, .top-bar a {
    font-size: <?php echo esc_attr(get_option('anps_top_bar_font_size', '14'));?>px;
}

/* Top bar height */
<?php
$anps_top_bar_height = get_option('anps_top_bar_height', '60');
if ($anps_top_bar_height == '') {
   $anps_top_bar_height = 60;
}
?>
@media(min-width: 992px) {
    .top-bar,
    .top-bar > .container {
        height: <?php echo esc_html($anps_top_bar_height);?>px;
    }

    /* Menu divider */

    .site-header:not(.site-header-vertical-menu) .site-navigation > ul > li:after {
        <?php
            if(get_option('anps_menu_dividers', '1') == '') {
                echo 'display: none';
            }
        ?>
    }
}

/* Main menu height */

<?php
$anps_menu_height = get_option('anps_main_menu_height', '');
$anps_above_menu_height = get_option('anps_above_menu_height', '');

if($anps_menu_height != '') : ?>
    @media(min-width: 992px) {
        <?php // header type 1  ?>
        .transparent.top-bar + .site-header-style-transparent:not(.site-header-sticky-active) .nav-wrap {
            height: <?php echo esc_attr($anps_menu_height, 'auto');?>px;
            max-height: <?php echo esc_attr($anps_menu_height, 'auto');?>px;
        }
        <?php // header type 2, 3, 4  ?>
        .site-header-style-normal:not(.site-header-sticky-active) .nav-wrap,
        .site-header-style-transparent:not(.site-header-sticky-active) .nav-wrap {
            height: <?php echo esc_attr($anps_menu_height, 'auto');?>px;
            max-height: <?php echo esc_attr($anps_menu_height, 'auto');?>px;
            transition: height .3s ease-out;
        }

        <?php // header type 5, 6  ?>
        .site-header-style-full-width .nav-bar-wrapper,
        .site-header-style-boxed .nav-bar,
        .site-header-style-full-width .cartwrap {
            height: <?php echo esc_attr($anps_menu_height, 'auto');?>px;
        }

        .site-header-style-full-width .menu-item-depth-0 > a,
        .site-header-style-boxed .menu-item-depth-0 > a,
        .site-header-style-full-width .site-search-toggle button,
        .site-header-style-boxed .site-search-toggle button,
        .site-header-style-full-width .cart-contents,
        .site-header-style-boxed .menu-button {
            line-height: <?php echo esc_attr($anps_menu_height, 'auto');?>px;
        }

        <?php // above menu  ?>
        .site-header-style-full-width .preheader-wrap, .site-header-style-boxed .preheader-wrap {
            height: <?php echo esc_attr($anps_above_menu_height, 'auto');?>px;
        }
        .site-header-style-full-width .site-logo:after, .site-header-style-boxed .site-logo:after {
            border-top: <?php echo esc_attr($anps_above_menu_height, 'auto');?>px solid currentColor;
        }

        .site-header-style-boxed .site-logo,
        .site-header-style-boxed .large-above-menu {
            padding-bottom: <?php echo esc_attr($anps_menu_height, 'auto') / 2;?>px;
        }
    }
<?php endif; ?>

/* logo bg color */
<?php if (isset($anps_logo_bg_color) && $anps_logo_bg_color != "" && get_option('anps_logo_background') == '1') :?>
    @media(min-width: 992px) {
        .site-header .site-logo {
            color: <?php echo esc_attr($anps_logo_bg_color);?>
        }
    }
<?php endif;?>

@media (min-width: 992px) {
    .site-header-dropdown-2 .sub-menu .menu-item + .menu-item > a::before,
    .site-header-dropdown-3 .sub-menu .menu-item + .menu-item > a::before {
        background-color: <?php echo esc_attr($anps_submenu_divider_color);?>;
    }
}
/* Footer */

.site-footer {
  background: <?php echo esc_attr($footer_bg_color); ?>;
}
.site-footer .copyright-footer {
  color: <?php echo esc_attr($copyright_footer_text_color); ?>;
  background: <?php echo esc_attr($copyright_footer_bg_color); ?>;
}

footer.site-footer .copyright-footer > .container:before,
.site-footer.style-4 .working-hours td::after, .site-footer.style-4 .working-hours th::after {
    background: <?php echo esc_attr($footer_divider_color); ?>;
}

.site-footer.style-4 .tagcloud a,
.site-footer.style-4 .menu-item {
    border-color: <?php echo esc_attr($footer_divider_color); ?>;
}

.site-footer, .site-footer h3, .site-footer h4, .site-wrap .site-footer .recentcomments a,
.site-wrap .site-footer caption, .site-wrap .site-footer th, .site-wrap .site-footer span, .site-wrap .site-footer cite,
.site-wrap .site-footer strong, .site-wrap .site-footer #today {
  color: <?php echo esc_attr($footer_text_color); ?> !important;
}

.site-footer .row .menu .current_page_item > a,
.site-footer.style-4 .working-hours td {
    color: <?php echo esc_attr($footer_selected_color); ?>;
}

.site-footer .row a:hover,
.site-footer .row a:focus,
.site-footer.style-4 .menu-item a::before,
.site-footer.style-4 .social a,
.site-footer.style-4 .socialize a {
    color: <?php echo esc_attr($footer_hover_color); ?> !important;
}

.site-footer.style-4 .widget-title::after {
    background-color: <?php echo esc_attr($footer_hover_color); ?>;
}

.site-footer.style-4 .tagcloud a:hover,
.site-footer.style-4 .tagcloud a:focus {
    border-color: <?php echo esc_attr($footer_hover_color); ?>;
}

.site-footer .row .widget-title {
    color: <?php echo esc_attr($anps_heading_text_color);?>
}

a,
.btn-link,
.icon.style-2 .fa,
.error-404 h2,
.page-heading,
.statement .style-3,
.dropcaps.style-2:first-letter,
.list li:before,
ol.list,
.post.style-2 header > span,
.post.style-2 header .fa,
.page-numbers span,
.nav-links span,
.team .socialize a,
blockquote.style-2:before,
.panel-group.style-2 .panel-title a:before,
.contact-info .fa,
blockquote.style-1:before,
.comment-list .comment header h1,
.faq .panel-title a.collapsed:before,
.faq .panel-title a:after,
.faq .panel-title a,
.filter button.selected,
.filter:before,
.primary,
.search-posts i,
.counter .counter-number,
#wp-calendar th,
#wp-calendar caption,
.testimonials blockquote p:before,
.testimonials blockquote p:after,
.heading-left span:before,
.heading-middle span:before,
.price,
.widget-price,
.star-rating,
section.container .widget_shopping_cart .quantity,
.tab-pane .commentlist .meta strong, .woocommerce-tabs .commentlist .meta strong,
.widget_recent_comments .recentcomments a {
  color: <?php echo esc_attr($primary_color); ?>;
}

.testimonials.white blockquote p:before,
.testimonials.white blockquote p:after {
  color: #fff;
}

.counter .wrapbox {
  border-color:<?php echo esc_attr($primary_color); ?>;
}

body .tp-bullets.simplebullets.round .bullet.selected {
  border-color: <?php echo esc_attr($primary_color); ?>;
}

.carousel-indicators li.active,
.ls-michell .ls-bottom-slidebuttons a.ls-nav-active {
  border-color: <?php echo esc_attr($primary_color); ?> !important;
}

.icon .fa,
.posts div a,
.progress-bar,
.nav-tabs > li.active:after,
.vc_tta-style-anps_tabs .vc_tta-tabs-list > li.vc_active:after,
section.container .menu li.current-menu-item .sub-menu a,
section.container .menu li.current-menu-ancestor .sub-menu a,
.pricing-table header,
.mark,
.post .post-meta button,
blockquote.style-2:after,
.panel-style-1 .panel-title a:before,
.carousel-indicators li,
.carousel-indicators .active,
.ls-michell .ls-bottom-slidebuttons a,
.twitter .carousel-indicators li,
.twitter .carousel-indicators li.active,
#wp-calendar td a,
body .tp-bullets.simplebullets.round .bullet,
.site-search,
.onsale,
.plus, .minus,
.widget_price_filter .ui-slider .ui-slider-range,
.woo-header-cart .cart-contents > span,
.form-submit #submit,
.testimonials blockquote header:before,
div.woocommerce-tabs ul.tabs li.active:before ,
mark,
.woocommerce-product-gallery__trigger {
  background-color: <?php echo esc_attr($primary_color); ?>;
}

.testimonials.white blockquote header:before {
   background-color: #fff;
}

h1, h2, h3, h4, h5, h6,
.nav-tabs > li > a,
.nav-tabs > li.active > a,
.vc_tta-tabs-list > li > a span,
.statement,
.page-heading a,
.page-heading a:after,
p strong,
.dropcaps:first-letter,
.page-numbers a,
.nav-links a,
.searchform,
.searchform input[type="text"],
.socialize a,
.widget_rss .rss-date,
.widget_rss cite,
.panel-title,
.panel-group.style-2 .panel-title a.collapsed:before,
blockquote.style-1,
.comment-list .comment header,
.faq .panel-title a:before,
.faq .panel-title a.collapsed,
.filter button,
.carousel .carousel-control,
#wp-calendar #today,
.woocommerce-result-count,
input.qty,
.product_meta,
.woocommerce-review-link,
.woocommerce-before-loop .woocommerce-ordering:after,
.widget_price_filter .price_slider_amount .button,
.widget_price_filter .price_label,
section.container .product_list_widget li h4 a,
.shop_table.table thead th,
.shop_table.table tfoot,
.product-single-header .variations label,
.tab-pane .commentlist .meta, .woocommerce-tabs .commentlist .meta,
.f-content__title,
.icon-m__title,
table.table > thead th,
.recent-portfolio__title,
a:hover .recent-portfolio__title,
a:focus .recent-portfolio__title,
.portfolio-modern__title,
a:hover .portfolio-modern__title,
a:focus .portfolio-modern__title {
  color: <?php echo esc_attr($headings_color); ?>;
}

.ls-michell .ls-nav-next,
.ls-michell .ls-nav-prev {
  color:#fff;
}

.contact-form input[type="text"]:focus,
.contact-form textarea:focus {
  border-color: <?php echo esc_attr($headings_color); ?> !important;
}

.pricing-table header h2,
.mark.style-2,
.btn.dark,
.twitter .carousel-indicators li,
.added_to_cart {
  background-color: <?php echo esc_attr($headings_color); ?>;
}

.price_slider_wrapper .ui-widget-content {
    background-color: #ececec;
}

body,
.alert .close,
.post header,
#lang_sel_list a.lang_sel_sel, #lang_sel_list ul a, #lang_sel_list_list ul a:visited,
.widget_icl_lang_sel_widget #lang_sel ul li ul li a, .widget_icl_lang_sel_widget #lang_sel a,
.heading-subtitle {
   font-family: <?php echo esc_attr($font_2);?>;
   <?php if($font_2 === 'Montserrat'): ?>
       font-weight: 500;
   <?php endif; ?>
}

<?php if( $logo_font ): ?>
.site-logo {
    font-family: <?php echo esc_attr($logo_font); ?>;
}
<?php endif; ?>

h1, h2, h3, h4, h5, h6,
.btn,
.woocommerce-page .button,
.page-heading,
.team em,
blockquote.style-1,
.onsale,
.added_to_cart,
.price,
.widget-price,
.woocommerce-review-link,
.product_meta,
.tab-pane .commentlist .meta, .woocommerce-tabs .commentlist .meta,
.wpcf7-submit,
.f-content__title,
.icon-m__title,
.icon-m__link,
button.single_add_to_cart_button,
.important,
.shipping-calculator-button {
  font-family: <?php echo esc_attr($font_1); ?>;
  <?php if($font_1 === 'Montserrat'): ?>
      font-weight: 500;
  <?php endif; ?>
}

.nav-tabs > li > a,
.site-navigation > ul a,
.menu-button,
.vc_tta-tabs-list > li > a,
.tp-arr-titleholder,
.above-nav-bar.top-bar ul li {
    font-family: <?php echo esc_attr($font_3);?>;
    <?php if($font_3 === 'Montserrat'): ?>
        font-weight: 500;
    <?php endif; ?>
}

.pricing-table header h2,
.pricing-table header .price,
.pricing-table header .currency,
.table thead,
h1.style-3,
h2.style-3,
h3.style-3,
h4.style-3,
h5.style-3,
h6.style-3,
.page-numbers a,
.page-numbers span,
.nav-links a,
.nav-links span,
.alert,
.comment-list .comment header,
.woocommerce-result-count,
.product_list_widget li > a,
.product_list_widget li p.total strong,
.cart_list + .total,
.shop_table.table tfoot,
.product-single-header .variations label {
  font-family: <?php echo esc_attr($font_1);?>;
  <?php if($font_1 === 'Montserrat'): ?>
      font-weight: 500;
  <?php endif; ?>
}

.site-search #searchform-header input[type="text"] {
 font-family: <?php echo esc_attr($font_1);?>;
 <?php if($font_1 === 'Montserrat'): ?>
     font-weight: 500;
 <?php endif; ?>
}

/*Top Bar*/

.testimonials.carousel .white ~ .carousel-control:hover,
.testimonials.carousel .white ~ .carousel-control:focus {
 color:  <?php echo esc_attr($hovers_color); ?> !important;
}

/*testimonials*/

.testimonials blockquote p {
  border-bottom: 1px solid <?php echo esc_attr($primary_color); ?>;
}
.testimonials.white blockquote p {
  border-bottom: 1px solid #fff;
}

div.testimonials blockquote.item.active p,
.testimonials blockquote cite {
color: <?php echo esc_attr($primary_color); ?>;
}

div.testimonials.white blockquote.item.active p,
div.testimonials.white blockquote.item.active cite a,
div.testimonials.white blockquote.item.active cite, .wpb_content_element .widget .tagcloud a,
div.testimonials.white blockquote.item p,
div.testimonials.white blockquote.item cite,
.testimonials.carousel .white ~ .carousel-control {
    color: #fff;
}

a:hover, a:focus,
.a:hover,
.site-header a:hover,
.icon a:hover h2,
.nav-tabs > li > a:hover,
.top-bar a:hover,
.page-heading a:hover,
.menu a:hover,
.menu .is-active a,
.page-numbers a:hover,
.nav-links a:hover,
.widget-categories a:hover,
.product-categories a:hover,
.widget_archive a:hover,
.widget_categories a:hover,
.widget_recent_entries a:hover,
.socialize a:hover,
.faq .panel-title a.collapsed:hover,
.carousel .carousel-control:hover,
a:hover h1, a:hover h2, a:hover h3, a:hover h4, a:hover h5,
.ls-michell .ls-nav-next:hover,
.ls-michell .ls-nav-prev:hover,
body .tp-leftarrow.default:hover,
body .tp-rightarrow.default:hover,
.product_list_widget li h4 a:hover,
.cart-contents:hover i,
.icon.style-2 a:hover .fa,
.team .socialize a:hover,
.recentblog header a:hover h2,
.scrollup a:hover,
.hovercolor, i.hovercolor, .post.style-2 header i.hovercolor.fa,
article.post-sticky header:before,
.wpb_content_element .widget a:hover,
.star-rating,
.menu .current_page_item > a,
.vc_tta-tab:hover > a > span,
.page-numbers.current,
.widget_layered_nav a:hover,
.widget_layered_nav a:focus,
.widget_layered_nav .chosen a,
.widget_layered_nav_filters a:hover,
.widget_layered_nav_filters a:focus,
.widget_rating_filter .star-rating:hover,
.widget_rating_filter .star-rating:focus,
.icon-m__link,
.bg-primary,
.logos .owl-nav > *:hover,
.logos .owl-nav > *:focus,
.testimonials-modern .owl-nav > *:hover,
.testimonials-modern .owl-nav > *:focus,
.rp-modern__icon {
  color: <?php echo esc_attr($hovers_color); ?>;
}

.filter button.selected {
  color: <?php echo esc_attr($hovers_color); ?>!important;
}

.logos--style-3 .logos__wrap:hover,
.logos--style-3 .logos__wrap:focus,
.logos--style-5 .logos__wrap:hover,
.logos--style-5 .logos__wrap:focus,
.scrollup a:hover,
.panel-style-3 .panel-heading a,
.gallery-fs .owl-item a:hover:after, .gallery-fs .owl-item a:focus:after, .gallery-fs .owl-item a.selected:after, blockquote:not([class]) p, .blockquote-style-1 p, .blockquote-style-2 p, .featured-content, .post-minimal-wrap {
  border-color: <?php echo esc_attr($hovers_color); ?>;
}

.site-footer:not(.style-4) .tagcloud a:hover,
.twitter .carousel-indicators li:hover,
.added_to_cart:hover,
.icon a:hover .fa,
.posts div a:hover,
#wp-calendar td a:hover,
.plus:hover, .minus:hover,
.widget_price_filter .price_slider_amount .button:hover,
.form-submit #submit:hover,
.anps_download > a span.anps_download_icon,
.onsale,
.woo-header-cart .cart-contents > span,
.woocommerce-product-gallery__trigger:hover,
.woocommerce-product-gallery__trigger:focus,
.f-content__icon,
.f-content__divider,
.icon-m__media,
.panel-style-3 .panel-heading a,
.logos .owl-dot:hover,
.logos .owl-dot:focus,
.logos .owl-dot.active,
.testimonials-modern .owl-dot:hover,
.testimonials-modern .owl-dot:focus,
.testimonials-modern .owl-dot.active,
.large-above-menu-style-5 .widget_anpstext .fa,
.large-above-menu-style-5 .widget_anpssocial ul,
.menu-button {
  background-color: <?php echo esc_attr($hovers_color); ?>;
}

body {
  font-size: <?php echo esc_attr($body_font_size); ?>px;
}

h1, .h1 {
  font-size: <?php echo esc_attr($h1_font_size); ?>px;
}
h2, .h2 {
  font-size: <?php echo esc_attr($h2_font_size); ?>px;
}
h3, .h3 {
  font-size: <?php echo esc_attr($h3_font_size); ?>px;
}
h4, .h4 {
  font-size: <?php echo esc_attr($h4_font_size); ?>px;
}
h5, .h5 {
  font-size: <?php echo esc_attr($h5_font_size); ?>px;
}
.site-navigation,
.site-navigation ul li a {
	font-size: <?php echo esc_attr($menu_font_size); ?>px;
}
@media (min-width: 992px) {
    .site-header-dropdown-3 .site-navigation > ul > .menu-item:not(.megamenu) .sub-menu a:hover,
    .site-header-dropdown-3 .site-navigation > ul > .menu-item:not(.megamenu) .sub-menu a:focus {
      background-color: <?php echo esc_attr($hovers_color); ?>;
    }
}
@media (min-width: 1200px) {
    .site-navigation .sub-menu a,
    .site-navigation .main-menu .megamenu {
        font-size: <?php echo esc_attr($submenu_font_size); ?>px;
    }
}
.page-heading h1 {
  font-size: <?php echo esc_attr($page_heading_h1_font_size); ?>px;
  line-height: 34px;
}
.recent-portfolio__title,
.recentportfolio h2,
.portfolio h2,
.portfolio-modern__title {
    font-size: <?php echo esc_attr($anps_portfolio_title_font_size); ?>px;
}

article.post-sticky header .stickymark i.nav_background_color {
  color: <?php echo esc_attr($nav_background_color); ?>;
}

.triangle-topleft.hovercolor {
  border-top: 60px solid <?php echo esc_attr($hovers_color); ?>;
}

h1.single-blog, article.post h1.single-blog {
  font-size: <?php echo esc_attr($blog_heading_h1_font_size); ?>px;
}

.home .site-header .above-nav-bar.top-bar,
.home div.site-wrapper div.transparent.top-bar, .home div.site-wrapper div.transparent.top-bar #lang_sel a.lang_sel_sel {
   color: <?php echo esc_attr($anps_front_topbar_color); ?>;
}

.home div.site-wrapper div.transparent.top-bar a:hover, .home div.site-wrapper div.transparent.top-bar #lang_sel a.lang_sel_sel:hover {
   color: <?php echo esc_attr($anps_front_topbar_hover_color); ?>;
}

section.container .menu li.current-menu-item .sub-menu a,
section.container .menu li.current-menu-ancestor .sub-menu a {
  background: <?php echo esc_attr($side_submenu_background_color); ?>;
  color: <?php echo esc_attr($side_submenu_text_color); ?>;
}

section.container ul.menu ul.sub-menu > li > a:hover,
section.container ul.menu li.current_page_item > a,
section.container ul.menu ul.sub-menu > li.current_page_item > a {
  color: <?php echo esc_attr($side_submenu_text_hover_color); ?>;
}

<?php
  global $anps_options_data;
  if( isset($anps_options_data['hide_slider_on_mobile']) && $anps_options_data['hide_slider_on_mobile'] == 'on' ):
?>

@media (max-width: 786px) {
    .wpb_layerslider_element, .wpb_revslider_element {
        display: none;
    }
}

<?php endif; ?>

<?php
//display search icon in menu?
$search_icon = get_option('search_icon', '1');
if (!$search_icon == '1') : ?>

.site-navigation .fa-search, .fa-search.desktop, body.vertical-menu header.site-header.vertical-menu .fa-search.desktop  {
display:none;
}

.responsive .site-navigation > ul > li:last-child:after {
    border-right: none!important;
}

<?php endif; ?>

<?php $search_icon_mobile = get_option('search_icon_mobile', '1');
if (!$search_icon_mobile == '1') : ?>
.nav-wrap > .container > button.fa-search.mobile {
  display:none!important;
}
<?php endif; ?>
@media (min-width: 993px) {
  .responsive .site-navigation .sub-menu {
    background:<?php echo esc_attr($submenu_background_color); ?>;
  }
    .responsive .site-navigation .sub-menu a {
    color: <?php echo esc_attr($submenu_text_color); ?>;
  }
}

<?php
if ( isset($anps_media_data['auto_adjust_logo']) && $anps_media_data['auto_adjust_logo'] =='on' ) :?>
@media (max-width: 400px) {
    .nav-wrap .site-logo a img {
        height: 60px!important;
        width: auto;
        max-width: 175px;
    }
}
<?php endif; ?>

<?php
echo get_option("anps_custom_css", "");
}

/* Custom styles for buttons */

function anps_custom_styles_buttons() {
    /* Buttons */
    $default_button_bg = anps_get_option('', '#292929', 'default_button_bg');
    $default_button_color = anps_get_option('', '#fff', 'default_button_color');
    $default_button_hover_bg = anps_get_option('', '#d54900', 'default_button_hover_bg');
    $default_button_hover_color = anps_get_option('', '#fff', 'default_button_hover_color');

    $style_1_button_bg = anps_get_option('', '#292929', 'style_1_button_bg');
    $style_1_button_color = anps_get_option('', '#fff', 'style_1_button_color');
    $style_1_button_hover_bg = anps_get_option('', '#d54900', 'style_1_button_hover_bg');
    $style_1_button_hover_color = anps_get_option('', '#fff', 'style_1_button_hover_color');


    $style_slider_button_bg = anps_get_option('', '#292929', 'style_slider_button_bg');
    $style_slider_button_color = anps_get_option('', '#fff', 'style_slider_button_color');
    $style_slider_button_hover_bg = anps_get_option('', '#d54900', 'style_slider_button_hover_bg');
    $style_slider_button_hover_color = anps_get_option('', '#fff', 'style_slider_button_hover_color');

    $style_2_button_bg = anps_get_option('', '#292929', 'style_2_button_bg');
    $style_2_button_color = anps_get_option('', '#fff', 'style_2_button_color');
    $style_2_button_hover_bg = anps_get_option('', '#d54900', 'style_2_button_hover_bg');
    $style_2_button_hover_color = anps_get_option('', '#fff', 'style_2_button_hover_color');

    $style_3_button_color = anps_get_option('', '#000', 'style_3_button_color');
    $style_3_button_hover_bg = anps_get_option('', '#fafafa', 'style_3_button_hover_bg');
    $style_3_button_hover_color = anps_get_option('', '#000', 'style_3_button_hover_color');
    $style_3_button_border_color = anps_get_option('', '#000', 'style_3_button_border_color');

    $style_4_button_color = anps_get_option('', '#d54900', 'style_4_button_color');
    $style_4_button_hover_color = anps_get_option('', '#000', 'style_4_button_hover_color');

    $style_style_5_button_bg = anps_get_option('', '#c3c3c3', 'style_style_5_button_bg');
    $style_style_5_button_color = anps_get_option('', '#fff', 'style_style_5_button_color');
    $style_style_5_button_hover_bg = anps_get_option('', '#737373', 'style_style_5_button_hover_bg');
    $style_style_5_button_hover_color = anps_get_option('', '#fff', 'style_style_5_button_hover_color');
    ?>
    /*buttons*/

    input#place_order {
         background-color: <?php echo esc_attr($default_button_bg); ?>;
    }

    input#place_order:hover,
    input#place_order:focus {
         background-color: <?php echo esc_attr($default_button_hover_bg); ?>;
    }

    .btn, .wpcf7-submit, button.single_add_to_cart_button,
    p.form-row input.button, .woocommerce-page .button {
        -moz-user-select: none;
        background-image: none;
        border: 0;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        line-height: 1.5;
        margin-bottom: 0;
        max-width: 100%;
        text-align: center;
        text-transform: uppercase;
        text-decoration:none;
        transition: background-color 0.2s ease 0s;
        text-overflow: ellipsis;
        vertical-align: middle;
        overflow: hidden;
        white-space: nowrap;
    }

    .btn.btn-sm, .wpcf7-submit {
        padding: 11px 17px;
        font-size: 14px;
    }

    .btn, .wpcf7-submit, button.single_add_to_cart_button,
    p.form-row input.button, .woocommerce-page .button {
      border-radius: 0;
      border-radius: 4px;
      background-color: <?php echo esc_attr($default_button_bg); ?>;
      color: <?php echo esc_attr($default_button_color); ?>;
    }

    .btn:hover, .btn:active, .btn:focus, .wpcf7-submit:hover, .wpcf7-submit:active, .wpcf7-submit:focus, button.single_add_to_cart_button:hover, button.single_add_to_cart_button:active, button.single_add_to_cart_button:focus,
    p.form-row input.button:hover, p.form-row input.button:focus, .woocommerce-page .button:hover, .woocommerce-page .button:focus {
      background-color: <?php echo esc_attr($default_button_hover_bg); ?>;
      color: <?php echo esc_attr($default_button_hover_color); ?>;
      border:0;
    }

    .btn.style-1, .vc_btn.style-1 {
      border-radius: 4px;
      background-color: <?php echo esc_attr($style_1_button_bg); ?>;
      color: <?php echo esc_attr($style_1_button_color); ?>!important;
    }

    .btn.style-1:hover, .btn.style-1:active, .btn.style-1:focus, .vc_btn.style-1:hover, .vc_btn.style-1:active, .vc_btn.style-1:focus  {
      background-color: <?php echo esc_attr($style_1_button_hover_bg); ?>;
      color: <?php echo esc_attr($style_1_button_hover_color); ?>!important;
    }

    .btn.slider  {
      border-radius: 4px;
      background-color: <?php echo esc_attr($style_slider_button_bg); ?>;
      color: <?php echo esc_attr($style_slider_button_color); ?>;
    }
    .btn.slider:hover, .btn.slider:active, .btn.slider:focus  {
      background-color: <?php echo esc_attr($style_slider_button_hover_bg); ?>;
      color: <?php echo esc_attr($style_slider_button_hover_color); ?>;
    }

    .btn.style-2, .vc_btn.style-2  {
      border-radius: 4px;
      border: 2px solid <?php echo esc_attr($style_2_button_bg); ?>;
      background-color: <?php echo esc_attr($style_2_button_bg); ?>;
      color: <?php echo esc_attr($style_2_button_color); ?>!important;
    }

    .btn.style-2:hover, .btn.style-2:active, .btn.style-2:focus, .vc_btn.style-2:hover, .vc_btn.style-2:active, .vc_btn.style-2:focus   {
      background-color: <?php echo esc_attr($style_2_button_hover_bg); ?>;
      color: <?php echo esc_attr($style_2_button_hover_color); ?>!important;
      border-color: <?php echo esc_attr($style_2_button_bg); ?>;
      border: 2px solid <?php echo esc_attr($style_2_button_bg); ?>;
    }

    .btn.style-3, .vc_btn.style-3
      {
      border: 2px solid <?php echo esc_attr($style_3_button_border_color); ?>;
      border-radius: 4px;
      background-color: transparent;
      color: <?php echo esc_attr($style_3_button_color); ?>!important;
    }
    .btn.style-3:hover, .btn.style-3:active, .btn.style-3:focus, .vc_btn.style-3:hover, .vc_btn.style-3:active, .vc_btn.style-3:focus  {
      border: 2px solid <?php echo esc_attr($style_3_button_border_color); ?>;
      background-color: <?php echo esc_attr($style_3_button_hover_bg); ?>;
      color: <?php echo esc_attr($style_3_button_hover_color); ?>!important;
    }

    .btn.style-4, .vc_btn.style-4   {
      padding-left: 0;
      background-color: transparent;
      color: <?php echo esc_attr($style_4_button_color); ?>!important;
      border: none;
    }

    .btn.style-4:hover, .btn.style-4:active, .btn.style-4:focus, .vc_btn.style-4:hover, .vc_btn.style-4:active, .vc_btn.style-4:focus   {
      padding-left: 0;
      background: none;
      color: <?php echo esc_attr($style_4_button_hover_color); ?>!important;
      border: none;
      border-color: transparent;
      outline: none;
    }

    .btn.style-5, .vc_btn.style-5   {
      background-color: <?php echo esc_attr($style_style_5_button_bg); ?>!important;
      color: <?php echo esc_attr($style_style_5_button_color); ?>!important;
      border: none;
    }

    .btn.style-5:hover, .btn.style-5:active, .btn.style-5:focus, .vc_btn.style-5:hover, .vc_btn.style-5:active, .vc_btn.style-5:focus   {
      background-color: <?php echo esc_attr($style_style_5_button_hover_bg); ?>!important;
      color: <?php echo esc_attr($style_style_5_button_hover_color); ?>!important;
    }
    <?php
}
