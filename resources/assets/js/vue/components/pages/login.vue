<template>
  <div class="page-content-padded">
    <div class="phase-logo-outline-top-left">
      <img src="/img/logo_outline_top_left.png" alt="" srcset="">
    </div>

    <!-- Overlay for Notify -->
    <overlay-notify :is-visible="isOverlayVisible" :duration="$route.query['email_verified'] === '1' ? 6500 : null"
      @close="hideOverlay">
      <!-- Content of the overlay -->
      <div class="overlay-content">
        <div v-if="$route.query['email_verified'] === '1'">
          <email-verified-svg></email-verified-svg>
          <h2>Email Verified.</h2>
          <!-- <span style="color: blue;cursor: pointer">Login</span> -->
        </div>
        <div v-else>
          <div class="overLayClose" @click="hideOverlay">
            <i class="fa fa-times" aria-hidden="true"></i>
          </div>
          <email-not-verified-svg></email-not-verified-svg>
          <h2>Registration complete</h2>
          <span>go to your email to verify</span>
        </div>
        <!-- <img slot="imageSrc" src="/img/Resized_mail.gif" alt="verified" srcset="" /> -->
        <!-- <div v-html="overlayContent" @click="handleOverlayClick"></div> -->
      </div>
    </overlay-notify>

    <div class="page-main" v-if="!app.user.loggedin">
      <h1 class="no-top">Login</h1>
      <!-- <p class="centered-text" style="margin: 1em 0">
        Don't have an account? <a href="#" @click="showRegister">Register</a>
      </p> -->
      <form class="form-login" @submit.prevent="formSubmit">
        <input type="email" name="email" placeholder="Email" v-model="email" v-validate="'required|email'"
          :class="{ error: errors.has('email') }" data-vv-validate-on="focusout" />
        <span class="error-msg" v-if="errors.has('email')">{{
          errors.first("email")
        }}</span>

        <input type="password" name="password" placeholder="Password" v-model="password" v-validate="'required'"
          :class="{ error: errors.has('password') }" data-vv-validate-on="focusout" />
        <span class="error-msg" v-if="errors.has('password')">{{
          errors.first("password")
        }}</span>
        <span v-if="showMessage" style="color: red;font-size: 12px;">{{ showMessage }}</span>
        <!-- <div style="display: flex; justify-content: space-between"> -->
        <label style="display: block">
          <input type="checkbox" name="remember" id="remember" v-model="remember" />
          Remember me
        </label>
        <label style="display: block; cursor: pointer; margin-top: 50px; margin-bottom: 20px; text-align: center;"
          class="remember-me" @click="showReset">
          Forgot Password?
        </label>
        <!-- </div> -->
        <div class="centered-text">
          <ph-button type="submit" size="medium" :loading="loading"> Login </ph-button>
        </div>
      </form>
    </div>

    <div class="phase-logo-outline-bottom-right">
      <img src="/img/logo_outline_bottom_right.png" alt="" srcset="">
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
import OverlayNotify from "./../layout/overlay-notify.vue";
import EmailVerifiedSvg from "./../icons/email-verified.vue";
import EmailNotVerifiedSvg from "./../icons/email-not-verified.vue";

export default {
  components: {
    OverlayNotify,
    EmailVerifiedSvg,
    EmailNotVerifiedSvg
  },
  data() {
    return {
      variables: window.variables,
      loading: false,
      email: "",
      password: "",
      remember: false,
      deActivatedUser: false,
      banned: false,
      showMessage: false,
      isOverlayVisible: false,
      overlayContent: "",
    };
  },
  created: async function () {
    // console.log(this.$route.query['email_verified']);
    if (this.$route.query["email_verified"]) {
      // this.overlayContent =
      //   '<h2>Email Verified.</h2><br><span style="color: blue;cursor: pointer">Login</span>';
      this.isOverlayVisible = true;
      this.$store.commit("app/unsetUser");
      await axios.get("/api/auth/logout");
    } else {
      if (this.app.user.loggedin) {
        this.$router.push({ path: "/account" });
      }
    }
  },
  async mounted() {
    // if (this.$route.query['email_verified'] === '1') {
    //   this.isOverlayVisible = true;
    //   this.$store.commit("app/unsetUser");
    //   await axios.get("/api/auth/logout");
    // }
  },
  computed: {
    ...mapState(["app"]),
  },

  methods: {
    handleOverlayClick(event) {
      const target = event.target;
      if (target.tagName === "SPAN" && target.style.color === "blue") {
        this.hideOverlay();
      }
    },

    hideOverlay() {
      this.isOverlayVisible = false;
      this.$router.push({ path: "/login" });
    },

    formSubmit: function () {
      this.$validator.validateAll().then((passes) => {
        const { email, password, remember } = this;

        if (!passes) return;

        this.loading = true;

        axios
          .post("/api/auth/login", { email, password, remember })
          .then(
            function (response) {
              this.loading = false;

              if (response.data.success) {
                this.username = "";
                this.password = "";

                this.$store.commit("app/setUser", response.data.user);
                // window.location = "/admin";
                location.reload()

              } else {
                if (response.data.deactivated) {
                  this.deActivatedUser = true;
                  this.showMessage = response.data.message;
                } else if (response.data.banned) {
                  this.banned = true;
                } else {
                  this.password = "";
                }
              }
            }.bind(this)
          )
          .catch(
            function (err) {
              this.loading = false;
              this.password = "";
            }.bind(this)
          );
      });
    },

    showReset: function () {
      this.$modal.show("reset-password");
    },

    showRegister: function () {
      this.$modal.show("modal-auth-register");
    },
  },
};
</script>

<style lang="scss" scoped>
.overLayClose {
  position: absolute;
  top: 10px;
  font-size: 30px;
  right: 10px;
  cursor: pointer;
}

.no-top {
  text-align: center;
}

.phase-logo-outline-top-left {
  img {
    position: absolute;
    width: 40%;
    top: 0px;
  }
}

.phase-logo-outline-bottom-right {
  img {
    position: absolute;
    width: 40%;
    bottom: 0px;
    right: 0px;
  }
}

form.form-login {
  width: 30%;
  margin: 0 auto;

  input {
    border: 2px solid #3300ff;
    border-radius: 6px;
    margin: 1em 0;
    padding: 8px;
    font-size: 18px;

    &.error {
      border: 1px solid red;
      border-radius: 3px;
    }
  }

  .error-msg {
    color: red;
    font-size: 10px;
  }
}
</style>
