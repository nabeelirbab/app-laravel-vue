<template>
    <div>
        <spinner style="margin: 3em auto;" :animation-duration="1000" :size="60" color="black" v-show="loadingEvents" />
        <div v-if="events.length">
            <item v-for="event in events" :item="event" :key="event.id" />
        </div>
        <div v-if="!events.length && !loadingEvents" class="not-found">
            <span class="not-found" v-if="!isShow">
                This user hasn't added any events yet.
            </span>
            <ph-button size="medium" style="display: block; text-align: center;" @click.native="showEventCreateModal()"
                v-else>Add Event</ph-button>
        </div>
    </div>
</template>

<script>
import ProfileMixin from '../profile-mixin';
import { HalfCircleSpinner as Spinner } from 'epic-spinners';
import Item from 'global/items/item';
import { ModalEvents } from '../../../../../event-bus';
import { mapState } from "vuex";

export default {
    data() {
        return {
            loadingEvents: false,
            events: [],
        }
    },
    computed: {
        isPro: function () {
            return (this.app.user.account_type === 'pro' || this.app.user.account_type === 'admin')
        },
        isShow: function () {
            return (this.app.user.id === this.user.id)
        },
        ...mapState([
            'app'
        ])
    },
    created: function () {
        this.fetchEvents();
        ModalEvents.$on('event-created', this.fetchEvents)
    },
    methods: {
        showEventCreateModal() {
            this.$modal.show('modal-create-event', { user: this.user });
        },
        fetchEvents() {
            this.loadingEvents = true;
            axios.get('/api/user/' + this.user.id + '/events').then(response => {
                this.events = response.data;
            }).finally(() => {
                this.loadingEvents = false;
            });
        }
    },
    mixins: [
        ProfileMixin
    ],
    components: {
        Item,
        Spinner
    }
}
</script>

<style lang="scss" scoped>
.not-found {
    text-align: center;
    margin-top: 10px;
    display: block;
}
</style>
