<template>
    <ph-panel id="manage">
        <div class="col-header flex justify-between align-item-center">
            <h2>Account</h2>
            <div class="btn-box">
                <ph-button v-if="app.user.roles[0].name === 'artist' || app.user.roles[0].name === 'pro'" style="
                    margin-bottom: 5px;" size="medium" @click.native="downgradeAccount" :loading="downgrading">
                    Downgrade to Standard
                </ph-button>
                <ph-button v-if="app.user.roles[0].name === 'pro'" style="margin-bottom: 5px;" size="medium"
                    @click.native="downgradeToArtist" :loading="downgrading">
                    Downgrade to Artist
                </ph-button>
                <ph-button v-if="app.user.roles[0].name === 'standard'" style="margin-bottom: 5px;" size="medium"
                    @click.native="openVerificationModal" :loading="upgrading">
                    Upgrade to Artist
                </ph-button>
                <ph-button size="deactive" class="deactive-btn" @click.native="deactivateAccount">
                    Deactivate
                </ph-button>
                <ph-button style="margin-bottom: 5px;" size="delete" class="del-btn" @click.native="deleteAccount">
                    Delete
                </ph-button>
            </div>
        </div>
        <!-- <hr> -->
        <!-- <div>
            <h3 class="account-type">Account Type - {{ app.user.account_type }}</h3>
        </div> -->
        <!-- <p>
            Deactivate or delete your account permanently.
        </p> -->
        <div class="account-setting">
            <div class="membership">
                <div class="title-block">
                    <h4>Membership</h4>
                </div>
                <div class="status-setting">
                    <div class="account-status">
                        <div>
                            <span v-if="app.user.roles[0].name === 'standard'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 30 30" fill="none">
                                    <path d="M15 30C18.9782 30 22.7936 28.4196 25.6066 25.6066C28.4196 22.7936 30 18.9782 30 15C30 11.0218 28.4196 7.20644 25.6066 4.3934C22.7936 1.58035 18.9782 0 15 0C11.0218 0 7.20644 1.58035 4.3934 4.3934C1.58035 7.20644 0 11.0218 0 15C0 18.9782 1.58035 22.7936 4.3934 25.6066C7.20644 28.4196 11.0218 30 15 30ZM21.6211 12.2461L14.1211 19.7461C13.5703 20.2969 12.6797 20.2969 12.1348 19.7461L8.38477 15.9961C7.83398 15.4453 7.83398 14.5547 8.38477 14.0098C8.93555 13.4648 9.82617 13.459 10.3711 14.0098L13.125 16.7637L19.6289 10.2539C20.1797 9.70312 21.0703 9.70312 21.6152 10.2539C22.1602 10.8047 22.166 11.6953 21.6152 12.2402L21.6211 12.2461Z" fill="#1AB130"/>
                                </svg>
                            </span>
                            <span v-if="app.user.roles[0].name !== 'standard'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 32 32" fill="none">
                                    <circle cx="16" cy="16" r="15.5" stroke="#3523FB"/>
                                </svg>
                            </span>
                            <span>Standard</span>
                        </div>
                        <ph-button size="deactive" @click.native="openVerificationModal" :loading="upgrading">Downgrade</ph-button>
                    </div>
                    <div class="account-status">
                        <div>
                            <span v-if="app.user.roles[0].name === 'admin'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 30 30" fill="none">
                                    <path d="M15 30C18.9782 30 22.7936 28.4196 25.6066 25.6066C28.4196 22.7936 30 18.9782 30 15C30 11.0218 28.4196 7.20644 25.6066 4.3934C22.7936 1.58035 18.9782 0 15 0C11.0218 0 7.20644 1.58035 4.3934 4.3934C1.58035 7.20644 0 11.0218 0 15C0 18.9782 1.58035 22.7936 4.3934 25.6066C7.20644 28.4196 11.0218 30 15 30ZM21.6211 12.2461L14.1211 19.7461C13.5703 20.2969 12.6797 20.2969 12.1348 19.7461L8.38477 15.9961C7.83398 15.4453 7.83398 14.5547 8.38477 14.0098C8.93555 13.4648 9.82617 13.459 10.3711 14.0098L13.125 16.7637L19.6289 10.2539C20.1797 9.70312 21.0703 9.70312 21.6152 10.2539C22.1602 10.8047 22.166 11.6953 21.6152 12.2402L21.6211 12.2461Z" fill="#1AB130"/>
                                </svg>
                            </span>
                            <span v-if="app.user.roles[0].name !== 'admin'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 32 32" fill="none">
                                    <circle cx="16" cy="16" r="15.5" stroke="#3523FB"/>
                                </svg>
                            </span>
                            <span>Artist</span>
                        </div>
                        <ph-button size="deactive"  @click.native="downgradeAccount" :loading="downgrading">Downgrade</ph-button>
                    </div>
                    <div class="account-status">
                        <div>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 30 30" fill="none">
                                    <rect width="30" height="30" fill="url(#pattern0)"/>
                                    <defs>
                                        <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                            <use xlink:href="#image0_207_1419" transform="scale(0.0111111)"/>
                                        </pattern>
                                        <image id="image0_207_1419" width="90" height="90" xlink:href="data:image/png;base64,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"/>
                                    </defs>
                                </svg>
                            </span>
                            <span>Artist PRO <span class="pro-badge">PRO</span></span>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="border-line"></div> 
            <div class="membership">
                <div class="title-block">
                    <h4>Membership Payment Method</h4>
                </div>
                
                <existing-card-account :card="card" :account="'member'" :actions="true" @handleRemove="handleRemove" />
                <p>

                <subscription-plan v-for="subscription in subscriptions" v-if="plansLoaded && subscriptionsLoaded"
                                :subscription="subscription" :plan="subscription.stripe_plan == 'Artist Pro EU' ? plans[0] : plans[1]"
                                :key="subscription.id" />
                </p>

                <div class="no-subscription-block" v-if="subscriptionsLoaded && subscriptions.length == 0">
                <p class="no-subscription-label">Not subscribed, free 30 days trail available.</p>
                <ph-button size="medium" @click.native="subscribe" :loading="loading" class="trial-button">
                    Start Trial
                </ph-button>
                </div>
            </div>
        </div>


        <delete-modal></delete-modal>
        <deactivate-modal></deactivate-modal>
        <downgrade-modal></downgrade-modal>
        <downgrade-to-artist-modal></downgrade-to-artist-modal>
        <modal name="modal-account-reg-form" @before-open="beforeOpen" @closed="closed" width="80%" height="auto" scrollable
            style="padding: 10px 35px;display: table-cell;">
            <div class="modal modal-account-reg-form">
                <div class="modal-header">
                    <close-icon class="float-right" @click.native="closeManageModals()"></close-icon>
                    <logo class="modal-logo centered-block" style="width: 185px;" />
                </div>
                <div class="modal-content full-width" v-if="!submitted" style="padding: 10px 35px;">

                    <connect-details :user="app.user" v-if="step === 2" @next-step="step++"
                        @finished="submitted = true"></connect-details>
                    <verification-details :user="app.user" v-if="step === 3"
                        @finished="upgradeAccount"></verification-details>
                </div>
            </div>
        </modal>
    </ph-panel>
