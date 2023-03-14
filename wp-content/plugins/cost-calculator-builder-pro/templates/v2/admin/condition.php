<div class="ccb-condition-content">
	<flow-chart v-if="open" @update="change" :scene.sync="scene" @linkEdit="linkEdit" :height="height"/>
</div>
<div class="ccb-condition-elements ccb-create-calc-sidebar ccb-custom-scrollbar">
	<div class="ccb-sidebar-header">
		<span class="ccb-heading-4 ccb-bold"><?php esc_html_e( 'Elements', 'cost-calculator-builder-pro' ); ?></span>
		<span class="ccb-default-description ccb-light"><?php esc_html_e( 'Click elements for adding', 'cost-calculator-builder-pro' ); ?></span>
	</div>
	<div class="ccb-sidebar-item-list">
		<template v-for="( field, index ) in getElements">
			<div class="ccb-sidebar-item" v-if="field.label && field.label.length" @click.prevent="newNode(field)">
				<span class="ccb-sidebar-item-icon">
					<i :class="field.icon"></i>
				</span>
				<span class="ccb-sidebar-item-box">
					<span class="ccb-default-title ccb-bold">{{ field.label | to-short }}</span>
					<span class="ccb-default-description">{{ field.text }}</span>
				</span>
			</div>
		</template>
		<div class="ccb-sidebar-item-empty"></div>
	</div>
</div>
