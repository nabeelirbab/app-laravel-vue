<template>
  <div class="page-content-padded page-discover-index">
    <div class="page-main">

      <!-- <div v-if="showMessage" class="alert alert-success" style="background: green; color: #fff; padding: 10px;">Email
        verified successfully.</div> -->

      <masonry-grid v-if="app.feed.length" v-bind:feed_items="app.feed" />
      <spinner style="margin: 3em auto;" v-else :animation-duration="1000" :size="80" color="black" />
    </div>
    <aside class="sidebar-right">
      <sidebar-group title="News" :items="news.articles.slice(0, 5)"></sidebar-group>
    </aside>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import { HalfCircleSpinner as Spinner } from 'epic-spinners'
import SidebarGroup from 'global/sidebar-group';
import MasonryGrid from 'global/feed/masonry-grid';
import store from 'store';

export default {
  components: {
    SidebarGroup,
    Spinner,
    MasonryGrid
  },
  data() {
    return {
      loadedAll: false,
    }
  },
  computed: mapState([
    'app',
    'news',
  ]),
  created: function () {
    this.fetchFeed()
  },
  methods: {
    fetchFeed() {
      store.dispatch('app/fetchFeed')
        .then(() => {
          this.loadedAll = true
        });
    }
  },
  // mounted() {
  //   if (this.$route.query['email-verified'] === '1') {
  //     // console.log("logged in");

  //     // this.showMessage = true
  //     //   setTimeout(() => {
  //     //     this.showMessage = false;
  //     //     this.$router.push('/');
  //     //   }, 15000) // hide message after 15 seconds
  //     axios.get("/api/auth/logout").then(function (response) {
  //       console.log("logged in");
  //       this.$store.commit("app/unsetUser");
  //       // this.$notify({
  //       //   group: 'main',
  //       //   type: 'success',
  //       //   title: '<img src="/img/Resized_mail.gif" alt="success" style="width=80%">',
  //       // })
  //       this.$router.push('/login');
  //     });

  //   }
  // },
}
</script>
