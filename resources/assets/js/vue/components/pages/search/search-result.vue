<template>
    <div>
        <h6>Users:</h6>
        <ul class="list" v-if="users.length">
            <li v-for="(result, index) in users" class="item" >
                <artist-tile :user="result" :size="150"  />
            </li>
        </ul>
        <span style="color: red;" v-else>No users found in this search!</span>

        <h6>Releases:</h6>
        <ul class="list" v-if="releases.length">
            <li v-for="(result, index) in releases" class="item" style="margin-right: 10px;">
                <release-tile :release="result" :size="150" ></release-tile>
            </li>
        </ul>
        <span style="color: red;" v-else>No releases found in this search!</span>


        <h6>Tracks:</h6>
        <ul class="list" v-if="tracks.length">
            <li v-for="(result, index) in tracks" class="item">
                <track-tile :track="result" :size="150" ></track-tile>
            </li>
        </ul>
        <span style="color: red;" v-else>No tracks found in this search!</span>

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
    props: ["users", "releases", "tracks"],
    components: {
        ReleaseTile,
        TrackTile,
        ArtistTile,
    }
};
</script>

<style>
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
