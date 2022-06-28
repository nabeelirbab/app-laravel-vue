<template>
  <vue-recaptcha
    sitekey="siteKey"
    :loadRecaptchaScript="true"
    ref="recaptcha"
    @verify="onCaptchaVerified"
    @expired="onCaptchaExpired"
  />
</template>

<script>
import { VueRecaptcha } from 'vue-recaptcha';
import {mapState} from "vuex";
  export default {
    name: "recaptcha",
    components: { VueRecaptcha },
    data() {
      return {
          recaptcha: '',
          siteKey: this.getSiteKey()
      }
    },
    computed: {
      ...mapState(['app']),
    },
    methods: {
      onCaptchaVerified: function (recaptchaToken) {
          this.form.recaptcha = recaptchaToken
          this.validateCaptcha = true
      },
      onCaptchaExpired: function () {
          this.$refs.recaptcha.reset();
      },
      getSiteKey: function () {
          return this.app.captchaCredentials.key;
      }
  }
};
</script>