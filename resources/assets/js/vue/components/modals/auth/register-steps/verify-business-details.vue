<template>
	<div>
		<h1 v-if="this.$store.state.app.account.business_type == 'company' || this.$store.state.app.account.business_type == 'non_profit'"
			style="text-align: center;">Verify you represent this business</h1>

		<!-- <span>{{ $store.state.app.account.persons }}</span> -->

		<form @submit.prevent="handleSubmit" id="account-form">
			<p style="text-align: center;">This form must be filled out by someone with significant control and management
				of your business. if that's
				not you, make sure to ask the right person to continue.</p>

			<div class="flex">
				<div class="input">
					<div>Legal Name:</div>
					<div>
						<input type="text" name="first_name" v-model="first_name" tabindex="1" placeholder="First name"
							v-validate="'required|max:255'" data-vv-as="first name"/>
						<span class="error-message">{{ errors.first("first_name") }}</span>
					</div>
				</div>
				<div class="input">
					<div>
						<input type="text" name="last_name" v-model="last_name" tabindex="1" placeholder="Last name"
							v-validate="'required|max:255'" data-vv-as="last name"/>
						<span class="error-message">{{ errors.first("last_name") }}</span>
					</div>
				</div>
			</div>

			<div class="flex">
				<div class="input">
					<div>Job Title:</div>
					<div>
						<input type="text" name="title" v-model="title" v-validate="'required'" />
						<span class="error-message">{{ errors.first("title") }}</span>
					</div>
				</div>
			</div>

			<div class="flex">
				<div class="input">
					<div>Relationship to Company:</div>
					<div>
						<select name="relation" v-model="relationship" data-vv-as="relation" v-validate="'required'"
							style="width: 100%;">
							<option value="" disabled selected>Select your Relation</option>
							<option value="owner">Owner</option>
							<option value="director">Director</option>
							<option value="representative">Representative</option>
						</select>
						<span class="error-message">{{ errors.first("relation") }}</span>
					</div>
				</div>
			</div>

			<!-- <div class="flex">
				<div class="input">
					<div>Email:</div>
					<div>
						<input type="text" name="email" v-model="email" v-validate="'required|email'" />
						<span class="error-message">{{ errors.first("email") }}</span>
					</div>
				</div>
			</div> -->

			<div class="flex">
				<div class="input">
					<div>DOB:</div>
					<div class="flex dob-fields" style="flex-direction:column;">
						<input name="day" id="day" type="text" placeholder="Day" v-model="dob.day"
							v-validate="'required|between:1,31'" data-vv-validate-on="blur" />
						<input name="month" id="month" type="text" placeholder="Month" v-model="dob.month"
							v-validate="'required|between:1,12'" data-vv-validate-on="blur" />
						<input name="year" id="year" type="text" maxlength="4" placeholder="Year" v-model="dob.year"
							v-validate="'required|min_value:1900|max_value:2020'" data-vv-validate-on="blur" />
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
						<input type="text" name="phone" placeholder="+441234567890" v-model="phone"
							v-validate="{ required: true, regex: /((\+?))\d{10,14}/ }" data-vv-validate-on="blur" />
						<span class="error-message">{{ errors.first("phone") }}</span>
					</div>
				</div>
			</div> -->

			<div class="flex">
				<div class="input">
					<div>Home Address:</div>
					<div>
						<input type="text" name="line1" style="margin-top: 8px; margin-bottom: 8px;" v-model="address.line1"
							v-validate="'required'" placeholder="Line 1" data-vv-validate-on="blur" />
						<span class="error-message">
							{{ errors.first("line1") }}
						</span>
						<input type="text" name="line2" style="margin-top: 8px; margin-bottom: 8px;" v-model="address.line2"
							placeholder="Line 2" data-vv-validate-on="blur" />
						<input type="text" name="city" style="margin-top: 8px; margin-bottom: 8px;" v-model="address.city"
							v-validate="'required'" placeholder="City" data-vv-validate-on="blur" />
						<span class="error-message">{{ errors.first("city") }}</span>
						<input type="text" name="postal_code" style="margin-top: 8px; margin-bottom: 8px;"
							v-model="address.postal_code" v-validate="'required'" placeholder="Post Code"
							data-vv-validate-on="blur" />
						<span class="error-message">{{ errors.first("postal_code") }}</span>

					</div>
				</div>
			</div>

			<div class="flex">
				<div class="input">
					<div>Percentage of Ownership:</div>
					<div>
						<input type="number" name="percentage" placeholder="0" v-model="percentage"
							v-validate="{ required: true, max_value: 100, min_value: 0.1 }" data-vv-validate-on="blur" />
						<span class="error-message">{{ errors.first("percentage") }}</span>
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
	name: "identity-details",
	props: {
		editPerson: Object,
	},
	data() {
		return {
			submitting: false,
			updateMode: false,
			count: 0,
			title: '',
			relationship: '',
			percentage: '',
			first_name: null,
			last_name: null,
			dob: {
				day: "",
				month: "",
				year: "",
			},
			address: {
				line1: '',
				line2: "",
				city: '',
				postal_code: '',
			},
		};
	},

	mounted() {
		console.log("editPerson", this.editPerson);
		if (this.editPerson != null) {
			this.first_name = this.editPerson.first_name;
			this.last_name = this.editPerson.last_name;
			this.title = this.editPerson.title;
			this.relationship = this.editPerson.relationship;
			this.percentage = this.editPerson.percentage;
			this.dob.day = this.editPerson.dob.day;
			this.dob.month = this.editPerson.dob.month;
			this.dob.year = this.editPerson.dob.year;
			this.address.line1 = this.editPerson.address.line1;
			this.address.line2 = this.editPerson.address.line2;
			this.address.city = this.editPerson.address.city;
			this.address.postal_code = this.editPerson.address.postal_code;
			this.updateMode = true;
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
		handleSubmit() {
			this.$validator.validate().then(async (valid) => {
				if (valid) {
					if (!this.updateMode) {
						const newPerson = {
							id: Math.floor(Math.random() * (999 - 0 + 1)) + 0,
							first_name: this.first_name,
							last_name: this.last_name,
							title: this.title,
							relationship: this.relationship,
							percentage: this.percentage,
							dob: {
								day: this.dob.day,
								month: this.dob.month,
								year: this.dob.year,
							},
							address: {
								line1: this.address.line1,
								line2: this.address.line2,
								city: this.address.city,
								postal_code: this.address.postal_code,
							},
						};
						this.$store.state.app.account.persons.push(newPerson);
						console.log("persons", this.$store.state.app.account.persons);
					} else {
						const person = this.$store.state.app.account.persons.find((p) => p.id === this.editPerson.id);
						console.log(person);
						person.first_name = this.first_name;
						person.last_name = this.last_name;
						person.title = this.title;
						person.relationship = this.relationship;
						person.percentage = this.percentage;
						person.dob.day = this.dob.day;
						person.dob.month = this.dob.month;
						person.dob.year = this.dob.year;
						person.address.line1 = this.address.line1;
						person.address.line2 = this.address.line2;
						person.address.city = this.address.city;
						person.address.postal_code = this.address.postal_code;
					}
					console.log("indiviual");
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
}
</style>
