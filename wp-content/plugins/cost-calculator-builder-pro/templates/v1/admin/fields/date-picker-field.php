<div class="field-form-wrapper">
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Name', 'cost-calculator-builder-pro' ); ?></label>
			<input type="text" placeholder="<?php esc_attr_e( '- Field Label -', 'cost-calculator-builder-pro' ); ?>" v-model.trim="dateField.label">
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Description', 'cost-calculator-builder-pro' ); ?></label>
			<input type="text" placeholder="<?php esc_attr_e( '- Field Description -', 'cost-calculator-builder-pro' ); ?>" v-model.trim="dateField.description">
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Description position', 'cost-calculator-builder-pro' ); ?></label>
			<select v-model="dateField.desc_option">
				<option v-for="(value, key) in getDescOptions" :value="key">
					{{value}}
				</option>
			</select>
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Placeholder', 'cost-calculator-builder-pro' ); ?></label>
			<input type="text"
				placeholder="<?php esc_attr_e( '- Field Placeholder -', 'cost-calculator-builder-pro' ); ?>"
				v-model.trim="dateField.placeholder">
		</div>
	</div>

	<div class="field-form-row">
		<div class="form-group large inline">
			<div class="ccb-switch">
				<input type="checkbox" v-model="dateField.required"/>
				<label></label>
			</div>
			<div class="ccb-switch-label">
				<?php esc_html_e( 'Required', 'cost-calculator-builder-pro' ); ?>
			</div>
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large inline">
			<div class="ccb-switch">
				<input type="checkbox" v-model="dateField.min_date"/>
				<label></label>
			</div>
			<div class="ccb-switch-label">
				<?php esc_html_e( 'Toggle Datepicking restrictions', 'cost-calculator-builder-pro' ); ?>
			</div>
			<div class="help-tip-block">
				<span class="round-icon" @mouseover="showHelp.min_date = true" @mouseleave="showHelp.min_date = false">?</span>
				<div class="help" v-if="showHelp.min_date">
					<div class="help-tip">
						<?php esc_attr_e( 'Disable for no restrictions set (i.e. for date of birth)', 'cost-calculator-builder-pro' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="field-form-row" v-if="dateField.min_date">
		<div class="form-group large">
			<label>
				<?php esc_attr_e( 'Datepicking is allowed from current date +', 'cost-calculator-builder-pro' ); ?>
				<div class="help-tip-block">
					<span class="round-icon" @mouseover="showHelp.min_date_days = true" @mouseleave="showHelp.min_date_days = false">?</span>
					<div class="help" v-if="showHelp.min_date_days">
						<div class="help-tip">
							<?php esc_attr_e( 'Set 0 for current date to be a minimum date for selection', 'cost-calculator-builder-pro' ); ?>
						</div>
					</div>
				</div>
			</label>
			<div class="input-type-number-wrapper">
				<input name="min_date_days"
						:class="{'error': errors.hasOwnProperty('min_date_days') && errors.min_date_days == true }"
						@input="validate()" min="0"
						placeholder="<?php esc_attr_e( 'Set 0 for current date to be a minimum date for selection', 'cost-calculator-builder-pro' ); ?>" type="number"
						step="1" v-model="dateField.min_date_days"/>
				<span @click="numberCounterAction('min_date_days')" class="input-number-counter up"></span>
				<span @click="numberCounterAction('min_date_days', '-')" class="input-number-counter down"></span>
			</div>
			<span v-if="errors.hasOwnProperty('min_date_days') && errors.min_date_days == true" class="error-tip">
				<?php esc_attr_e( 'Value must be integer', 'cost-calculator-builder-pro' ); ?>
			</span>
		</div>
	</div>

	<div class="field-form-row">
		<div class="form-group large inline">
			<div class="ccb-switch">
				<input type="checkbox" v-model="dateField.hidden"/>
				<label></label>
			</div>
			<div class="ccb-switch-label">
				<?php esc_html_e( 'Default hidden', 'cost-calculator-builder-pro' ); ?>
			</div>
		</div>
	</div>

	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Calendar Option', 'cost-calculator-builder-pro' ); ?></label>
			<select v-model="dateField.range">
				<option value="1"><?php esc_html_e( 'With range', 'cost-calculator-builder-pro' ); ?></option>
				<option value="0"><?php esc_html_e( 'No range', 'cost-calculator-builder-pro' ); ?></option>
			</select>
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Additional classes', 'cost-calculator-builder-pro' ); ?></label>
			<textarea placeholder="<?php esc_attr_e( 'Enter your classes', 'cost-calculator-builder-pro' ); ?>" v-model="dateField.additionalStyles"></textarea>
		</div>
	</div>

	<div class="actions">
		<div class="right">
			<button type="button" class="white" @click="$emit( 'cancel' )">
				<span><?php esc_html_e( 'Cancel', 'cost-calculator-builder-pro' ); ?></span>
			</button>
			<button type="button" class="green" @click.prevent="saveField">
				<span><?php esc_html_e( 'Save', 'cost-calculator-builder-pro' ); ?></span>
			</button>
		</div>
	</div>
</div>

