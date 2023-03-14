<div class="field-form-wrapper drop-down-with-image">
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Name', 'cost-calculator-builder-pro' ); ?></label>
			<input type="text" placeholder="<?php esc_attr_e( '- Field Label -', 'cost-calculator-builder-pro' ); ?>" v-model.trim="dropField.label">
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Description', 'cost-calculator-builder-pro' ); ?></label>
			<input type="text" placeholder="<?php esc_attr_e( '- Field Description -', 'cost-calculator-builder-pro' ); ?>" v-model.trim="dropField.description">
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Description position', 'cost-calculator-builder-pro' ); ?></label>
			<select v-model="dropField.desc_option">
				<option v-for="(value, key) in getDescOptions" :value="key">
					{{value}}
				</option>
			</select>
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Default Value', 'cost-calculator-builder-pro' ); ?></label>
			<select v-model="dropField.default">
				<option value="" selected><?php esc_html_e( '- Select A Default Value -', 'cost-calculator-builder-pro' ); ?></option>
				<option v-for="(value, index) in dropField.options" :key="index"
						:value="value.optionValue + '_' + index">
					{{value.optionText}}
				</option>
			</select>
		</div>
	</div>

	<div class="field-form-row">
		<div class="form-group large inline">
			<div class="ccb-switch">
				<input type="checkbox" v-model="dropField.allowCurrency"/>
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
				<input type="checkbox" v-model="dropField.allowRound"/>
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
				<input type="checkbox" v-model="dropField.required"/>
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
				<input type="checkbox" v-model="dropField.hidden"/>
				<label></label>
			</div>
			<div class="ccb-switch-label">
				<?php esc_html_e( 'Default hidden', 'cost-calculator-builder-pro' ); ?>
			</div>
		</div>
	</div>

	<div class="field-form-row options">
		<div class="form-group large">
			<label class="form-title">
				<?php esc_attr_e( 'Drop Down Options', 'cost-calculator-builder-pro' ); ?>
				<span class="form-title-description"><?php esc_attr_e( 'You can upload JPG, PNG files max. 5mb', 'cost-calculator-builder-pro' ); ?></span>
			</label>
		</div>
		<div class="form-group large inline add-options with-img" v-for="(option, index) in dropField.options">
			<div class="options dd-options">
				<input type="text" placeholder="<?php esc_attr_e( 'Option Label ...', 'cost-calculator-builder-pro' ); ?>" v-model="option.optionText">
			</div>
			<div class="options dd-options">
				<div class="input-type-number-wrapper">
					<input :name="'option_' + index"
						@keyup="removeErrorTip('errorOptionValue' + index)"
						min="0"
						placeholder="<?php esc_attr_e( 'Option Value ...', 'cost-calculator-builder-pro' ); ?>"
						type="number" step="1" v-model="option.optionValue"
						required>
					<span @click="numberCounterActionForOption(index)" class="input-number-counter up"></span>
					<span @click="numberCounterActionForOption(index, '-')" class="input-number-counter down"></span>
				</div>
				<span :id="'errorOptionValue' + index"></span>
			</div>

			<img-selector :key="option.id"
				:id="option.id"
				:index="index"
				:url="option.src"
				@set="setThumbnail"
				:select_text="translations?.select_image"
			></img-selector>

			<div class="delete-option" @click.prevent="removeOption(index, option.optionValue)">
				<span>
					<i class="fas fa-trash-alt"></i>
				</span>
			</div>
		</div>
		<div class="form-group small">
			<button type="button" class="green" @click="addOption">
				<i class="fas fa-plus"></i>
				<span><?php esc_html_e( 'Add Row', 'cost-calculator-builder-pro' ); ?></span>
			</button>
		</div>
	</div>

	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Additional classes', 'cost-calculator-builder-pro' ); ?></label>
			<textarea placeholder="<?php esc_attr_e( 'Enter your classes', 'cost-calculator-builder-pro' ); ?>" v-model="dropField.additionalStyles"></textarea>
		</div>
	</div>
	<div class="actions">
		<div class="right">
			<button type="button" class="white" @click="$emit( 'cancel' )">
				<span><?php esc_html_e( 'Cancel', 'cost-calculator-builder-pro' ); ?></span>
			</button>
			<button type="button" class="green" @click.prevent="save(dropField, id, index, event)">
				<span><?php esc_html_e( 'Save', 'cost-calculator-builder-pro' ); ?></span>
			</button>
		</div>
	</div>
</div>
