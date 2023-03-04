<template>
  <div>
    <spinner style="margin: 3em auto;" :animation-duration="1000" :size="60" color="black" v-show="loadingMerch" />
    <div v-if="merches.length">
      <item v-for="merch in merches" :item="merch" :key="merch.id" />
    </div>
    <div v-if="!merches.length && !loadingMerch">
      <span class="not-found" v-if="!isShow">
        This user hasn't added any merchandise yet.
      </span>
      <ph-button size="medium" style="display: block; text-align: center;" @click.native="showMerchCreateModal()" v-else>Add Merch</ph-button>
    </div>
  </div>
</template>

<script>
import ProfileMixin from '../profile-mixin';
import { HalfCircleSpinner as Spinner } from 'epic-spinners';
import Item from 'global/items/item';
import { UserEvents, SocialEvents } from "events";
import { mapState } from "vuex";

export default {
  data() {
    return {
      loadingMerch: false,
      merches: [],
    }
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
    this.fetchMerch();
    UserEvents.$on('merch-added', () => {
      this.fetchMerch();
    });
    SocialEvents.$on('merch-deleted', () => {
      this.fetchMerch();
    });
  },
  methods: {
    showMerchCreateModal() {
      this.$modal.show('modal-create-merch', { user: this.user });
    },
    fetchMerch() {
      this.loadingMerch = true;
      axios.get('/api/user/' + this.user.id + '/merch').then(response => {
        this.merches = response.data;
      }).finally(() => {
        this.loadingMerch = false;
      });
    }
  },
  mixins: [
    ProfileMixin
  ],
  components: {
    Item,
    Spinner
  }
}
</script>
<style lang="scss" scoped>
.not-found {
  text-align: center;
  margin-top: 10px;
  display: block;
}
</style>