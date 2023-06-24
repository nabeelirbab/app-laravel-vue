<template>
  <modal name="modal-auth-register-form" @before-open="beforeOpen" @closed="closed" width="70%" height="auto" scrollable>
    <div class="modal modal-auth-register-form">
      <div class="modal-header">
        <logo class="modal-logo centered-block" style="width: 185px;" />
        <close-icon @click.native="$modal.hide('modal-auth-register-form')"></close-icon>
      </div>
      <div class="modal-content full-width" v-if="!submitted">
        <!--                <div class="membership-selection">-->
        <!--                    <div class="membership-type" v-for="plan in plans" :key="plan.id" @click="selectedPlan = plan">-->
        <!--                        <img src="https://placehold.it/150x150" :alt="plan.title"-->
        <!--                             :class="{ selected : isSelected(plan) }"/>-->
        <!--                        <span>{{ plan.title }}</span>-->
        <!--                    </div>-->
        <!--                </div>-->
        <form class="register-form" v-if="selectedPlan">
          <personal-details v-if="step === 1" :selected-plan="selectedPlan" :verrors="verrors" @next-step="nextStep"></personal-details>
          <connect-details v-if="step === 2" @skip="onHandleSkip" @next-step="nextStep"></connect-details>
          <phone-details @next-step="nextStep" @handleOtpId="handleOtpId" v-if="step === 3"></phone-details>
          <phone-verification @next-step="nextStep" :otpId="otpId" @handleOtpId="handleOtpId" v-if="step === 4"></phone-verification>
          <business-type @next-step="nextStep" v-if="step === 5"></business-type>
          <identity-details @next-step-verify="nextStepVerify"  @next-step="nextStep" v-if="step === 6"></identity-details>
          <verify-business-details @next-step-verify="nextStepVerify" v-if="step === 9"></verify-business-details>
          <!-- <professional-details @next-step="nextStep" v-if="step === 7"></professional-details> -->
          <payouts-details @next-step="nextStep" @prev-step="prevStep" :selected-plan="selectedPlan" @finished="onHandleFinished" v-if="step === 7"></payouts-details>

          <div class="time-confirmation-text" style="padding: 20px 50px" v-if="selectedPlan.id !== 1">
            <br />
            <p style="margin-top: 30px;text-align: center;">
              *
              {{ selectedPlan.id === 2 ? "Artist" : "Artist Pro" }} Applications
              are subject to a verification process. This may take up to 48
              hours.
            </p>
          </div>
        </form>
      </div>
      <div class="modal-content" v-else>
        <h2 class="flex justify-center">
          Your registration was successful!
        </h2>
        <p class="flex justify-center">
          Account verification email sent.Please check your email for account activation instructions.
        </p>
        <div class="flex justify-center" style="padding: 20px 0;">
          <ph-button size="large" @click.native.prevent="showLoginModal">
            Login
          </ph-button>
        </div>
      </div>
    </div>
  </modal>
</template>

<script>
import CloseIcon from "global/close-icon";
import Logo from "global/logo";
import PersonalDetails from "./register-steps/personal-details";
import ConnectDetails from "./register-steps/connect-details";
import VerificationDetails from "./register-steps/verification-details";
import PhoneDetails from "./register-steps/phone-details";
import PhoneVerification from "./register-steps/phone-verification";
import BusinessType from "./register-steps/business-type";
import IdentityDetails from "./register-steps/identity-details";
import VerifyBusinessDetails from "./register-steps/verify-business-details";
import ProfessionalDetails from "./register-steps/professional-details";
import PayoutsDetails from "./register-steps/payouts-details";

import { mapGetters } from "vuex";


export default {
  data() {
    return {
      step: 1,
      selectedPlan: null,
      submitted: false,
      otpId: null,
      verrors: null,
    };
  },
  computed: {
    ...mapGetters({
      plans: "app/getPlans",
      tempUser: "app/getTempUser",
    }),
  },
  methods: {
    isSelected(plan) {
      return plan === this.selectedPlan;
    },
    beforeOpen(event) {
      this.selectedPlan = event.params.type;
    },
    closed() {
      this.selectedPlan = null;
      this.submitted = false;
    },
    onHandleSkip() {
      this.submitted = true;
      this.step = 1;
      axios.post(
        "/api/auth/mail",
        {
          user: this.tempUser,
        }
      )
    },
    onHandleFinished() {
      this.submitted = true;
      this.step = 1;
    },
    prevStep(step, data = null){
      if(step == 1){
        this.step = step;
        this.verrors = data;
      }
    },
    nextStep() {
      if (this.selectedPlan.title === "Standard") {
        return (this.submitted = true);
      }
      if(this.$store.state.app.isUserOnLastStep){
        this.step = 7;
        return 0;
      }else{
        this.step++;
      }
    },

    nextStepVerify() {
      if (this.step == 9) {
        this.step = 7;
      }
      if (this.$store.state.app.account.business_type == 'company' && this.step == 6) {
        this.step = 9;
      } 
      if (this.$store.state.app.account.business_type == 'non_profit' && this.step == 6) {
        this.step = 9;
      } 
    },
    handleOtpId(id){
      this.otpId = id;
      console.log(this.otpId);
    },
    showLoginModal() {
      this.$modal.hide("modal-auth-register-form");
      this.$modal.show("modal-auth-login");
    },
  },
  components: {
    CloseIcon,
    Logo,
    PersonalDetails,
    ConnectDetails,
    VerificationDetails,
    PhoneDetails,
    PhoneVerification,
    BusinessType,
    IdentityDetails,
    VerifyBusinessDetails,
    ProfessionalDetails,
    PayoutsDetails
  },
};
</script>

<style lang="scss" scoped>
@import "~styles/helpers/_variables.scss";

.membership-selection {
  display: flex;
  justify-content: space-around;
  align-items: flex-start;
}

.membership-type {
  text-align: center;
  flex-basis: 33%;

  img {
    padding: 0;

    &.selected {
      border: 10px solid $color-2;
    }
  }

  span {
    display: block;
    margin-top: 30px;
    text-transform: uppercase;
    font-size: 20px;
  }
}

.time-confirmation-text {
  @media (max-width: 768px) {
    padding: 20px 8px !important;

    p {
      margin-top: 0px !important;
    }
  }
}
</style>
