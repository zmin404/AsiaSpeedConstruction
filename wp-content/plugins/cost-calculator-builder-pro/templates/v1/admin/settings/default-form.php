<div class="list-row">
	<div class="list-header">
		<h6><?php esc_html_e( 'Default Contact Form', 'cost-calculator-builder-pro' ); ?></h6>
	</div>
	<div>

		<template>

			<div class="list-content">
				<div class="list-content-label">
					<label><?php esc_attr_e( 'Email', 'cost-calculator-builder-pro' ); ?></label>
				</div>
				<input type="text" placeholder="<?php esc_attr_e( '- Type Email -', 'cost-calculator-builder-pro' ); ?>" v-model="settingsField.formFields.adminEmailAddress">
			</div>

			<div class="list-content">
				<div class="list-content-label">
					<label><?php esc_attr_e( 'Subject', 'cost-calculator-builder-pro' ); ?></label>
				</div>
				<input type="text" placeholder="<?php esc_attr_e( '- Type Subject -', 'cost-calculator-builder-pro' ); ?>" v-model="settingsField.formFields.emailSubject">
			</div>

		</template>

		<div class="list-content">
			<div class="list-content-label">
				<label><?php esc_attr_e( 'Button Text', 'cost-calculator-builder-pro' ); ?></label>
			</div>
			<input type="text" placeholder="<?php esc_attr_e( '- Type Button Text -', 'cost-calculator-builder-pro' ); ?>" v-model="settingsField.formFields.submitBtnText">
		</div>
	</div>
</div>
