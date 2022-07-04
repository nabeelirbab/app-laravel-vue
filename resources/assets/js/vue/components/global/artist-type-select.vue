<template>
    <div class="artist-type-select">
        <ul >
            <li
                v-for="(artistType, i) in getArtistTypes()"
                :key="i"
                :class="{ highlighted: i === arrowCounter }"
            >
            <label >
              <input @click="selectArtistType(artistType)" type="radio" v-model="selectedType" :value="artistType.id">{{artistType.name}}
            </label>
            </li>
        </ul>
    
    </div>
</template>

<script>
    import { mapState } from "vuex";
    export default {
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
            getArtistTypes: function() {
                return this.app.artistTypes;
            },
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
    .genre-select {
        ul.search-results {
            background: white;
            border-left: 1px solid $color-grey2;
            border-right: 1px solid $color-grey2;
            border-bottom: 1px solid $color-grey2;

            li {
                padding: 5px;
                cursor: pointer;

                &.highlighted {
                    background: darken(white, 5);
                }

                .active {
                }
            }
        }
        p {
            margin: 5px 0;
            color: $color-grey2;
            font-size: 10px;
        }
        ul.selected-genres {
            margin: 5px 0;

            li {
                display: inline-block;
                padding: 5px;
                margin-right: 5px;
                cursor: pointer;
                background: darken(white, 15);
                border-radius: 5px;

                &:hover {
                    background: darken(white, 20);
                }
            }
        }
        input {
            box-sizing: border-box;
            font-size: inherit;
            border: 1px solid $color-grey2;
            padding: 5px;
            border-radius: 2px;
            width: 100%;
        }
    }
</style>
