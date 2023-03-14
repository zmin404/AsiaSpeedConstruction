<div class="calc-buttons" style="min-height: 50px; margin-top: 20px; position: relative" v-if="getWooCheckoutSettings.enable">
	<loader-wrapper v-if="loader" :form="true" :idx="getPreloaderIdx" width="60px" height="60px" scale="0.8" :front="true"></loader-wrapper>
	<button class="calc-btn-action success" @click="applyWoo(<?php the_ID(); ?>)" v-else >
		<?php esc_html_e( 'Add To Cart', 'cost-calculator-builder-pro' ); ?>
	</button>
	<span class="is-pro" v-if="!loader">pro</span>
</div>
