<template>
    <modal name="modal-downgrade" width="500px" height="auto" scrollable adaptive>
        <div class="modal modal-downgrade">
            <div class="modal-header">
                <close-icon class="float-right" @click.native="$modal.hide('modal-downgrade')"></close-icon>
            </div>
            <div class="modal-content">
                <h2>Downgrade Account</h2>
                <p>
                    After downgrade all of your music will be withdrawn from sale.Are you sure you want to downgrade to standard ?.
                </p>
                    
                <div class="save-button">
                    <ph-button size="large" @click.native="downgradeConfirmAccount" :loading="submitting">Delete</ph-button>
                    <ph-button size="large" @click.native="$modal.hide('modal-downgrade')" >Cancel</ph-button>
                </div>
            </div>
        </div>
    </modal>
</template>

<script>
    import { mapState } from 'vuex';
    import CloseIcon from 'global/close-icon';
    export default {
        data () {
            return {
                submitting: false,
                response: null,
            }
        },
        created: function() {

        },
        mounted: function() {

        },
        computed: {
            ...mapState([
                'app'
            ])
        },
        methods: {
            downgradeConfirmAccount() {
                    axios.post('/api/account/downgrade', {user_id: this.app.user})
                    .then(response => {
                        this.$store.commit('app/setUser', response.data)
                        this.$notify({
                            group: 'main',
                            type: 'success',
                            title: 'Successfully downgrade account',
                        });
                        this.downgrading = false;
                    }).finally(()=>location.reload())
            }
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
    .save-button {
        margin-top: 1em;
        text-align: center;
    }
    .error-msg {
        font-size: 70%;
        color: red;
    }
</style>