<div :style="additionalCss" class="calc-item ccb-field"
	 v-if="Object.keys($store.getters.getCustomStyles).length"
	 :class="{required: $store.getters.isUnused(fileUpload), [fileUpload.additionalStyles]: fileUpload.additionalStyles}"
	 :data-id="fileUpload.alias">
	<div class="calc-file-upload " :class="'calc_' + fileUpload.alias">
		<div class="calc-item__title" :style="$store.getters.getCustomStyles['labels']">
		<span class="ccb-label-span">
			{{ fileUpload.label }}
			<span v-if="(errors.hasOwnProperty('fileUploadUrl') && errors.fileUploadUrl) || $store.getters.isUnused(fileUpload)" class="ccb-error">
				<div class="ccb-error-tooltip">
					<p v-if="errors.hasOwnProperty('fileUploadUrl') && errors.fileUploadUrl">
						{{ errors.fileUploadUrl }}
					</p>
					<p v-if="$store.getters.isUnused(fileUpload)">
						{{ $store.getters.getSettings.notice.requiredField }}
					</p>
				</div>
			</span>
			<span class="is-pro">
				<span class="pro-tooltip">pro
					<span style="visibility: hidden;" class="pro-tooltiptext">Feature Available <br> in Pro Version</span>
				</span>
			</span>
		</span>
		<span v-if="fileUpload.required" class="calc-required-field">
			*
		</span>
		<div class="info-tip-block">
			<span class="info-icon" @mouseover="showInfo = true"
				@mouseleave="showInfo = false">
				<div class="info" v-if="showInfo">
					<div class="info-tip">
						<span>
						<?php esc_html_e( 'Supported file formats:', 'cost-calculator-builder-pro' ); ?>
						</span>
						<span class="bold uppercase">{{ fileUpload.fileFormats.join(', ') }}</span>
						<span class="lighter">
						<?php esc_html_e( 'max', 'cost-calculator-builder-pro' ); ?> {{ fileUpload.max_file_size }}mb
					</span>

				</div>
				</div>
			</span>
		</div>
		</div>
		<p v-if="fileUpload.desc_option == 'before'" class="calc-description" :style="$store.getters.getCustomStyles['descriptions']">{{ fileUpload.description }}</p>

		<div class="calc-buttons">
			<input @change="addFiles" type="file" ref="file" :accept="allowedFormats.map(item=> `.${item}`).join(',')" :multiple="fileUpload.max_attached_files > 1"/>
			<button :disabled="fileUpload.max_attached_files <= parseInt(uploadedFiles.length)" :style="$store.getters.getCustomStyles['buttons']"
					@click="chooseFileBtn"><?php esc_html_e( 'Choose file', 'cost-calculator-builder-pro' ); ?></button>
			<button :disabled="fileUpload.max_attached_files <= parseInt(uploadedFiles.length)"
					:style="$store.getters.getCustomStyles['buttons']"
					@click.prevent="uploadFromUrlBtn"><?php esc_html_e( 'Upload from URL', 'cost-calculator-builder-pro' ); ?></button>
		</div>
		<div v-if="uploadFromUrl" class="calc-input-wrapper ccb-field url-file-upload">
			<div class="ccb-url-file-upload-input">
				<input :class="[{'error': ( errors.hasOwnProperty('fileUploadUrl') && errors.fileUploadUrl ) }, 'calc-input file-url-upload ccb-field cleanable vertical']" v-model="fileUploadUrl" :style="inputStyles" placeholder="<?php esc_html_e( 'Enter file url', 'cost-calculator-builder-pro' ); ?>" type="search"/>
			</div>
			<button :class="{disabled: (fileUploadUrl.length <= 0 || ( errors.hasOwnProperty('fileUploadUrl') && errors.fileUploadUrl ))}"
					:disabled="fileUploadUrl.length <= 0"
					:style="$store.getters.getCustomStyles['buttons']"
					@click.prevent="uploadFileFromUrl()"><?php esc_html_e( 'Upload', 'cost-calculator-builder-pro' ); ?></button>
		</div>
		<div v-if="uploadedFiles.length > 0" class="calc-uploaded-files">
			<div class="ccb-uploaded-file-list-info" v-if="uploadedFiles.length > 3" @click="openFileList = !openFileList;">
				<i :style="{'color': iconColor}" class="fas fa-check-circle"></i>
				<span>{{ uploadedFiles.length }} <?php esc_html_e( 'files uploaded', 'cost-calculator-builder-pro' ); ?></span>
				<i :class="['ccb-select-anchor',{ 'open': openFileList}]" @click="openFileList = !openFileList;"></i>
			</div>
			<div class="ccb-uploaded-file-list" v-if="openFileList || uploadedFiles.length <= 3">
				<span :style='fileUploadStyles' v-for="(uploadedFile, uploadedFileIndex) in uploadedFiles" class="file-name">
					{{ uploadedFile.name }} <i @click.prevent="removeFile(uploadedFileIndex)" class="remove"></i>
				</span>
			</div>
		</div>

		<p v-if="fileUpload.desc_option === undefined || fileUpload.desc_option == 'after'" class="calc-description" :style="$store.getters.getCustomStyles['descriptions']">{{ fileUpload.description }}</p>
	</div>
</div>
