<template>
	<div>
		<h1>Tell us about your business</h1>

		<form @submit.prevent="handleSubmit" id="account-form">
			<div class="flex">
				<div class="input">
					<div>Business Type:</div>
					<div>
						<select name="business_type" v-model="business_type" data-vv-as="business type"
							v-validate="'required'" style="width: 100%;">
							<option value="" disabled selected>Select Type</option>
							<option value="individual">Individual / Sole Trader</option>
							<option value="company">Company</option>
							<option value="non_profit">Non-profit</option>
						</select>
						<span class="error-message">{{ errors.first("business_type") }}</span>
					</div>
				</div>
			</div>

			<div class="flex" v-if="business_type == 'company' || business_type == 'non_profit'">
				<div class="input">
					<div>Business Structure:</div>
					<div>
						<select name="business_structure" v-model="business_structure" data-vv-as="business structure"
							v-validate="'required'" style="width: 100%;" v-if="business_type == 'company'">
							<option value="" disabled selected>Select Structure</option>
							<option value="incorporated_partnership">Incorporated Partnership</option>
							<option value="unincorporated_partnership">Unincorporated Partnership</option>
							<option value="public_corporation">Public Corporation</option>
							<option value="private_corporation">Private corporation</option>
						</select>

						<select name="business_structure" v-model="business_structure" data-vv-as="business structure"
							v-validate="'required'" style="width: 100%;" v-if="business_type == 'non_profit'">
							<option value="" disabled selected>Select Structure</option>
							<option value="incorporated_non_profit">Incorporated Non-Profit</option>
							<option value="unincorporated_non_profit">Unincorporated Non-Profit</option>
						</select>
						<span class="error-message">{{ errors.first("business_structure") }}</span>
					</div>
				</div>
			</div>

			<div class="submit-buttons">
				<div class="button-wrap">
					<ph-button size="medium" :loading="submitting">
						Continue
					</ph-button>
				</div>
			</div>
		</form>
	</div>
</template>

<script>
import { mapGetters, mapState } from "vuex";
export default {
	name: "business-type",

	data() {
		return {
			date: "",
			connectErrors: null,
			accountToken: null,
			submitting: false,
			business_type: '',
			business_structure: '',
		};
	},

	mounted() { },

	computed: {
		...mapGetters({
			tempUser: "app/getTempUser",
		}),
		currentYear() {
			return new Date().getFullYear();
		},
	},

	methods: {
		handleSubmit() {
			this.$validator.validate().then(async (valid) => {
				if (valid) {
					this.$store.state.app.account.business_type = this.business_type;
					this.$store.state.app.account.business_structure = this.business_structure;
					this.$emit('next-step');
				}
			});
		},
	},
};
</script>

<style lang="scss" scoped>
@import "~styles/helpers/_variables.scss";

ul.gridtypelist li label {
	display: block;
	color: $color-grey3;
	text-align: center;
	padding: 8px;
	text-decoration: none;
	border: 2px $color-blue solid;
	border-radius: 10px;
	margin: 2px;
	background-color: #f1f1f1;
}

ul.gridtypelist li label:hover {
	background-color: $color-2;
	color: $color-grey3;
}

ul.gridtypelist li label.active {
	background-color: $color-2;
	color: #fff;
}

ul.gridtypelist li label input[type="radio"] {
	display: none;
}

.submit-buttons {
	display: flex;
	flex-direction: column;

	.button-wrap {
		padding: 10px 0;
		display: flex;
		justify-content: center;
	}
}

.full-width {
	flex-basis: 100%;
}

.dob-fields {

	input,
	select {
		margin: 10px 0;
	}
}

.input {
	flex: 1;
	display: flex;
	margin: 1.8em 0;
	width: 48%;
	padding: 0 20px;

	&>div:first-of-type {
		width: 125px;
		display: flex;
		align-items: center;
	}

	&>div:last-of-type {
		flex: 1;
		position: relative;
	}

	input,
	select {
		padding: 10px !important;
		box-sizing: border-box;
		font-size: 17px !important;
		border: 1px solid $color-grey4 !important;
		border-radius: 3px;
	}
}</style>
