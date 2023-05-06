<template>
	<div>
		<h1>Verification</h1>

		<form @submit.prevent="handleSubmit" id="account-form">
			<p>The following details are required to provide verification and a method of payment for sales</p>

			<div class="flex">
				<div class="input">
					<div>Account Type:</div>
					<ul class="gridtypelist list-unstyled list-inline float-left">
						<li>
							<label v-bind:class="[type === 'Independent' ? 'active' : '']">
								<input type="radio" v-validate="'required|max:255'" v-model="type" value="Independent"
									@click="bussinessTypeChanged()" /> Independent
							</label>
						</li>
						<li>
							<label v-bind:class="[type === 'Company' ? 'active' : '']">
								<input type="radio" v-validate="'required|max:255'" v-model="type"
									@click="bussinessTypeChanged()" value="Company" /> Company
							</label>
						</li>

						<!-- <span class="error-message">{{ errors.first("first_name") }}</span> -->
					</ul>
				</div>
			</div>
			<div class="flex" v-if="type == 'Independent'">
				<div class="input">
					<div>First Name:</div>
					<div>
						<input type="text" name="first_name" v-model="first_name" tabindex="1"
							v-validate="'required|max:255'" data-vv-as="first name" />
						<span class="error-message">{{ errors.first("first_name") }}</span>
					</div>
				</div>
				<div class="input">
					<div>Last Name:</div>
					<div>
						<input type="text" name="last_name" v-model="last_name" tabindex="1" v-validate="'required|max:255'"
							data-vv-as="last name" />
						<span class="error-message">{{ errors.first("last_name") }}</span>
					</div>
				</div>
			</div>
			<div class="flex" v-if="type == 'Company'">
				<div class="input">
					<div>Company Name:</div>
					<div>
						<input type="text" name="company_name" v-model="company_name" tabindex="1"
							v-validate="'required|max:255'" data-vv-as="company name" />
						<span class="error-message">{{ errors.first("company_name") }}</span>
					</div>
				</div>
			</div>
			<!-- <div class="flex">
				<div class="input">
					<div>DOB:</div>
					<div class="flex dob-fields" style="flex-direction:column;">
						<input name="day" id="day" type="text" placeholder="Day" v-model="account.individual.dob.day"
							v-validate="'required|between:1,31'" data-vv-validate-on="blur" />
						<input name="month" id="month" type="text" placeholder="Month"
							v-model="account.individual.dob.month" v-validate="'required|between:1,12'"
							data-vv-validate-on="blur" />
						<input name="year" id="year" type="text" maxlength="4" placeholder="Year"
							v-model="account.individual.dob.year" v-validate="'required|min_value:1900|max_value:2020'"
							data-vv-validate-on="blur" />
						<span class="error-message flex">
							{{ errors.first("day") || errors.first("month") || errors.first("year") }}
						</span>
					</div>
				</div>
			</div> -->

			<!-- <div class="flex">
				<div class="input">
					<div>Email:</div>
					<div>
						<input type="text" name="email" v-model="account.individual.email" v-validate="'required|email'" />
						<span class="error-message">{{ errors.first("email") }}</span>
					</div>
				</div>
				<div class="input">
					<div>Phone:</div>
					<div>
						<input type="text" name="phone" placeholder="+441234567890" v-model="account.individual.phone"
							v-validate="{ required: true, regex: /((\+?))\d{10,14}/ }" data-vv-validate-on="blur" />
						<span class="error-message">{{ errors.first("phone") }}</span>
					</div>
				</div>
			</div> -->
			<div class="flex">
				<div class="input">
					<div>Country:</div>
					<div>
						<country-select @change="artistCountryChanged" style="width: 100%;margin-top: 8px;" />
						<span class="error-message">{{ errors.first("country") }}</span>
					</div>
				</div>
			</div>
			<span class="hover-text">
				<i class="fa fa-info-circle" aria-hidden="true" v-tooltip="'my text'"> </i>
				Country not
				listed?
				<p class="tooltip-text" id="left">if your country not listed we are not yet able to setup and verify you as
					an
					Artist or
					Artist PRO.</p>
			</span>

			<!-- <i class="fa fa-info" aria-hidden="true" v-tooltip="'my text'"> </i> -->
			<!-- <div class="flex">
				<div class="input">
					<div>Address:</div>
					<div>
						<input type="text" name="line1" style="margin-top: 8px; margin-bottom: 8px;"
							v-model="account.individual.address.line1" v-validate="'required'" placeholder="Line 1"
							data-vv-validate-on="blur" />
						<span class="error-message">
							{{ errors.first("line1") }}
						</span>
						<input type="text" name="line2" style="margin-top: 8px; margin-bottom: 8px;"
							v-model="account.individual.address.line2" placeholder="Line 2" data-vv-validate-on="blur" />
						<input type="text" name="city" style="margin-top: 8px; margin-bottom: 8px;"
							v-model="account.individual.address.city" v-validate="'required'" placeholder="City"
							data-vv-validate-on="blur" />
						<span class="error-message">{{ errors.first("city") }}</span>
						<input type="text" name="state" style="margin-top: 8px; margin-bottom: 8px;"
							v-model="account.individual.address.state" placeholder="State" data-vv-validate-on="blur" />
						<input type="text" name="postal_code" style="margin-top: 8px; margin-bottom: 8px;"
							v-model="account.individual.address.postal_code" v-validate="'required'" placeholder="Post Code"
							data-vv-validate-on="blur" />
						<span class="error-message">{{ errors.first("postal_code") }}</span>
						<country-select @change="artistCountryChanged" style="width: 100%;margin-top: 8px;" />

						<span class="error-message">{{ errors.first("country") }}</span>
					</div>
				</div>
			</div> -->

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
import CountrySelect from "../../upload/country-select";
export default {
	name: "connect-details",

	data() {
		return {
			date: "",
			connectErrors: null,
			accountToken: null,
			submitting: false,
			type: "Independent",
			first_name: '',
			last_name: '',
			country: 'GB',
			company_name: "",
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

		if (this.tempUser) {
			this.first_name = this.tempUser.first_name;
			this.last_name = this.tempUser.last_name;
			// this.email = this.tempUser.email;
			this.phone = this.tempUser.phone ? this.tempUser.phone : '';
			// this.account.website = this.tempUser.social_web;
		}
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
		async getAccountToken() {
			const stripe = Stripe(process.env.MIX_VUE_APP_STRIPE_KEY);

			await stripe
				.createToken("account", this.account)
				.then((result) => {
					if (result.token) {
						this.connectErrors = null;
						this.accountToken = result.token.id;
					}
					if (result.error) {
						this.connectErrors = result.error.message;
						this.submitting = false;
					}
				})
				.catch((error) => {
					this.connectErrors = error.message;
					this.submitting = false;
				});
		},
		handleSubmit() {
			this.$validator.validate().then(async (valid) => {
				if (valid) {
					if (this.$store.state.app.account.type == "Individual") {
						this.$store.state.app.account.individual.first_name = this.first_name;
						this.$store.state.app.account.individual.last_name = this.last_name;
					} else {
						this.$store.state.app.account.company.company_name = this.company_name;
					}
					this.$store.state.app.account.country = this.country;
					console.log(this.$store.state.app.account);
					this.$emit('next-step');
				}
			});
			// this.$emit('next-step');

		},
		// async handleForm() {
		// 	this.$validator.validate().then(async (valid) => {
		// 		if (valid) {
		// 			this.connectErrors = null;
		// 			this.submitting = true;

		// 			await this.getAccountToken();

		// 			if (this.accountToken && !this.connectErrors) {
		// 				await axios
		// 					.post("/api/auth/marketplace/create", {
		// 						account_token: this.accountToken,
		// 						user_id: this.tempUser.id,
		// 						website: this.account.website,
		// 						phone: this.account.individual.phone,
		// 						country: this.account.individual.address.country


		// 					})
		// 					.then((response) => {

		// 						this.submitting = false;
		// 						this.$emit('next-step');

		// 					})
		// 					.catch((error) => {
		// 						this.submitting = false;
		// 						this.connectErrors = error.response.data.message;
		// 					});
		// 			}
		// 		}
		// 	});
		// },

		bussinessTypeChanged(type) {
			this.type = type;
			// this.$validator.validate();
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
}
</style>


<style>
.tooltip-text {
	visibility: hidden;
	position: absolute;
	z-index: 2;
	width: 100px;
	color: white;
	font-size: 12px;
	background-color: #192733;
	border-radius: 10px;
	padding: 10px 15px 10px 15px;
}

.tooltip-text::before {
	content: "";
	position: absolute;
	transform: rotate(45deg);
	background-color: #192733;
	padding: 5px;
	z-index: 1;
}

.hover-text:hover .tooltip-text {
	visibility: visible;
}

#left {
	top: -29px;
	right: 105%;
}

#left::before {
	top: 35%;
	left: 94%;
}


.hover-text {
	position: relative;
	display: inline-block;
	margin-left: 145px;
	font-family: Arial;
	text-align: center;
}
</style>