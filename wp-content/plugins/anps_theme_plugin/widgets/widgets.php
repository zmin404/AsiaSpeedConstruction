<?php
/* Get all widgets */
function anps_get_all_widgets() {
    $dir = WP_PLUGIN_DIR . '/anps_theme_plugin/widgets';
    $arr = array();
    if ($handle = opendir($dir)) {
        while (($entry = readdir($handle)) !== false) {
            if (is_dir("{$dir}/{$entry}")) continue;
            if ($entry === 'widgets.php') continue;
            $parts = explode('.', $entry);
            if (isset($parts[1]) && $parts[1] === 'php') {
                $arr[] = $entry;
            }
        }
        closedir($handle);
    }
    return $arr;
}

/* Include all widgets */
foreach (anps_get_all_widgets() as $item) {
    include_once WP_PLUGIN_DIR . '/anps_theme_plugin/widgets/' . $item;
}
