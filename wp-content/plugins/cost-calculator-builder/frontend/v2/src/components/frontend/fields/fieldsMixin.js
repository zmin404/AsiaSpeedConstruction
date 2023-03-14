export default {
	methods: {
		// const calcAccordion
		calcToggleAccordion() {

		},
	},

	computed: {
		getPreloaderIdx() {
			const othersData = this.getElementAppearanceStyleByPath( this.appearance, 'desktop.others.data')
			return othersData.calc_preloader || 0
		},

		calcStore() {
			return this.$store.getters.getCalcStore;
		},

		appearance() {
			return this.$store.getters.getAppearance;
		},

		fieldsView() {
			return this.getElementAppearanceStyleByPath(this.appearance, 'desktop.others.data')
		},

		checkboxView() {
			return this.fieldsView.checkbox_horizontal_view === true ? 'ccb-horizontal' : '';
		},

		radioView() {
			return this.fieldsView.radio_horizontal_view === true ? 'ccb-horizontal' : '';
		},

		toggleView() {
			return this.fieldsView.toggle_horizontal_view === true ? 'ccb-horizontal' : '';
		},

		getStep: {
			get() {
				return this.$store.getters.getStep;
			},

			set(value) {
				if (value === '') {
					this.open = false
				}
				this.$store.commit('updateStep', value)
			}
		},

		noticeData: {
			get() {
				return this.$store.getters.getNotices;
			},

			set(noticeData) {
				const getters = this.$store.getters;
				if (noticeData)
					noticeData.image = noticeData.type === 'error' ? getters.getErrorImg : getters.getSuccessImg;
				this.$store.commit('setNotices', noticeData);
			}
		},
	}
}