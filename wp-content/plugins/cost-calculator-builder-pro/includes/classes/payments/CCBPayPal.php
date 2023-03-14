<?php

namespace cBuilder\Classes\Payments;

use cBuilder\Classes\CCBPayments;
use cBuilder\Classes\Database\Orders as OrdersModel;
use cBuilder\Classes\Database\Payments;

class CCBPayPal extends CCBPayments {

	/**
	 * Generate payment url with order data
	 */
	public static function render() {

		/** setPaymentData , generate all data */
		parent::setPaymentData();

		$payment_url = '';

		if ( ! empty( self::$paymentSettings ) && self::$paymentSettings['enable'] ) {

			$custom = '';
			$url    = ( 'live' === self::$paymentSettings['paypal_mode'] ) ? 'www.paypal.com' : 'www.sandbox.paypal.com';
			$amount = number_format( self::$total, 2, '.', '' );

			if ( isset( self::$params['order_id'] ) ) {
				Payments::update_payment_total_by_order_id( self::$params['order_id'], $amount );
			}

			$get_params = array(
				'cmd'           => '_xclick',
				'business'      => self::$paymentSettings['paypal_email'],
				'item_name'     => self::$params['item_name'],
				'amount'        => ! empty( $amount ) ? $amount : 1,
				'rm'            => 1,
				'return'        => apply_filters( 'ccb_paypal_return_url', empty( $_SERVER['HTTP_REFERER'] ) ? home_url() : $_SERVER['HTTP_REFERER'] ),
				'notify_url'    => get_home_url() . '/?stm_ccb_check_ipn=1', //todo
				'currency_code' => self::$paymentSettings['currency_code'],
				'invoice'       => self::$params['order_id'],
				'order_id'      => self::$params['order_id'],
				'no_shipping'   => 1,
				'no_note'       => 1,
				'display'       => 1,
				'charset'       => 'UTF%2d8',
				'bn'            => 'PP%2dBuyNowBF',
			);

			/** customer info */
			if ( ! empty( self::$customer ) ) {
				$get_params['email']      = self::$customer['email'];
				$get_params['first_name'] = self::$customer['name'];

				$client_data = array_map(
					function( $value, $key ) {
						return $key . ':' . $value;
					},
					array_values( self::$customer ),
					array_keys( self::$customer )
				);

				$custom .= __( 'Customer', 'cost-calculator-builder-pro' );
				$custom .= ' - ' . implode( ' , ', $client_data ) . ';';
			}

			/** set order details */
			if ( null !== self::$order && is_object( self::$order ) && property_exists( self::$order, 'order_details' ) ) {

				$custom      .= __( 'Calculator', 'cost-calculator-builder-pro' ) . ' - ';
				$count_detail = 0;
				foreach ( json_decode( self::$order->order_details ) as $detail_key => $detail ) {
					$custom .= $detail->title . ':' . number_format( $detail->value, 2, '.', '' ) . ';';

					if ( $count_detail < 6 ) {
						$get_params[ 'on' . $detail_key ] = strlen( $detail->title ) > 60 ? substr( $detail->title, 0, 60 ) . '...' : $detail->title;
						$get_params[ 'os' . $detail_key ] = number_format( $detail->value, 2, '.', '' );
						$count_detail++;
					}
				}
			}
			$custom = strlen( $custom ) > 256 ? substr( $custom, 0, 250 ) . '...' : $custom;

			$get_params['custom'] = $custom;
			$payment_url          = 'https://' . $url . '/cgi-bin/webscr?' . http_build_query( $get_params );
		}

		wp_send_json(
			array(
				'success' => true,
				'url'     => $payment_url,
			)
		);
	}

	public static function check_payment( $ipn_response ) {

		$validate_ipn  = array( 'cmd' => '_notify-validate' );
		$validate_ipn += stripslashes_deep( $ipn_response );

		$params = array(
			'body'        => $validate_ipn,
			'sslverify'   => false,
			'timeout'     => 60,
			'httpversion' => '1.1',
			'compress'    => false,
			'decompress'  => false,
			'user-agent'  => 'paypal-ipn/',
		);

		$order = OrdersModel::get( 'id', $params['body']['invoice'] );
		if ( null === $order ) {
			header( 'HTTP/1.1 404 Not Found', true, 404 );
			exit;
		}
		$payment_settings = self::getPaymentSettingsByCalculatorId( $order->calc_id );
		$paypal_url       = ( 'live' === $payment_settings['paypal_mode'] ) ? 'www.paypal.com' : 'www.sandbox.paypal.com';
		$response_url     = "https://{$paypal_url}/cgi-bin/webscr";

		$response = wp_safe_remote_post( $response_url, $params );

		if ( is_wp_error( $response ) ) {
			header( 'HTTP/1.1 500 Response Error', true, 500 );
			exit;
		}

		if ( 200 === $response['response']['code'] && ( strstr( $response['body'], 'VERIFIED' ) || strcmp( $response, 'VERIFIED' ) === 0 ) ) {
			$payment_data = array(
				'type'        => 'paypal',
				'transaction' => sanitize_text_field( $ipn_response['txn_id'] ),
				'notes'       => serialize( array_map( 'sanitize_text_field', $ipn_response ) ), //phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.serialize_serialize
			);
			CCBPayments::makePaid( $order->id, $payment_data );
			header( 'HTTP/1.1 200 OK' );
			exit;
		} else {
			header( 'HTTP/1.1 500 Response Error', true, 500 );
			exit;
		}
	}

	private static function getPaymentSettingsByCalculatorId( $calculator_id ) {
		$settings = get_option( 'stm_ccb_form_settings_' . $calculator_id );
		if ( false === $settings || ! array_key_exists( 'paypal', $settings ) ) {
			return array();
		}
		return $settings['paypal'];
	}
}
