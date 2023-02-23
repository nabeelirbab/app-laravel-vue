<template>
    <div>
        <h6>Users: {{ users.length }} Results</h6>
        <ul class="list" v-if="users.length">
            <li v-for="(result, index) in users" class="item">
                <artist-tile :user="result" :size="150" />
            </li>
        </ul>
        <a href="#" @click="userLoad" class="searchLoadMore" v-if="counts.user > pages.user">Load more</a>
        <!-- <span style="color: red;" v-else>No users found in this search!</span> -->

        <h6>Releases: {{ releases.length }} Results</h6>
        <ul class="list" v-if="releases.length">
            <li v-for="(result, index) in releases" class="item" style="margin-right: 10px;">
                <release-tile :release="result" :size="150"></release-tile>
            </li>
        </ul>
        <a href="#" class="searchLoadMore" @click="releaseLoad" v-if="counts.release > pages.release">Load more</a>
        <!-- <span style="color: red;" v-else>No releases found in this search!</span> -->


        <h6>Tracks: {{ tracks.length }} Results</h6>
        <ul class="list" v-if="tracks.length">
            <li v-for="(result, index) in tracks" class="item">
                <track-tile :track="result" :size="150"></track-tile>
            </li>
        </ul>
        <a href="#" @click="trackLoad" class="searchLoadMore" v-if="counts.track > pages.track">Load more</a>
        <!-- <span style="color: red;" v-else>No tracks found in this search!</span> -->

    </div>
    <!-- <div>
        <release-tile
            :release="result"
            :size="150"
            v-if="result.type === 'release'"
        ></release-tile>
        <track-tile
            :track="result"
            :size="150"
            v-if="result.type === 'track'"
        ></track-tile>
        <artist-tile :user="result" :size="150" v-if="result.type === 'user'" />
        <h6>Users:</h6>
        <artist-tile :user="user" :key="index" :size="150" v-for="(user, index) in users" v-if="users.length" />
        <h6>Releases:</h6>
        <release-tile :release="release" :key="index" :size="150" v-for="(release, index) in releases"
            v-if="releases.length"></release-tile>
    </div> -->
</template>

<script>
import ReleaseTile from "global/releases/release-tile";
import TrackTile from "global/releases/track-tile";
import ArtistTile from "global/artists/artist-tile";
export default {
    props: ["users", "releases", "tracks", "counts", "pages"],
    components: {
        ReleaseTile,
        TrackTile,
        ArtistTile,
    },
    methods: {
        userLoad() {
            this.$emit("handleUserLoad");
        },
        releaseLoad() {
            this.$emit("handleReleaseLoad");

        },
        trackLoad() {
            this.$emit("handleTrackLoad");

        }
    },
};
</script>

<style scoped>
h6 {
    border-bottom: 2px solid #3300ff;
    padding-bottom: 10px;
}

.searchLoadMore{
   color: #3300ff; 
   font-size: 14px;
}

.list {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
}

.list li {
    margin-left: 10px;
    width: 150px;
}
</style>
