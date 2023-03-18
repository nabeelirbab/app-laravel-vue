<template>
    <router-link class="track-tile" :to="getRouterObject(track)">
        <div v-if="track.release" class="track-tile-image">
            <avatar :tile="true" :size="size" :src="track.release.image.files.medium.url" :recent="track.is_recent">
            </avatar>
        </div>
        <div class="track-tile-text">
            {{ track.name }}
        </div>
        <small class="track-artist-name">{{ track.artist.name }}</small>
    </router-link>
</template>

<script>
import Avatar from 'global/avatar';
export default {
    props: {
        size: Number,
        track: Object,
    },
    data() {
        return {

        }
    },
    created: function () {

    },
    components: {
        Avatar
    }
}
</script>

<style lang="scss" scoped>
.track-tile {
    text-decoration: none;
}

.track-tile-text {
    text-align: left;
    font-size: 12px;
    margin-top: 10px;
    margin-bottom: 5px;
    font-weight: bold;
}

.track-artist-name {
    font-size: 11px;
}
</style>