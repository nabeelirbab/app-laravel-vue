<template>
  <div>
    <h1 style="text-align: center">Select an account for payouts</h1>

    <form @submit.prevent="handleSubmit" id="account-form">
      <div class="flex">
        <div class="input">
          <div>Country of bank account:</div>
          <div>
            <country-select
              @change="artistCountryChanged"
              style="width: 100%; margin-top: 8px"
            />
            <span class="error-message">{{ errors.first("country") }}</span>
          </div>
        </div>
      </div>

      <!-- <div class="flex">
				<div class="input">
					<div>Sort Code:</div>
					<div>
						<input type="text" name="sort_code" v-model="sort_code"
							v-validate="{ required: true, regex: /^([0-9]{2})-([0-9]{2})-([0-9]{2})$/ }"
							placeholder="11-22-33" />
						<span class="error-message">{{ errors.first("sort_code") }}</span>
					</div>
				</div>
			</div> -->

      <div class="flex">
        <div class="input">
          <div>Account name:</div>
          <div>
            <input
              type="text"
              name="account_name"
              v-model="account_name"
              v-validate="{ required: true }"
              placeholder="Test Bank"
            />
            <span class="error-message">{{ errors.first("account_name") }}</span>
          </div>
        </div>
      </div>

      <div class="flex">
        <div class="input">
          <div>Account number:</div>
          <div>
            <input
              type="text"
              name="account_number"
              v-model="account_number"
              v-validate="'required'"
              ref="account_number"
              placeholder="GB82WEST12345698765432"
              data-vv-as="account number"
            />
            <span class="error-message">{{ errors.first("account_number") }}</span>
          </div>
        </div>
      </div>

      <div class="flex">
        <div class="input">
          <div>Confirm account number:</div>
          <div>
            <input
              type="text"
              name="confirm_account_number"
              v-model="confirm_account_number"
              v-validate="'required|confirmed:account_number'"
              placeholder="GB82WEST12345698765432"
              data-vv-as="account number"
            />
            <span class="error-message">{{
              errors.first("confirm_account_number")
            }}</span>
          </div>
        </div>
      </div>

      <div class="flex" style="flex-direction: column">
        <div class="input">
          <div>Accept Terms of Service:</div>
          <input
            name="terms"
            type="checkbox"
            v-model="tos_shown_and_accepted"
            v-validate="'required'"
            data-vv-as="Terms and Conditions"
          />
        </div>
        <span class="error-message">{{ errors.first("terms") }}</span>
      </div>

      <div class="error-message flex" v-if="connectErrors">
        {{ connectErrors }}
      </div>

      <div class="submit-buttons">
        <div class="button-wrap">
          <ph-button size="medium" :loading="submitting"> Agree & Submit </ph-button>
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
  props: {
    selectedPlan: {
      required: true,
      type: Object,
    },
  },
  data() {
    return {
      date: "",
      connectErrors: null,
      accountToken: null,
      submitting: false,
      country: this.$store.state.app.account.country,
      sort_code: "",
      account_name: this.$store.state.app.account.account_name ? this.$store.state.app.account.account_name : "",
      account_number: this.$store.state.app.account.account_number ? this.$store.state.app.account.account_number :"",
      confirm_account_number: this.$store.state.app.account.account_number ? this.$store.state.app.account.account_number :"",
      tos_shown_and_accepted: false,
      accountObj: null,
      identity_document_verification: null,
    };
  },

  mounted() {
    this.$store.state.app.isUserOnLastStep = true;
    const dict = {
      custom: {
        sort_code: {
          required: "This field is required",
          regex: "Sort code needs to be in the format 00-00-00",
        },
      },
    };

    this.$validator.localize("en", dict);
  },

  computed: {
    ...mapGetters({
      tempUser: "app/getTempUser",
    }),
  },

  methods: {
    accountMutation() {
      if (this.$store.state.app.account.business_type == "individual") {
        // For Indiviual.
        this.accountObj = {
          business_type: this.$store.state.app.account.business_type,
          individual: {
            first_name: this.$store.state.app.account.first_name,
            last_name: this.$store.state.app.account.last_name,
            dob: {
              day: this.$store.state.app.account.dob.day,
              month: this.$store.state.app.account.dob.month,
              year: this.$store.state.app.account.dob.year,
            },
            email: this.$store.state.app.account.email,
            phone: this.$store.state.app.account.phone,
            address: {
              line1: this.$store.state.app.account.address.line1,
              line2: this.$store.state.app.account.address.line2,
              city: this.$store.state.app.account.address.city,
              // state: this.$store.state.app.account.address.state,
              postal_code: this.$store.state.app.account.address.postal_code,
              country: this.$store.state.app.account.country,
            },
            verification: this.identity_document_verification,
          },
          website: this.$store.state.app.account.website,
          tos_shown_and_accepted: this.$store.state.app.account.tos_shown_and_accepted,
        };
      } else if (this.$store.state.app.account.business_type == "company") {
        this.accountObj = {
          business_type: this.$store.state.app.account.business_type,
          company: {
            // name: "ePhase",
            registration_number: this.$store.state.app.account.crn,
            tax_id: this.$store.state.app.account.crn,
            structure: this.$store.state.app.account.business_structure,
            name: this.$store.state.app.account.company_name,
            phone: this.$store.state.app.account.business_number,
            address: {
              line1: this.$store.state.app.account.companyAddress.line1,
              line2: this.$store.state.app.account.companyAddress.line2,
              city: this.$store.state.app.account.companyAddress.city,
              // state: this.$store.state.app.account.companyAddress.state,
              postal_code: this.$store.state.app.account.companyAddress.postal_code,
              country: this.$store.state.app.account.country,
            },
            verification: this.identity_document_verification,
          },
          tos_shown_and_accepted: this.$store.state.app.account.tos_shown_and_accepted,
        };
      } else {
        this.accountObj = {
          business_type: this.$store.state.app.account.business_type,
          non_profit: {
            // name: "ePhase",
            registration_number: this.$store.state.app.account.crn,
            tax_id: this.$store.state.app.account.crn,
            structure: this.$store.state.app.account.business_structure,
            name: this.$store.state.app.account.company_name,
            phone: this.$store.state.app.account.business_number,
            address: {
              line1: this.$store.state.app.account.companyAddress.line1,
              line2: this.$store.state.app.account.companyAddress.line2,
              city: this.$store.state.app.account.companyAddress.city,
              // state: this.$store.state.app.account.companyAddress.state,
              postal_code: this.$store.state.app.account.companyAddress.postal_code,
              country: this.$store.state.app.account.country,
            },
            verification: this.identity_document_verification,
          },
          tos_shown_and_accepted: this.$store.state.app.account.tos_shown_and_accepted,
        };
      }
    },
    async getAccountToken() {
      const stripe = Stripe(process.env.MIX_VUE_APP_STRIPE_KEY);
      this.accountMutation();
      console.log(this.accountObj);
      await stripe
        .createToken("account", this.accountObj)
        .then((result) => {
          console.log(result);
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
          this.submitting = true;
          await this.registerUser();
          const files = await this.uploadFiles({
            document: this.$store.state.app.stripeFiles
              ? this.$store.state.app.stripeFiles
              : null,
          });
          this.identity_document_verification = {
            document: {
              front: files.document ? files.document.id : null,
            },
          };
          this.$store.state.app.account.identity_document = this.identity_document_verification;
          this.$store.state.app.account.account_country = this.country;
          // this.$store.state.app.account.sort_code = this.sort_code;
          this.$store.state.app.account.account_name = this.account_name;
          this.$store.state.app.account.account_number = this.account_number;
          this.$store.state.app.account.tos_shown_and_accepted = this.tos_shown_and_accepted;
          console.log("testing......", this.$store.state.app.account);
          await this.getAccountToken();
          // console.log();

          if (this.accountToken && !this.connectErrors) {
            await axios
              .post("/api/auth/marketplace/create", {
                account_token: this.accountToken,
                user_id: this.$store.state.app.tempRegUser.id,
                account: this.$store.state.app.account,
              })
              .then((response) => {
                this.submitting = false;
                this.$emit("finished");
              })
              .catch((error) => {
                this.submitting = false;
                this.connectErrors = error.response.data.message;
              });
          }
          // this.$emit('finished');
        }
      });
    },
    async registerUser() {
        const transferCart = this.$route.query.transferCart;
        let guestCart = null;
        if (transferCart === "true") {
          guestCart = Cookies.getJSON("phase_cart");
        }
          try {
    const response = await axios.post("/api/auth/register/" + this.selectedPlan.role.name, {
      ...this.$store.state.app.tempUser,
      guestCart,
    });
    this.$store.state.app.tempRegUser = response.data;
    console.log(response);
  } catch (error) {
    console.log(error);
    this.$emit("prev-step", 1, error.response.data.errors);
    return; // Exit the method to prevent further execution
  }
          
    },
    async uploadFiles(files) {
      const document = await this.uploadFile(files.document);
      const additional_document = await this.uploadFile(files.additional_document);

      return {
        document: document,
        additional_document: additional_document,
      };
    },

    async uploadFile(file) {
      if (file) {
        const data = new FormData();
        data.append("file", file);
        data.append("purpose", "identity_document");
        this.loading = true;
        const fileResult = await fetch("https://uploads.stripe.com/v1/files", {
          method: "POST",
          headers: { Authorization: `Bearer ${process.env.MIX_VUE_APP_STRIPE_KEY}` },
          body: data,
        });

        return await fileResult.json();
      }
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

  & > div:first-of-type {
    width: 125px;
    display: flex;
    align-items: center;
  }

  & > div:last-of-type {
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
