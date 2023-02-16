<template>
  <div class="search-view">
    <filter-container>
      <class-filter v-model="filters.classes" :single="true"></class-filter>
      <genre-filter v-model="filters.genres"></genre-filter>
      <key-filter v-model="filters.keys" :single="false"></key-filter>
      <div class="bpm-filter">
        <h2>BPM</h2>
        <p class="bpm-values">
          {{ filters.bpm[0] + " > " + filters.bpm[1] }}
        </p>
        <vue-slider v-model="filters.bpm" :min="0" :max="200" :enable-cross="false" :lazy="true"
          v-on:drag-end.once="doSearch"></vue-slider>
      </div>
    </filter-container>
    <div class="search-results">
      <div class="search-results-count">
        <div v-show="loading">
          Loading...
        </div>
        <div v-show="!loading">
          Showing {{ results.length }} results
          <span v-if="$store.state.search.searchTerm.length">for '{{ $store.state.search.searchTerm }}'</span>
          <span v-if="
            filters.genres.length ||
            filters.classes.length ||
            filters.keys.length
          ">in</span>
          <span v-for="(genre, i) in filters.genres" :key="i">'{{ genre.name }}'<span v-if="filters.genres[i + 1]">,
            </span></span>
          <span v-for="(type, i) in filters.classes" :key="i">'{{ type.name }}'<span v-if="filters.classes[i + 1]">,
            </span></span>
          <span v-for="(key, i) in filters.keys" v-html="'\'' + key.name + '\''" :key="i"><span
              v-if="filters.keys[i + 1]">, </span></span>
        </div>
      </div>
      <!-- v-for="(item, index) in results" -->
      <div class="search-results-grid">
        <div class="search-result" v-show="!loading" :key="index">
          <search-result :users="users" :releases="releases" :tracks="tracks" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

import PhButton from "global/ph-button";
import FilterContainer from "global/filters/filter-container";
import ClassFilter from "global/filters/class-filter";
import GenreFilter from "global/filters/genre-filter";
import KeyFilter from "global/filters/key-filter";
import ReleaseTile from "global/releases/release-tile";
import TrackTile from "global/releases/track-tile";
import ArtistTile from "global/artists/artist-tile";
import VueSlider from "vue-slider-component";
import "vue-slider-component/theme/default.css";
import AvatarTrack from "../../global/avatar-track";

import SearchResult from "./search-result";

export default {
  data() {
    return {
      loading: false,
      results: [],
      users: [],
      releases: [],
      tracks: [],
      filters: {
        classes: [],
        genres: [],
        keys: [],
        bpm: [0, 200],
      },
    };
  },
  computed: {
    ...mapGetters({
      vuexSearchTerm: "search/getSearchTerm",
    }),
  },
  mounted: function () {
    this.doSearch();
  },
  watch: {
    vuexSearchTerm: _.debounce(function () {
      this.doSearch();
    }, 500),
    filters: {
      handler: function () {
        this.doSearch();
      },
      deep: true,
    },
  },
  methods: {
    doSearch() {
      this.loading = true;
      axios
        .post("/api/search", {
          term: this.vuexSearchTerm,
          classes: this.filters.classes,
          genres: this.filters.genres,
          keys: this.filters.keys,
          bpm: this.filters.bpm,
          newsearch: 1
        })
        .then((response) => {

          if (typeof (response.data.term) != typeof (undefined)) {

            var validGenres = this.checkTwoArrays(this.filters.genres, response.data.genres);
            var validClasses = this.checkTwoArrays(this.filters.classes, response.data.classes);
            var validKeys = this.checkTwoArrays(this.filters.keys, response.data.keys);
            var validBpm = this.checkTwoArrays(this.filters.bpm, response.data.bpm);

            if (response.data.term == this.vuexSearchTerm && validGenres && validClasses && validKeys && validBpm) {
              this.loading = false;
              this.results = response.data.data;
              this.users = [];
              this.releases = [];
              this.tracks = [];
              this.results.map(e => {
                if (e.type == 'user') {
                  this.users.push(e);
                } else if (e.type == 'release') {
                  this.releases.push(e);
                } else {
                  this.tracks.push(e);
                }
              });
            }
          } else {
            this.loading = false;
            this.results = response.data;
            this.users = [];
            this.releases = [];
            this.tracks = [];
            this.results.map(e => {
              if (e.type == 'user') {
                this.users.push(e);
              } else if (e.type == 'release') {
                this.releases.push(e);
              } else {
                this.tracks.push(e);
              }
            });
          }

        });
    },

    checkTwoArrays(arr1, arr2) {
      if (arr1.length != arr2.length) { return false; }
      if (arr1.length == 0 && arr2.length == 0) { return true; }
      for (let i = 0; i < arr1.length; i++) {
        if (JSON.stringify(arr1[i]) === JSON.stringify(arr2[i])) {
          continue;
        } else {
          return false;
        }
      }
      return true;
    }
  },
  components: {
    PhButton,
    FilterContainer,
    ClassFilter,
    GenreFilter,
    KeyFilter,
    VueSlider,

    AvatarTrack,
    SearchResult,
  },
};
</script>

<style lang="scss">
.vue-slider {
  padding: 20px 0;

  .vue-slider-process {
    background-color: #9eefe1;
  }

  .vue-slider-dot-tooltip-inner {
    border-color: #9eefe1;
    background-color: #9eefe1;
  }
}
</style>

<style lang="scss" scoped>
.bpm-filter {
  margin-bottom: 50px;
}

.search-filter-group {
  margin-bottom: 30px;
}

.bpm-filter {
  .bpm-values {
    margin: 30px 0;
  }
}

.search-view {
  display: flex;
  align-items: flex-start;

  @media (max-width: 900px) {
    display: block;
  }

  .search-results {
    padding: 0 20px;
    margin: 32px 0;

    .search-results-grid {
      margin-top: 20px;
      // display: grid;
      grid-template-columns: repeat(8, 1fr);

      @media (max-width: 1500px) {
        grid-template-columns: repeat(6, 1fr);
      }

      @media (max-width: 900px) {
        grid-template-columns: repeat(3, 1fr);
      }

      @media (max-width: 650px) {
        grid-template-columns: repeat(2, 1fr);
      }

      grid-gap: 10px;
    }
  }
}
</style>
