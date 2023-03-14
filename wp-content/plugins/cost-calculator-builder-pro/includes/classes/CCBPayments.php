<?php

namespace cBuilder\Classes;

use cBuilder\Classes\Database\Orders as OrdersModel;
use cBuilder\Classes\Database\Payments as PaymentModel;


class CCBPayments {
	public static $total;
	public static $calculatorId     = array();
	public static $params           = array();
	public static $paymentSettings  = array();
	public static $settings         = array();
	public static $general_settings = array();
	public static $customer         = array();
	public static $order            = array();
	public static $payment          = array();
	protected static $paymentMethod = '';

	protected static $availablePayments = array(
		array(
			'name'  => 'paypal',
			'class' => 'cBuilder\Classes\Payments\CCBPayPal',
		),
		array(
			'name'  => 'stripe',
			'class' => 'cBuilder\Classes\Payments\CCBStripe',
		),
		array(
			'name'  => 'woo_checkout',
			'class' => 'cBuilder\Classes\Payments\CCBWooCheckout',
		),
	);

	protected static $permittedActions = array( 'ccb_paypal_payment', 'ccb_stripe_payment', 'calc_stripe_intent_payment' );
	protected static $paymentNonces    = array(
		'paypal'       => 'ccb_paypal',
		'stripe'       => 'ccb_stripe',
		'woo_checkout' => 'ccb_woo_checkout',
	);

	public static function setPaymentData() {

		if ( is_string( $_POST['data'] ) ) {
			self::$params = json_decode( str_replace( '\\', '', $_POST['data'] ), true );
		}

		/** check payment method */
		if ( ! array_key_exists( 'method', self::$params ) || ( array_key_exists( 'method', self::$params ) && ! in_array( self::$params['method'], array_column( self::$availablePayments, 'name' ), true ) ) ) {
			wp_send_json(
				array(
					'status'  => 'error',
					'success' => false,
					'message' => 'No payment method',
				)
			);
		}
		self::$paymentMethod = self::$params['method'];

		/** check action */
		if ( ! array_key_exists( 'action', self::$params ) || ( array_key_exists( 'action', self::$params ) && ! in_array( self::$params['action'], self::$permittedActions, true ) ) ) {
			wp_send_json(
				array(
					'status'  => 'error',
					'success' => false,
					'message' => 'No action',
				)
			);
		}

		/** check nonce */
		if ( ! array_key_exists( 'nonce', self::$params ) || ( array_key_exists( 'nonce', self::$params ) && ! wp_verify_nonce( self::$params['nonce'], self::$paymentNonces[ self::$params['method'] ] ) ) ) {
			wp_send_json(
				array(
					'status'  => 'error',
					'success' => false,
					'message' => 'nonce',
				)
			);
		}

		/** check calculator id */
		if ( ! array_key_exists( 'calc_id', self::$params ) || ! self::$params['calc_id'] ) {
			wp_send_json(
				array(
					'status'  => 'error',
					'success' => false,
					'message' => 'No calc id',
				)
			);
		}

		self::$calculatorId    = self::$params['calc_id'];
		self::$settings        = self::getSettings();
		self::$paymentSettings = self::getPaymentSettings();

		if ( ! self::$paymentSettings ) {
			wp_send_json(
				array(
					'status'  => 'error',
					'success' => false,
					'message' => 'No settings',
				)
			);
		}

		self::$total = self::getTotal();
		if ( ! is_null( self::$total ) && intval( self::$total ) <= 0 ) {
			wp_send_json(
				array(
					'success' => false,
					'status'  => 'error',
					'message' => __( 'Total must be more then 0', 'cost-calculator-builder-pro' ),
				)
			);
			wp_die();
		}

		/** set payment method to order */
		if ( array_key_exists( 'order_id', self::$params ) && self::$params['order_id'] ) {
			self::$order = OrdersModel::get( 'id', self::$params['order_id'] );

			/** if order id exist, but order not found return error */
			if ( null === self::$order ) {
				wp_send_json(
					array(
						'status'  => 'error',
						'success' => false,
						'message' => 'Order not found',
					)
				);
			}

			self::$payment = PaymentModel::get( 'order_id', self::$params['order_id'] );
			/** if no payment , create */
			if ( null === self::$payment ) {
				$paymentData = array(
					'type'     => self::$paymentMethod,
					'total'    => self::$total,
					'currency' => self::$settings['currency']['currency'],
				);
				PaymentModel::create_new_payment( $paymentData, self::$params['order_id'] );
			}

			self::$customer = self::getCustomerData();

			$paymentData = array(
				'type'       => self::$paymentMethod,
				'updated_at' => wp_date( 'Y-m-d H:i:s' ),
			);

			PaymentModel::update(
				$paymentData,
				array(
					'order_id' => self::$params['order_id'],
				)
			);

			OrdersModel::update_order(
				array(
					'payment_method' => self::$paymentMethod,
				),
				self::$params['order_id']
			);
		}
	}

