<div class="cbb-edit-field-container">
	<div class="ccb-edit-field-header">
		<span class="ccb-edit-field-title ccb-heading-3 ccb-bold"><?php esc_html_e( 'Multi Range', 'cost-calculator-builder-pro' ); ?></span>
		<div class="ccb-field-actions">
			<button class="ccb-button default" @click="$emit( 'cancel' )"><?php esc_html_e( 'Cancel', 'cost-calculator-builder-pro' ); ?></button>
			<button class="ccb-button success" @click.prevent="save(multiRangeField, id, index)"><?php esc_html_e( 'Save', 'cost-calculator-builder-pro' ); ?></button>
		</div>
	</div>
	<div class="ccb-grid-box">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="ccb-edit-field-switch">
						<div class="ccb-edit-field-switch-item ccb-default-title" :class="{active: tab === 'main'}" @click="tab = 'main'"><?php esc_html_e( 'Main settings', 'cost-calculator-builder-pro' ); ?></div>
						<div class="ccb-edit-field-switch-item ccb-default-title" :class="{active: tab === 'options'}" @click="tab = 'options'"><?php esc_html_e( 'Options', 'cost-calculator-builder-pro' ); ?></div>
					</div>
				</div>
			</div>
			<template v-if="tab === 'main'">
				<div class="row ccb-p-t-15">
					<div class="col">
						<div class="ccb-input-wrapper">
							<span class="ccb-input-label"><?php esc_html_e( 'Name', 'cost-calculator-builder-pro' ); ?></span>
							<input class="ccb-heading-5 ccb-light" type="text" v-model.trim="multiRangeField.label" placeholder="<?php esc_attr_e( 'Enter field name', 'cost-calculator-builder-pro' ); ?>">
						</div>
					</div>
				</div>
				<div class="row ccb-p-t-15">
					<div class="col-12">
						<div class="ccb-input-wrapper">
							<span class="ccb-input-label"><?php esc_html_e( 'Description', 'cost-calculator-builder-pro' ); ?></span>
							<input type="text" class="ccb-heading-5 ccb-light" v-model.trim="multiRangeField.description" placeholder="<?php esc_attr_e( 'Enter field description', 'cost-calculator-builder-pro' ); ?>">
						</div>
					</div>
				</div>
				<div class="row ccb-p-t-15">
					<div class="col-6">
						<div class="list-header">
							<div class="ccb-switch">
								<input type="checkbox" v-model="multiRangeField.allowCurrency"/>
								<label></label>
							</div>
							<h6 class="ccb-heading-5"><?php esc_html_e( 'Currency Sign', 'cost-calculator-builder-pro' ); ?></h6>
						</div>
					</div>
					<div class="col-6">
						<div class="list-header">
							<div class="ccb-switch">
								<input type="checkbox" v-model="multiRangeField.hidden"/>
								<label></label>
							</div>
							<h6 class="ccb-heading-5"><?php esc_html_e( 'Hidden by Default', 'cost-calculator-builder-pro' ); ?></h6>
						</div>
					</div>
					<div class="col-6 ccb-p-t-10">
						<div class="list-header">
							<div class="ccb-switch">
								<input type="checkbox" v-model="multiRangeField.allowRound"/>
								<label></label>
							</div>
							<h6 class="ccb-heading-5"><?php esc_html_e( 'Round Value', 'cost-calculator-builder-pro' ); ?></h6>
						</div>
					</div>
				</div>
				<div class="row ccb-p-t-15">
					<div class="col-12">
						<div class="ccb-input-wrapper">
							<span class="ccb-input-label"><?php esc_html_e( 'Additional Classes', 'cost-calculator-builder-pro' ); ?></span>
							<textarea class="ccb-heading-5 ccb-light" v-model="multiRangeField.additionalStyles" placeholder="<?php esc_attr_e( 'Set Additional Classes', 'cost-calculator-builder-pro' ); ?>"></textarea>
						</div>
					</div>
				</div>
			</template>
			<template v-else>
				<div class="row ccb-p-t-15">
					<div class="col-6">
						<div class="ccb-input-wrapper number">
							<span class="ccb-input-label"><?php esc_html_e( 'Minimum Range Value', 'cost-calculator-builder-pro' ); ?></span>
							<div class="ccb-input-box">
								<input type="number" class="ccb-heading-5 ccb-light" name="minValue" step="1" @input="errors.minValue=false" v-model="multiRangeField.minValue" placeholder="<?php esc_attr_e( 'Enter min range', 'cost-calculator-builder-pro' ); ?>">
								<span @click="numberCounterAction('minValue')" class="input-number-counter up"></span>
								<span @click="numberCounterAction('minValue', '-')" class="input-number-counter down"></span>
							</div>
							<span class="ccb-error-tip default" v-if="isObjectHasPath(errors, ['minValue'] ) && errors.minValue" v-html="errors.minValue"></span>
						</div>
					</div>
					<div class="col-6">
						<div class="ccb-input-wrapper number">
							<span class="ccb-input-label"><?php esc_html_e( 'Maximum Range Value', 'cost-calculator-builder-pro' ); ?></span>
							<div class="ccb-input-box">
								<input type="number" class="ccb-heading-5 ccb-light" name="maxValue" step="1" @input="errors.maxValue=false" v-model="multiRangeField.maxValue" placeholder="<?php esc_attr_e( 'Enter max range', 'cost-calculator-builder-pro' ); ?>">
								<span @click="numberCounterAction('maxValue')" class="input-number-counter up"></span>
								<span @click="numberCounterAction('maxValue', '-')" class="input-number-counter down"></span>
							</div>
							<span class="ccb-error-tip default" v-if="isObjectHasPath(errors, ['maxValue'] ) && errors.maxValue" v-html="errors.maxValue"></span>
						</div>
					</div>
				</div>
				<div class="row ccb-p-t-15">
					<div class="col-6">
						<div class="ccb-input-wrapper number">
							<span class="ccb-input-label"><?php esc_html_e( 'Range Step', 'cost-calculator-builder-pro' ); ?></span>
							<div class="ccb-input-box">
								<input type="number" class="ccb-heading-5 ccb-light" name="step" step="1" @input="errors.step=false" v-model="multiRangeField.step" placeholder="<?php esc_attr_e( 'Enter step', 'cost-calculator-builder-pro' ); ?>">
								<span @click="numberCounterAction('step')" class="input-number-counter up"></span>
								<span @click="numberCounterAction('step', '-')" class="input-number-counter down"></span>
							</div>
							<span class="ccb-error-tip default" v-if="isObjectHasPath(errors, ['step'] ) && errors.step" v-html="errors.step"></span>
						</div>
					</div>
					<div class="col-6">
						<div class="ccb-input-wrapper number">
							<span class="ccb-input-label"><?php esc_html_e( 'Range Unit', 'cost-calculator-builder-pro' ); ?></span>
							<div class="ccb-input-box">
								<input type="number" class="ccb-heading-5 ccb-light" name="unit" step="1" @input="errors.unit=false" v-model="multiRangeField.unit" placeholder="<?php esc_attr_e( 'Enter unit', 'cost-calculator-builder-pro' ); ?>">
								<span @click="numberCounterAction('unit')" class="input-number-counter up"></span>
								<span @click="numberCounterAction('unit', '-')" class="input-number-counter down"></span>
							</div>
							<span class="ccb-error-tip default" v-if="isObjectHasPath(errors, ['unit'] ) && errors.unit" v-html="errors.unit"></span>
						</div>
					</div>
				</div>
				<div class="row ccb-p-t-15">
					<div class="col-6">
						<div class="ccb-input-wrapper number">
							<span class="ccb-input-label"><?php esc_html_e( 'Default Start Value', 'cost-calculator-builder-pro' ); ?></span>
							<div class="ccb-input-box">
								<input type="number" class="ccb-heading-5 ccb-light" name="default_left" step="1" min="0" v-model="multiRangeField.default_left" placeholder="<?php esc_attr_e( 'Enter value', 'cost-calculator-builder-pro' ); ?>">
								<span @click="numberCounterAction('default_left')" class="input-number-counter up"></span>
								<span @click="numberCounterAction('default_left', '-')" class="input-number-counter down"></span>
							</div>
						</div>
					</div>
					<div class="col-6">
						<div class="ccb-input-wrapper">
							<span class="ccb-input-label"><?php esc_html_e( 'Default End Value', 'cost-calculator-builder-pro' ); ?></span>
							<div class="ccb-input-box">
								<input type="number" class="ccb-heading-5 ccb-light" name="default_right" min="0" step="1" v-model="multiRangeField.default_right" placeholder="<?php esc_attr_e( 'Enter value', 'cost-calculator-builder-pro' ); ?>">
								<span @click="numberCounterAction('default_right')" class="input-number-counter up"></span>
								<span @click="numberCounterAction('default_right', '-')" class="input-number-counter down"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="row ccb-p-t-15">
					<div class="col-6">
						<div class="ccb-input-wrapper">
							<span class="ccb-input-label"><?php esc_html_e( 'Currency Symbol', 'cost-calculator-builder-pro' ); ?></span>
							<input type="text" class="ccb-heading-5 ccb-light" v-model.trim="multiRangeField.sign" placeholder="<?php esc_attr_e( 'Enter currency symbol', 'cost-calculator-builder-pro' ); ?>">
						</div>
					</div>
				</div>
			</template>
		</div>
	</div>
</div>
