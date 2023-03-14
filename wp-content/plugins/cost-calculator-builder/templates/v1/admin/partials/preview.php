<?php
$default_img = CALC_URL . '/frontend/v1/dist/img/default.png';
?>

<preview inline-template>
	<div class="modal-body preview">
		<calc-builder-front :custom="1" :content="{...preview_data, default_img: '<?php echo esc_attr( $default_img ); ?>'}" inline-template :id="getId">
			<div ref="calc" class="calc-container" :class="box_style" :data-calc-id="getId">
				<loader v-if="loader"></loader>
				<template>
					<div class="calc-fields calc-list" :style="getStyles[getContainerStyle]" :class="{loaded: !loader, 'payment' :  getHideCalc}" v-if="!loader">
						<div class="calc-item-title">
							<h4 :style="getStyles['headers']"> {{ getTitle }} </h4>
						</div>
						<template v-for="field in content.fields">

							<template v-if="field && field.alias && field.type !== 'Total'">
								<component
										text-days="<?php esc_attr_e( 'days', 'cost-calculator-builder' ); ?>"
										v-if="fields[field.alias]"
										:is="field._tag"
										:id="getId"
										:style="box_style"
										:field="field"
										v-model="fields[field.alias].value"
										v-on:[field._event]="change"
										v-on:condition-apply="renderCondition"
								>
								</component>
							</template>
							<template v-else-if="field && !field.alias && field.type !== 'Total'">
								<component
										:id="getId"
										:style="box_style"
										:is="field._tag"
										:field="field"
								>
								</component>
							</template>
						</template>
					</div>

					<div class="calc-subtotal calc-list " :class="{loaded: !loader}" :style="getStyles[getContainerStyle]">
						<div class="calc-item title">
							<h4 :style="getStyles['headers']">{{ getHeaderTitle }}</h4>
						</div>
						<div class="calc-subtotal-list">
							<template v-for="field in getTotalSummaryFields" v-if="field.alias.indexOf('total') === -1 && settings && settings.general.descriptions === 'show'">

								<div :class="[field.alias, 'sub-list-item']" :style="{...getStyles['total-summary'], display: field.hidden ? 'none' : 'flex'}">
									<span class="sub-item-title"> {{ field.label | to_short(getContainerStyle, 50) }}</span>
									<span class="sub-item-value"> {{ field.converted }} </span>
								</div>

								<div :class="[field.alias, 'sub-list-item inner']" :style="getStyles['total-summary']" v-if="field.options && field.options.length && ['checkbox', 'toggle'].includes(field.alias.replace(/\_field_id.*/,''))">
									<div class="sub-inner" v-for="option in field.options">
										<span class="sub-item-title"> {{ option.label | to_short(getContainerStyle) }} </span>
										<span class="sub-item-value"> {{ option.converted }} </span>
									</div>
								</div>
							</template>

							<div :style="[ item.hidden ? { display: 'none' } : 'flex' ]" :class="['sub-list-item total', item.additionalStyles]" v-for="item in formula" :id="item.alias">
								<span class="sub-item-title" :style="getStyles['total']"> {{ item.label }} </span>
								<span class="sub-item-value" :style="getStyles['total']"> {{ item.converted }} </span>
							</div>
							<?php if ( ccb_pro_active() ) : ?>
								<cost-pro-features inline-template :settings="content.settings">
									<?php echo \cBuilder\Classes\CCBProTemplate::load( 'frontend/pro-features', array( 'settings' => array() ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</cost-pro-features>
							<?php endif; ?>
						</div>
					</div>
				</template>
			</div>
		</calc-builder-front>
	</div>
</preview>
