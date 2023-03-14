<modal-add-field ref="calc-modal" inline-template>
	<div class="ccb-modal-wrapper" :class="{open: modal.isOpen, hide: modal.hide}">
		<div class="modal-overlay">
			<div class="modal-window" :class="getModalType">
				<div class="modal-window-content">
					<span @click="closeModal()" class="close"><span class="close-icon"></span></span>
					<template v-if="getModalType === 'add-field'">
						<?php echo \cBuilder\Classes\CCBTemplate::load( '/admin/modal/add-field' ); //phpcs:ignore ?>
					</template>
					<template v-else-if="getModalType === 'existing'">
						<?php echo \cBuilder\Classes\CCBTemplate::load( '/admin/partials/existing' ); //phpcs:ignore ?>
					</template>
					<template v-else-if="getModalType === 'create-new'">
						<?php echo \cBuilder\Classes\CCBTemplate::load( '/admin/modal/create-new' ); //phpcs:ignore ?>
					</template>
					<template v-else-if="getModalType === 'preview'">
						<?php echo \cBuilder\Classes\CCBTemplate::load( '/admin/modal/modal-preview' ); //phpcs:ignore ?>
					</template>
					<template v-else-if="getModalType === 'condition'">
						<?php echo \cBuilder\Classes\CCBTemplate::load( '/admin/modal/condition' ); //phpcs:ignore ?>
					</template>
				</div>
			</div>
		</div>
	</div>
</modal-add-field>
