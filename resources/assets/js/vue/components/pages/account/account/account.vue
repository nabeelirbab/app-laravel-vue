<template>
  <div class="my-account-responsive">
    <ph-panel v-if="!app.user.approved_at" id="approved" class="">
      <p>This account is waiting for approval</p>
    </ph-panel>
    <ph-panel v-if="app.user.status === 'frozen'">
      <p>Your account is currently frozen</p>
    </ph-panel>
    <ph-panel id="email">
      <h2>Email Address</h2>
      <hr />
      <table>
        <tr>
          <td>Your Email</td>
          <td>{{ app.user.email }}</td>
        </tr>
        <tr>
          <td>New Email</td>
          <td>
            <!-- <input
              type="email"
              name="email-address"
              data-vv-scope="form-email"
              v-validate.disable="'required|email'"
              v-model="email.address"
              placeholder="New Email"
            /> -->

            <div :class="{ 'email-input': true, valid: isValid }">
              <input type="email" v-model="email.address" placeholder="aaron@gmail.com">
              <svg viewBox="0 0 18 18">
                <path
                  d="M11.5,10.5 C6.4987941,17.5909626 1,3.73719105 11.5,6 C10.4594155,14.5485365 17,13.418278 17,9 C17,4.581722 13.418278,1 9,1 C4.581722,1 1,4.581722 1,9 C1,13.418278 4.581722,17 9,17 C13.418278,17 17,13.42 17,9">
                </path>
                <polyline points="5 9.25 8 12 13 6"></polyline>
              </svg>
            </div>

            <span class="error-msg">{{
              errors.first("form-email.email-address")
            }}</span>
          </td>
        </tr>
      </table>

      <ph-button size="medium" @click.native="saveEmail" :loading="email.submitting">Save</ph-button>
    </ph-panel>
    <notifications />
    <ph-panel id="password">
      <h2>Password</h2>
      <hr />
      <table>
        <tr>
          <td>Current Password</td>
          <td>
            <input type="password" name="password-current" data-vv-scope="form-password" v-validate.disable="'required'"
              v-model="password.current" placeholder="Current Password" />
            <span class="error-msg">{{
              errors.first("form-password.password-current")
            }}</span>
          </td>
        </tr>
        <tr>
          <td>New Password</td>
          <td>
            <input type="password" name="password-new" data-vv-scope="form-password"
              v-validate.disable="{ required: true }" v-model="password.new" placeholder="New Password" />
            <span class="error-msg">{{
              errors.first("form-password.password-new")
            }}</span>
          </td>
        </tr>
        <tr v-if="password.new">
          <td>Confirm Password</td>
          <td>
            <input type="password" name="password-confirm" data-vv-scope="form-password" v-validate.disable="{
              is: password.new,
              required: true,
              max: 255,
            }" v-model="password.confirm" placeholder="Confirm Password" />
            <span class="error-msg">{{
              errors.first("form-password.password-confirm")
            }}</span>
          </td>
        </tr>
      </table>

      <ph-button size="medium" @click.native="savePassword" :loading="password.submitting">Save</ph-button>
    </ph-panel>

    <billing />
    <subscriptions v-if="app.user.roles[0].name !== 'standard'" />
    <manage />
  </div>
</template>

<script>
import { mapState } from "vuex";
import { UserEvents } from "events";

import ErrorMessages from "./error-messages";

import PhButton from "global/ph-button";
import AccountMenu from "../account-menu";

import Notifications from "./notifications";
import Billing from "./billing";
import Subscriptions from "./subscriptions/subscriptions";
import Manage from "./manage";

