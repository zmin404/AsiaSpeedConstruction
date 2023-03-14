<?php
if (isset($_GET['save_css'])) {
    update_option("anps_google_maps", $_POST['anps_google_maps']);
    header("Location: themes.php?page=theme_options&sub_page=google_maps");
}
?>
<form action="themes.php?page=theme_options&sub_page=google_maps&save_css" method="post">
    <div class="content-inner">
        <h3><?php _e("Google Maps", 'constructo'); ?></h3>

        <div class="input">
            <label for="anps_google_maps"><?php _e("Google Maps API code", 'constructo'); ?></label>
            <input class="fullwidth" type="text" name="anps_google_maps" value="<?php echo esc_attr(get_option('anps_google_maps', '')); ?>" id="anps_google_maps">
            <p><?php printf( esc_html__('All Google Maps applications require authentication. Go to %s and follow the described steps to retrieve an API key. Please read it carefully as there are different methods for Standard users and Premium users. Input your Google Maps API code in the above input field.', 'constructo'), '<a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key">https://developers.google.com/maps/documentation/javascript/get-api-key</a>'); ?></p>
        </div>
    </div>
    <?php anps_admin_save_buttons(); ?>
</form>
