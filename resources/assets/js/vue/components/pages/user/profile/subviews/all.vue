<template>
    <div>
        <add-text type="post" :addTextAble="user" @success="addStatusUpdate" />
        <feed-action
            v-for="(action, index) in activity"
            :index="index"
            :action="action"
            :this-user="mutableUser"
            :key="index"
            v-on:delete-action="fetchActivity"
        />
        <spinner
            style="margin: 3em auto;"
            :animation-duration="1000"
            :size="60"
            color="black"
            v-show="loadingActivity"
        />
        <div style="margin: 0 0 4em 0" class="centered-text" v-if="nextStart">
                <ph-button
                    ize="medium"
                    color="blue2"
                    :loading="loadingNextPage"
                    @click.native="loadNextPage"
                >Load More</ph-button>
        </div>
        
    </div>
</template>

<script>
    import ProfileMixin from '../profile-mixin';
    import AddText from 'global/add-text/add-text';
    import FeedAction from '../partials/feed-action';

    import { HalfCircleSpinner as Spinner } from 'epic-spinners';
    import {SocialEvents} from "../../../../../event-bus";

    export default {
        data () {
            return {
                nextStart: false,
                loadingNextPage: false
            }
        },
        created: function() {
            this.fetchActivity();
            SocialEvents.$on('delete-action', this.fetchActivity)
        },
        methods: {
            addStatusUpdate(action) {
                this.activity.unshift(action)
            },

            loadNextPage() {
                //this.loadingNextPage = true; 
                this.fetchActivity(this.nextStart);
            }
        },
        mixins: [
            ProfileMixin
        ],
        components: {
            FeedAction,
            AddText,
            Spinner
        }
    }
</script>

<style lang="scss" scoped>

</style>
