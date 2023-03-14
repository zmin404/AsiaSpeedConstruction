<div :style="additionalCss" class="calc-item" v-if="Object.keys($store.getters.getCustomStyles).length" :class="multiRange.additionalStyles" :data-id="multiRange.alias">
	<div class="calc-range " :class="'calc_' + multiRange.alias">
		<div class="calc-item__title" :style="$store.getters.getCustomStyles['labels']" style="display: flex; justify-content: space-between">
			<span>
				{{ multiRange.label }}
				<span class="is-pro">
					<span class="pro-tooltip">
						pro
						<span style="visibility: hidden;"
							 class="pro-tooltiptext">Feature Available <br> in Pro Version</span>
					</span>
				</span>
			</span>
			<span> {{ leftVal }} - {{ rightVal }}  {{ multiRange.sign ? multiRange.sign : '' }}</span>
		</div>

		<p v-if="multiRange.desc_option == 'before'" class="calc-description" :style="$store.getters.getCustomStyles['descriptions']">{{ multiRange.description }}</p>

		<div :class="['range_' + multiRange.alias]"></div>

		<p v-if="multiRange.desc_option === undefined || multiRange.desc_option == 'after'" class="calc-description" :style="$store.getters.getCustomStyles['descriptions']">{{ multiRange.description }}</p>
	</div>
</div>
