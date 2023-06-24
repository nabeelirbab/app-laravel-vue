<template>
  <div>
    <h1>Phone Verification</h1>

    <form @submit.prevent="handleSubmit" id="account-form">
      <p>Enter the verification code we sent to your phone</p>

      <div class="flex flex-row justify-between" id="in">
        <input
          :style="style"
          v-model="inputs[idx]"
          :class="inputClass"
          @keyup="inputFocus"
          @focus="check($event)"
          @change="handleChange(idx, $event)"
          v-for="(inp, idx) in inputCount"
          :key="idx"
          :tabindex="idx"
          maxlength="1"
          autocomplete="off"
        />
      </div>
      <hr />

      <span
        style="color: red; text-align: center; display: block; font-size: 14px"
        v-if="errMsg"
        >{{ errMsg }}</span
      >
      <span
        style="color: #3300ff; text-align: center; display: block; font-size: 14px"
        v-if="resendMsg"
        >{{ resendMsg }}</span
      >
      <small
        style="
          display: flex;
          justify-content: center;
          flex-direction: row;
          margin: 15px 0px;
          cursor: pointer;
        "
        @click="handleResend"
        ><i class="fa fa-redo"></i>&nbsp;Resend code</small
      >

      <div class="submit-buttons">
        <div class="button-wrap">
          <ph-button size="medium" :loading="submitting"> Continue </ph-button>
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
  name: "phone-verification",

  data() {
    return {
      submitting: false,
      code: "",
      inputs: Array(this.inputCount),
      currentKey: 0,
      errMsg: null,
      resendMsg: null,
    };
  },
  props: {
    inputCount: {
      type: Number,
      default: 6,
    },
    inputClass: String,
    dimension: {
      type: String,
      default: "43px",
    },
    value: [String, Number, Object],
    otpId: Number,
  },
  mounted() {},

  computed: {
    style() {
      return `
        width: ${this.dimension}; 
        height: ${this.dimension}; 
        text-align: center;
      `;
    },
  },
  watch: {
    value() {
      this.inputs = this.value.split("");
    },
  },
  methods: {
    async handleSubmit() {
      console.log("otp", this.otpId);
      console.log(this.inputs.filter((value) => value).length);
      if (this.inputs.filter((value) => value).length == 0) {
        this.errMsg = "Verification code feild is required!";
        return 0;
      }

      if (this.inputs.filter((value) => value).length < 6) {
        this.errMsg = "Verification code must be 6 digit!";
        return 0;
      }

      const nonIntValues = this.inputs.filter(
        (value) => !Number.isInteger(Number(value))
      );
      if (nonIntValues.length > 0) {
        this.errMsg = "Verification code is invalid!";
        return 0;
      }

      await axios
        .post("/api/auth/phone-verification", {
          code: this.inputs.join(""),
          id: this.otpId,
        })
        .then((res) => {
          this.$emit("next-step");
        })
        .catch((err) => {
          this.errMsg = "Please enter valid verification code!";
          console.log(err);
        });
    },
    async handleResend() {
      await axios
        .post("/api/auth/resend-otp", {
          // user_id: '45',
          id: this.otpId,
          // phone: '+441234567890',
          phone: this.$store.state.app.account.phone,
        })
        .then((res) => {
          this.$emit("handleOtpId", res.data.otp_id);
          this.resendMsg = "Verification code resent successfully!";
        });
    },
    handleChange(key, event) {
      this.inputs[key] = event.target.value;
    },

    getChildren(event) {
      return event.target.parentElement.children;
    },

    check(event) {
      const inputs = this.getChildren(event);

      if (inputs[this.currentKey]) {
        inputs[this.currentKey].focus();
      }
    },

    inputFocus(event) {
      const data = this.inputs.join("");
      const inputs = this.getChildren(event);

      this.$emit("input", data);
      if (data.length === this.inputCount) {
        // console.log("data foucs", data)
        // this.handleSubmit();
      }

      if (event.key === "Delete" || event.key === "Backspace") {
        this.currentKey--;
        if (this.currentKey <= 0) {
          this.currentKey = 0;
        }
        if (inputs[this.currentKey]) {
          inputs[this.currentKey].focus();
        }
      } else {
        this.currentKey++;
        if (this.currentKey >= this.inputCount) {
          this.currentKey = this.inputCount;
        }
        if (inputs[this.currentKey]) {
          inputs[this.currentKey].focus();
        }
      }
    },
  },
  components: {},
};
</script>

<style lang="scss" scoped>
@import "~styles/helpers/_variables.scss";

input {
  border: 1px solid #80808030;
  height: 56px !important;
  width: 42px !important;
  font-size: 18px !important;
}

input:nth-child(1) {
  border-right: none;
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
}

input:nth-child(2) {
  border-right: none;
}

input:nth-child(3) {
  margin-right: 20px;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
}

#in {
  margin-top: 20px;
  text-align: center;
  display: flex;
  margin-bottom: 20px;
  justify-content: center;
}

hr {
  width: 8px;
  margin-top: -49px !important;
  text-align: center;
  border-top: 1px solid rgba(128, 128, 128, 0.1882352941);
  margin-bottom: 42px !important;
}

input:nth-child(4) {
  border-right: none;
  margin-left: 20px;
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
}

input:nth-child(5) {
  border-right: none;
}

input:nth-child(6) {
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
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
