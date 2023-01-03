<template>
    <modal name="modal-downgrade" width="500px" height="auto" scrollable adaptive>
        <div class="modal modal-downgrade">
            <div class="modal-header">
                <close-icon class="float-right" @click.native="$modal.hide('modal-downgrade')"></close-icon>
            </div>
            <div class="modal-content">
                <div v-if="downgradeConfirm" class="timePeriodBlock">
                    {{ this.subscriptionLeftPeriod() }}
                </div>
                <div v-else="downgradeConfirm">
                    <h2>Downgrade Account</h2>
                    <p>
                        Are you sure you want to downgrade to a Standard account? you account will remain the same until
                        your paid period expires, you will then automatically be downgraded, any current membership
                        benefits
                        will be lost any music will be withdrawn from sale.
                    </p>

                    <div class="save-button">
                        <ph-button size="large" @click.native="downgradeConfirmAccount"
                            :loading="submitting">Downgrade</ph-button>
                        <ph-button size="large" @click.native="$modal.hide('modal-downgrade')">Cancel</ph-button>
                    </div>
                </div>

            </div>
        </div>
    </modal>
</template>

<script>
import { mapState } from 'vuex';
import CloseIcon from 'global/close-icon';
export default {
    data() {
        return {
            downgradeConfirm: false,
            submitting: false,
            response: null,
            subscriptions: [],
            subscriptionsLoaded: false,
        }
    },
    created: function () {

    },
    mounted: function () {
        this.getSubscriptions()
    },
    computed: {
        ...mapState([
            'app'
        ])
    },
    methods: {
        downgradeConfirmAccount() {
            this.submitting = true;
            axios.post('/api/account/downgrade', { user_id: this.app.user })
                .then(response => {
                    this.$store.commit('app/setUser', response.data)
                    this.$notify({
                        group: 'main',
                        type: 'success',
                        title: 'Successfully downgrade account',
                    });
                    this.submitting = false;
                }).finally(() => {
                    this.downgradeConfirm = true;
                    setInterval(() => {
                        location.reload()
                    }, 10000);
                })
        },
        subscriptionLeftPeriod: function () {
            return `Your remaining subscription time period ${moment(this.subscriptions.created_at).add(29, 'd').diff(moment(), 'days')} days, and you will be automatically downgrade on ${moment(this.subscriptions.created_at).add(1, 'M').format('DD/MM/YYYY')}.`
        },
        async getSubscriptions() {
            this.subscriptionsLoaded = false
            await axios.get('/api/account/subscription/subscriptions').then(response => {
                this.subscriptionsLoaded = true
                this.subscriptions = response.data
                console.log("subs downgrade....", this.subscriptions);

            })
        },
    },
    components: {
        CloseIcon,
    }
}
</script>

<style lang="scss" scoped>
@import "~styles/helpers/_variables.scss";

h2 {
    margin-bottom: 0;
}

p {
    margin: 1em 0;
}

textarea {
    box-sizing: border-box;
    border: 1px solid $color-grey2;
    padding: 5px;
    width: 100%;
    height: 50px;
}

.timePeriodBlock {
    padding-top: 2em;
}

.save-button {
    margin-top: 1em;
    text-align: center;
}

.error-msg {
    font-size: 70%;
    color: red;
}
</style>