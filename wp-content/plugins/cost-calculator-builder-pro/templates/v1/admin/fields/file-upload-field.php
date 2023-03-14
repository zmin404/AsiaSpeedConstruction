<div class="field-form-wrapper file-upload">
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Name', 'cost-calculator-builder-pro' ); ?></label>
			<input type="text" placeholder="<?php esc_attr_e( '- Field Label -', 'cost-calculator-builder-pro' ); ?>" v-model.trim="fileUploadField.label">
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Description', 'cost-calculator-builder-pro' ); ?></label>
			<input type="text" placeholder="<?php esc_attr_e( '- Field Description -', 'cost-calculator-builder-pro' ); ?>" v-model.trim="fileUploadField.description">
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group medium">
			<label><?php esc_attr_e( 'Description position', 'cost-calculator-builder-pro' ); ?></label>
			<select v-model="fileUploadField.desc_option">
				<option v-for="(value, key) in descOptions" :value="key">
					{{value}}
				</option>
			</select>
		</div>
		<div class="form-group medium">
			<label><?php esc_attr_e( 'Maximum file size MB', 'cost-calculator-builder-pro' ); ?></label>
			<div class="input-type-number-wrapper">
				<input v-model="fileUploadField.max_file_size"
						name="max_file_size"
						:class="{'error': fieldErrors.hasOwnProperty('max_file_size') && fieldErrors.max_file_size != null }"
						min="0"
						max="<?php echo esc_attr( round( wp_max_upload_size() / 1024 / 1024 ) ); ?>"
						placeholder="<?php esc_attr_e( '- Maximum file size KB -', 'cost-calculator-builder-pro' ); ?>"
						type="number"
						step="1" required>
				<span @click="numberCounterAction('max_file_size')" class="input-number-counter up"></span>
				<span @click="numberCounterAction('max_file_size', '-')" class="input-number-counter down"></span>
			</div>
			<span v-if="fieldErrors.hasOwnProperty('max_file_size') && fieldErrors.max_file_size != null" class="error-tip" v-html="fieldErrors.max_file_size"></span>
			<p class="info">
				<?php esc_attr_e( 'Upload max filesize limit on your Server: ', 'cost-calculator-builder-pro' ); ?>
				<span class="wp_max_upload_size"><?php echo esc_html( size_format( wp_max_upload_size() ) ); ?></span>
				<a :href="wpFileSizeLink" target="_blank"><?php esc_attr_e( 'Read more', 'cost-calculator-builder-pro' ); ?></a>
			</p>
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large">
			<label>
				<?php esc_attr_e( 'Supported file formats', 'cost-calculator-builder-pro' ); ?>
			</label>
			<div :class="['multiselect', {'error': fieldErrors.hasOwnProperty('fileFormats') && fieldErrors.fileFormats != null }]">

				<span v-if="fileUploadField.hasOwnProperty('fileFormats') && fileUploadField.fileFormats.length > 0 && fileUploadField.fileFormats.length <= 7"
					class="anchor" @click.prevent="multiselectShow(event)">
					<span class="selected-payment"
					v-for="choosenFileFormat in fileUploadField.fileFormats">
					{{ choosenFileFormat }}
					<i class="remove"
					@click.self="removeFileFormat( choosenFileFormat )"></i>
					</span>
				</span>
				<span v-else-if="fileUploadField.hasOwnProperty('fileFormats') && fileUploadField.fileFormats.length > 0 && fileUploadField.fileFormats.length > 7" class="anchor" @click.prevent="multiselectShow(event)">{{ fileUploadField.fileFormats.length }} <?php esc_attr_e( 'file formats selected', 'cost-calculator-builder-pro' ); ?></span>
				<span v-else class="anchor" @click.prevent="multiselectShow(event)"><?php esc_html_e( 'Select File formats', 'cost-calculator-builder-pro' ); ?></span>
				<ul class="items row-list">
					<li :class="['option-item', {disabled: !allowedFileFormats.includes(fileFormat.name)}]"
						v-for="fileFormat in fileFormats"
						@click.prevent="multiselectChooseFileFormat(fileFormat)">
						<input :checked="fileUploadField.fileFormats && fileUploadField.fileFormats.includes(fileFormat.name) && allowedFileFormats.includes(fileFormat.name)" name="fileFormat" class="index" type="checkbox" @change="multiselectChooseFileFormat(fileFormat);"/>
						{{ fileFormat.name }}
					</li>
				</ul>
				<input name="options" type="hidden"/>
			</div>
			<span v-if="fieldErrors.hasOwnProperty('fileFormats') && fieldErrors.fileFormats != null" class="error-tip" v-html="fieldErrors.fileFormats"></span>
			<p class="info">
				<?php esc_attr_e( 'For enabling all file types, you need to edit wp-config.php file.', 'cost-calculator-builder-pro' ); ?>
				<a :href="wpConfigLink" target="_blank"><?php esc_attr_e( 'Read more', 'cost-calculator-builder-pro' ); ?></a>
			</p>
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group medium">
			<label><?php esc_attr_e( 'Maximum attached files', 'cost-calculator-builder-pro' ); ?></label>
			<div class="input-type-number-wrapper">
				<input name="max_attached_files"
						:class="{'error': fieldErrors.hasOwnProperty('max_attached_files') && fieldErrors.max_attached_files != null }"
						min="0"
						placeholder="<?php esc_attr_e( '- Maximum attached files -', 'cost-calculator-builder-pro' ); ?>" type="number"
						step="1" v-model="fileUploadField.max_attached_files"
						required>
				<span @click="numberCounterAction('max_attached_files')" class="input-number-counter up"></span>
				<span @click="numberCounterAction('max_attached_files', '-')" class="input-number-counter down"></span>
			</div>
			<span v-if="fieldErrors.hasOwnProperty('max_attached_files') && fieldErrors.max_attached_files != null" class="error-tip" v-html="fieldErrors.max_attached_files"></span>
		</div>
		<div class="form-group medium">
			<label><?php esc_attr_e( 'File upload price$ (optional)', 'cost-calculator-builder-pro' ); ?></label>
			<div class="input-type-number-wrapper">
				<input name="price" min="0" placeholder="<?php esc_attr_e( '- File upload price -', 'cost-calculator-builder-pro' ); ?>" type="number" step="0.1" v-model="fileUploadField.price">
				<span @click="numberCounterAction('price')" class="input-number-counter up"></span>
				<span @click="numberCounterAction('price', '-')" class="input-number-counter down"></span>
			</div>
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large inline">
			<div class="ccb-switch">
				<input type="checkbox" v-model="fileUploadField.allowCurrency"/>
				<label></label>
			</div>
			<div class="ccb-switch-label">
				<?php esc_html_e( 'Currency Symbol On Total Description', 'cost-calculator-builder-pro' ); ?>
			</div>
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large inline">
			<div class="ccb-switch">
				<input type="checkbox" v-model="fileUploadField.required"/>
				<label></label>
			</div>
			<div class="ccb-switch-label">
				<?php esc_html_e( 'Required', 'cost-calculator-builder-pro' ); ?>
			</div>
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large inline">
			<div class="ccb-switch">
				<input type="checkbox" v-model="fileUploadField.hidden"/>
				<label></label>
			</div>
			<div class="ccb-switch-label">
				<?php esc_html_e( 'Default hidden', 'cost-calculator-builder-pro' ); ?>
			</div>
		</div>
	</div>
	<div class="field-form-row">
		<div class="form-group large">
			<label><?php esc_attr_e( 'Additional classes', 'cost-calculator-builder-pro' ); ?></label>
			<textarea placeholder="<?php esc_attr_e( 'Enter your classes', 'cost-calculator-builder-pro' ); ?>" v-model="fileUploadField.additionalStyles"></textarea>
		</div>
	</div>
	<div class="actions">
		<div class="right">
			<button type="button" class="white" @click="$emit( 'cancel' )">
				<span><?php esc_html_e( 'Cancel', 'cost-calculator-builder-pro' ); ?></span>
			</button>
			<button type="button" class="green" @click.prevent="save">
				<span><?php esc_html_e( 'Save', 'cost-calculator-builder-pro' ); ?></span>
			</button>
		</div>
	</div>
</div>
