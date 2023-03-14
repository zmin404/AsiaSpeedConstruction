<?php
	$settings_status = isset( $settings );
?>
<div v-if="getStripeSettings.enable || getPayPalSettings.enable">
	<div class="calc-item">
		<div class="calc-form-wrapper" v-if="getMethod">
			<div class="calc-default-form">
				<?php if ( $settings_status ) : ?>
					<template
							v-if="$store.getters.getUnusedFields.length === 0 && getMethod && ['paypal', 'stripe'].includes(getMethod)">
						<p class="form-field">
							<label :class="{'require-fields' : paymentForm.requires[0].required}" :style="$store.getters.getCustomStyles['labels']">
								<?php esc_html_e( 'Name', 'cost-calculator-builder-pro' ); ?>
								<input type="text" v-model="paymentForm.sendFields[0].value">
							</label>
						</p>

						<p class="form-field">
							<label :class="{'require-fields' : paymentForm.requires[1].required}" :style="$store.getters.getCustomStyles['labels']">
								<?php esc_html_e( 'Email', 'cost-calculator-builder-pro' ); ?>
								<input type="email" v-model="paymentForm.sendFields[1].value">
							</label>
						</p>

						<p class="form-field">
							<label :class="{'require-fields' : paymentForm.requires[2].required}" :style="$store.getters.getCustomStyles['labels']">
								<?php esc_html_e( 'Phone', 'cost-calculator-builder-pro' ); ?>
								<input v-model="paymentForm.sendFields[2].value" type="number" placeholder="">
							</label>
						</p>

						<p class="form-field">
							<label :style="$store.getters.getCustomStyles['labels']">
								<?php esc_html_e( 'Message', 'cost-calculator-builder-pro' ); ?>
								<textarea v-model="paymentForm.sendFields[3].value"></textarea>
							</label>
						</p>
					</template>
				<?php endif; ?>

				<p v-if="paymentForm.errorMessage" class="ccb-error-message">
					<?php esc_html_e( 'One or more fields have an error. Please check and try again!', 'cost-calculator-builder-pro' ); ?>
				</p>
				<p v-if="paymentForm.successMessage" class="ccb-thanks-message">
					<?php echo esc_html_e( 'Thank you for your message. It has been sent.', 'cost-calculator-builder-pro' ); ?>
				</p>
			</div>
		</div>
		<div class="calc-item-title" style="margin-bottom: 10px" v-if="!form">
			<h4><?php esc_html_e( 'Payment methods', 'cost-calculator-builder-pro' ); ?></h4>
			<span class="is-pro">
				<span class="pro-tooltip">
					pro
					<span class="pro-tooltiptext" style="visibility: hidden;">Feature Available <br> in Pro Version</span>
				</span>
			</span>
		</div>
		<div class="calc-item-title" style="margin-bottom: 25px" v-if="getHideCalc">
			<h4>
				<?php esc_html_e( 'Credit Card details', 'cost-calculator-builder-pro' ); ?>
			</h4>
			<span class="is-pro">
				<span class="pro-tooltip">
					pro
					<span class="pro-tooltiptext" style="visibility: hidden;">Feature Available <br> in Pro Version</span>
				</span>
			</span>
		</div>
		<div class="calc-radio" v-if="isPaymentEnabled('paypal')">
			<div class="calc-radio-item">
				<input :id="'radioLabel1_' + getSettings.calc_id" type="radio" name="paymentMethods" value="paypal"
					v-model="getMethod">
				<label :for="'radioLabel1_' + getSettings.calc_id" class="payment">
					<?php esc_html_e( 'PayPal', 'cost-calculator-builder-pro' ); ?>
				</label>
				<span class="is-pro">
					<span class="pro-tooltip">
						pro
						<span style="visibility: hidden;"
							class="pro-tooltiptext">Feature Available <br> in Pro Version</span>
					</span>
				</span>
			</div>
		</div>

		<div class="calc-radio" v-if="isPaymentEnabled('stripe')">
			<div class="calc-radio-item">
				<input :id="'radioLabel2_' + getSettings.calc_id" type="radio" name="paymentMethods" value="stripe"
					v-model="getMethod">
				<label :for="'radioLabel2_' + getSettings.calc_id" class="payment stripe">
					<?php esc_html_e( 'Credit Card', 'cost-calculator-builder-pro' ); ?>
				</label>
				<span class="is-pro">
					<span class="pro-tooltip">
						pro
						<span style="visibility: hidden;"
							class="pro-tooltiptext">Feature Available <br> in Pro Version</span>
					</span>
				</span>
			</div>
			<div style="margin: 10px 0" v-show="getMethod === 'stripe'" :id="'ccb_stripe_' + getSettings.calc_id"></div>
		</div>

		<div class="calc-radio" v-if="isPaymentEnabled('woo_checkout')">
			<div class="calc-radio-item">
				<input :id="'radioLabel3_' + getSettings.calc_id" type="radio" name="paymentMethods"
					value="woocommerce_checkout" v-model="getMethod">
				<label :for="'radioLabel3_' + getSettings.calc_id" class="payment woocommerce-checkout">
					<?php esc_html_e( 'Woocommerce Checkout', 'cost-calculator-builder-pro' ); ?>
				</label>
				<span class="is-pro">
					<span class="pro-tooltip">
					pro
						<span style="visibility: hidden;"
							class="pro-tooltiptext">Feature Available <br> in Pro Version</span>
					</span>
				</span>
			</div>
		</div>

	</div>
	<div class="ccb-payment-info" :class="payment.status" v-show="!loader">
		<p> {{ payment.message }} </p>
	</div>
	<div class="ccb-btn-wrap" style="margin-top: 20px">
		<loader class="front" v-if="loader"></loader>
		<div class="ccb-btn-container" v-else>
			<button v-if="getMethod === 'woocommerce_checkout'" @click="applyWoo(<?php the_ID(); ?>)" v-else
					:style="$store.getters.getCustomStyles['buttons']">
				<?php esc_html_e( 'Add To Cart', 'cost-calculator-builder-pro' ); ?>
			</button>
			<button v-else
					@click.prevent="<?php echo $settings_status ? 'false' : 'true'; ?> ? applyPayment() : OrderPayment() "
					:class="purchaseBtnClass"
					:style="$store.getters.getCustomStyles['buttons']">
				<?php esc_html_e( 'Purchase', 'cost-calculator-builder-pro' ); ?>
			</button>
		</div>
	</div>
</div>
