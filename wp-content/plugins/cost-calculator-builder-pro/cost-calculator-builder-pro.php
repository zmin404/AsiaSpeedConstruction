<?php

/**
 * Plugin Name: Cost Calculator Builder PRO
 * Plugin URI: https://stylemixthemes.com/cost-calculator-plugin/
 * Description: WP Cost Calculator helps you to build any type of estimation forms on a few easy steps. The plugin offers its own calculation builder.
 * Author: Stylemix Themes
 * Author URI: https://stylemixthemes.com/
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: cost-calculator-builder-pro
 * Version: 3.0.2
 */
define( 'CCB_PRO', __FILE__ );
define( 'CCB_PRO_PATH', dirname( __FILE__ ) );
define( 'CCB_PRO_URL', plugins_url( __FILE__ ) );
																											   
												  

if ( !function_exists( 'ccb_fs' ) ) {
    function ccb_fs()
    {
        global  $ccb_fs ;
        
        if ( !isset( $ccb_fs ) ) {
			class ccbFsNull {
						  
											
																   
																   
											  
																		
										  
				public function is__premium_only() {
					return true;
				}
				public function can_use_premium_code() {
										   
														  
																		 
									  
			  
					return true;
				}
																					  
															
			}
            $ccb_fs = new ccbFsNull();
        }
        
        return $ccb_fs;
    }
    
    ccb_fs();
    do_action( 'ccb_fs_loaded' );
}


if ( ccb_fs()->is__premium_only() ) {
    register_activation_hook( CCB_PRO, 'set_stm_admin_notification_ccb' );
    
    if ( ccb_fs()->can_use_premium_code() ) {
        define( 'CCB_PRO_VERSION', '3.0.2' );
        add_action( 'plugins_loaded', function () {
            $ccb_installed = defined( 'CALC_VERSION' );
            
            if ( !$ccb_installed ) {
                add_action( 'admin_notices', function () {
                    require_once CCB_PRO_PATH . '/templates/admin/notice.php';
								   
                } );
                require_once CCB_PRO_PATH . '/templates/admin/wizard.php';
							   
            } else {
                require_once CCB_PRO_PATH . '/includes/functions.php';
                require_once CCB_PRO_PATH . '/includes/classes/CCBProTemplate.php';
                require_once CCB_PRO_PATH . '/includes/classes/CCBProSettings.php';
                require_once CCB_PRO_PATH . '/includes/classes/CCBProAjaxCallbacks.php';
                require_once CCB_PRO_PATH . '/includes/classes/CCBProAjaxActions.php';
                require_once CCB_PRO_PATH . '/includes/classes/CCBPayments.php';
                require_once CCB_PRO_PATH . '/includes/classes/payments/CCBPayPal.php';
                require_once CCB_PRO_PATH . '/includes/classes/payments/CCBStripe.php';
                require_once CCB_PRO_PATH . '/includes/classes/payments/CCBWooCheckout.php';
                require_once CCB_PRO_PATH . '/includes/classes/CCBWooProducts.php';
                require_once CCB_PRO_PATH . '/includes/classes/CCBContactForm.php';
                require_once CCB_PRO_PATH . '/includes/init.php';
            }
        
        } );
    }

}
if ( is_admin() ) {
    require_once CCB_PRO_PATH . '/includes/item-announcements.php';
}
if ( !function_exists( 'set_stm_admin_notification_ccb' ) ) {
    function set_stm_admin_notification_ccb()
    {
        //set rate us notice
        set_transient( 'stm_cost-calculator-builder_notice_setting', array(
            'show_time'   => time(),
            'step'        => 0,
            'prev_action' => '',
        ) );
    }

}

if ( get_option( 'ccb_version' ) !== false && version_compare( get_option( 'ccb_version' ), '2.2.5', '<' ) ) {
    require_once CCB_PRO_PATH . '/includes/classes/CCBProAdminNotices.php';
    \cBuilder\Classes\CCBProAdminNotices::initWrongVersion();
    return;
}
