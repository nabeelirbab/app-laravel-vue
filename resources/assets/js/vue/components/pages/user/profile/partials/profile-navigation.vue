<template>
    <nav class="sub-nav">
        <ul>
            <li><router-link :to="{ name: 'profile_all' }" @click.native="changeRoute">All</router-link></li>
            <li><router-link :to="{ name: 'profile_music' }" @click.native="changeRoute">Music</router-link></li>
            <li ><router-link :to="{ name: 'profile_events' }" @click.native="changeRoute">Events</router-link></li>
            <li><router-link :to="{ name: 'profile_videos' }" @click.native="changeRoute">Videos</router-link></li>
            <li ><router-link :to="{ name: 'profile_merch' }" @click.native="changeRoute">Merch</router-link></li>
            <li><router-link :to="{ name: 'profile_posts' }" @click.native="changeRoute">Posts</router-link></li>
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
        changeRoute() {
            this.$router.go(0);
        },
        
    },
}
</script>