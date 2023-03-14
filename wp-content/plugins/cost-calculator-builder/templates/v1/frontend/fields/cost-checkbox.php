<div class="calc-item ccb-field" :style="additionalCss" :class="{required: $store.getters.isUnused(checkboxField), [checkboxField.additionalStyles]: checkboxField.additionalStyles}" v-if="Object.keys($store.getters.getCustomStyles).length" :data-id="checkboxField.alias">
	<div class="calc-item__title" :style="$store.getters.getCustomStyles['labels']">
		<span> {{ checkboxField.label }} </span>
		<span v-if="checkboxField.required" class="calc-required-field">
			*
			<div class="ccb-field-required-tooltip">
				<span class="ccb-field-required-tooltip-text" :class="{active: $store.getters.isUnused(checkboxField)}" style="display: none;">{{ $store.getters.getSettings.notice.requiredField }}</span>
			</div>
		</span>
	</div>
	<p v-if="checkboxField.desc_option == 'before'" class="calc-description" :style="$store.getters.getCustomStyles['descriptions']">{{ checkboxField.description }}</p>
	<div :class="['calc-checkbox', 'calc_' + checkboxField.alias, { 'horizontally-view': checkboxField.horizontally_view }]">
		<div class="calc-checkbox-item" v-for="( element, index ) in getOptions">
			<input :checked="element.isChecked" type="checkbox" :id="checkboxLabel + index" :value="element.value" @change="change(event, element.label)">
			<label :for="checkboxLabel + index">
				<span :style="$store.getters.getCustomStyles['checkbox']">
					{{ element.label }}
					<span class="ccb-checkbox-hint" v-if="element.hint">
						<img src="<?php echo esc_url( CALC_URL . '/frontend/v1/dist/img/information.svg' ); ?>">
						<span class="ccb-checkbox-hint__content">{{ element.hint }}</span>
					</span>
				</span>
			</label>
		</div>
	</div>
	<p v-if="checkboxField.desc_option === undefined || checkboxField.desc_option == 'after'" class="calc-description" :style="$store.getters.getCustomStyles['descriptions']">{{ checkboxField.description }}</p>
</div>
