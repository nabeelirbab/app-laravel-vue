<template>
    <div class="artist-type-select">
        <ul class="gridtypelist list-unstyled list-inline float-left">
            <li
                v-for="(artistType, i) in $store.state.app.artistTypes"
                :key="i"
                :class="{ highlighted: selectedType === artistType.id }"
            >
            <label v-bind:class="[selectedType === artistType.id ? 'active' : '']">
              <input @click="selectArtistType(artistType)" type="radio" v-model="selectedType" :value="artistType.id">I am {{artistType.name}}
            </label>
            </li>
        </ul>
    
    </div>
</template>

<script>
    import { mapState } from "vuex";
    export default {
        data() {
            return {
                selectedType: ''
            }
        },
        props: {
            populated: {
                selectedType:  {
                  type: String,
                  default: "",
                },
            }
        },
    
        created() {
             this.$store.dispatch("app/fetchArtistTypes");
        },
        computed: mapState(["app"]),
        mounted: function() {
           
        },
        methods: {
            selectArtistType: function(artistType) {
                this.selectedType = artistType;
                this.$emit("change", artistType.id);
            }
            
        },
        components: {}
    };
</script>

<style lang="scss" scoped>
  @import "~styles/helpers/_variables.scss";

  ul.gridtypelist {
    margin-bottom: 2px;
  }

  ul.gridtypelist li label {
    display: block;
    color: $color-grey3;
    text-align: center;
    padding: $padding-sm;
    text-decoration: none;
    border: 2px $color-blue solid;
    border-radius: 10px;
    margin: 2px;
    background-color: #f1f1f1;
  }

  ul.gridtypelist li label:hover {
    background-color: $color-2;
    color: $color-grey3;
  }

  ul.gridtypelist li label.active {
    background-color: $color-2;
    color: #fff;
  }

  ul.gridtypelist li label input[type="radio"] {
    display: none;
  }

  .gridfilter_list_count {
    padding-top: $padding-sm;
    padding-bottom: $padding-sm;
    text-align: right;
    color: $color-blue2;
  }
</style>
