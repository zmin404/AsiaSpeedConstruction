<div class="sub-list-item next-btn">
	<div class="ccb-next-content">
		<div class="payment-methods">
			<calc-payments  inline-template v-if="type === 'payment'">
				<?php echo \cBuilder\Classes\CCBProTemplate::load( 'frontend/partials/calc-payments', array( 'settings' => $settings, 'general_settings' => $general_settings ) ); // phpcs:ignore ?>
			</calc-payments>

			<calc-woo-checkout inline-template v-if="type === 'woo_checkout'">
				<?php echo \cBuilder\Classes\CCBProTemplate::load( 'frontend/partials/woo-checkout' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</calc-woo-checkout>

			<template v-if="settings.woo_products?.enable">
				<?php echo \cBuilder\Classes\CCBProTemplate::load( 'frontend/partials/woo-products' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</template>

			<calc-form inline-template v-if="type === 'form'" :settings="settings">
				<div>
					<?php if ( ! empty( $settings ) && ! empty( $general_settings ) ) : ?>
						<template>
							<?php echo \cBuilder\Classes\CCBProTemplate::load( 'frontend/partials/calc-form', array( 'settings' => $settings, 'general_settings' => $general_settings ) ); // phpcs:ignore ?>
						</template>
					<?php elseif ( empty( $settings ) && empty( $general_settings ) ) : ?>
						<template>
							<div class="calc-form-wrapper">
								<div class="ccb-btn-wrap calc-buttons" v-if="getSettings">
									<button class="calc-btn-action success"><?php esc_html_e( 'Submit', 'cost-calculator-builder-pro' ); ?></button>
								</div>
							</div>
						</template>
					<?php endif; ?>
				</div>
			</calc-form>
		</div>
	</div>
</div>
