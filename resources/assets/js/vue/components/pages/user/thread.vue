<template>
    <div class="page-content-padded" style="padding: 0px;height: auto;">
        <!-- <aside class="sidebar-left">
            <sidebar-group title="Notifications" :view-all="true" :items="[]"></sidebar-group>
        </aside> -->

        <div class="page-main single-thread-page">
            <div class="thread-messages" id="messages">
                <div class="thread-message-row" v-for="message in currentThread.messages" :key="message.id">
                    <div class="thread-message" :class="didSendMessage(message)">
                        <div class="message-avatar">
                            <avatar :src="getMessageSender(message, 'avatar')" :size="40" />
                        </div>
                        <div class="message-body" :class="unreadMessage(message.views[0].view)">
                            {{ message.body }}
                        </div>

                        <div class="actions" v-if="didSendMessage(message) == 'mine'">
                            <div class="action">
                                <delete-button :deleteable="message"></delete-button>
                            </div>
                        </div>
                        <div class="message-time">
                            <small>{{ moment(message.date).calendar() }}</small>
                        </div>
                    </div>
                </div>

                <!-- <div class="thread-message-row">
                    <div class="thread-message" :class="`not-mine`">
                        <div class="message-avatar">
                            <avatar :src="getMessageSender(currentThread.messages[0], 'avatar')" :size="40" />
                        </div>
                        <div class="message-body">
                            <p>testing divv,mnsadjnaskd</p>
                        </div>
                        <div class="message-time">
                            <small>12/12/12</small>
                        </div>
                        <div class="actions">
                            <div class="action">
                                <delete-button :deleteable="currentThread.messages[0]"></delete-button>
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>
            <div class="thread-respond">
                <add-text type="message" @keydown.enter.prevent :thread="currentThread"
                    @success="appendNewMessage($event)" style="margin-bottom: 0rem;"></add-text>
            </div>
        </div>

        <!-- <aside class="sidebar-right">
            <sidebar-group title="Followed" :view-all="true" :items="[]"></sidebar-group>
            <sidebar-group title="Favourites" :view-all="true" :items="[]"></sidebar-group>
        </aside> -->
    </div>
</template>

<script>
import DeleteButton from 'global/actions/delete-button';
import SidebarGroup from 'global/sidebar-group';
import { mapActions, mapState } from 'vuex';
import store from 'store';
import AddText from 'global/add-text/add-text';
import { MessageEvents } from '../../../event-bus';

export default {
    components: { SidebarGroup, AddText, DeleteButton },

    computed: {
        ...mapState('messenger', [
            'currentThread',
            'unreadThreads',
            'threads',
        ]),

        ...mapState([
            'app',
            'user'
        ])
    },
    data() {
        return {
            moment: window.moment,
        }
    },
    mounted() {
        MessageEvents.$on('newMessage', (data) => { this.appendNewMessage(data) });
    },

    created() {
        const id = this.$route.params.threadid;
        this.getCurrentThread(id);
        this.markMessageRead(id);


        MessageEvents.$on("message-removed", () => {
            this.getCurrentThread(id);

            this.$notify({
                group: "main",
                type: "success",
                title: "Message removed",
            });
            return true;
        });

        if (!this.app.user.loggedin) {
            this.$router.push({ path: '/login' });
        }
    },

    watch: {
        currentThread: {
            handler(value) {
                const id = this.$route.params.threadid;
                this.markMessageRead(id);
                setTimeout(() => this.scrollToLatest(), 0)
            },

            deep: true
        },
        '$route.params.threadid': function (id) {
            store.dispatch('messenger/getCurrentThread', id).then(() => {
                // setTimeout(() => this.scrollToLatest(), 0)
            });

        }
    },
    methods: {
        ...mapActions('messenger', [
            'getCurrentThread',
            'markMessageRead'
        ]),

        getMessageSender(message, field = null) {
            const users = this.currentThread.users;

            const user = users.filter(user => {

                return user.id === message.sender;
            });

            const result = user.shift();

            if (field) return result[field];
            return result;
        },

        didSendMessage(message) {
            const sender = this.getMessageSender(message);
            return sender.id === this.app.user.id ? 'mine' : 'not-mine';
        },
        unreadMessage(value) {

            console.log(value);
            return value ? '' : 'boldText';
        },

        scrollToLatest() {
            const wrapper = document.getElementById('messages');
            wrapper.scrollTo({ top: wrapper.scrollHeight, behavior: 'smooth' });
            // wrapper.scrollTop = wrapper.scrollHeight;
        },

        appendNewMessage(event) {
            this.currentThread.messages.push(event);
            // this.messages.push({
            //         body:this.message,
            //         date:new Date(),
            //         sender:this.app.user.id
            //     })
        }
    }
}
</script>

<style lang="scss" scoped>
@import "~styles/helpers/_variables.scss";

.single-thread-page {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.otheruser-data {
    display: flex;
    align-items: center;
    margin-bottom: 1em;

    h1 {
        margin: 0 0 0 0.5em;
    }
}

.user-messages-container {
    margin: 3em 0;
}

.thread-messages {
    overflow-y: scroll;
    flex: 1;
    max-height: 70vh;
    padding-right: 10px;
    //box-shadow: 0 -5px 5px -5px #333;

    /*
        &::-webkit-scrollbar {
            appearance: none;
            width: 7px;
            max-width: 7px;
            height: 100%;
        }
        &::-webkit-scrollbar-track {
            background: $color-grey;
        }
        */
    &::-webkit-scrollbar-thumb {
        background: $color-2;
    }
}

.thread-message-row {
    width: 100%;
    overflow: auto;
    margin: 1em 0;
}

.thread-message {
    display: flex;
    justify-content: space-between;
    max-width: 80%;
    padding: 1em;
    border-radius: 20px;
    text-align: right;

    &.mine {
        float: right;

        background: $color-grey;

        .message-avatar {
            order: 2;
            margin-left: 1em;
        }

        .message-body {
            order: 1;
        }
    }

    &.not-mine {
        float: left;
        text-align: left;
        border: 1px solid $color-grey;

        .message-avatar {
            margin-right: 1em;
        }
    }
}

.message-body {
    text-align: justify;
    line-height: 130%;
}

.message-time {
    line-height: 30px;
    font-size: 9px;
    color: #a5a5a5;
    min-width: 105px
}

.mine .message-time {
    float: left;
    position: relative;
    left: -15px;
    top: -16px;
}

.not-mine .message-time {
    // float: right;
    position: relative;
    right: -15px;
    top: -16px;
}

.actions {
    // width: 30%;
    font-size: 11px;
    font-weight: bold;

    display: flex;
    align-items: center;
    justify-content: flex-start;

    .action {
        padding: 0 8px 0 0;
    }
}

.boldText {
    font-weight: bold;
}
</style>