</template>

<script>
import CloseIcon from '../../../global/close-icon';
import DeleteModal from './../../../modals/delete';
import DowngradeModal from './../../../modals/downgrade-confirm';
import DowngradeArtistModal from './../../../modals/downgrade-to-artist-confirm';
import DeactivateModal from './../../../modals/deactivate';
import ConnectDetails from './connect-details';
import VerificationDetails from './verification-details';
import ExistingCardAccount from '../../../global/existing-card-account';
import Subscriptions from "./subscriptions/subscriptions";
import SubscriptionPlan from '../account/subscriptions/subscription-plan'
import { mapState } from "vuex";

export default {
    data() {
        return {
            step: 1,
            upgrading: false,
            downgrading: false,
            submitted: false,
            card: null,
            plans: [],
            plansLoaded: false,
            subscriptions: [],
            subscriptionsLoaded: false,
            loading: false,
        }
    },
    computed: {
        ...mapState([
            'app'
        ])
    },
    mounted: function () {
        this.getPaymentMethod();
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
        getPaymentMethod() {
      axios.get('/api/account/billing/method')
        .then(response => {
          this.card = response.data.payment_method
          console.log("billing card", this.card);
        })
        },
        handleRemove() {
        this.card = null
        },
        beforeOpen() {

        },
        closed() {
            if (this.upgrading) {
                this.upgrading = false;
            }
            if (this.downgrading) {
                this.downgrading = false;
            }
        },
        closeManageModals() {
            this.$modal.hide('modal-account-reg-form');
            if (this.upgrading) {
                this.upgrading = false;
            }
            if (this.downgrading) {
                this.downgrading = false;
            }
        },
        deactivateAccount() {
            this.$modal.show('modal-deactivate');
        },
        deleteAccount() {
            this.$modal.show('modal-delete');
        },
        openVerificationModal() {
            this.step = 2;
            this.$modal.show("modal-account-reg-form");
            this.upgrading = true;
        },
        upgradeAccount() {
            this.submitted = true;
            this.$modal.hide("modal-account-reg-form");
            axios.post('/api/account/upgrade', { user_id: this.app.user })
                .then(response => {
                    this.$store.commit('app/setUser', response.data)
                    this.$notify({
                        group: 'main',
                        type: 'success',
                        title: '<img src="/img/confirm.gif" alt="success" width="60%">',
                    });
                    this.upgrading = false;

                }).finally(() => location.reload())
        },
        downgradeAccount() {
            this.$modal.show('modal-downgrade');
            // if (this.app.user.roles[0].name != 'artist') {
            //     this.$modal.show('modal-downgrade');
            // } else {
            //     this.downgrading = true
            //     axios.post('/api/account/downgrade', {user_id: this.app.user})
            //         .then(response => {
            //             this.$store.commit('app/setUser', response.data)
            //             this.$notify({
            //                 group: 'main',
            //                 type: 'success',
            //                 title: 'Successfully downgrade account',
            //             });
            //             this.downgrading = false;
            //         }).finally(()=>location.reload())
            // }

        },
        downgradeToArtist() {
            this.$modal.show('modal-to-artist-downgrade');
        }
    },
    components: {
        'delete-modal': DeleteModal,
        'downgrade-modal': DowngradeModal,
        'downgrade-to-artist-modal': DowngradeArtistModal,
        'deactivate-modal': DeactivateModal,
        'connect-details': ConnectDetails,
        'verification-details': VerificationDetails,
        'close-icon': CloseIcon,
        'existing-card-account': ExistingCardAccount,
        'subscriptions': Subscriptions,
        'subscription-plan': SubscriptionPlan,
    }
}
</script>

