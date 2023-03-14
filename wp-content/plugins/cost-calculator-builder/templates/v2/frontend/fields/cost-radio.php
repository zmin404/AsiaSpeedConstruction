<?php
/**
 * @file
 * Cost-quantity component's template
 */
?>
<div :style="additionalCss" class="calc-item ccb-field" :class="{required: $store.getters.isUnused(radioField), [radioField.additionalStyles]: radioField.additionalStyles}" :data-id="radioField.alias">
	<div class="calc-item__title">
		<span> {{ radioField.label }} </span>
		<span class="ccb-required-mark" v-if="radioField.required">*</span>
		<span v-if="radioField.required" class="calc-required-field">
			<div class="ccb-field-required-tooltip">
				<span class="ccb-field-required-tooltip-text" :class="{active: $store.getters.isUnused(radioField)}" style="display: none;">{{ $store.getters.getSettings.texts.required_msg }}</span>
			</div>
		</span>
	</div>

	<div class="calc-item__description before">
		<span>{{ radioField.description }}</span>
	</div>
	<div class="calc-radio-wrapper" :class="[radioView, {'calc-field-disabled': getStep === 'finish'}, 'calc_' + radioField.alias]">
		<label v-for="(element, index) in getOptions">
			<input type="radio" :name="radioLabel" v-model="radioValue" :value="element.value">
			<span class="calc-radio-label">{{ element.label }}</span>
		</label>
	</div>

	<div class="calc-item__description after">
		<span>{{ radioField.description }}</span>
	</div>
</div>
