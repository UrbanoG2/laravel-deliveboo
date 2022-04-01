<template>
  <div class="container">
    <div class="row">
      <div class="col" v-for="(plate, index) in plates" :key="index">
          <div class="card">
            <img :src="'/storage/'+ plate.preview" class="card-img-top" :alt="plate.name">
            <div class="card-body">
              <h3 class="card-title">{{ plate.name }}</h3>
              <h6>{{ plate.price }} &euro;</h6>
              <p class="card-text"><strong>Descrizione:</strong>  {{ plate.description }}</p>
              <p class="card-text"><strong>Ingredienti:</strong> {{ plate.ingredients }}</p>
              <a href="#" class="btn btn-primary" @click="addPlates($event)">Add To Cart</a>
            </div>
          </div>
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
        plates: [],
        cards: null,
        orderId:null,
        cart: null,
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
              this.filterPlates();
            }).catch(error => console.log(error));
      },
      filterPlates(){
        this.plates = this.plates.filter(plate => plate.visible == 1);
      },

      addItemToLocalStore(){
        let cartBox = localStorage.getItem('cart');
        if (cartBox) {
          cartBox.forEach(element => {
            if (element.restaurant == this.id) {
              this.cart.plates = plates
            }
          });
        } else {
          this.cart.restaurant == this.id;
          this.cart.plates = plates;
        }

        localStorage.setItem('cart', JSON.stringify(this.cart));
      },

      // addItemToCart(){
      //   if() {

      //   }
      // }
    },
}
</script>

<style>

</style>