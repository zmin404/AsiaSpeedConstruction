<?php

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) die( GSL_HACK_MSG );

add_shortcode( 'gslogo', 'register_gslogo_shortcode_builder' );

function gslogo_get_temp_settings( $id, $is_preview = false ) {

    if ( $is_preview ) return get_transient( $id );

    $gslogo_sb = GS_Logo_Slider_Shortcode_Builder::get_instance();

    $shortcode = $gslogo_sb->_get_shortcode( $id, false );

    if ( $shortcode ) return $shortcode['shortcode_settings'];

    return [];
    
}

function gslogo_get_shortcode_params( $settings ) {

    $params = [];

    foreach( $settings as $key => $val ) {
        $params[] = $key.'="'.$val.'"';
    }

    return implode( ' ', $params );

}

function gslogo_change_key( $settings, $old_key, $new_key ) {

    if( ! array_key_exists( $old_key, $settings ) ) return $settings;

    $settings[$new_key] = $settings[$old_key];
    unset($settings[$old_key]);

    return $settings;

}

function register_gslogo_shortcode_builder( $atts ) {

    if ( empty($atts['id']) ) {
        return __( 'No shortcode ID found', 'gslogo' );
    }

    $is_preview = ! empty($atts['preview']);

    $settings = gslogo_get_temp_settings( $atts['id'], $is_preview );

    if ( empty($settings) ) $settings = [];

    $settings['id'] = $atts['id'];
    $settings['is_preview'] = $is_preview;

    // Cache the $settings from being changed
    $_settings = $settings;

    // By default force mode
    $force_asset_load = true;

    if ( ! $is_preview ) {
    
        // For Asset Generator
        $main_post_id = gsLogoAssetGenerator()->get_current_page_id();

        $asset_data = gsLogoAssetGenerator()->get_assets_data( $main_post_id );

        if ( empty($asset_data) ) {
            // Saved assets not found
            // Force load the assets for first time load
            // Generate the assets for later use
            gsLogoAssetGenerator()->generate( $main_post_id, $_settings );
        } else {
            // Saved assets found
            // Stop force loading the assets
            // Leave the job for Asset Loader
            $force_asset_load = false;
        }

    }

    $settings = gslogo_change_key( $settings, 'gs_l_title', 'title' );
    $settings = gslogo_change_key( $settings, 'gs_l_mode', 'mode' );
    $settings = gslogo_change_key( $settings, 'gs_l_slide_speed', 'speed' );
    $settings = gslogo_change_key( $settings, 'gs_l_inf_loop', 'inf_loop' );
    $settings = gslogo_change_key( $settings, 'gs_l_gray', 'logo_color' );
    $settings = gslogo_change_key( $settings, 'gs_l_theme', 'theme' );
    $settings = gslogo_change_key( $settings, 'gs_l_tooltip', 'tooltip' );

    $shortcode_params = gslogo_get_shortcode_params( $settings );

    ob_start();
    
    echo do_shortcode("[gs_logo $shortcode_params]");
    
    // Fire force asset load when needed
    if ( $force_asset_load ) gsLogoAssetGenerator()->force_enqueue_assets( $_settings );

    $settings = $_settings = null; // Free up the memory

    return ob_get_clean();

}