<div :style="additionalCss" class="calc-item ccb-field"
	 :class="[dateField.additionalStyles, {required: $store.getters.isUnused(dateField)}]"
	 v-if="Object.keys($store.getters.getCustomStyles).length"
	 :data-id="dateField.alias">
	<div class="calc-item__title"
		 :style="$store.getters.getCustomStyles['labels']">
		<span> {{ dateField.label }} </span>
		<span v-if="dateField.required" class="calc-required-field">
			*
			<div class="ccb-field-required-tooltip">
				<span class="ccb-field-required-tooltip-text" :class="{active: $store.getters.isUnused(dateField)}" style="display: none;">
					{{ translations.required_field }}
				</span>
			</div>
		</span>
		<span class="is-pro">
			<span class="pro-tooltip">
				pro
				<span style="visibility: hidden;" class="pro-tooltiptext">Feature Available <br> in Pro Version</span>
			</span>
		</span>
	</div>
	
	<p v-if="dateField.desc_option == 'before'" class="calc-description" :style="$store.getters.getCustomStyles['descriptions']">
		{{ dateField.description }}
	</p>
	<customDateCalendarField @setDatetimeField="setDatetimeField" :dateField="dateField"></customDateCalendarField>
	
	<p v-if="dateField.desc_option === undefined || dateField.desc_option == 'after'" class="calc-description" :style="$store.getters.getCustomStyles['descriptions']">{{ dateField.description }}</p>
</div>
