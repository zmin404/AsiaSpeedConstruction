<div class="calc-form-wrapper">
	<div class="ccb-btn-wrap" v-show="!open && formData.accessEmail && !close">
		<button @click.prevent="toggleOpen" :style="$store.getters.getCustomStyles['buttons']">
			{{ formData.submitBtnText ? formData.submitBtnText
			: <?php esc_html_e( 'Submit', 'cost-calculator-builder-pro' ); ?> }}
		</button>
		<span class="is-pro">
			<span class="pro-tooltip">
				pro
				<span style="visibility: hidden;" class="pro-tooltiptext">Feature Available <br> in Pro Version</span>
			</span>
		</span>
	</div>
	<div :class="['ccb-cf-wrap', {'disabled': loader}]" v-show="open && formData.accessEmail" style="position: relative">
		<div class="pro-border"></div>
		<span class="is-pro">
			<span class="pro-tooltip">
				pro
				<span style="visibility: hidden;" class="pro-tooltiptext">Feature Available <br> in Pro Version</span>
			</span>
		</span>

		<div class="ccb-contact-form7" v-if="formData.contactFormId && !getHideCalc">
			<?php
			echo do_shortcode( '[contact-form-7 id="' . $settings['formFields']['contactFormId'] . '"]' );
			?>
		</div>

		<div v-else-if="!showPayments" class="calc-default-form">
			<template v-if="!getHideCalc">
				<p class="form-field">
					<label :class="{'require-fields' : requires[0].required}" :style="$store.getters.getCustomStyles['labels']">
						<?php esc_html_e( 'Name', 'cost-calculator-builder-pro' ); ?>
						<input :disabled="loader" type="text" v-model="sendFields[0].value">
					</label>
				</p>

				<p class="form-field">
					<label :class="{'require-fields' : requires[1].required}" :style="$store.getters.getCustomStyles['labels']">
						<?php esc_html_e( 'Email', 'cost-calculator-builder-pro' ); ?>
						<input :disabled="loader" type="email" v-model="sendFields[1].value">
					</label>
				</p>

				<p class="form-field">
					<label :class="{'require-fields' : requires[2].required}" :style="$store.getters.getCustomStyles['labels']">
						<?php esc_html_e( 'Phone', 'cost-calculator-builder-pro' ); ?>
						<input :disabled="loader" v-model="sendFields[2].value" type="number" placeholder="">
					</label>
				</p>

				<p class="form-field">
					<label :style="$store.getters.getCustomStyles['labels']">
						<?php esc_html_e( 'Message', 'cost-calculator-builder-pro' ); ?>
						<textarea :disabled="loader" v-model="sendFields[3].value"></textarea>
					</label>
				</p>
			</template>

			<div :id="getSettings.calc_id" class="g-rec" v-if="getSettings.recaptcha.enable"></div>
			<p v-if="loader" style="position: relative; min-height: 50px">
				<loader style="left:0" class="front"></loader>
			</p>
			<div class="ccb-btn-wrap" v-else-if="!stripe && !loader">
				<button :disabled="loader" @click.prevent="sendData" :style="$store.getters.getCustomStyles['buttons']">{{ formData.submitBtnText ? formData.submitBtnText : <?php esc_html_e( 'Submit', 'cost-calculator-builder-pro' ); ?> }}
				</button>
			</div>
		</div>

		<p v-if="errorMessage" class="ccb-error-message"><?php esc_html_e( 'One or more fields have an error. Please check and try again!', 'cost-calculator-builder-pro' ); ?></p>
		<p v-if="errorContactForm" class="ccb-error-message"><?php esc_html_e( 'Contact form settings aren’t configured completely. Please set the necessary data in the Calculator Settings > Default Contact Form. ', 'cost-calculator-builder-pro' ); ?></p>
		<p v-if="successMessage" class="ccb-thanks-message"><?php esc_html_e( 'Thank you for your message. It has been sent.', 'cost-calculator-builder-pro' ); ?> </p>

		<form-payments v-if="showPayments" inline-template>
			<?php echo \cBuilder\Classes\CCBProTemplate::load( 'frontend/partials/calc-form-payments' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</form-payments>
	</div>
</div>
