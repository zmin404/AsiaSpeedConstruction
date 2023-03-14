<div class="list-row">
	<div class="list-header">
		<div class="ccb-switch">
			<input type="checkbox" v-model="settingsField.stripe.enable"/>
			<label></label>
		</div>
		<h6><?php esc_html_e( 'Enable Stripe', 'cost-calculator-builder-pro' ); ?></h6>
	</div>
	<div :class="{disabled: !settingsField.stripe.enable}">
		<div class="list-content" style="margin-top: 0">
			<div class="list-content-label">
				<label><?php esc_attr_e( 'Public Key', 'cost-calculator-builder-pro' ); ?></label>
			</div>
			<input type="text" placeholder="<?php esc_attr_e( '- Stripe Public Key -', 'cost-calculator-builder-pro' ); ?>" v-model="settingsField.stripe.publishKey">
		</div>

		<div class="list-content">
			<div class="list-content-label">
				<label><?php esc_attr_e( 'Secret Key', 'cost-calculator-builder-pro' ); ?></label>
			</div>
			<input type="text" v-model="settingsField.stripe.secretKey" placeholder="<?php esc_attr_e( '- Stripe Secret Key -', 'cost-calculator-builder-pro' ); ?>">
		</div>

		<div class="list-content">
			<div class="list-content-label">
				<label><?php esc_attr_e( 'Currency Format', 'cost-calculator-builder-pro' ); ?></label>
			</div>
			<input type="text" v-model="settingsField.stripe.currency" placeholder="<?php esc_attr_e( '- Stripe Currency Format -', 'cost-calculator-builder-pro' ); ?>">
		</div>

		<div class="list-content">
			<div class="list-content-label">
				<label><?php esc_attr_e( 'Total Field Element', 'cost-calculator-builder-pro' ); ?></label>
			</div>
			<textarea v-model="settingsField.stripe.description"></textarea>
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
