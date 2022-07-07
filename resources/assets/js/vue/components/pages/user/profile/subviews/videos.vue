<template>
  <div>
    <ph-button @addedVideo="addedVideo" v-if="isPro" @click.native="$modal.show('modal-upload-video', {user: user});" size="medium">Add Video</ph-button>
    <spinner
      style="margin: 3em auto;"
      :animation-duration="1000"
      :size="60"
      color="black"
      v-show="loadingVideos"
    />
    <div v-if="videos.length">
      <item v-for="video in videos" :item="video" :key="video.id" />
    </div>
    <div v-if="!videos.length && !loadingVideos" class="not-found">
      Videos not found
    </div>
    <div>
        
    </div>
  </div>
</template>

<script>
import ProfileMixin from "../profile-mixin";
import { HalfCircleSpinner as Spinner } from "epic-spinners";
import Item from "global/items/item";
import { UserEvents } from "events";
import {mapState} from "vuex";

export default {
  data() {
    return {
      loadingVideos: false,
      videos: [],
    };
  },
  computed: {
    isPro: function() {
      return (this.app.user.account_type === 'pro' || this.app.user.account_type === 'admin')
    },
    ...mapState([
                'app'
              ])
  },
  created: function () {
    this.fetchVideos();
    UserEvents.$on('video-added', () => {
      this.fetchVideos();
    });

    UserEvents.$on('video-deleted', () => {
      this.fetchVideos();
    });
  },
  methods: {
    fetchVideos() {
      this.loadingVideos = true;
      axios
        .get("/api/user/" + this.user.id + "/videos")
        .then((response) => {
          this.videos = response.data;
        })
        .finally(() => {
          this.loadingVideos = false;
        });
    }
  },
  mixins: [ProfileMixin],
  components: {
    Item,
    Spinner,
  },
};
</script>

<style lang="scss" scoped>
  .not-found {
    text-align: center;
    margin-top: 10px;
  }
</style>
