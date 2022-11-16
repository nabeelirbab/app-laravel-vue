<template>
  <div>
    <sidebar-group :title="user.account_type !== 'pro' ? user.name : null">
      <div v-if="isMe">
        <router-link :to="{ name: 'account_default' }">
          <ph-button>Profile</ph-button>
        </router-link>
      </div>
    </sidebar-group>
    <sidebar-group>
      <div class="sidebar-group-title">
        <span>
          <i class="fa fa-user"></i>
          {{ mutableUser.follower_count ?  mutableUser.follower_count : 0 }}
        </span>
        <span>
          <i class="fa fa-music"></i>
          {{ mutableUser.releases_count ? mutableUser.releases_count : 0 }}
        </span>
      </div>
      <div class="sidebar-group-subtitle" v-if="!isMe && isLogin">
        <div style="display: flex; align-items: center">
          <follow-action
            :user="mutableUser"
            @update="followStatusUpdated"
            style="margin: 0"
          />

          <span style="margin: 0 10px; cursor: pointer">
            <share-button
              :shareable="mutableUser"
              @share="shared"
              :show-title="true"
            ></share-button>
          </span>

          <router-link :to="{ path: '/user/messages/'+user.path}">
            <i class="fa fa-envelope"></i>
          </router-link>
        </div>
      </div>
      <div class="sidebar-group-content user-bio">
           {{ user.bio }}
      </div>
      <div class="profile-social">
        <a :href="user.social_web" class="profile-social-item">
          <i class="fa fa-globe"></i>
        </a>
        <a :href="user.social_youtube" class="profile-social-item">
          <i class="fab fa-youtube"></i>
        </a>
        <a :href="user.social_twitter" class="profile-social-item">
          <i class="fab fa-twitter"></i>
        </a>
        <a :href="user.social_facebook" class="profile-social-item">
          <i class="fab fa-facebook-f"></i>
        </a>
      </div>
    </sidebar-group>
    <!-- Pro Sidebar Items -->
    <div >
      <sidebar-group title="Merchandise">
        <div class="sidebar-group-content">
        <a v-if="isPro" @click="showMerchCreateModal" size="small">
          <i class="fa fa-2x fa-plus-circle"></i>
        </a>
          <sidebar-group-item
            v-for="(item, index) in merchs"
            :item="item"
            :key="index"
          ></sidebar-group-item>
          <router-link v-if="merchs.length > 0" :to="{ name: 'profile_merch' }"> >> View All</router-link>
        </div>
      </sidebar-group>
      <sidebar-group title="Events">
        <div class="sidebar-group-content">
        <a v-if="isPro" @click="showEventCreateModal" size="small">
          <i class="fa fa-2x fa-plus-circle"></i>
        </a>
          <sidebar-group-item
            v-for="(item, index) in events"
            :item="item"
            :key="index"
          ></sidebar-group-item>
          <router-link v-if="events.length > 0" :to="{ name: 'profile_events' }"> >> View All</router-link>
        </div>
      </sidebar-group>
    </div>
    <!-- / -->
  </div>
</template>

<script>
import { mapState } from "vuex";
import { UserEvents, ModalEvents } from "events";


import SidebarGroup from "global/sidebar-group";
import SidebarGroupItem from "global/sidebar-group-item";
import FollowAction from "../../pages/user/profile/partials/follow-action";
import ShareButton from "../../global/actions/share-button";

export default {
  name: "user-left-sidebar",

  props: {
    user: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
      mutableUser: this.user,
      events: [],
      merchs:[]
    };
  },

  computed: {
    isMe: function () {
      return this.user.id === this.$store.state.app.user.id;
    },
    isLogin: function() {
      return this.$store.state.app.user.loggedin;
    },
    isPro: function() {
      return (this.$store.state.app.user.account_type === 'pro' || this.$store.state.app.user.account_type === 'admin')
    },
    ...mapState([
                'app'
              ])
  },
  created() {
    this.fetchEvents();
    this.fetchMerch();
    ModalEvents.$on('event-created', ()=> {
      this.fetchEvents()
    })
  },
  methods: {
    fetchEvents() {
      axios.get(`/api/event/${this.mutableUser.id}/list`).then((response) => {
        this.events = response.data;
      });
    },
    fetchMerch() {
      axios.get(`/api/user/${this.mutableUser.id}/merch`).then((response) => {
        this.merchs = response.data;
      });
    },
    followStatusUpdated(followStatus) {
      this.mutableUser.followed = followStatus;

      if (followStatus) {
        this.mutableUser.follower_count += 1;
      } else {
        this.mutableUser.follower_count -= 1;
      }
    },
    shared() {
      this.$emit("share");
    },
    showMerchCreateModal() {
       this.$modal.show('modal-create-merch', { user: this.user });
    },
    showEventCreateModal() {
        this.$modal.show('modal-create-event', { user: this.user });
    },
  },
  components: {
    SidebarGroup,
    FollowAction,
    ShareButton,
    SidebarGroupItem,
  },
};
</script>