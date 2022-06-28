<template>
  <vue-recaptcha
    :sitekey="getSiteKey()"
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
          recaptcha: ''
      }
    },
    computed: {
      ...mapState(['app'])
    },
    methods: {
      onCaptchaVerified: function (recaptchaToken) {
          this.validateCaptcha = true;
          this.$emit("onvalidateCaptcha", recaptchaToken);
      },
      onCaptchaExpired: function () {
          this.$refs.recaptcha.reset();
          this.$emit("onExpiredCaptcha");
      },
      getSiteKey: function () {
          return this.app.captchaCredentials.key;
      }
  }
};
</script>