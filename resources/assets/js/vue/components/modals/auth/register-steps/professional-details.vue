<template>
	<div>
		<h1 v-if="this.$store.state.app.account.bussiness_type == 'individual'">Professional details</h1>

		<form @submit.prevent="handleSubmit" id="account-form">
			<p>Tell us a few details about how you earn money with Phase</p>

			<div class="flex">
				<div class="input">
					<div>Industry:</div>
					<div>
						<select name="industry" v-model="industry" data-vv-as="industry" v-validate="'required'"
							style="width: 100%;">
							<option value="" disabled selected>Select your industry</option>
							<option value="software">Software</option>
							<option value="music">Music</option>
						</select>
						<span class="error-message">{{ errors.first("industry") }}</span>
					</div>
				</div>
			</div>
			<div class="flex">
				<div class="input">
					<div>Your Website:</div>
					<div>
						<input type="text" name="site" style="margin-top: 8px; margin-bottom: 8px;" v-model="site"
                                v-validate="{ max:255, regex: /^((https?):\/\/)?(www.)?[a-z0-9]+\.[a-z]+(\/[a-zA-Z0-9#]+\/?)*$/ }"
							placeholder="www.example.com" data-vv-validate-on="blur" />
						<span class="error-message">
							{{ errors.first("site") }}
						</span>
						<span class="error-message">{{ errors.first("site") }}</span>
					</div>
				</div>
			</div>

			<div class="flex">
				<div class="input">
					<div>Product Description:</div>
					<div>
						<textarea rows="5" name="prod_des" style="margin-top: 8px; margin-bottom: 8px;border: 1px solid grey;border-radius: 3px;" v-model="prod_des" v-validate="'required|max: 255'" data-vv-as="product descrpiton"
							data-vv-validate-on="blur">
					            </textarea>
						<span class="error-message">
							{{ errors.first("prod_des") }}
						</span>
					</div>
				</div>
			</div>

			<!-- <div class="flex" style="flex-direction:column;">
				<div class="input">
					<div>Accept Terms of Service:</div>
					<input name="terms" type="checkbox" v-model="account.tos_shown_and_accepted" v-validate="'required'"
						data-vv-as="Terms and Conditions" />
				</div>
				<span class="error-message">{{ errors.first("terms") }}</span>
			</div>

			<div class="error-message flex" v-if="connectErrors">
				{{ connectErrors }}
			</div> -->

			<div class="submit-buttons">
				<div class="button-wrap">
					<ph-button size="medium" :loading="submitting">
						Save & Continue
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
export default {
	name: "professional-details",

	data() {
		return {
			date: "",
			submitting: false,
			industry: '',
			site: '',
			prod_des: '',
		};
	},

	mounted() {
		const dict = {
			custom: {
				phone: {
					required: 'This field is required',
					regex: 'Phone number needs to be in the format +44xxxxxxxxxx'
				},
			}
		};

		this.$validator.localize('en', dict);
	},

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
					console.log(this.industry);
					console.log(this.site);
					this.$emit('next-step');
				}
			});
		},

		artistCountryChanged(country) {
			this.country = country;
			this.$validator.validate();
		},
	},
	components: {
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
}
</style>
