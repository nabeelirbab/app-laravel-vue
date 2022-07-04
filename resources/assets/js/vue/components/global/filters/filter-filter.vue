<template>
  <div class="search-filter-group">
    <slot>
      <h2>{{ title }}</h2>
    </slot>
    <br />
    <div class="filter-buttons">
      <div class="button-container" v-for="(artistType, i) in $store.state.app.artistTypes">
        <ph-button
          size="medium"
          color="blue2"
          width="100%"
          type="search-filter"
          :active="isActive(artistType.id)"
          @click.native="single ? setSingleFilter(artistType.id) : toggleFilter(artistType.id)"
        >{{ artistType.name }}</ph-button>
      </div>
    </div>
    
  </div>
</template>

<script>
import FilterMethods from "./filter-methods";
import { mapState } from "vuex";

export default {
  data() {
    return {
      filters: this.value,
      options: ["Latest", "Popular", "Labels", "Producers"],
    };
  },
  props: {
    value: {
      type: Array,
      default: [],
    },
    single: {
      type: Boolean,
      default: false,
    },
    title: {
      type: String,
      default: "Select a filter",
    },
  },
  computed: mapState(["app"]),
  created: function () {
     this.$store.dispatch("app/fetchArtistTypes");
  },
  mixins: [FilterMethods],
};
</script>

<style scoped>
h3 {
  font-size: 17px;
  margin-bottom: 5px;
}
</style>

<style lang="scss">
.range-slider-fill {
  background-color: #9eefe1;
}
</style>