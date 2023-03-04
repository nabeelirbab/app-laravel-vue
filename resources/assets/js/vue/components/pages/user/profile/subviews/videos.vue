<template>
  <div>
    <ph-button v-if="isPro && isShow" @click.native="$modal.show('modal-upload-video', { user: user });" size="medium"
      style="display: block; text-align: center;">Add Video</ph-button>
    <spinner style="margin: 3em auto;" :animation-duration="1000" :size="60" color="black" v-show="loadingVideos" />
    <div v-if="videos.length">
      <item v-for="video in videos" :item="video" :key="video.id" />
    </div>
    <div v-if="!videos.length && !loadingVideos" class="not-found">
      This user has not uploaded any videos yet.
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
import { mapState } from "vuex";

export default {
  data() {
    return {
      loadingVideos: false,
      videos: [],
    };
  },
  computed: {
    isPro: function () {
      return (this.app.user.account_type === 'pro' || this.app.user.account_type === 'admin')
    },
    isShow: function () {
      return (this.app.user.id === this.user.id)
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
  display: block;
}
</style>
