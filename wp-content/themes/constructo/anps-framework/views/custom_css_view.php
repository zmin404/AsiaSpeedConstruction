<?php
if (isset($_GET['save_css'])) {
    update_option("anps_custom_css", stripcslashes($_POST['anps_custom_css']));
    header("Location: themes.php?page=theme_options&sub_page=theme_style_custom_css");
}
?>
<form action="themes.php?page=theme_options&sub_page=theme_style_custom_css&save_css" method="post">
    <div class="content-inner">
        <h3><?php _e("Custom css", 'constructo'); ?></h3>
        <div class="input fullwidth" id="anps_custom_css_wrapper">
            <label for="anps_custom_css"><?php _e("Custom css", 'constructo'); ?></label>
            <textarea name="anps_custom_css" id="anps_custom_css" class="fullwidth"><?php echo get_option('anps_custom_css', ''); ?> </textarea>
        </div>

        <!-- Editor -->
        <div class="input fullwidth">
            <div class="anps-editor-wrapper">
                <div class="anps-editor" id="editor"><?php echo get_option('anps_custom_css', ''); ?></div>
            </div>
        </div>
        <script>
            ace.config.set("basePath", "<?php echo get_template_directory_uri(); ?>/anps-framework/js");
            var editor = ace.edit("editor");
            editor.getSession().setMode("ace/mode/css");

            $('#anps_custom_css_wrapper').hide()

            var textarea = $('#anps_custom_css');
            editor.getSession().on('change', function(){
                textarea.val(editor.getSession().getValue());
            });
        </script>
    </div>
    <?php anps_admin_save_buttons(); ?>
</form>
