<template>
<select name="country" v-model="selectedcountry" @change="onChange()">
  <option value="" disabled selected>Select Country</option>
  <option
      v-for="c in countries"
      :key="c.iso_code" 
      :value="c.iso_code">
      {{ c.name }} ({{ c.iso_code }})
 </option>
</select>
</template>


<script>
    import { mapState } from "vuex";
    export default {
        props: {
          
            initialized: {
                type: Array,
                default: function() {
                    return [];
                }
            }
        },
        data() {
            return {
                countries: [],
                selectedcountry: 'GB'
            };
        },
        created() {
            this.countries = this.initialized;
        },
        computed: mapState(["app"]),
        mounted: function() {
            axios.get('/api/countries').then(response => {
                this.countries = response.data;
            });
        },
        methods : {
            onChange: function(){
              this.$emit("change", this.selectedcountry);
            }
        },
        components: {}
    };
</script>