<?php
include_once(get_template_directory() . '/anps-framework/classes/AnpsImport.php');
if (isset($_GET['save_file'])) {
    $anps_import_export->save_file();
}
if (isset($_GET['save_import'])) {
    $anps_import_export->import_theme_options();
}
wp_enqueue_script('clipboard');
?>
<div class="content-inner">
    <h3><?php esc_html_e('Export', 'constructo'); ?></h3>
    <form action="themes.php?page=theme_options&sub_page=import_export&save_file" method="post">
        <div class="fullwidth">
            <?php $anps_import_export->anps_create_textarea('anps_export', json_encode($anps_import_export->get_theme_options()), 8, '', 'fullwidth'); ?>
        </div>
        <div class="onehalf">
             <button type="submit" class="inline-save btn-std"><i class="fa fa-floppy-o"></i><?php esc_html_e('Export', 'constructo'); ?></button>
        </div>
        <div class="onehalf">
            <button type="button" class="inline-save btn-std" id="copy-clipboard" data-clipboard-target="#anps_export"><i class="fa fa-floppy-o"></i><?php esc_html_e('Copy to clipboard', 'constructo'); ?></button>
        </div>
        <div class="clear"></div>
    </form>

    <h3><?php esc_html_e('Import', 'constructo'); ?></h3>
    <form action="themes.php?page=theme_options&sub_page=import_export&save_import" method="post" enctype="multipart/form-data">
        <?php $anps_import_export->anps_create_textarea('anps_import','', 6, '', 'fullwidth'); ?>
        <div class="fullwidth">
            <input type="file" class="custom pull-left import-export-file" name="import_file"/>
            <button type="submit" class="inline-save btn-std"><i class="fa fa-floppy-o"></i><?php esc_html_e('Import', 'constructo'); ?></button>
        </div>
        <div class="clear"></div>
    </form>
</div>
