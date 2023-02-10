<template>
  <div>
    <div v-if="loading">
      <div class="release-wrapper" v-if="releases.data.length">
        <my-music-release v-for="release in releases.data" :key="release.id" :release="release" />

        <div style="margin: 4em 0" class="centered-text" v-if="hasAnotherPage && releases.data.length">
          <ph-button size="large" @click.native="loadNextPage" :loading="loadingNextPage">
            Show Me More
          </ph-button>
        </div>
      </div>
      <div v-else>
        <p style="text-align: center;">
          This user has not released any music yet.
        </p>
      </div>
    </div>
    <spinner style="margin: 5em auto;" :animation-duration="1000" :size="60" color="black" v-else />
  </div>
</template>

<script>
import SidebarGroup from 'global/sidebar-group';
import { HalfCircleSpinner } from 'epic-spinners';
import { UserEvents } from "events";
import { mapGetters, mapState } from 'vuex';
import Item from '../../../global/items/item'
import MyMusicRelease from './music'

export default {
  props: {
    user: {
      type: Object,
      required: true,
    }
  },
  data() {
    return {
      loaded: false,
      loadingNextPage: false,
      loading: false,
    }
  },
  computed: {
    ...mapGetters({
      'releases': 'app/getUsersUploadedMusic',
      'hasAnotherPage': 'app/uploadedMusicHasAnotherPage',
    }),
    ...mapState(['app'])
  },
  mounted: function () {
    UserEvents.$emit('updateTitle', 'My Music')
    this.loading = false;
    if (this.app.uploadedMusic.data.length) {
      this.app.uploadedMusic = {
        data: [],
        current_page: '',
        next_page_url: '',
        prev_page_url: '',
        last_page: '',
        from: '',
        to: '',
      };
    }
    this.$store.dispatch('app/fetchUsersUploadedMusic', this.user.id)
      .finally(() => {
        this.loading = true;
      });
  },
  methods: {
    loadNextPage: function () {
      this.loadingNextPage = true;
      this.$store.dispatch('app/fetchUsersUploadedMusic', this.user.id).then(() => {
        this.loadingNextPage = false;
      });
    },
  },
  components: {
    Item,
    SidebarGroup,
    MyMusicRelease,
    'spinner': HalfCircleSpinner,
  }
}
</script>

<style lang="scss" scoped>

</style>