<style lang="scss" scoped>
.border-line{
    width: 1px;
    background: #30f;
    margin-top: -10px;
}
p {
    margin: 10px 0;
}
.button.medium{
    border-radius: 6px !important;
}
.account-type {
    margin: 20px 0;
    font-weight: bold;
    text-transform: capitalize;
}
.col-header{
    border-bottom: 1px solid #30f;
    padding-bottom: 4px;
    margin-bottom: 20px;
    h2{
        margin-bottom: 0;
        font-size: 24px;
    }
}
.deactive-btn button{
    border-radius: 6px;
    color: #555756;
    font-size: 15px;
    
}
.del-btn button{
    border-radius: 6px;
    color: #AE1803;
    font-size: 15px;
}
.account-setting{
    display: flex;
    justify-content: space-between;
}
.membership{
    background-color: #fff;
    padding: 20px;
    width: 45.5%;
}
.title-block{
    display: flex;
    justify-content: center;
}
.title-block h4 {
    font-size: 18px;
    font-weight: 700;
    text-transform: uppercase;
    border-bottom: 1px solid #3300ff;
}
.status-setting{
    width: 80%;
}
.account-status{
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    align-items: center;
}
.account-status span{
    position: relative
}
.pro-badge{
    border-radius: 10px;
    border: 1px solid #3523FB;
    background: #3523FB;
    position: absolute;
    font-size: 8px;
    padding: 2px 4px;
    color: white;
    line-height: 8px;
    top: -10px;
    line-height: 8px;
    left: -5px;
}
</style>
