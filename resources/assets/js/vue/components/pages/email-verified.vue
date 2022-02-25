<template>
  <div class="page-content-padded">
    <div class="page-main">
      <div class="alert alert-success">{{message}}</div>
    </div>
  </div>
</template>

<script>

import Vue from "vue";

export default {
  name: "email-verified",

  data() {
    return {
      message: 'Email validated successfully. Please login to access',
    }
  },

  computed: {
    
  },

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
  padding: 5px;
}
</style>
