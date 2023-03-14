<?php
global $anps_media_data;

$favicon = '';

if (isset($anps_media_data['favicon']) && $anps_media_data['favicon'] != "") {
    $favicon = $anps_media_data['favicon'];
}

if (get_option('anps_favicon', '') != '') {
    $favicon = get_option('anps_favicon');
}

if ($favicon != '') : ?>
    <link rel="shortcut icon" href="<?php echo esc_url($favicon); ?>" type="image/x-icon" />
<?php endif; ?>
