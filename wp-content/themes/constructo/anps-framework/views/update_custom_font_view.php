<?php
include_once get_template_directory() . '/anps-framework/classes/Style.php';

if (isset($_GET['save_font'])) {
    $style->upload_font();
}
?>
<div class="content">
<form action="themes.php?page=theme_options&sub_page=theme_style_custom_font&save_font" method="post" enctype="multipart/form-data">
    <div class="content-top">
        <input type="submit" value="<?php _e("Save all changes", 'constructo'); ?>">
        <div class="clear"></div>
    </div>
    <div class="content-inner">
        <h3 style="margin-bottom: 30px"><?php _e("Upload custom fonts", 'constructo'); ?></h3>
        <p>To maximize your customization you can upload your own typography. Simply upload your font from your computer.</p>
        <div class="input"><input type="file" class="custom" name="font"/></div>

    </div>

    <?php anps_admin_save_buttons(); ?>
</form>
</div>
