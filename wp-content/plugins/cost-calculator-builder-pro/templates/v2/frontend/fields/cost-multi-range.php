<?php
/**
 * @file
 * Cost-date-picker component's template
 */
?>

<div :style="additionalCss" class="calc-item" :class="multiRange.additionalStyles" :data-id="multiRange.alias">
	<div class="calc-range " :class="['calc_' + multiRange.alias, {'calc-field-disabled': getStep === 'finish'}]">
		<div class="calc-item__title ccb-range-field">
			<span>
				{{ multiRange.label }}
				<span class="is-pro">
					<span class="pro-tooltip">
						pro
						<span style="visibility: hidden;" class="pro-tooltiptext">Feature Available <br> in Pro Version</span>
					</span>
				</span>
			</span>
			<span> {{ leftVal }} - {{ rightVal }}  {{ multiRange.sign ? multiRange.sign : '' }}</span>
		</div>

		<div class="calc-item__description before">
			<span>{{ multiRange.description }}</span>
		</div>

		<div :class="['range_' + multiRange.alias]"></div>

		<div class="calc-item__description after">
			<span>{{ multiRange.description }}</span>
		</div>
	</div>
</div>
