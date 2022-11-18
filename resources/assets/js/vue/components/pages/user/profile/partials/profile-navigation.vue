<template>
    <nav class="sub-nav">
        <ul>
            <li><a v-bind:class="[currentRouteName == 'profile_all' ? 'router-link-exact-active router-link-active' : '']"  @click="changeRoute('profile_all')">All</a></li>
            <li><a v-bind:class="[currentRouteName == 'profile_music' ? 'router-link-exact-active router-link-active' : '']" @click="changeRoute('profile_music')">Music</a></li>
            <li ><a v-bind:class="[currentRouteName == 'profile_events' ? 'router-link-exact-active router-link-active' : '']" @click="changeRoute('profile_events')">Events</a></li>
            <li><a  v-bind:class="[currentRouteName == 'profile_videos' ? 'router-link-exact-active router-link-active' : '']" @click="changeRoute('profile_videos')">Videos</a></li>
            <li ><a v-bind:class="[currentRouteName == 'profile_merch' ? 'router-link-exact-active router-link-active' : '']"  @click="changeRoute('profile_merch')">Merch</a></li>
            <li><a v-bind:class="[currentRouteName == 'profile_posts' ? 'router-link-exact-active router-link-active' : '']" @click="changeRoute('profile_posts')">Posts</a></li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        user: {
            type: Object,
            required: true,
        }
    },
    computed: {
        currentRouteName() {
            return this.$route.name;
        }
    },
    methods: {
        changeRoute(pathname) {
            //this.$router.push({ path: pathname });
            this.$emit("linkclick");
        },
        
    },
}
</script>