<template>
  <div class="container">
    <div class="row">
      <div class="col" v-for="(plate, index) in plates" :key="index">
        <span v-if="plate.visible == 1">
          {{plate.name}}
        </span>
      </div>
    </div>
  </div>
</template>

<script>
import Axios from "axios";
export default {
name: 'Restaurant',
props: ['id'],
    data() {
      return {
        restaurant: null,
        plates: []
      }
    },
created() {
        const url = 'http://127.0.0.1:8000/api/restaurant/' + this.id;
        this.getProduct(url);
    },
    methods: {
      getProduct(url){
          Axios.get(url)
          .then(
            (result) => {
              this.restaurant = result.data.results.data;
              this.plates = result.data.results.plates;
            }).catch(error => console.log(error));
      }
    },
}
</script>

<style>

</style>