export default {
  data() {
    return {
      email: {
        submitting: false,
        address: "",
      },
      password: {
        submitting: false,
        current: "",
        new: "",
        confirm: "",
      },
      audio: {
        submitting: false,
        format: "mp3",
      },
    };
  },
  computed: {
    ...mapState(["app"]),
    isValid() {
      // Define your email validation logic here
      const regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return regex.test(this.email.address);
    },
  },
  created: function () {
    this.$validator.localize("en", {
      custom: ErrorMessages,
    });
    UserEvents.$emit("updateTitle", "My Account");
  },
  methods: {
    saveEmail() {
      this.$validator.validateAll("form-email").then((passes) => {
        if (passes) {
          this.email.submitting = true;
          axios.post("/api/account/email", this.email).then((response) => {
            this.email.submitting = false;
            this.$store.commit("app/setUser", response.data);
            this.email.address = "";
            this.$notify({
              group: "main",
              type: "success",
              title: "<img src='/img/success.gif' alt='success'>",
            });
          });
        }
      });
    },
    savePassword() {
      this.$validator.validateAll("form-password").then((passes) => {
        if (passes) {
          this.password.submitting = true;
          axios
            .post("/api/account/password", this.password)
            .then((response) => {
              this.$store.commit("app/setUser", response.data);
              this.$notify({
                group: "main",
                type: "success",
                title: "<img src='/img/success.gif' alt='success'>",
              });
              this.resetForms();
              this.password.submitting = false;
            });
        }
      });
    },
    saveAudio() {
      this.$validator.validateAll("form-audio");
    },
    resetForms() {
      this.email = {
        submitting: false,
        address: "",
      };
      this.password = {
        submitting: false,
        current: "",
        new: "",
        confirm: "",
      };
      this.audio = {
        submitting: false,
        format: "mp3",
      };
    },
  },
  components: {
    AccountMenu,
    PhButton,
    Notifications,
    Billing,
    Subscriptions,
    Manage,
  },
};
</script>

<style lang="scss" scoped>
.email-input {
  --text: #646B8C;
  --text-placeholder: #BBC1E1;
  --icon: #A6ACCD;
  --icon-focus: #646B8C;
  --icon-invalid: #F04949;
  --icon-valid: #16BF78;
  --background: #fff;
  --border: #D1D6EE;
  --border-hover: #A6ACCD;
  --border-focus: #275EFE;
  --shadow-focus: #{rgba(#275EFE, .32)};
  position: relative;
  max-width: 220px;

  input {
    width: 100% !important;
    -webkit-appearance: none;
    outline: none;
    display: block;
    font-size: 14px;
    font-family: inherit;
    margin: 0;
    padding: 8px 16px 8px 41px !important;
    line-height: 26px;
    border-radius: 6px;
    color: var(--text);
    border: 1px solid var(--bc, var(--border));
    background: var(--background);
    transition: border-color .3s, box-shadow .3s;

    &::placeholder {
      color: var(--text-placeholder);
    }
  }

  svg {
    width: 16px;
    height: 16px;
    top: 14px;
    left: 14px;
    display: block;
    position: absolute;
    fill: none;
    stroke: var(--i, var(--icon));
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke-width: 1.6;
    transition: stroke .3s;

    path {
      stroke-dasharray: 80;
      stroke-dashoffset: var(--path, 170);
      transition: stroke-dashoffset .5s ease var(--path-delay, .3s);
    }

    polyline {
      stroke-dasharray: 12;
      stroke-dashoffset: var(--tick, 12);
      transition: stroke-dashoffset .45s ease var(--tick-delay, 0s);
    }
  }

  &:hover {
    --bc: var(--border-hover);
  }

  &:focus-within {
    --bc: var(--border-focus);
    --i: var(--icon-focus);

    input {
      box-shadow: 0 1px 6px -1px var(--shadow-focus);
    }
  }

  &:not(.valid) {
    input {
      &:not(:placeholder-shown) {
        &:not(:focus) {
          &+svg {
            --i: var(--icon-invalid);
          }
        }
      }
    }
  }

  &.valid {
    --i: var(--icon-valid);
    --path: 132;
    --path-delay: 0s;
    --tick: 0;
    --tick-delay: .3s;
  }
}

.my-account-responsive {
  @media (max-width: 450px) {
    width: 90%;
  }

  @media (max-width: 400px) {
    width: 85%;
  }

  @media (max-width: 380px) {
    width: 80%;
  }

  @media (max-width: 360px) {
    width: 75%;
  }

  @media (max-width: 340px) {
    width: 70%;
  }
}

h3 {
  text-decoration: underline;
}

table {
  width: 100%;
}

td {
  padding: 15px 10px;
  vertical-align: middle;

  @media (max-width: 415px) {
    padding: 15px 5px;
    font-size: 12px;
  }
}

input:not([type="radio"]):not([type="checkbox"]) {
  width: 70%;
  box-sizing: border-box;
  padding: 5px;

  @media (max-width: 1024px) {
    width: 80%;
  }
}

.error-msg {
  color: #ff6e6e;
  position: absolute;
  font-size: 12px;
  margin-top: 5px;
}

.checkbox-container {
  margin: 1em 0;
}

.approved {
  background: red !important;

  p {
    text-decoration: none;
    text-transform: uppercase;
  }
}
</style>
