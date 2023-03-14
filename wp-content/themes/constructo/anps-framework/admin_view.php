<div class="envoo-admin">
<?php $themever = wp_get_theme(get_template()); $version = $themever["Version"]; ?>
    <ul class="envoo-admin-menu">
        <li>
            <a id="anpslogo" href="http://anpsthemes.com" target="_blank"></a>
            <h2 class="small_lh"><?php esc_html_e("Theme Options", 'constructo'); ?><br/>
                <span id="version"><?php echo esc_attr('version: '). esc_attr($version);?></span>
            </h2>
        </li>
        <li><a <?php if (!isset($_GET['sub_page']) || $_GET['sub_page'] == "theme_style") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=theme_style"><i class="fa fa-tint"></i><?php esc_html_e("Theme Style", 'constructo'); ?></a></li>
        <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "theme_style_google_font") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=theme_style_google_font"><i class="fa fa-google"></i><?php esc_html_e("Update google fonts", 'constructo'); ?></a></li>
        <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "theme_style_custom_font") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=theme_style_custom_font"><i class="fa fa-text-height"></i><?php esc_html_e("Custom fonts", 'constructo'); ?></a></li>
        <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "theme_style_custom_css") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=theme_style_custom_css"><i class="fa fa-code"></i><?php esc_html_e("Custom css", 'constructo'); ?></a></li>
        <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "options") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=options"><i class="fa fa-columns"></i><?php esc_html_e("Page layout", 'constructo'); ?></a></li>
        <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "options_page_setup") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=options_page_setup"><i class="fa fa-cog"></i><?php esc_html_e("Page setup", 'constructo'); ?></a></li>
        <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "header_options") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=header_options"><i class="fa fa-bars"></i><?php esc_html_e("Header options", 'constructo'); ?></a></li>
        <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "footer_options") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=footer_options"><i class="fa fa-level-down"></i><?php esc_html_e("Footer options", 'constructo'); ?></a></li>
        <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "woocommerce") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=woocommerce"><i class="fa fa-shopping-basket"></i><?php esc_html_e("Woocommerce", 'constructo'); ?></a></li>
        <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "options_media") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=options_media"><i class="fa fa-picture-o"></i><?php esc_html_e("Logos & Media", 'constructo'); ?></a></li>
        <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "google_maps") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=google_maps"><i class="fa fa-map"></i><?php esc_html_e("Google Maps", 'constructo'); ?></a></li>
        <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "dummy_content")echo 'id="selected-menu-item"'; ?> href="themes.php?page=theme_options&sub_page=dummy_content"><i class="fa fa-dropbox"></i><?php esc_html_e("Dummy Content", 'constructo'); ?></a></li>
        <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "theme_upgrade")echo 'id="selected-menu-item"'; ?> href="themes.php?page=theme_options&sub_page=theme_upgrade"><i class="fa fa-cloud-download"></i><?php esc_html_e("Theme Update", 'constructo'); ?></a></li>
        <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "import_export")echo 'id="selected-menu-item"'; ?> href="themes.php?page=theme_options&sub_page=import_export"><i class="fa fa-file-code-o"></i><?php esc_html_e("Import/Export", 'constructo'); ?></a></li>
        <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "import_export_widgets")echo 'id="selected-menu-item"'; ?> href="themes.php?page=theme_options&sub_page=import_export_widgets"><i class="fa fa-file-code-o"></i><?php esc_html_e("Import/Export widgets", 'constructo'); ?></a></li>
        <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "system_req")echo 'id="selected-menu-item"'; ?> href="themes.php?page=theme_options&sub_page=system_req"><i class="fa fa-cogs"></i><?php esc_html_e("System requirements", 'constructo'); ?></a></li>
    </ul>
        <?php
        if(!isset($_GET['sub_page'])) {
            $_GET['sub_page']='';
        }
        ?>
        <div class="envoo-admin-content <?php echo esc_attr($_GET['sub_page']);?>">
        <?php
        switch($_GET['sub_page']) {
            case 'options': include_once 'views/options_page_view.php'; break;
            case 'options_page': include_once 'views/options_page_view.php'; break;
            case 'options_page_setup': include_once 'views/options_page_setup_view.php'; break;
            case 'header_options': include_once 'views/header_options_view.php'; break;
            case 'footer_options': include_once 'views/footer_options_view.php'; break;
            case 'options_media': include_once 'views/options_media_view.php'; break;
            case 'google_maps': include_once 'views/google_maps_view.php'; break;
            case 'dummy_content': include_once 'views/dummy_view.php'; break;
            case 'theme_upgrade': include_once 'views/theme_upgrade_view.php'; break;
            case 'theme_style_google_font': include_once 'views/update_google_font_view.php'; break;
            case 'theme_style_custom_font': include_once 'views/update_custom_font_view.php'; break;
            case 'theme_style_custom_css': include_once 'views/custom_css_view.php'; break;
            case 'import_export': include_once 'views/import_export_view.php'; break;
            case 'import_export_widgets': include_once 'views/import_export_widgets_view.php'; break;
            case 'system_req': include_once 'views/system_req_view.php'; break;
            case 'woocommerce': include_once 'views/woocommerce_view.php'; break;
            default: include_once 'views/style_view.php';
        }
        ?>
    </div>
</div>
