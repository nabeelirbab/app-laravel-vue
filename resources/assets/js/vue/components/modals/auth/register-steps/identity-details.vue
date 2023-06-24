<template>
	<div>
		<h1 v-if="this.$store.state.app.account.business_type == 'individual'" style="text-align: center;">Verify your personal details</h1>
		<h1
			v-if="this.$store.state.app.account.business_type == 'company' || this.$store.state.app.account.business_type == 'non_profit'" style="text-align: center;">
			Tell us more about your business</h1>

		<form @submit.prevent="handlePersonalSubmit" id="account-form"
			v-if="this.$store.state.app.account.business_type == 'individual'">
			<p style="text-align: center;">Phase collects this information to verify your identity and keep your account safe</p>

			<div class="flex">
				<div class="input">
					<div>DOB:</div>
					<div class="flex dob-fields" style="flex-direction:column;">
						<input name="day" id="day" type="text" placeholder="Day" v-model="individual.dob.day"
							v-validate="'required|between:1,31'" data-vv-validate-on="blur" />
						<input name="month" id="month" type="text" placeholder="Month" v-model="individual.dob.month"
							v-validate="'required|between:1,12'" data-vv-validate-on="blur" />
						<input name="year" id="year" type="text" maxlength="4" placeholder="Year"
							v-model="individual.dob.year" v-validate="'required|min_value:1900|max_value:2020'"
							data-vv-validate-on="blur" />
						<span class="error-message flex">
							{{ errors.first("day") || errors.first("month") || errors.first("year") }}
						</span>
					</div>
				</div>
			</div>

			<!-- <div class="flex">
				<div class="input">
					<div>Phone:</div>
					<div>
						<input type="text" name="phone" placeholder="+441234567890" v-model="individual.phone"
							v-validate="{ required: true, regex: /((\+?))\d{10,14}/ }" data-vv-validate-on="blur" />
						<span class="error-message">{{ errors.first("phone") }}</span>
					</div>
				</div>
			</div> -->
			<div class="flex">
				<div class="input">
					<div>Address:</div>
					<div>
						<input type="text" name="line1" style="margin-top: 8px; margin-bottom: 8px;"
							v-model="individual.address.line1" v-validate="'required'" placeholder="Line 1"
							data-vv-validate-on="blur" />
						<span class="error-message">
							{{ errors.first("line1") }}
						</span>
						<input type="text" name="line2" style="margin-top: 8px; margin-bottom: 8px;"
							v-model="individual.address.line2" placeholder="Line 2" data-vv-validate-on="blur" />
						<input type="text" name="city" style="margin-top: 8px; margin-bottom: 8px;"
							v-model="individual.address.city" v-validate="'required'" placeholder="City"
							data-vv-validate-on="blur" />
						<span class="error-message">{{ errors.first("city") }}</span>
						<input type="text" name="postal_code" style="margin-top: 8px; margin-bottom: 8px;"
							v-model="individual.address.postal_code" v-validate="'required'" placeholder="Post Code"
							data-vv-validate-on="blur" />
						<span class="error-message">{{ errors.first("postal_code") }}</span>

						<!-- <country-select @change="artistCountryChanged" style="width: 100%;margin-top: 8px;" />
						<span class="error-message">{{ errors.first("country") }}</span> -->
					</div>
				</div>
			</div>

			<div class="flex">
				<div class="input">
					<div>Identity Document:</div>
					<div>
						<input type="file" name="identity_document" style="margin-top: 8px; margin-bottom: 8px;"
						v-on:change="handleIdentityDocumentChange"  v-validate="'required|ext:jpeg,jpg,png'"
							data-vv-validate-on="blur" />
						<span class="error-message">{{ errors.first("identity_document") }}</span>

						<!-- <country-select @change="artistCountryChanged" style="width: 100%;margin-top: 8px;" />
						<span class="error-message">{{ errors.first("country") }}</span> -->
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

		<form @submit.prevent="handleSubmit" id="account-form"
			v-if="this.$store.state.app.account.business_type == 'company' || this.$store.state.app.account.business_type == 'non_profit'">
			<p style="text-align: center;">Phase collects this information to better
				serve your business and help meet the requirements of regulators, financial partners, and our service
				agreements</p>

			<div class="flex">
				<div class="input">
					<div>Companies House Registration Number (CRN):</div>
					<div>
						<input type="text" name="crn" placeholder="1234567" v-model="company.crn"
							v-validate="{ required: true, max: 8, min: 7 }" data-vv-validate-on="blur" />
						<span class="error-message">{{ errors.first("crn") }}</span>
						<small>We only need your 7 or 8 digit company number.</small>
					</div>
				</div>
			</div>

			<div class="flex">
				<div class="input">
					<div>Business Phone Number:</div>
					<div>
						<input type="text" name="phone" placeholder="+441234567890" v-model="company.business_number"
							v-validate="{ required: true, regex: /((\+?))\d{10,14}/ }" data-vv-validate-on="blur" />
						<span class="error-message">{{ errors.first("phone") }}</span>
					</div>
				</div>
			</div>

			<!-- <div class="flex">
				<div class="input">
					<div>DOB:</div>
					<div class="flex dob-fields" style="flex-direction:column;">
						<input name="day" id="day" type="text" placeholder="Day" v-model="company.dob.day"
							v-validate="'required|between:1,31'" data-vv-validate-on="blur" />
						<input name="month" id="month" type="text" placeholder="Month" v-model="company.dob.month"
							v-validate="'required|between:1,12'" data-vv-validate-on="blur" />
						<input name="year" id="year" type="text" maxlength="4" placeholder="Year"
							v-model="company.dob.year" v-validate="'required|min_value:1900|max_value:2020'"
							data-vv-validate-on="blur" />
						<span class="error-message flex">
							{{ errors.first("day") || errors.first("month") || errors.first("year") }}
						</span>
					</div>
				</div>
			</div> -->

			<div class="flex">
				<div class="input">
					<div style="padding-bottom: 56px;">Registered Business Address:</div>
					<div>
						<input type="text" name="line1" style="margin-top: 8px; margin-bottom: 8px;"
							v-model="company.address.line1" v-validate="'required'" placeholder="Line 1"
							data-vv-validate-on="blur" />
						<span class="error-message">
							{{ errors.first("line1") }}
						</span>

						<input type="text" name="line2" style="margin-top: 8px; margin-bottom: 8px;"
							v-model="company.address.line2" placeholder="Line 2" data-vv-validate-on="blur" />
						<input type="text" name="city" style="margin-top: 8px; margin-bottom: 8px;"
							v-model="company.address.city" v-validate="'required'" placeholder="City"
							data-vv-validate-on="blur" />
						<span class="error-message">{{ errors.first("city") }}</span>

						<input type="text" name="postal_code" style="margin-top: 8px; margin-bottom: 8px;"
							v-model="company.address.postal_code" v-validate="'required'" placeholder="Post Code"
							data-vv-validate-on="blur" />
						<span class="error-message">{{ errors.first("postal_code") }}</span>

						<!-- <country-select @change="artistCountryChanged" style="width: 100%;margin-top: 8px;" />
						<span class="error-message">{{ errors.first("country") }}</span> -->
						<br>
						<small>This address must match the address filed with the UK tax authority.</small>
						<br>
						<small>You can use your home address if you don't have a business address.</small>
					</div>
				</div>
			</div>

			<div class="flex">
				<div class="input">
					<div>Identity Document:</div>
					<div>
						<input type="file" name="identity_document" style="margin-top: 8px; margin-bottom: 8px;"
						v-on:change="handleIdentityDocumentChange"  v-validate="'required|ext:jpeg,jpg,png'"
							data-vv-validate-on="blur" />
						<span class="error-message">{{ errors.first("identity_document") }}</span>

						<!-- <country-select @change="artistCountryChanged" style="width: 100%;margin-top: 8px;" />
						<span class="error-message">{{ errors.first("country") }}</span> -->
					</div>
				</div>
			</div>

			<!-- <div class="flex">
				<div class="input">
					<div>Industry:</div>
					<div>
						<select name="industry" v-model="company.industry" data-vv-as="industry" v-validate="'required'"
							style="width: 100%;">
							<option value="" disabled selected>Select your industry</option>
							<option value="software">Software</option>
							<option value="music">Music</option>
						</select>
						<span class="error-message">{{ errors.first("industry") }}</span>
					</div>
				</div>
			</div> -->

			<!-- <div class="flex">
				<div class="input">
					<div>Your Website:</div>
					<div>
						<input type="text" name="site" style="margin-top: 8px; margin-bottom: 8px;" v-model="company.site"
							v-validate="{ max: 255, regex: /^((https?):\/\/)?(www.)?[a-z0-9]+\.[a-z]+(\/[a-zA-Z0-9#]+\/?)*$/ }"
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
						<textarea rows="5" name="prod_des"
							style="margin-top: 8px; margin-bottom: 8px;border: 1px solid grey;border-radius: 3px;"
							v-model="company.prod_des" v-validate="'required|max: 255'" data-vv-as="product descrpiton"
							data-vv-validate-on="blur">
								            </textarea>
						<span class="error-message">
							{{ errors.first("prod_des") }}
						</span>
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
						Continue
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
// import CountrySelect from "../../upload/country-select";
export default {
	name: "identity-details",

	data() {
		return {
			date: "",
			submitting: false,
			individual: {
				dob: {
					day: "",
					month: "",
					year: "",
				},
				phone: '',
				address: {
					line1: '',
					line2: "",
					city: '',
					postal_code: '',
					country: 'GB',
				},
			},
			company: {
				crn: "",
				business_number: '',
				address: {
					line1: '',
					line2: "",
					city: '',
					postal_code: '',
					country: 'GB',
				},
				// industry: "",
				// site: "",
				// prod_des: "",
			},
			identity_document: null,
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
		handleIdentityDocumentChange(event) {
      const file = event.target.files[0];
      if (file) {
        this.identity_document = file;
		this.$store.state.app.stripeFiles = this.identity_document;
		this.$validator.validate();
      }
    },
	
		handlePersonalSubmit() {
			this.$validator.validate().then(async (valid) => {
				if (valid) {
					this.$store.state.app.account.dob.day = this.individual.dob.day;
					this.$store.state.app.account.dob.month = this.individual.dob.month;
					this.$store.state.app.account.dob.year = this.individual.dob.year;
					this.$store.state.app.account.address.line1 = this.individual.address.line1;
					this.$store.state.app.account.address.line2 = this.individual.address.line2;
					this.$store.state.app.account.address.city = this.individual.address.city;
					this.$store.state.app.account.address.postal_code = this.individual.address.postal_code;
					console.log("indiviual");
					this.$emit('next-step');
				}
			});
		},
		handleSubmit() {
			this.$validator.validate().then(async (valid) => {
				if (valid) {
					this.$store.state.app.account.companyAddress.line1 = this.company.address.line1;
					this.$store.state.app.account.companyAddress.line2 = this.company.address.line2;
					this.$store.state.app.account.companyAddress.city = this.company.address.city;
					this.$store.state.app.account.companyAddress.postal_code = this.company.address.postal_code;
					this.$store.state.app.account.crn = this.company.crn;
					this.$store.state.app.account.business_number = this.company.business_number;
					console.log("company");
					this.$emit('next-step-verify');
				}
			});
		},

		// artistCountryChanged(country) {
		// 	this.country = country;
		// 	this.$validator.validate();
		// },
	},
	// components: {
	// 	CountrySelect,
	// },
};
</script>

<style lang="scss" scoped>
@import "~styles/helpers/_variables.scss";

small {
	display: flex;
	margin-top: 10px;
}

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
		width: 180px;
		line-height: 22px;
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
