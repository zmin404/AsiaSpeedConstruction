<?php

namespace cBuilder\Classes;

class CCBContactForm {
	public static function render() {
		$result = array(
			'success' => false,
			'message' => __( 'Something went wrong', 'cost-calculator-builder-pro' ),
		);

		if ( isset( $_POST['action'] ) && 'calc_contact_form' === $_POST['action'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			$params = '';
			if ( is_string( $_POST['data'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
				$params = str_replace( '\\n', '^n', $_POST['data'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
				$params = str_replace( '\\\"', 'ccb_quote', $params );
				$params = str_replace( '\\', '', $params );
				$params = str_replace( 'ccb_quote', '\"', $params );
				$params = str_replace( '^n', '\\n', $params );

				$params = json_decode( $params, true );
			}

			if ( isset( $params['captchaSend'] ) ) {
				if ( isset( $params['captcha'] ) && ! empty( $params['captcha']['token'] ) ) {
					$token    = $params['captcha']['token'];
					$captcha  = $params['captcha']['v3'];
					$secret   = $captcha['secretKey'];
					$url      = 'https://www.google.com/recaptcha/api/siteverify?secret=' . rawurlencode( $secret ) . '&response=' . rawurlencode( $token );
					$response = file_get_contents( $url ); // phpcs:ignore
					$response = json_decode( $response );

					if ( ! $response->success ) {
						wp_send_json( $result );
					}
				} else {
					wp_send_json( $result );
				}
			}

			$body         = '';
			$email_err    = false;
			$user_email   = $params['userEmail'] ?? '';
			$client_email = $params['clientEmail'] ?? '';

			if ( ! filter_var( $user_email, FILTER_VALIDATE_EMAIL ) || ! filter_var( $client_email, FILTER_VALIDATE_EMAIL ) ) {
				$email_err = true;
			}
			if ( ! $email_err ) {

				$headers     = array( 'Content-Type: text/html; charset=UTF-8' );
				$subject     = $params['subject'] ?? $_SERVER['REQUEST_URI'];
				$attachments = array();

				/** upload files, get  $file_urls */
				$file_urls = self::add_files( $params );
				if ( count( $file_urls ) > 0 ) {
					foreach ( $file_urls as $file_item ) {
						$attachments = array_merge( $attachments, array_column( $file_item, 'file' ) );
					}
				}

				$body .= '<h3>' . __( 'Total descriptions', 'cost-calculator-builder-pro' ) . '</h3>';
				foreach ( $params['descriptions'] as $value ) {
					if ( 'total' !== substr( $value['alias'], 0, 5 ) && 1 !== $value['hidden'] ) {
						$body .= '<p><strong> ' . esc_html( ucfirst( $value['label'] ) ) . '</strong>';

						if ( count( $file_urls ) > 0 && preg_replace( '/_field_id.*/', '', $value['alias'] ) === 'file_upload' ) {
							/** append file names */
							$file_names_array = array_column( $file_urls[ $value['alias'] ], 'url' );
							array_walk(
								$file_names_array,
								function ( &$file ) {
									$file = basename( $file );
								}
							);
							$body .= ' ( ' . implode( ',', $file_names_array ) . ' )</p>' . PHP_EOL;
						} elseif ( isset( $value['extra'] ) ) {
							$body .= ' ' . $value['extra'];
						}

						$body .= ' ' . $value['converted'] . '</p>' . PHP_EOL;
					}
				}

				if ( isset( $params['calcTotals'] ) && count( $params['calcTotals'] ) > 0 ) {
					foreach ( $params['calcTotals'] as $total ) {
						$total_converted = $total['converted'] ?? $total['total'];
						$body           .= '<p><strong>' . $total['label'] . ': </strong>' . $total_converted . '</p>' . PHP_EOL;
					}
				}

				if ( isset( $params['sendFields'] ) ) {
					$body .= '<hr>';
					$body .= '<h3>' . __( 'Client Info', 'cost-calculator-builder-pro' ) . '</h3>';

					foreach ( $params['sendFields'] as $value ) {
						if ( ! empty( $value ) ) {
							$body .= '<p><strong> ' . esc_html( ucfirst( $value['name'] ) ) . ': </strong> ' . esc_html( $value['value'] ) . '</p>' . PHP_EOL;
						}
					}
				}

				$to_user_email   = wp_mail( $user_email, $subject, $body, $headers, $attachments );
				$to_client_email = wp_mail( $client_email, $subject, $body, $headers, $attachments );

				if ( true || $to_user_email && $to_client_email ) {
					$result['success'] = true;
					$result['message'] = __( 'Thank you for your message. It has been sent.', 'cost-calculator-builder-pro' );
				}
			}
		}

		wp_send_json( $result );
	}

	/** check uploaded files based on settings ( file upload field ) */
	protected static function validateFile( $file, $field_id, $calc_id ) { // phpcs:ignore
		if ( empty( $file ) ) {
			return false;
		}

		$calc_fields = get_post_meta( $calc_id, 'stm-fields', true );
		/** get file field settings */
		$file_field_index = array_search( $field_id, array_column( $calc_fields, 'alias' ), true );

		$extension       = pathinfo( $file['name'], PATHINFO_EXTENSION );
		$allowed_formats = array();

		foreach ( $calc_fields[ $file_field_index ]['fileFormats'] as $format ) {
			$allowed_formats = array_merge( $allowed_formats, explode( '/', $format ) );
		}

		/** check file extension */
		if ( ! in_array( $extension, $allowed_formats, true ) ) {
			return false;
		}

		/** check file size */
		if ( $calc_fields[ $file_field_index ]['max_file_size'] < round( $file['size'] / 1024 / 1024, 1 ) ) {
			return false;
		}

		return true;
	}

	protected static function add_files( $params ) {
		/** upload files if exist */
		if ( ! is_array( $_FILES ) ) {
			return $params;
		}

		if ( ! function_exists( 'wp_handle_upload' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}

		$file_urls     = array();
		$order_details = $params['descriptions'];

		/** upload all files, create array for fields */
		foreach ( $_FILES as $file_key => $file ) {
			$field_id    = preg_replace( '/_ccb_.*/', '', $file_key );
			$field_index = array_search( $field_id, array_column( $order_details, 'alias' ), true );

			/** if field not found continue */
			if ( false === $field_index ) {
				continue;
			}

			/** validate file by settings */
			$is_valid = self::validateFile( $file, $field_id, $params['calcId'] );
			if ( ! $is_valid ) {
				continue;
			}

			if ( ! array_key_exists( $field_id, $file_urls ) ) {
				$file_urls[ $field_id ] = array();
			}

			$file_info = wp_handle_upload( $file, array( 'test_form' => false ) );
			if ( $file_info && empty( $file_info['error'] ) ) {
				array_push( $file_urls[ $field_id ], $file_info );
			}
		}
		return $file_urls;
	}
}
