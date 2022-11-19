<template>
    <div>
        <all v-if="path == 'profile_all'" />
        <events v-if="path == 'profile_events'" />
        <merch v-if="path == 'profile_merch'" />
        <music v-if="path == 'profile_music'" />
        <posts v-if="path == 'profile_posts'" />
        <releases v-if="path == 'profile_releases'" />
        <videos v-if="path == 'profile_videos'" />
    </div>
</template>

<script>
    import All from "./all";
    import Events from "./events";
    import Merch from "./merch";
    import Music from "./music";
    import Posts from "./posts";
    import Releases from "./releases";
    import Videos from "./videos";

    export default {
        props: {
          user: {
            type: Object,
          },
          path: {
            type: String,
            required: true
          }
        },
        components: {
            All,
            Events,
            Merch,
            Music,
            Posts,
            Releases,
            Videos
        }
    }
</script>

<style lang="scss" scoped>

</style>
