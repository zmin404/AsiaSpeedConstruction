<div class="list-row">
	<div class="list-header">
		<div class="ccb-switch">
			<input type="checkbox" v-model="settingsField.woo_products.enable"/>
			<label></label>
		</div>
		<h6><?php esc_html_e( 'Enable Calculator for WooCommerce Products', 'cost-calculator-builder-pro' ); ?></h6>
	</div>
	<div :class="{disabled: !settingsField.woo_products.enable}">
		<div class="list-content" style="margin-top: 0">
			<div class="list-content-label">
				<label><?php esc_attr_e( 'Product Category', 'cost-calculator-builder-pro' ); ?></label>
			</div>
			<select v-model="settingsField.woo_products.category_id">
				<option value="" selected><?php esc_html_e( 'All Categories', 'cost-calculator-builder-pro' ); ?></option>
				<option v-for="(category, index) in $store.getters.getCategories" :key="index" :value="category.term_id">{{category.name}}
				</option>
			</select>
		</div>

		<div class="list-content">
			<div class="list-content-label">
				<label><?php esc_attr_e( 'Calculator Position', 'cost-calculator-builder-pro' ); ?></label>
			</div>
			<select v-model="settingsField.woo_products.hook_to_show">
				<option value="" selected disabled><?php esc_html_e( '- Select Hook For Showing Calculator -', 'cost-calculator-builder-pro' ); ?></option>
				<option value="woocommerce_before_single_product"><?php esc_html_e( 'Before Single Product (At the Top of Product)', 'cost-calculator-builder-pro' ); ?></option>
				<option value="woocommerce_before_add_to_cart_form" v-if="!settingsField.woo_products.hide_woo_cart"><?php esc_html_e( 'Before Add To Cart Form', 'cost-calculator-builder-pro' ); ?></option>
				<option value="woocommerce_after_add_to_cart_form" v-if="!settingsField.woo_products.hide_woo_cart"><?php esc_html_e( 'After Add To Cart Form', 'cost-calculator-builder-pro' ); ?></option>
				<option value="woocommerce_product_meta_start"><?php esc_html_e( 'Before Product Meta', 'cost-calculator-builder-pro' ); ?></option>
				<option value="woocommerce_product_meta_end"><?php esc_html_e( 'After Product Meta', 'cost-calculator-builder-pro' ); ?></option>
				<option value="woocommerce_after_single_product_summary"><?php esc_html_e( 'After Single Product Summary (Before Tabs)', 'cost-calculator-builder-pro' ); ?></option>
				<option value="woocommerce_after_single_product"><?php esc_html_e( 'After Single Product (At the Bottom of Product)', 'cost-calculator-builder-pro' ); ?></option>
			</select>
		</div>

		<div class="list-header" style="margin-top: 30px">
			<div class="ccb-switch">
				<input type="checkbox" v-model="settingsField.woo_products.hide_woo_cart"/>
				<label></label>
			</div>
			<h6><?php esc_html_e( 'Hide WooCommerce Add To Cart Form', 'cost-calculator-builder-pro' ); ?></h6>
		</div>

		<div class="list-content" style="margin-top: 10px;">
			<div class="list-content-label">
				<label><?php esc_html_e( 'Link WooCommerce Meta to Calculator Fields:', 'cost-calculator-builder-pro' ); ?></label>
			</div>
			<div class="list-content woo-links" style="margin-top: 15px">
				<div class="ccb-select-wrap">
					<label class="ccb-select-label"><?php esc_html_e( 'WooCommerce Meta', 'cost-calculator-builder-pro' ); ?></label>
					<label class="ccb-select-label"><?php esc_html_e( 'Action', 'cost-calculator-builder-pro' ); ?></label>
					<label class="ccb-select-label"><?php esc_html_e( 'Calculator Field', 'cost-calculator-builder-pro' ); ?></label>
					<div class="remove-wrap"></div>
				</div>
				<div class="ccb-select-wrap" v-for="(link, index) in $store.getters.getWooMetaLinks" v-if="$store.getters.getWooMetaLinks.length">
					<select class="ccb-woo-select" v-model="link.woo_meta">
						<option value=""><?php esc_html_e( '- Select WooCommerce Field -', 'cost-calculator-builder-pro' ); ?></option>
						<option v-for="meta in $store.getters.getWooMetaFields"
								:value="meta">{{ meta }}
						</option>
					</select>

					<select class="ccb-woo-select" v-model="link.action">
						<option value=""><?php esc_html_e( '- Select Action -', 'cost-calculator-builder-pro' ); ?></option>
						<option v-for="(value, key) in $store.getters.getWooActions"
								:value="key">{{ value }}
						</option>
					</select>

					<select class="ccb-woo-select" v-model="link.calc_field">
						<option value=""><?php esc_html_e( '- Select Calculator Field -', 'cost-calculator-builder-pro' ); ?></option>
						<option v-for="(element, index) in $store.getters.getBuilder"
								v-if="typeof element.alias !== 'undefined'"
								:key="index" :value="element.alias">{{
							element.label }}
						</option>
					</select>

					<div class="remove-wrap">
						<i class="far fa-times-circle" @click.prevent="removeWooMetaLink(index)"></i>
					</div>
				</div>
			</div>

			<div class="list-content" style="margin-top: 15px">
				<div class="list-btn-item">
					<button @click.prevent="addWooMetaLink" type="button"
							class="green">
						<i class="fas fa-plus"></i>
						<span><?php esc_html_e( 'Add New Link', 'cost-calculator-builder-pro' ); ?></span>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
