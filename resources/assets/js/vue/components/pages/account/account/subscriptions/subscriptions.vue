<template>
  <ph-panel id="subscriptions">
    <h2>Subscriptions</h2>
    <p>
      All subscriptions are billed monthly.
    </p>
    <!-- <subscription-plan v-for="plan in plans" v-if="plansLoaded && subscriptionsLoaded" :plan="plan"
      :subscription="getSubscriptionForPlan(plan)" :key="plan.id" /> -->

    <subscription-plan v-for="subscription in subscriptions" v-if="plansLoaded && subscriptionsLoaded"
      :subscription="subscription" :plan="subscription.stripe_plan == 'Artist Pro EU' ? plans[0] : plans[1]"
      :key="subscription.id" />

    <div class="no-subscription-block" v-if="subscriptionsLoaded && subscriptions.length == 0">
      <p class="no-subscription-label">Not subscribed, free 30 days trail available.</p>
      <ph-button size="medium" @click.native="subscribe" :loading="loading" class="trial-button">
        Start Trial
      </ph-button>
    </div>

    <div v-show="!(plansLoaded && subscriptionsLoaded)">
      <div class="phase-loading">
        <img src="/img/phase-loading.gif" alt="" srcset="">
      </div>
      <!-- <spinner style="margin: 3em auto;"
                     :animation-duration="1000"
                     :size="60"
                     :color="'black'"
            /> -->
    </div>
  </ph-panel>
</template>

<script>
import { mapState } from 'vuex'
import { HalfCircleSpinner as Spinner } from 'epic-spinners'
import SubscriptionPlan from './subscription-plan'

export default {
  data() {
    return {
      plans: [],
      plansLoaded: false,
      subscriptions: [],
      subscriptionsLoaded: false,
      loading: false,
    }
  },
  computed: {
    ...mapState([
      'app',
    ]),
  },
  mounted: function () {
    this.getSubscriptionPlans()
    this.getSubscriptions()
  },
  methods: {
    async getSubscriptionPlans() {
      this.plansLoaded = false
      await axios.get('/api/account/subscription/plans').then(response => {
        this.plansLoaded = true
        this.plans = response.data
        console.log("subs plan", this.plans);
      })
    },
    async getSubscriptions() {
      this.subscriptionsLoaded = false
      await axios.get('/api/account/subscription/subscriptions').then(response => {
        this.subscriptionsLoaded = true
        this.subscriptions = response.data
        console.log("subssss", this.subscriptions);

      })
    },
    getSubscriptionForPlan(plan) {
      return _.find(this.subscriptions, { 'stripe_plan': this.toSnakeCase(plan.title) })
    },
    toSnakeCase(str) {
      return str &&
        str
          .match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g)
          .map(x => x.toLowerCase())
          .join('_')
    },
    subscribe() {
      // console.log(this.app.user.stripe_account_id);
      this.loading = true
      axios.get('/api/account/subscription/plan/subscribe').then(response => {
        this.loading = false
        if (response.data.success) {
          window.location.href = response.data.subscription;

          // this.localSubscription = response.data.subscription
          // Vue.notify({
          //   group: 'main',
          //   type: 'success',
          //   title: '<img src="/img/confirm.gif" alt="success" width="60%">',
          // })
        } else {
          Vue.notify({
            group: 'main',
            type: 'error',
            title: response.data.message,
          })
        }
      }).finally(response => {
        this.loading = false
      })
    },
  },
  components: {
    Spinner,
    SubscriptionPlan,
  },
}
</script>

<style lang="scss" scoped>
h2{
  margin-bottom: 20px;
  font-size: 24px;
  padding-bottom: 5px;
  border-bottom: 1px solid #30f;
}
p {
  margin: 10px 0;
}

.no-subscription-block {
  display: flex;
  justify-content: space-between;
  padding: 20px 0px;
  background: #fff;
  font-weight: 600;
  border-radius: 5px;
  align-items: center;
}

.no-subscription-label {
  margin: 0px 10px !important;
}

.trial-button {
  margin-right: 10px;
}
</style>
