<template>
    <nav class="sub-nav">
        <ul v-if="app.user.roles[0].name === 'standard'">
            <li><a href="#"
                    v-bind:class="[routename == 'profile_all' ? 'router-link-exact-active router-link-active' : '']"
                    @click="changeRoute('profile_all')">Activity</a>&nbsp;|</li>
            <li><a href="#"
                    v-bind:class="[routename == 'profile_posts' ? 'router-link-exact-active router-link-active' : '']"
                    @click="changeRoute('profile_posts')">Posts</a></li>
        </ul>
        <ul v-else>
            <li><a href="#"
                    v-bind:class="[routename == 'profile_all' ? 'router-link-exact-active router-link-active' : '']"
                    @click="changeRoute('profile_all')">Activity</a>&nbsp;|</li>
            <li><a href="#"
                    v-bind:class="[routename == 'profile_music' ? 'router-link-exact-active router-link-active' : '']"
                    @click="changeRoute('profile_music')">Music</a></li>
            <li><a href="#"
                    v-bind:class="[routename == 'profile_events' ? 'router-link-exact-active router-link-active' : '']"
                    @click="changeRoute('profile_events')">Events</a></li>
            <li><a href="#"
                    v-bind:class="[routename == 'profile_videos' ? 'router-link-exact-active router-link-active' : '']"
                    @click="changeRoute('profile_videos')">Videos</a></li>
            <li><a href="#"
                    v-bind:class="[routename == 'profile_merch' ? 'router-link-exact-active router-link-active' : '']"
                    @click="changeRoute('profile_merch')">Merch</a></li>
            <li><a href="#"
                    v-bind:class="[routename == 'profile_posts' ? 'router-link-exact-active router-link-active' : '']"
                    @click="changeRoute('profile_posts')">Posts</a></li>
        </ul>
    </nav>
</template>

<script>
import { mapState } from 'vuex';
export default {
    data() {
        return {
            routename: this.$route.name
        };
    },
    props: {
        user: {
            type: Object,
            required: true,
        }
    },
    computed: {
        ...mapState(['app'])
    },
    methods: {
        changeRoute(pathname) {
            //this.$router.replace({ name: pathname });
            this.routename = pathname;
            this.$emit("linkclick", pathname);
        },

    },
}
</script>

<style>
.router-link-active {
    text-decoration-color: #9eefe1 !important;
}
</style>