	/** update order and payment rows statuses */
	public static function makePaid( $orderId, $paymentData ) {
		$orderId = sanitize_text_field( $orderId );

		try {
			OrdersModel::complete_order_by_id( $orderId );

			$paymentData['order_id']   = $orderId;
			$paymentData['status']     = PaymentModel::$completeStatus;
			$paymentData['updated_at'] = wp_date( 'Y-m-d H:i:s' );
			$paymentData['paid_at']    = wp_date( 'Y-m-d H:i:s' );

			$payment = PaymentModel::get( 'order_id', $orderId );
			if ( null === $payment ) {
				/** if no payment , create */
				$paymentData['created_at'] = wp_date( 'Y-m-d H:i:s' );
				PaymentModel::insert( $paymentData );
			} else {
				/** update if row exist */
				PaymentModel::update( $paymentData, array( 'order_id' => $orderId ) );
			}
		} catch ( Exception $e ) {
			//log here
			header( 'Status: 500 Server Error' );
		}
	}

	/** set payment transaction ( id from payment system ) */
	public static function setPaymentTransaction( $orderId, $transaction, $notes = array() ) {
		$orderId     = sanitize_text_field( $orderId );
		$transaction = sanitize_text_field( $transaction );
		$paymentData = array(
			'transaction' => sanitize_text_field( $transaction ),
			'updated_at'  => wp_date( 'Y-m-d H:i:s' ),
		);

		if ( ! empty( $notes ) ) {
			$paymentData['notes'] = serialize( array_map( 'sanitize_text_field', $notes ) ); // phpcs:ignore
		}

		PaymentModel::update( $paymentData, array( 'order_id' => $orderId ) );
	}

	protected static function getCustomerData() {
		if ( null === self::$order || ! is_object( self::$order ) || ! property_exists( self::$order, 'form_details' ) ) {
			return array();
		}

		$formDetails = json_decode( self::$order->form_details );
		if ( ! $formDetails || ! property_exists( $formDetails, 'fields' ) ) {
			return array();
		}

		$customer = array();
		foreach ( $formDetails->fields as $detail ) {
			$customer[ $detail->name ] = $detail->value;
		}

		return $customer;
	}

	protected static function getSettings() {
		if ( empty( self::$settings ) ) {
			self::$settings = get_option( 'stm_ccb_form_settings_' . self::$calculatorId );
		}
		return self::$settings;
	}

	protected static function getGeneralSettings() {
		if ( empty( self::$general_settings ) ) {
			self::$general_settings = get_option( 'ccb_general_settings', CCBSettingsData::general_settings_data() );
		}
		return self::$general_settings;
	}

	protected static function getPaymentSettings() {
		$general_settings = self::getGeneralSettings();
		$settings         = self::getSettings();

		if ( ! empty( $general_settings[ self::$paymentMethod ] ) && ! empty( $general_settings[ self::$paymentMethod ]['use_in_all'] ) ) {
			foreach ( $general_settings[ self::$paymentMethod ] as $stripe_field_key => $stripe_field_value ) {
				if ( ! in_array( $stripe_field_key, array( 'enable', 'use_in_all' ), true ) ) {
					$settings[ self::$paymentMethod ][ $stripe_field_key ] = $stripe_field_value;
				}
			}
		}

		return isset( $settings[ self::$paymentMethod ] ) ? (array) $settings[ self::$paymentMethod ] : array();
	}

	protected static function getTotal() {
		$total = 0;
		if ( count( self::$params['calcTotals'] ) > 0 ) {
			$version_control = empty( get_option( 'ccb_version_control' ) ) ? 'v2' : get_option( 'ccb_version_control' );
			foreach ( self::$params['calcTotals'] as $index => $value ) {
				$ccbDesc = null;
				if ( 'v1' === $version_control ) {
					$ccbDesc = strpos( self::$paymentSettings['description'], '[ccb-total-' ) !== false ? '[ccb-total-' . $index . ']' : null;
				} elseif ( ! empty( self::$paymentSettings['formulas'] ) ) {
					foreach ( self::$paymentSettings['formulas'] as $formula ) {
						if ( isset( $formula['idx'] ) && intval( $index ) === intval( $formula['idx'] ) ) {
							$ccbDesc = true;
						}
					}
				}

				if ( ! is_null( $ccbDesc ) ) {
					$total += floatval( $value['total'] );
				}
			}
		}

		return $total;
	}
}
