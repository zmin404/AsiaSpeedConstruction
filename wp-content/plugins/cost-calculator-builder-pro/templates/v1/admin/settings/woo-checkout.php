<div class="list-row">
	<div class="list-header">
		<div class="ccb-switch">
			<input type="checkbox" v-model="settingsField.woo_checkout.enable"/>
			<label></label>
		</div>
		<h6><?php esc_html_e( 'Enable WooCommerce Checkout', 'cost-calculator-builder-pro' ); ?></h6>
	</div>
	<div :class="{disabled: !settingsField.woo_checkout.enable}">
		<div class="list-content" style="margin-top: 0">
			<div class="list-content-label">
				<label><?php esc_attr_e( 'Product', 'cost-calculator-builder-pro' ); ?></label>
			</div>
			<select v-model="settingsField.woo_checkout.product_id">
				<option value="" selected disabled><?php esc_html_e( '- Select WooCommerce Product -', 'cost-calculator-builder-pro' ); ?></option>
				<option value="current_product" v-if="settingsField.woo_products.enable"><?php esc_html_e( '%Current Woo Product%', 'cost-calculator-builder-pro' ); ?></option>
				<option v-for="(product, index) in $store.getters.getProducts" :key="index" :value="product.ID">{{product.post_title}}
				</option>
			</select>
		</div>

		<div class="list-content">
			<div class="list-content-label">
				<label><?php esc_html_e( 'Redirect after Submits', 'cost-calculator-builder-pro' ); ?></label>
			</div>
			<div class="ccb-radio-wrapper">
				<input id="redirect_to_cart" type="radio" v-model="settingsField.woo_checkout.redirect_to" name="redirect_to" value="cart" checked>
				<label for="redirect_to_cart">
					<?php esc_html_e( 'to Cart page', 'cost-calculator-builder-pro' ); ?>
				</label>

				<input id="redirect_to_checkout" type="radio" v-model="settingsField.woo_checkout.redirect_to" name="redirect_to" value="checkout">
				<label for="redirect_to_checkout">
					<?php esc_html_e( 'to Checkout page', 'cost-calculator-builder-pro' ); ?>
				</label>
			</div>
		</div>

		<div class="list-content">
			<div class="list-content-label">
				<label><?php esc_attr_e( 'Total Field Element', 'cost-calculator-builder-pro' ); ?></label>
			</div>
			<textarea v-model="settingsField.woo_checkout.description"></textarea>
			<?php
			$desc_url  = 'https://docs.stylemixthemes.com/cost-calculator-builder/pro-plugin-features/woo-checkout';
			$desc_link = sprintf(
				wp_kses(
					__( 'Connection shortcode for linking a selling service or product to online payment systems. %s will be changed into total. <a href="%s">Read more</a>', 'cost-calculator-builder-pro' ), //phpcs:ignore
					array( 'a' => array( 'href' => array() ) )
				),
				'[ccb-total-0]',
				esc_url( $desc_url )
			);
			?>
			<p class="list-content__desc"><?php echo $desc_link; //phpcs:ignore ?></p>
		</div>
	</div>
</div>
