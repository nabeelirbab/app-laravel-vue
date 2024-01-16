<template>
  <nav class="sub-nav" :class="classes">
    <ul>
      <li>&nbsp;</li>
      <li :class="{ active: active === 'account' }" @click="$emit('handleActiveTab', 'account')">
        <span class="top_curve"></span>
        <span class="left_curve"></span>
        <router-link :to="{ name: 'account_default' }">
          <img src="/img/billing_account.png" alt=""> Billing & Account
        </router-link>
        <span class="bottom_curve"></span>
      </li>
      <!-- v-if="$can('create unlimited releases')" -->
      <!-- <li :class="{ active: active === 'invoices' }" @click="$emit('handleActiveTab', 'invoices')">
        <span class="top_curve"></span>
        <span class="left_curve"></span>
        <router-link :to="{ name: 'account_invoices' }">
          Billing
        </router-link>
        <span class="bottom_curve"></span>
      </li> -->
      <li :class="{ active: active === 'verification' }" v-if="$can('create releases')"
        @click="$emit('handleActiveTab', 'verification')">
        <span class="top_curve"></span>
        <span class="left_curve"></span>
        <router-link :to="{ name: 'account_marketplace' }">
          <img src="/img/verification.png" alt="">
          Verification
        </router-link>
        <span class="bottom_curve"></span>
      </li>
      <li :class="{ active: active === 'mymusic' }" @click="$emit('handleActiveTab', 'mymusic')">
        <span class="top_curve"></span>
        <span class="left_curve"></span>
        <router-link :to="{ name: 'mymusic' }">
          <img src="/img/my_music.png" alt="">
          My Music
        </router-link>
        <span class="bottom_curve"></span>
      </li>
      <li :class="{ active: active === 'releases' }" v-if="$can('create releases')"
        @click="$emit('handleActiveTab', 'releases')">
        <span class="top_curve"></span>
        <span class="left_curve"></span>
        <router-link :to="{ name: 'account_releases' }">
          <img src="/img/my_release.png" alt="">
          My Releases
        </router-link>
        <span class="bottom_curve"></span>
      </li>
      <li :class="{ active: active === 'stats' }" v-if="$can('create releases')"
        @click="$emit('handleActiveTab', 'stats')">
        <span class="top_curve"></span>
        <span class="left_curve"></span>
        <router-link :to="{ name: 'account_stats' }">
          <img src="/img/sales.png" alt="">
          Sales & Feedback
        </router-link>
        <span class="bottom_curve"></span>
      </li>
      <li :class="{ active: active === 'profile' }" @click="$emit('handleActiveTab', 'profile')">
        <span class="top_curve"></span>
        <span class="left_curve"></span>
        <router-link :to="{ name: 'account_edit' }">
          <img src="/img/profile.png" alt="">
          Profile
        </router-link>
        <span class="bottom_curve"></span>
      </li>
    </ul>
    <div class="extra-spacer-outline">&nbsp;</div>
  </nav>
</template>

<script>
export default {
  props: {
    active: {
      type: String,
      default: 'account',
    },
    center: {
      type: Boolean,
      default: false,
    },
    white: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {}
  },
  computed: {
    classes() {
      let classes = []
      if (this.center) {
        classes.push('center')
      }
      if (this.white) {
        classes.push('white')
      }
      return classes
    },
  },
  created: function () {

  },
  components: {},
}
</script>

<style lang="scss" scoped>
.sub-nav {
  text-align: center;
  width: 20%;
  overflow: hidden;

  @media(max-width: 380px) {
    padding-right: 6em;
  }
}

.center {
  text-align: center;
}

.white a {
  color: white;
}

.router-link-active {
  text-decoration-color: #9eefe1 !important;
}

ul {
  padding: 0px 20px;
}

ul li {
  position: relative;
  border-right: 2px solid #3300ff;
  margin: 0px !important;
}

ul li a {
  display: flex;
  align-items: center;
  justify-content: flex-start;
}

ul li a img {
  width: 16px;
  height: 18px;
  padding-right: 10px;
}

ul li.active .top_curve {
  position: absolute;
  left: -1.5px;
  top: -1px;
  width: 100%;
  height: 8px;
}

ul li.active .bottom_curve {
  position: absolute;
  left: -1.5px;
  top: 50.5px;
  width: 100%;
  height: 10px;
}

ul li.active .left_curve {
  position: absolute;
  left: -8px;
  top: 7px;
  width: 5px;
  height: 71%;
}

ul li.active .top_curve:before,
ul li.active .left_curve:before,
ul li.active .bottom_curve:before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

ul li.active .top_curve:before {
  border-bottom: 2px solid #3300ff;
  border-right: 2px solid #3300ff;
}

ul li.active .left_curve:before {
  border-left: 2px solid #3300ff;
  border-top: 2px solid #3300ff;
  border-bottom: 2px solid #3300ff;
}

ul li.active .bottom_curve:before {
  border-top: 2px solid #3300ff;
  border-right: 2px solid #3300ff;
}

ul li.active .top_curve:before {
  border-bottom-right-radius: 25px;
}

ul li.active .left_curve:before {
  border-bottom-left-radius: 25px;
  border-top-left-radius: 25px;
}

ul li.active .bottom_curve:before {
  border-top-right-radius: 25px;
}

ul li {
  display: block !important;
  padding: 20px;
}

ul li.active {
  border-right: 0px !important;
}

.extra-spacer-outline {
  height: 100%;
  margin: 0px 20px;
  border-right: 2px solid #3300ff;
}
</style>
