<div class="ccb-page-content condition">
	<div class="condition-wrapper">
		<div class="condition-content">
			<div class="ccb-condition-wrap">
				<div class="ccb-c-container">
					<flow-chart @update="change" :scene.sync="scene" @linkEdit="linkEdit" v-bind:height="800"/>
				</div>
			</div>
		</div>
		<div class="condition-fields ">
			<div class="fields-header condition">
				<h4><?php esc_html_e( 'Your Elements', 'cost-calculator-builder-pro' ); ?></h4>
				<p><?php esc_html_e( 'Click Element for adding', 'cost-calculator-builder-pro' ); ?></p>
			</div>
			<div class="fields-wrapper condition">
				<div class="calc-field-row">

					<div class="calc-field" v-for="( field, index ) in getElements" @click.prevent="newNode(field)">
						<div class="calc-field__container" v-if="field.label && field.label.length">
							<div class="calc-field__content">
								<h6 class="calc-field__title">{{ field.label |
									to-short }}</h6>
								<i class="calc-field__icon" :class="field.icon"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
