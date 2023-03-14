<div class="sub-list-item next-btn">
	<div class="ccb-next-content">
		<div class="payment-methods">
			<calc-payments inline-template v-if="type === 'payment'">
				<?php echo \cBuilder\Classes\CCBProTemplate::load( 'frontend/partials/calc-payments', [ 'settings' => $settings ] ); //phpcs:ignore ?>
			</calc-payments>

			<calc-woo-checkout inline-template v-if="type === 'woo_checkout'">
				<?php echo \cBuilder\Classes\CCBProTemplate::load( 'frontend/partials/woo-checkout' ); //phpcs:ignore ?>
			</calc-woo-checkout>

			<template v-if="settings.woo_products?.enable">
				<?php echo \cBuilder\Classes\CCBProTemplate::load( 'frontend/partials/woo-products' ); //phpcs:ignore ?>
			</template>

			<calc-form inline-template v-if="type === 'form'" :settings="settings">
				<div>
					<?php if ( ! empty( $settings ) ) : ?>
						<template v-if="'<?php echo ! empty( $settings ) //phpcs:ignore ?>'">
							<?php echo \cBuilder\Classes\CCBProTemplate::load( 'frontend/partials/calc-form', [ 'settings' => $settings ] ); //phpcs:ignore ?>
						</template>
					<?php endif; ?>
					<template v-if="'<?php echo empty( $settings ) //phpcs:ignore ?>'">
						<div class="calc-form-wrapper">
							<div class="ccb-btn-wrap" v-if="getSettings">
								<button :style="$store.getters.getCustomStyles['buttons']"><?php esc_html_e( 'Submit', 'cost-calculator-builder-pro' ); ?></button>
							</div>
						</div>
					</template>
				</div>
			</calc-form>
		</div>
	</div>
</div>
