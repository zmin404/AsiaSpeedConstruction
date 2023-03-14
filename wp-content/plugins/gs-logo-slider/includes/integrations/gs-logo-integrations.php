<?php

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) die( GSL_HACK_MSG );

if ( ! class_exists( 'GS_Logo_Slider_Integration' ) ) {

    final class GS_Logo_Slider_Integration {

        private static $_instance = null;
        
        public static function get_instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new GS_Logo_Slider_Integration();
            }

            return self::$_instance;
            
        }

        public function __construct() {

            // Elementor
            if ( apply_filters( 'gs_logo_slider_integration_elementor', true ) ) $this->integration_with_elementor();

            // WP Bakery Visual Composer
            if ( apply_filters( 'gs_logo_slider_integration_wpb_vc', true ) ) $this->integration_with_wpbakery_vc();

            // Gutenberg
            if ( apply_filters( 'gs_logo_slider_integration_gutenberg', true ) ) $this->integration_with_gutenberg();

            // Divi
            if ( apply_filters( 'gs_logo_slider_integration_divi', true ) ) $this->integration_with_divi();
            
        }

        public function integration_with_elementor() {

            require_once GSL_PLUGIN_DIR . 'includes/integrations/gs-logo-integration-elementor.php';

            GS_Logo_Slider_Integration_Elementor::get_instance();

        }
        
        public function integration_with_wpbakery_vc() {

            require_once GSL_PLUGIN_DIR . 'includes/integrations/gs-logo-integration-wpb-vc.php';

            GS_Logo_Slider_Integration_WPB_VC::get_instance();

        }

        public function integration_with_gutenberg() {

            require_once GSL_PLUGIN_DIR . 'includes/integrations/gs-logo-integration-gutenberg.php';

            GS_Logo_Slider_Integration_Gutenberg::get_instance();

        }

        public function integration_with_divi() {

            require_once GSL_PLUGIN_DIR . 'includes/integrations/gs-logo-integration-divi.php';

            GS_Logo_Slider_Integration_Divi::get_instance();

        }

    }

}

GS_Logo_Slider_Integration::get_instance();