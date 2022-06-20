<template>
  <div class="only-music-bar">
    <div class="user-bar-player" v-show="$store.state.player.status.set">
      <player></player>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
import store from "store";
import { PlayerEvents } from "events";

import Player from "global/player";

export default {
  components: {
    Player
  },

  data() {
    return {
      moment: window.moment,
    };
  },

  computed: mapState(["app"]),

  mounted() {
    
  },

  destroyed() {
    document.removeEventListener("click", this.handleClickOutside);
  },

  methods: {
    
  },
};
</script>

<style lang="scss" scoped>
@import "~styles/helpers/_variables.scss";

.only-music-bar {
  height: 0px;
  width: auto;
  background-color: hsla(0, 0%, 0%, 0);
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-top: 25px;
}
.player .controls {
  background: #fff !important;
}
.user-bar-main {
  justify-content: space-between;
  flex: 1;

  font-size: 20px;
  align-items: center;
  //padding: 0 1em;

  display: flex;

  @media (max-width: 1024px) {
    // flex-direction: column;
  }
}
.user-bar-guest {
  justify-content: flex-end;
}
.user-bar-left {
  flex: 1;
  display: flex;
  align-items: center;

  & > * {
    margin: 0 10px;

    @media (max-width: 488px) {
      margin: 0 0.7em;
    }

    @media (max-width: 448px) {
      margin: 0 0.5em;
    }

    @media (max-width: 421px) {
      margin: 0 0.3em;
    }

    @media (max-width: 396px) {
      margin: 0 0.3em;
    }
  }
}
.user-bar-actions {
  display: flex;
  position: relative;
  justify-content: flex-end;
  align-items: center;
}
a.user-bar-item {
  margin: 0 10px;
  color: initial;
  display: block;
  position: relative;

  @media (max-width: 1024px) {
    margin: 0 8px;
  }
}

.user-bar-player {
  flex: 0 0 18%;
  font-size: 90%;
  min-width: 250px;
  max-width: 500px;
}
</style>
