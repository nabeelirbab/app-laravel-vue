<template>
  <div class="page-content-padded">
    <div class="page-main">
      <div class="alert alert-success">{{message}}
        <span v-if="!app.user.loggedin">Please <a href="#" @click="$modal.show('modal-auth-login')" class="text-white">Login</a> to Access.</span>
      </div>
    </div>
  </div>
</template>

<script>

import Vue from "vue";
import { mapState } from "vuex";
export default {
  name: "email-verified",

  data() {
    return {
      message: 'Email verified successfully.',
    }
  },

  computed: mapState(["app"]),

  mounted() {
  },

  methods: {
    
  },

}
</script>

<style>
.alert-success {
  background: green;
  color: #fff;
  padding: 10px;
}
.text-white {
  color: #fff;
}
</style>
