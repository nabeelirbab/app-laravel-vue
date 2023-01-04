<template>
	<div>

		<form @submit.prevent="handleForm" id="account-form">
			<h1>Verification</h1>
			<p>The following details are required to provide verification and a method of payment for sales</p>

			<div class="flex">
				<div class="full-width">
					<div class="full-width">
						<div class="artist-input">
							<div>
								Artist Type:
							</div>
							<div>
								<artist-type-select @change="artistTypesChanged" :min="2" :max="4" tabindex="10"
									:disabled="submitting" data-vv-validate-on="blur" />

								<input type="hidden" name="artist_user_type" placeholder="Artist Type"
									v-validate="'required'" ref="artist_user_type_input" />

								<p class="error-message">
									{{ errors.first("artist_user_type") }}
								</p>

							</div>
							<p class="error-message" v-show="emptyArtistType" style="margin-top: 20px">
								The artist type is required
							</p>
						</div>
					</div>
				</div>
			</div>

			<div class="flex">
				<div class="input">
					<div>First Name:</div>
					<div>
						<input type="text" name="first_name" v-model="account.individual.first_name" tabindex="1"
							v-validate="'required|max:255'" data-vv-as="first name" />
						<span class="error-message">{{ errors.first("first_name") }}</span>
					</div>
				</div>
				<div class="input">
					<div>Last Name:</div>
					<div>
						<input type="text" name="last_name" v-model="account.individual.last_name" tabindex="1"
							v-validate="'required|max:255'" data-vv-as="last name" />
						<span class="error-message">{{ errors.first("last_name") }}</span>
					</div>
				</div>
			</div>
			<div class="flex">
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
						<span class="error-message flex">{{
		errors.first("day") || errors.first("month") || errors.first("year")
}}</span>
					</div>
				</div>
			</div>

			<div class="flex">
				<div class="input">
					<div>Email:</div>
					<div>
						<input type="text" name="email" v-model="account.individual.email"
							v-validate="'required|email'" />
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
			</div>
			<div class="flex">
				<div class="input">
					<div>Address:</div>
					<div>
						<input type="text" name="line1" style="margin-top: 8px; margin-bottom: 8px;" v-model="account.individual.address.line1" v-validate="'required'" placeholder="Line 1" data-vv-validate-on="blur" />
						<span class="error-message">{{
                            errors.first("line1")
                        }}</span>
						<input type="text" name="line2" style="margin-top: 8px; margin-bottom: 8px;" v-model="account.individual.address.line2" placeholder="Line 2" data-vv-validate-on="blur" />
						<input type="text" name="city" style="margin-top: 8px; margin-bottom: 8px;" v-model="account.individual.address.city" v-validate="'required'" placeholder="City" data-vv-validate-on="blur" />
						<span class="error-message">{{
                            errors.first("city")
                        }}</span>
						<input type="text" name="state" style="margin-top: 8px; margin-bottom: 8px;" v-model="account.individual.address.state" placeholder="State" data-vv-validate-on="blur" />
						<input type="text" name="postal_code" style="margin-top: 8px; margin-bottom: 8px;" v-model="account.individual.address.postal_code" v-validate="'required'" placeholder="Post Code" data-vv-validate-on="blur" />
						<span class="error-message">{{
                            errors.first("postal_code")
                        }}</span>
						<country-select
                               @change="artistCountryChanged"
                            style="width: 100%;margin-top: 8px;"/>
						<span class="error-message">{{
		errors.first("country")
}}</span>
					</div>
				</div>
			</div>

			<div class="flex" style="flex-direction:column;">
				<div class="input">
					<div>Accept Terms of Service:</div>
					<input name="terms" type="checkbox" v-model="account.tos_shown_and_accepted" v-validate="'required'"
						data-vv-as="Terms and Conditions" />
				</div>
				<span class="error-message">{{
		errors.first("terms")
}}</span>
			</div>

			<div class="error-message flex" v-if="connectErrors">
				{{ connectErrors }}
			</div>

			<div class="submit-buttons">
				<div class="button-wrap">
					<ph-button size="large" :loading="submitting">
						Submit
					</ph-button>
				</div>
			</div>
		</form>
	</div>
</template>

<script>
import { mapGetters } from "vuex";
import CountrySelect from "../../../modals/upload/country-select";
import ArtistTypeSelect from "../../../global/artist-type-select";

export default {
	name: "connect-details",
	props: ["user"],
	data() {
		return {
			date: "",
			connectErrors: null,
			accountToken: null,
			submitting: false,
			account: {
				business_type: "individual",
				individual: {
					first_name: '',
					last_name: '',
					dob: {
						day: "",
						month: "",
						year: "",
					},
					email: '',
					phone: '',
					address: {
						line1: '',
						line2: "",
						city: '',
						state: '',
						postal_code: '',
						country: 'GB',
					},
				},
				website: null,
				tos_shown_and_accepted: false,
			},
			artist_user_type: '',
			emptyArtistType: true,
		};
	},

	mounted() {
		const dict = {
			custom: {
				phone: {
					required: 'This field is required',
					regex: 'Phone number needs to be in the format +44xxxxxxxxxx'
				},
				artist_user_type: {
					required: 'This field is required',
				},
			}
		};

		this.$validator.localize('en', dict);

		if (this.user) {
			this.account.individual.first_name = this.user.first_name;
			this.account.individual.last_name = this.user.last_name;
			this.account.individual.email = this.user.email;
			this.account.individual.phone = this.user.phone ? this.user.phone : '';
			this.account.website = this.user.social_web;
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
		async handleForm() {
			this.$validator.validate().then(async (valid) => {
				if (valid) {
					this.connectErrors = null;
					this.submitting = true;

					await this.getAccountToken();

					if (this.accountToken && !this.connectErrors) {
						await axios
							.post("/api/auth/marketplace/create", {
								account_token: this.accountToken,
								user_id: this.user.id,
								website: this.account.website,
								artist_user_type: this.artist_user_type,
							})
							.then((response) => {
								this.submitting = false;
								this.$emit("next-step");
							})
							.catch((error) => {
								this.submitting = false;
								this.connectErrors = error.response.data.message;
							});
					}
				}
			});
		},

		artistTypesChanged(artistType) {
			this.artist_user_type = artistType;

			this.$refs.artist_user_type_input.value = artistType;
			this.emptyArtistType = false;
		},
		artistCountryChanged(country) {
			this.account.individual.address.country = country;
			this.$validator.validate();

		},
	},
	components: {
		CountrySelect,
		ArtistTypeSelect
	},
};
</script>

<style lang="scss" scoped>
@import "~styles/helpers/_variables.scss";

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

.artist-input {
	flex: 1;
	display: flex;
	margin: 1.8em 0;
	width: 100%;
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
