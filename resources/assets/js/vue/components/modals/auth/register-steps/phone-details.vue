<template>
	<div>
		<h1>Verification</h1>

		<form @submit.prevent="handleSubmit" id="account-form">
			<p>The following details are required to provide verification and a method of payment for sales</p>

			<div class="flex">
				<div class="input">
					<div>Phone:</div>
					<div>
						<input type="text" name="phone" placeholder="+441234567890" v-model="phone"
							v-validate="{ required: true, regex: /((\+?))\d{10,14}/ }" data-vv-validate-on="blur" />
						<span class="error-message">{{ errors.first("phone") }}</span>
						<br>
						<small>We'll text this number to verify your account.</small>
					</div>
				</div>
			</div>

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
export default {
	name: "phone-details",

	data() {
		return {
			date: "",
			connectErrors: null,
			accountToken: null,
			submitting: false,
			email: '',
			phone: '',
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
			this.phone = this.tempUser.phone ? this.tempUser.phone : '';
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
					this.$store.state.app.account.phone = this.phone;
					// console.log(this.$store.state.app.tempUser);
					await axios.post(
						"/api/auth/send-otp",
						{
							// user_id: '45',
							// id: this.$store.state.app.tempUser.id,
							// phone: '+441234567890',
							phone: this.$store.state.app.account.phone ,
						}
					).then((res) => {
						console.log(res);
						this.$emit('handleOtpId', res.data.otp_id);
						this.$emit('next-step');
					})

				}
			});
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
