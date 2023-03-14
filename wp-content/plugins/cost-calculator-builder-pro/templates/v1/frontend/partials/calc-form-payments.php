<?php
/**
 * Payments template if 'Send Form' -> Contact Form is Enabled
 */
?>
<div :class="['ccb-form-payments', { 'disabled': loader }]">
	<div class="calc-item" v-if="payment.status != 'success'">
		<div class="calc-item-title" style="margin-bottom: 10px">
			<h4><?php esc_html_e( 'Payment methods', 'cost-calculator-builder-pro' ); ?></h4>
			<span class="is-pro">
				<span class="pro-tooltip">pro<span class="pro-tooltiptext" style="visibility: hidden;">Feature Available <br> in Pro Version</span>
				</span>
		</span>
		</div>

		<div class="calc-item-title" style="margin-bottom: 25px" v-if="showStripeCard">
			<h4><?php esc_html_e( 'Credit Card details', 'cost-calculator-builder-pro' ); ?></h4>
			<span class="is-pro">
				<span class="pro-tooltip">pro<span class="pro-tooltiptext" style="visibility: hidden;">Feature Available <br> in Pro Version</span>
				</span>
			</span>
		</div>

		<div class="calc-radio" v-if="isPaymentEnabled('paypal')">
			<div class="calc-radio-item">
				<input :id="'radioLabel1_' + settings.calc_id" type="radio" name="paymentMethods" value="paypal" v-model="paymentMethod">
				<label :for="'radioLabel1_' + settings.calc_id" class="payment"><?php esc_html_e( 'PayPal', 'cost-calculator-builder-pro' ); ?></label>
				<span class="is-pro">
					<span class="pro-tooltip">pro<span style="visibility: hidden;" class="pro-tooltiptext">Feature Available <br> in Pro Version</span></span>
				</span>
			</div>
		</div>

		<div class="calc-radio" v-if="isPaymentEnabled('stripe')">
			<div class="calc-radio-item">
				<input :id="'radioLabel2_' + settings.calc_id" type="radio" name="paymentMethods" value="stripe" v-model="paymentMethod">
				<label :for="'radioLabel2_' + settings.calc_id" class="payment stripe"><?php esc_html_e( 'Credit Card', 'cost-calculator-builder-pro' ); ?></label>
				<span class="is-pro">
					<span class="pro-tooltip">pro<span style="visibility: hidden;" class="pro-tooltiptext">Feature Available <br> in Pro Version</span></span>
				</span>
			</div>
			<div style="margin: 10px 0" v-show="paymentMethod === 'stripe'" :id="'ccb_stripe_' + settings.calc_id"></div>
		</div>

		<div class="calc-radio" v-if="isPaymentEnabled('woo_checkout')">
			<div class="calc-radio-item">
				<input :id="'radioLabel3_' + settings.calc_id" type="radio" name="paymentMethods" value="woocommerce_checkout" v-model="paymentMethod">
				<label :for="'radioLabel3_' + settings.calc_id" class="payment woocommerce-checkout"><?php esc_html_e( 'Woocommerce Checkout', 'cost-calculator-builder-pro' ); ?></label>
				<span class="is-pro">
					<span class="pro-tooltip">pro<span style="visibility: hidden;" class="pro-tooltiptext">Feature Available <br> in Pro Version</span>
				</span>
			</div>
		</div>
	</div>

	<div class="ccb-payment-info" :class="payment.status" v-show="payment.status">
		<p> {{ payment.message }} </p>
	</div>

	<div v-if="payment.status != 'success'" class="ccb-btn-wrap" style="margin-top: 20px">
		<loader class="front" v-if="loader"></loader>
		<div class="ccb-btn-container" v-else>
			<button v-if="paymentMethod === 'woocommerce_checkout'"
					@click="applyWoo(<?php the_ID(); ?>)" v-else
					:style="$store.getters.getCustomStyles['submit-button']">
				<?php esc_html_e( 'Add To Cart', 'cost-calculator-builder-pro' ); ?>
			</button>
			<button v-else @click.prevent="applyPayment()"
					:class="{disabled: (!paymentMethod || loader )}"
					:style="$store.getters.getCustomStyles['submit-button']">
				<?php esc_html_e( 'Purchase', 'cost-calculator-builder-pro' ); ?>
			</button>
		</div>
	</div>
</div>
