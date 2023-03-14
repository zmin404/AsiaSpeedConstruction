<div class="ccb-btn-wrap" style="margin-top: 20px" v-if="getWooCheckoutSettings.enable">
	<p style="color: red; text-align: center; margin-bottom: 10px;" v-if="message"><?php esc_html_e( 'Something went wrong, please try again!', 'cost-calculator-builder-pro' ); ?></p>
	<loader class="front" v-if="loader"></loader>
	<button @click="applyWoo(<?php the_ID(); ?>)" v-else :style="$store.getters.getCustomStyles['buttons']">
		<?php esc_html_e( 'Add To Cart', 'cost-calculator-builder-pro' ); ?>
	</button>
	<span class="is-pro" v-if="!loader">pro</span>
</div>
