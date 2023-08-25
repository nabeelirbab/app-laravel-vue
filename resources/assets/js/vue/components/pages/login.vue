<template>
  <div class="page-content-padded">
    <!-- Overlay for Notify -->
    <overlay-notify :is-visible="isOverlayVisible" :duration="10000" @close="hideOverlay">
      <!-- Content of the overlay -->
      <div class="overlay-content">
        <img slot="imageSrc" src="/img/Resized_mail.gif" alt="verified" srcset="">
        <div v-html="overlayContent"></div>
      </div>
    </overlay-notify>

    <div class="page-main" v-if="!app.user.loggedin">
      <h1 class="no-top">Login</h1>
      <p class="centered-text" style="margin: 1em 0;">
        Don't have an account? <a href="#" @click="showRegister">Register</a>
      </p>
      <form class="form-login" @submit.prevent="formSubmit">
        <input type="email" name="email" placeholder="Email" v-model="email" v-validate="'required|email'"
          :class="{ 'error': errors.has('email') }" />
        <span class="error-msg" v-if="errors.has('email')">{{ errors.first('email') }}</span>

        <input type="password" name="password" placeholder="Password" v-model="password" v-validate="'required'"
          :class="{ 'error': errors.has('password') }" />
        <span class="error-msg" v-if="errors.has('password')">{{ errors.first('password') }}</span>

        <div style="display: flex;justify-content: space-between;">
          <label style="display: block">
            <input type="checkbox" name="remember" id="remember" v-model="remember" />
            Remember me
          </label>
          <label style="display: block;cursor:pointer;margin-top: auto;margin-bottom: auto;" class="remember-me"
            @click="showReset">
            Forgot password
          </label>
        </div>

        <div class="centered-text">
          <ph-button type="submit" size="medium" :loading="loading">
            Login
          </ph-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import OverlayNotify from './../layout/overlay-notify.vue';

export default {
  components: {
    OverlayNotify,
  },
  data() {
    return {
      variables: window.variables,
      loading: false,
      email: '',
      password: '',
      remember: false,
      deActivatedUser: false,
      banned: false,
      showMessage: false,
      isOverlayVisible: false,
      overlayContent: ""
    }
  },
  created: async function () {
    // console.log(this.$route.query['email_verified']);
    if (this.$route.query['email_verified'] === '1') {
      this.overlayContent = "<p>Email Verified.</p>";
      this.isOverlayVisible = true;
      this.$store.commit("app/unsetUser");
      await axios.get("/api/auth/logout");
    } else if (this.$route.query['email_verified'] === '0') {
      this.overlayContent = "<p>Verify your email address</p><br><span>Check your email to complete verification</span>";
      this.isOverlayVisible = true;
      this.$store.commit("app/unsetUser");
      await axios.get("/api/auth/logout");
    } else {
      if (this.app.user.loggedin) {
        this.$router.push({ path: '/account' });
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
    ...mapState([
      'app'
    ])
  },

  methods: {
    hideOverlay() {
      this.isOverlayVisible = false;
      this.$router.push({ path: '/login' });
    },
    formSubmit: function () {
      this.$validator.validateAll().then(passes => {
        const { email, password, remember } = this

        if (!passes) return

        this.loading = true;

        axios.post('/api/auth/login', { email, password, remember }).then(function (response) {
          this.loading = false;

          if (response.data.success) {
            this.username = ''
            this.password = ''

            this.$store.commit('app/setUser', response.data.user);
            window.location = '/admin';
          } else {
            if (response.data.deactivated) {
              this.deActivatedUser = true;
            } else if (response.data.banned) {
              this.banned = true;
            } else {
              this.password = ''
            }
          }
        }.bind(this)).catch(function (err) {
          this.loading = false;
          this.password = ''
        }.bind(this))
      })
    },
    showReset: function () {
      this.$modal.show('reset-password')
    },
    showRegister: function () {
      this.$modal.show('modal-auth-register')
    },
  }
}
</script>

<style lang="scss" scoped>
.no-top {
  text-align: center;
}

form.form-login {
  width: 70%;
  margin: 0 auto;

  input {
    margin: 1em 0;
    padding: 3px;

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
