<template>
    <div>
        <h6>Users: {{ users.length }} Results</h6>
        <ul class="list" v-if="users.length">
            <li v-for="(result, index) in users" class="item">
                <artist-tile :user="result" :size="150" />
            </li>
            <li class="load-more-icon">
                <button class="btn" @click="userLoad" v-if="counts.user > pages.user" v-show="!loadingUserMore">Load
                    More</button>
            </li>
            <!-- <li class="load-more-icon">
                <i class="fa fa-plus-circle"></i>
            </li>
            <li class="load-more-spinner" >
                <i class="fas fa-spinner fa-pulse"></i>
            </li> -->
        </ul>
        <spinner style="margin: 2em auto" v-show="loadingUserMore" :animation-duration="1000" :size="60" color="black" />

        <!-- <span style="color: red;" v-else>No users found in this search!</span> -->

        <h6>Releases: {{ releases.length }} Results</h6>
        <ul class="list" v-if="releases.length">
            <li v-for="(result, index) in releases" class="item">
                <release-tile :release="result" :size="150"></release-tile>
            </li>
            <li class="load-more-icon">
                <button class="btn" @click="releaseLoad" v-if="counts.release > pages.release"
                    v-show="!loadingReleaseMore">Load
                    More</button>
            </li>
            <!-- <li class="load-more-icon" @click="releaseLoad" v-if="counts.release > pages.release"
                v-show="!loadingReleaseMore">
                <i class="fa fa-plus-circle"></i>
            </li>
            <li class="load-more-spinner" v-show="loadingReleaseMore">
                <i class="fas fa-spinner fa-pulse"></i>
            </li> -->
        </ul>
        <spinner style="margin: 2em auto" v-show="loadingReleaseMore" :animation-duration="1000" :size="60" color="black" />

        <!-- <span style="color: red;" v-else>No releases found in this search!</span> -->


        <h6>Tracks: {{ tracks.length }} Results</h6>
        <ul class="list" v-if="tracks.length">
            <li v-for="(result, index) in tracks" class="item">
                <track-tile :track="result" :size="150"></track-tile>
            </li>
            <li class="load-more-icon">
                <button class="btn" @click="trackLoad" v-if="counts.track > pages.track" v-show="!loadingTrackMore">Load
                    More</button>
            </li>
            <!-- <li class="load-more-icon" @click="trackLoad" v-if="counts.track > pages.track" v-show="!loadingTrackMore">
                <i class="fa fa-plus-circle"></i>
            </li>
            <li class="load-more-spinner" v-show="loadingTrackMore">
                <i class="fas fa-spinner fa-pulse"></i>
            </li> -->
        </ul>
        <spinner style="margin: 2em auto" v-show="loadingTrackMore" :animation-duration="1000" :size="60" color="black" />

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
import { HalfCircleSpinner as Spinner } from "epic-spinners";

export default {
    props: ["users", "releases", "tracks", "counts", "pages", "loadingUserMore", "loadingReleaseMore", "loadingTrackMore"],
    components: {
        Spinner,
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
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Koulen&family=Lato&family=Nunito&family=Playfair+Display:ital@1&family=Prata&family=Raleway:ital,wght@1,100&family=Roboto&family=Roboto+Condensed&family=Teko&display=swap');

.btn {

    font-family: "Comfortaa", cursive;
    font-weight: 400;
    font-size: 13px;
    color: #292626;
    background-color: #f2f2f2;
    padding: 7px 16px;
    border: solid #0000ff 2px;
    box-shadow: rgb(0, 0, 0) 0px 0px 0px 0px;
    border-radius: 10px;
    transition: 225ms;
    transform: translateY(0);
    display: flex;
    flex-direction: row;
    align-items: center;
    cursor: pointer;
    margin: auto;
}

.btn:hover {

    transition: 225ms;
    padding: 10px 21px;
    transform: translateY(-0px);
    background-color: #e3dede;
    color: #292626;
    border: solid 2px #0066cc;
}

h6 {
    border-bottom: 2px solid #3300ff;
    padding-bottom: 10px;
}

.load-more-icon {
    margin: auto;
    /* padding: 5px;
    color: #0000ff;
    font-size: 20px;
    cursor: pointer; */
}

.load-more-spinner {
    margin: auto 0;
    padding: 5px;
    color: #0000ff;
    font-size: 20px;
}

.list {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
}

.list .item {
    margin-left: 10px;
    margin-bottom: 10px;
    width: 150px;
}
</style>
