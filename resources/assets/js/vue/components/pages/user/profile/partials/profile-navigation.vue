<template>
    <nav class="sub-nav">
        <ul>
            <li><router-link :to="{ name: 'profile_all' }" @click.native="changeRoute('profile_all')">All</router-link></li>
            <li><router-link :to="{ name: 'profile_music' }" @click.native="changeRoute('profile_music')">Music</router-link></li>
            <li ><router-link :to="{ name: 'profile_events' }" @click.native="changeRoute('profile_events')">Events</router-link></li>
            <li><router-link :to="{ name: 'profile_videos' }" @click.native="changeRoute('profile_videos')">Videos</router-link></li>
            <li ><router-link :to="{ name: 'profile_merch' }" @click.native="changeRoute('profile_merch')">Merch</router-link></li>
            <li><router-link :to="{ name: 'profile_posts' }" @click.native="changeRoute('profile_posts')">Posts</router-link></li>
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
     methods: {
        changeRoute(pathname) {
            //this.$router.push({ path: pathname });
            this.$emit("linkclick");
        },
        
    },
}
</script>