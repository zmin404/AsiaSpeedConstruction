<div class="list-row">

	<div class="list-header">
		<div class="ccb-switch">
			<input type="checkbox" v-model="settingsField.paypal.enable"/>
			<label></label>
		</div>
		<h6><?php esc_html_e( 'Enable PayPal', 'cost-calculator-builder-pro' ); ?></h6>
	</div>
	<div :class="{disabled: !settingsField.paypal.enable}">
		<div class="list-content" style="margin-top: 0">
			<div class="list-content-label">
				<div class="paypal-ipn">
					<div class="paypal-ipn__title">
						<div><?php esc_html_e( 'Paypal Ipn Setup', 'cost-calculator-builder-pro' ); ?></div>
					</div>
					<div class="paypal-ipn__subtitle">
						<?php esc_html_e( 'You need to use this URL for your IPN Listener Settings:', 'cost-calculator-builder-pro' ); ?>
					</div>
					<div class="paypal-ipn__url">
						<span class="paypal-ipn__value"><?php echo esc_url( get_home_url() . '/?stm_ccb_check_ipn=1' ); ?></span>
						<button @click.prevent="copyIPN" @mouseleave="copy.text = 'Copy'" class="paypal-ipn__button">{{ copy.text }}</button>
						<input type="hidden" class="paypal-ipn__input" value="<?php echo esc_url( get_home_url() . '/?stm_ccb_check_ipn=1' ); ?>" />
					</div>
				</div>
			</div>
		</div>

		<div class="list-content" style="margin-top: 0">
			<div class="list-content-label">
				<label><?php esc_attr_e( 'Email', 'cost-calculator-builder-pro' ); ?></label>
			</div>
			<input type="text" placeholder="<?php esc_attr_e( '- PayPal Email -', 'cost-calculator-builder-pro' ); ?>" v-model="settingsField.paypal.paypal_email">
		</div>

		<div class="list-content">
			<div class="list-content-label">
				<label><?php esc_attr_e( 'Currency', 'cost-calculator-builder-pro' ); ?></label>
			</div>
			<select v-model="settingsField.paypal.currency_code">
				<option value="" selected disabled><?php esc_html_e( '- Select Currency Symbol -', 'cost-calculator-builder-pro' ); ?></option>
				<option v-for="(element, index) in currencies" :key="index" :value="element.value">{{element.alias}}</option>
			</select>
		</div>

		<div class="list-content">
			<div class="list-content-label">
				<label><?php esc_attr_e( 'Account Type', 'cost-calculator-builder-pro' ); ?></label>
			</div>
			<select v-model="settingsField.paypal.paypal_mode">
				<option value="" selected disabled><?php esc_html_e( '- Select type of .... -', 'cost-calculator-builder-pro' ); ?></option>
				<option v-for="(element, index) in modes" :key="index" :value="element.value">{{element.alias}}</option>
			</select>
		</div>

		<div class="list-content">
			<div class="list-content-label">
				<label><?php esc_attr_e( 'Total Field Element', 'cost-calculator-builder-pro' ); ?></label>
			</div>
			<textarea v-model="settingsField.paypal.description"></textarea>
			<?php
			// @codingStandardsIgnoreStart
			$desc_url  = 'https://docs.stylemixthemes.com/cost-calculator-builder/pro-plugin-features/woo-checkout';
			$desc_link = sprintf(
				wp_kses(
					__( 'Connection shortcode for linking a selling service or product to online payment systems. %s will be changed into total. <a href="%s">Read more</a>', 'cost-calculator-builder-pro' ),
					array( 'a' => array( 'href' => array() ) )
				),
				'[ccb-total-0]',
				esc_url( $desc_url )
			);
			?>
			<p class="list-content__desc">
				<?php echo $desc_link;
			// @codingStandardsIgnoreStart
			?>
			</p>
		</div>
	</div>
</div>
