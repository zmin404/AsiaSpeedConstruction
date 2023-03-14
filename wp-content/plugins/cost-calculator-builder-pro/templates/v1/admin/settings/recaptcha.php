<div class="list-row">
	<div class="list-header">
		<div class="ccb-switch">
			<input type="checkbox" v-model="settingsField.recaptcha.enable"/>
			<label></label>
		</div>
		<h6><?php esc_html_e( 'Enable reCAPTCHA', 'cost-calculator-builder-pro' ); ?></h6>
	</div>
	<div :class="{disabled: !settingsField.recaptcha.enable}">

		<div class="list-content" style="margin-top: 0">
			<div class="list-content-label">
				<label><?php esc_attr_e( 'reCAPTCHA version', 'cost-calculator-builder-pro' ); ?></label>
			</div>
			<select v-model="settingsField.recaptcha.type">
				<option v-for="(value, index) in settingsField.recaptcha.options" :key="index" :value="index">{{value}}
				</option>
			</select>
		</div>
		<div style="margin-bottom: 40px"></div>
		<template
				v-if="settingsField.recaptcha.type === 'v2' && settingsField.recaptcha.v2">
			<div class="list-content" style="margin-top: 0">
				<div class="list-content-label">
					<label><?php esc_attr_e( 'Site Key', 'cost-calculator-builder-pro' ); ?></label>
				</div>
				<input type="text" v-model.trim="settingsField.recaptcha.v2.siteKey" placeholder="<?php esc_attr_e( '- Paste reCAPTCHA v2 Site Key -', 'cost-calculator-builder-pro' ); ?>">
			</div>

			<div class="list-content">
				<div class="list-content-label">
					<label><?php esc_attr_e( 'Secret Key', 'cost-calculator-builder-pro' ); ?></label>
				</div>
				<input type="text" v-model.trim="settingsField.recaptcha.v2.secretKey" placeholder="<?php esc_attr_e( '- Paste reCAPTCHA v2 Secret Key -', 'cost-calculator-builder-pro' ); ?>">
			</div>
		</template>

		<template
				v-if="settingsField.recaptcha.type === 'v3' && settingsField.recaptcha.v3">
			<div class="list-content" style="margin-top: 0">
				<div class="list-content-label">
					<label><?php esc_attr_e( 'Site Key', 'cost-calculator-builder-pro' ); ?></label>
				</div>
				<input type="text" v-model.trim="settingsField.recaptcha.v3.siteKey" placeholder="<?php esc_attr_e( '- Paste reCAPTCHA v3 Site Key -', 'cost-calculator-builder-pro' ); ?>">
			</div>

			<div class="list-content">
				<div class="list-content-label">
					<label><?php esc_attr_e( 'Secret Key', 'cost-calculator-builder-pro' ); ?></label>
				</div>
				<input type="text" v-model.trim="settingsField.recaptcha.v3.secretKey" placeholder="<?php esc_attr_e( '- Paste reCAPTCHA v3 Secret Key -', 'cost-calculator-builder-pro' ); ?>">
			</div>
		</template>
	</div>
</div>
