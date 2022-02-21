<template>
  <div
    class="avatar"
    :style="'width:' + size + 'px;height:' + size + 'px;'"
    :class="{ center: center }"
  >
    <ph-label v-if="labels.tl" class="tl" size="small" :color="labels.tl.color">
      {{ labels.tl.text }}
    </ph-label>
    <img :src="src" :alt="alt" :class="{ tile: tile }" />
    <ph-label v-if="labels.tr && labels.tr.text != 'Verified'" class="tr" size="small" :color="labels.tr.color" >
      {{ labels.tr.text }}
    </ph-label>

    <label v-if="verified" class="tr-verified" size="small" >
      <span class='verified-tick'  ><img src='/img/tick.jpg' style='height:25px;width:25px;'/></span>
    </label>
    <div class="is-new-badge" v-if="recent">
      new
    </div>
  </div>
</template>

<script>
import PhLabel from "./ph-label";
export default {
  props: {
    tile: {
      type: Boolean,
      default: false,
    },
    recent: {
      type: Boolean,
      default: false,
    },
    size: {
      type: Number,
      default: 100,
    },
    src: {
      type: String,
      default: "https://placehold.it/200x200",
    },
    alt: {
      type: String,
      default: "Image",
    },
    center: {
      type: Boolean,
      default: true,
    },
    labels: {
      type: Object,
      default: function() {
        return {};
      },
    },
    verified: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {};
  },
  created: function() {},
  components: {
    PhLabel,
  },
};
</script>

<style lang="scss" scoped>
@import "~styles/helpers/_variables.scss";
.avatar {
  width: 100px;
  height: 100px;
  position: relative;

  &.center {
    @media (min-width: 371px) {
      margin: 0 auto;
    }
  }
}
.is-new-badge {
  background: #30f;
  text-align: center;
  padding: 7px;
  border-radius: 12px;
  color: #fff;
  position: absolute;
  top: -5px;
  left: -5px;
  font-size: 12px;
}
img {
  width: inherit;
  height: inherit;
  object-fit: cover;

  border-radius: 100%;
  &.tile {
    border-radius: 0;

    @media (max-width: 500px) {
      border-radius: 5px;
    }
  }
}
.label {
  font-size: 10px;
  position: absolute;
  top: 7px;

  &.tl {
    left: -12px;
  }
  &.tr {
    left: 29px;
  }

  &.tr-verified {
    left: 23px;
    top: 78px;
    color: #5198e9;
  }
}
.verified-badge {
  position: absolute;
  top: 13px;
  right: 13px;
  color: $color-2;
  font-size: 35px;
}

.tr-verified{
  position: absolute;
  bottom: 0px;
  left: 10px;
}

</style>
