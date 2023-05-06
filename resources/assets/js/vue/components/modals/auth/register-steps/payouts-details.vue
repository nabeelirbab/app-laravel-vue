<template>
	<div>
		<h1>Select an account for payouts</h1>

		<form @submit.prevent="handleSubmit" id="account-form">
			<div class="flex">
				<div class="input">
					<div>Country of back account:</div>
					<div>
						<country-select @change="artistCountryChanged" style="width: 100%;margin-top: 8px;" />
						<span class="error-message">{{ errors.first("country") }}</span>
					</div>
				</div>
			</div>

			<div class="flex">
				<div class="input">
					<div>Sort Code:</div>
					<div>
						<input type="text" name="sort_code" v-model="sort_code" v-validate="{ required: true, regex: /^([0-9]{2})-([0-9]{2})-([0-9]{2})$/ }" placeholder="11-22-33"/>
						<span class="error-message">{{ errors.first("sort_code") }}</span>
					</div>
				</div>
			</div>

			<div class="flex">
				<div class="input">
					<div>Account number:</div>
					<div>
						<input type="text" name="account_number" v-model="account_number" v-validate="'required'" placeholder="01234567" data-vv-as="account number"/>
						<span class="error-message">{{ errors.first("account_number") }}</span>
					</div>
				</div>
			</div>

			<div class="flex">
				<div class="input">
					<div>Confirm account number:</div>
					<div>
						<input type="text" name="confirm_account_number" v-model="confirm_account_number" v-validate="'required'" placeholder="01234567" data-vv-as="account number"/>
						<span class="error-message">{{ errors.first("confirm_account_number") }}</span>
					</div>
				</div>
			</div>

			<div class="submit-buttons">
				<div class="button-wrap">
					<ph-button size="medium" :loading="submitting">
						Agree & Submit
					</ph-button>
				</div>
				<!-- <div class="button-wrap">
					<ph-button size="large" @click.native="$emit('skip')">
						Skip
					</ph-button>
				</div> -->
			</div>
		</form>
	</div>
</template>

<script>
import { mapGetters, mapState } from "vuex";
import CountrySelect from "../../upload/country-select";
export default {
	name: "payouts-details",

	data() {
		return {
			date: "",
			connectErrors: null,
			accountToken: null,
			submitting: false,
			country: this.$store.state.app.account.country,
			sort_code: '',
			account_number: '',
			confirm_account_number: '',
		};
	},

	mounted() {
		const dict = {
			custom: {
				sort_code: {
					required: 'This field is required',
					regex: 'Sort code needs to be in the format 00-00-00'
				},
			}
		};

		this.$validator.localize('en', dict);

	},

	computed: {
		...mapGetters({
			tempUser: "app/getTempUser",
		}),
	},

	methods: {
		handleSubmit() {
			this.$validator.validate().then(async (valid) => {
				if (valid) {
					console.log("testing......");
					this.$emit('finished');
				}
			});
		},
		artistCountryChanged(country) {
			this.country = country;
			this.$validator.validate();
		},
	},
	components: {
		CountrySelect,
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
