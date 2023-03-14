<?php
/**
 * add ajax action
 */
add_action('init', function (){

    if ( array_key_exists('stm_ccb_check_ipn', $_GET ) && $_GET['stm_ccb_check_ipn'] == 1 ) {
        \cBuilder\Classes\Payments\CCBPayPal::check_payment($_REQUEST);
    }

    \cBuilder\Classes\CCBProSettings::init();
    \cBuilder\Classes\CCBProAjaxActions::init();
    \cBuilder\Classes\CCBWooProducts::init();
});