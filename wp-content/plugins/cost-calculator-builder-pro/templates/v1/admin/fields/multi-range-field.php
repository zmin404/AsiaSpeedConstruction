<div class="field-form-wrapper">
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Name', 'cost-calculator-builder-pro' ); ?></label>
			<input type="text" placeholder="<?php esc_attr_e( '- Field Label -', 'cost-calculator-builder-pro' ); ?>" v-model.trim="multiRangeField.label">
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Description', 'cost-calculator-builder-pro' ); ?></label>
			<input type="text" placeholder="<?php esc_attr_e( '- Field Description -', 'cost-calculator-builder-pro' ); ?>" v-model.trim="multiRangeField.description">
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Description position', 'cost-calculator-builder-pro' ); ?></label>
			<select v-model="multiRangeField.desc_option">
				<option v-for="(value, key) in getDescOptions" :value="key">
					{{value}}
				</option>
			</select>
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Minimum Range Value', 'cost-calculator-builder-pro' ); ?></label>
			<div class="input-type-number-wrapper">
				<input name="minValue" @input="errors.minValue=false" min="0" placeholder="<?php esc_attr_e( '- Min Value -', 'cost-calculator-builder-pro' ); ?>" type="number" step="1" v-model="multiRangeField.minValue">
				<span @click="numberCounterAction('minValue')" class="input-number-counter up"></span>
				<span @click="numberCounterAction('minValue', '-')" class="input-number-counter down"></span>
			</div>
			<span class="error-tip" v-if="isObjectHasPath(errors, ['minValue'] ) && errors.minValue" v-html="errors.minValue"></span>
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Maximum Range Value', 'cost-calculator-builder-pro' ); ?></label>
			<div class="input-type-number-wrapper">
				<input name="maxValue" @input="errors.maxValue=false" min="0" placeholder="<?php esc_attr_e( '- Max Value -', 'cost-calculator-builder-pro' ); ?>" type="number" step="1" v-model="multiRangeField.maxValue">
				<span @click="numberCounterAction('maxValue')" class="input-number-counter up"></span>
				<span @click="numberCounterAction('maxValue', '-')" class="input-number-counter down"></span>
			</div>
			<span class="error-tip" v-if="isObjectHasPath(errors, ['maxValue'] ) && errors.maxValue" v-html="errors.maxValue"></span>
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Range Step', 'cost-calculator-builder-pro' ); ?></label>
			<div class="input-type-number-wrapper">
				<input name="step" @input="errors.step=false" min="0" placeholder="<?php esc_attr_e( '- Step -', 'cost-calculator-builder-pro' ); ?>" type="number" step="1" v-model="multiRangeField.step">
				<span @click="numberCounterAction('step')" class="input-number-counter up"></span>
				<span @click="numberCounterAction('step', '-')" class="input-number-counter down"></span>
			</div>
			<span class="error-tip" v-if="isObjectHasPath(errors, ['step'] ) && errors.step" v-html="errors.step"></span>
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Default Start Value', 'cost-calculator-builder-pro' ); ?></label>
			<div class="input-type-number-wrapper">
				<input name="default_left" min="0" placeholder="<?php esc_attr_e( '- Default Left Value -', 'cost-calculator-builder-pro' ); ?>" type="number" step="1" v-model="multiRangeField.default_left">
				<span @click="numberCounterAction('default_left')" class="input-number-counter up"></span>
				<span @click="numberCounterAction('default_left', '-')" class="input-number-counter down"></span>
			</div>
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Default End Value', 'cost-calculator-builder-pro' ); ?></label>
			<div class="input-type-number-wrapper">
				<input name="default_right" min="0" placeholder="<?php esc_attr_e( '- Default Right Value -', 'cost-calculator-builder-pro' ); ?>" type="number" step="1" v-model="multiRangeField.default_right">
				<span @click="numberCounterAction('default_right')" class="input-number-counter up"></span>
				<span @click="numberCounterAction('default_right', '-')" class="input-number-counter down"></span>
			</div>
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Currency Symbol', 'cost-calculator-builder-pro' ); ?></label>
			<input type="text" placeholder="<?php esc_attr_e( '- Sign -', 'cost-calculator-builder-pro' ); ?>" v-model.trim="multiRangeField.sign">
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Range Unit', 'cost-calculator-builder-pro' ); ?></label>
			<div class="input-type-number-wrapper">
				<input name="unit" @input="errors.unit=false" min="0" placeholder="<?php esc_attr_e( '- Unit -', 'cost-calculator-builder-pro' ); ?>" type="number" step="1" v-model="multiRangeField.unit">
				<span @click="numberCounterAction('unit')" class="input-number-counter up"></span>
				<span @click="numberCounterAction('unit', '-')" class="input-number-counter down"></span>
			</div>
			<span class="error-tip" v-if="isObjectHasPath(errors, ['unit'] ) && errors.unit" v-html="errors.unit"></span>
		</div>
	</div>

	<div class="field-form-row">
		<div class="form-group large inline">
			<div class="ccb-switch">
				<input type="checkbox" v-model="multiRangeField.allowCurrency"/>
				<label></label>
			</div>
			<div class="ccb-switch-label">
				<?php esc_html_e( 'Currency Symbol On Total Description', 'cost-calculator-builder-pro' ); ?>
			</div>
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large inline">
			<div class="ccb-switch">
				<input type="checkbox" v-model="multiRangeField.allowRound"/>
				<label></label>
			</div>
			<div class="ccb-switch-label">
				<?php esc_html_e( 'Round Value', 'cost-calculator-builder-pro' ); ?>
			</div>
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large inline">
			<div class="ccb-switch">
				<input type="checkbox" v-model="multiRangeField.hidden"/>
				<label></label>
			</div>
			<div class="ccb-switch-label">
				<?php esc_html_e( 'Default hidden', 'cost-calculator-builder-pro' ); ?>
			</div>
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Additional classes', 'cost-calculator-builder-pro' ); ?></label>
			<textarea placeholder="<?php esc_attr_e( 'Enter your classes', 'cost-calculator-builder-pro' ); ?>" v-model="multiRangeField.additionalStyles"></textarea>
		</div>
	</div>
	<div class="actions">
		<div class="right">
			<button type="button" class="white" @click="$emit( 'cancel' )">
				<span><?php esc_html_e( 'Cancel', 'cost-calculator-builder-pro' ); ?></span>
			</button>
			<button type="button" class="green" @click.prevent="$emit( 'save', multiRangeField, id, index)">
				<span><?php esc_html_e( 'Save', 'cost-calculator-builder-pro' ); ?></span>
			</button>
		</div>
	</div>
</div>
