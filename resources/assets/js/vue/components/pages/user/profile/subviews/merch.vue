<template>
  <div>
    <ph-button v-if="isPro" @click.native="$modal.show('modal-create-merch')" size="medium">
      Add Merch
    </ph-button>
    <spinner style="margin: 3em auto;"
      :animation-duration="1000"
      :size="60"
      color="black"
      v-show="loadingMerch"
    />
    <div v-if="merches.length">
      <item v-for="merch in merches"
        :item="merch"
        :key="merch.id" />
    </div>
    <div v-if="!merches.length && !loadingMerch" class="not-found">
      Merchandise not found
    </div>
  </div>
</template>

<script>
import ProfileMixin from '../profile-mixin';
import { HalfCircleSpinner as Spinner } from 'epic-spinners';
import Item from 'global/items/item';
import { UserEvents } from "events";
import {mapState} from "vuex";

export default {
  data () {
    return {
      loadingMerch: false,
      merches: [],
    }
  },
  computed: {
    isPro: function() {
      return (this.app.user.account_type === 'pro' || this.app.user.account_type === 'admin')
    },
    ...mapState([
                'app'
              ])
  },
  created: function() {
    this.fetchMerch();
    UserEvents.$on('merch-added', () => {
      this.fetchMerch();
    });
  },
  methods: {
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
  }
</style>