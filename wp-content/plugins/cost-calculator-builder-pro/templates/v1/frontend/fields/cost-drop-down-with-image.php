<div class="calc-item ccb-field" :style="additionalCss"
	:class="{required: $store.getters.isUnused(dropDownField), [dropDownField.additionalStyles]: dropDownField.additionalStyles}"
	v-if="Object.keys($store.getters.getCustomStyles).length"
	:data-id="dropDownField.alias">
	<div class="calc-item__title"
		:style="$store.getters.getCustomStyles['labels']">
		<span>{{ dropDownField.label }}</span>
		<span v-if="dropDownField.required" class="calc-required-field">
			*
			<div class="ccb-field-required-tooltip">
				<span class="ccb-field-required-tooltip-text"
					:class="{active: $store.getters.isUnused(dropDownField)}"
					style="display: none;">{{ $store.getters.getSettings.notice.requiredField }}
				</span>
			</div>
		</span>
	</div>

	<p v-if="dropDownField.desc_option == 'before'" class="calc-description" :style="$store.getters.getCustomStyles['descriptions']">{{ dropDownField.description }}</p>

	<div :class="['ccb-drop-down', 'calc_' + dropDownField.alias, {'calc-field-disabled': disabled}]">
		<div class="calc-drop-down-with-image">
			<div class="calc-drop-down-wrapper">
				<span class="calc-drop-down-with-image-current"
					@click="openList = !openList" :style="getStyles"
					:data-alias="dropDownField.alias">
					<img v-if="getCurrent" :src="getCurrent.src" alt="current-img">
					<span>{{ getCurrent ? getCurrent.label : '<?php esc_html_e( '- Select value -', 'cost-calculator-builder-pro' ); ?>' }}</span>
					<span :class="['ccb-arrow', {'ccb-arrow-up' : openList}, {'ccb-arrow-down': !openList}]" :style="gerArrowsStyles"></span>
					<span class="calc-current-image-placeholder"></span>
				</span>
				<div :class="[{'calc-list-open': openList}, 'calc-drop-down-with-image-list']" :style="getListStyles">
					<ul class="calc-drop-down-with-image-list-items">
						<li @click="selectOption(null)"
							:style="getOptionStyles">
							<span class="calc-list-title"><?php esc_html_e( '- Select value -', 'cost-calculator-builder-pro' ); ?></span>
						</li>
						<li v-for="element in getOptions" :key="element.value"
							:value="element.value"
							@click="selectOption(element)"
							:style="getOptionStyles">
							<img :src="element.src" alt="field-img"/>
							<span class="calc-list-wrapper">
								<span class="calc-list-title">{{ element.label }}</span>
								<span class="calc-list-price" v-if="dropDownField.allowCurrency"><?php esc_html_e( 'Price', 'cost-calculator-builder-pro' ); ?>: {{ element.converted }}</span>
							</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<p v-if="dropDownField.desc_option === undefined || dropDownField.desc_option == 'after'" class="calc-description" :style="$store.getters.getCustomStyles['descriptions']">{{ dropDownField.description }}</p>
</div>
