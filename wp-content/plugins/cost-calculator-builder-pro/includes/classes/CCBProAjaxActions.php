<?php

namespace cBuilder\Classes;

use cBuilder\Classes\Payments\CCBPayPal;
use cBuilder\Classes\Payments\CCBStripe;

class CCBProAjaxActions {

    /**
     * @param string   $tag             The name of the action to which the $function_to_add is hooked.
     * @param callable $function_to_add The name of the function you wish to be called.
     * @param boolean  $nonpriv         Optional. Boolean argument for adding wp_ajax_nopriv_action. Default false.
     * @param int      $priority        Optional. Used to specify the order in which the functions
     *                                  associated with a particular action are executed. Default 10.
     *                                  Lower numbers correspond with earlier execution,
     *                                  and functions with the same priority are executed
     *                                  in the order in which they were added to the action.
     * @param int      $accepted_args   Optional. The number of arguments the function accepts. Default 1.
     * @return true Will always return true.
     */

    public static function addAction($tag, $function_to_add, $nonpriv = false, $priority = 10, $accepted_args = 1) {
        add_action('wp_ajax_'.$tag, $function_to_add, $priority = 10, $accepted_args = 1);
        if ( $nonpriv ) add_action('wp_ajax_nopriv_'.$tag, $function_to_add);
        return true;
    }

    public static function init() {
        // payment methods
        CCBProAjaxActions::addAction('ccb_paypal_payment', [CCBPayPal::class , 'render'], true);
        CCBProAjaxActions::addAction('ccb_stripe_payment', [CCBStripe::class , 'render'], true);
        CCBProAjaxActions::addAction('calc_stripe_intent_payment', [CCBStripe::class , 'intent_payment'], true);

        // contact form
        CCBProAjaxActions::addAction('calc_contact_form', [CCBContactForm::class , 'render'], true);

        // WooCommerce Checkout
        CCBProAjaxActions::addAction('calc_woo_redirect', [CCBWooCheckout::class , 'init'], true);

        add_action('woocommerce_new_order_item', array(CCBWooCheckout::class, 'calc_add_wc_order'), 99, 3);
        add_action('woocommerce_add_order_item_meta', array(CCBWooCheckout::class, 'calc_add_item_meta'), 99, 3);
        add_filter('woocommerce_get_item_data', array(CCBWooCheckout::class, 'calc_get_item_data'), 99, 2);
        add_action('woocommerce_check_cart_items', array(CCBWooCheckout::class, 'calc_check_cart_items'), 99);
        add_filter('woocommerce_order_item_meta_end', array(CCBWooCheckout::class, 'calc_order_item_meta'), 99, 2);
        add_action('woocommerce_before_calculate_totals', array(CCBWooCheckout::class, 'calc_total'), 99, 1);
        add_action('woocommerce_after_order_itemmeta', array(CCBWooCheckout::class, 'calc_order_item_meta'), 99, 3);
        add_action('woocommerce_cart_item_removed', array(CCBWooCheckout::class, 'calc_remove_cart_item'), 99, 2);
    }

}