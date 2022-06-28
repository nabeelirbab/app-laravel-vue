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
      console.log("validate on recaptcha 27 "+ recaptchaToken);
          this.validateCaptcha = true;
          console.log("validate on recaptcha 30 "+ this.recaptcha);
          this.$emit("onvalidateCaptcha", this.recaptcha);
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