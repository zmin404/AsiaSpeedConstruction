<div class="list-row">
	<div class="list-header">
		<div class="ccb-switch">
			<input type="checkbox" v-model="settingsField.formFields.accessEmail"/>
			<label></label>
		</div>
		<h6><?php esc_html_e( 'Enable Contact Form', 'cost-calculator-builder-pro' ); ?></h6>
	</div>
	<div :class="{disabled: !settingsField.formFields.accessEmail}">
		<div class="list-content" style="margin-top: 0">
			<div class="list-content-label">
				<label><?php esc_attr_e( 'Select Form', 'cost-calculator-builder-pro' ); ?></label>
			</div>
			<select v-model="settingsField.formFields.contactFormId">
				<option value="" selected><?php esc_html_e( 'Default', 'cost-calculator-builder-pro' ); ?></option>
				<option v-for="(value, index) in $store.getters.getForms" :key="index" :value="value['id']">{{value['title']}}</option>
			</select>
		</div>

		<template v-if="!settingsField.formFields.contactFormId">

		</template>
		<template v-else>

			<div class="list-content">
				<div class="list-content-label">
					<label></label>
				</div>
				<textarea v-model="settingsField.formFields.body"></textarea>
				<p class="list-content__desc">
					[ccb-total-0] <?php esc_html_e( 'will be changed into total', 'cost-calculator-builder-pro' ); ?> </p>
			</div>

		</template>

		<div class="list-content">
			<div class="list-content-label">
				<label><?php esc_attr_e( 'Button Text', 'cost-calculator-builder-pro' ); ?></label>
			</div>
			<input type="text" placeholder="<?php esc_attr_e( '- Type Button Text -', 'cost-calculator-builder-pro' ); ?>" v-model="settingsField.formFields.submitBtnText">
		</div>

		<div class="list-header" style="margin-top: 25px">
			<div class="ccb-switch">
				<input type="checkbox" v-model="settingsField.formFields.payment"/>
				<label></label>
			</div>
			<h6><?php esc_html_e( 'Enable Payment Gateways', 'cost-calculator-builder-pro' ); ?></h6>
		</div>
		<div class="list-content" style="margin-top: 0" v-if="settingsField.formFields.payment">
			<div class="list-content-label">
				<label><?php esc_attr_e( 'Select Online Payment Gateways', 'cost-calculator-builder-pro' ); ?></label>
			</div>
			<div class="multiselect">
				<span v-if="settingsField.formFields.paymentMethods.length > 0" class="anchor" @click.prevent="multiselectShow(event)">
					<span class="selected-payment" v-for="selectedPaymentSlug in settingsField.formFields.paymentMethods">
						{{ getPaymentNameBySlug(selectedPaymentSlug) }}
						<i class="remove" @click.self="removePaymentFromFormList( selectedPaymentSlug )"></i>
					</span>
				</span>
				<span v-else class="anchor" @click.prevent="multiselectShow(event)">
					<?php esc_html_e( '- Select Payment method -', 'cost-calculator-builder-pro' ); ?>
				</span>
				<ul class="items">
					<li @click.self="multiselectChooseSendFormPayments(payment)"
						:class="['option-item',{'disabled' :payment.disabled} ]"
						v-for="payment in payments">
						<input @change="multiselectChooseSendFormPayments(payment);"
							:checked="settingsField.formFields.paymentMethods.includes(payment.slug)"
							name="payment"
							:class="['index',payment.name].join('_')"
							type="checkbox"/>{{ payment.name }}
					</li>
				</ul>
				<input name="options" type="hidden"/>
			</div>
			<p class="ccb-desc"><?php esc_html_e( 'Only enabled online payment systems will be available to choose.', 'cost-calculator-builder-pro' ); ?></p>
		</div>
	</div>
</div>
