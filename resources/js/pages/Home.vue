<template>
  <div class="container-fluid">
    <div class="row">
      <div class="jumbo p-4">
        <div class="row h-100">
          <div class="col d-flex flex-column align-items-center justify-content-center">
            <h1>Benvenuti su Deliveboo!</h1>
            <h2>Tutto il cibo di cui hai bisogno a portata di click</h2>
          </div>
        </div>
        <div class="container mt-4">
          <div class="row p-4">
            <div class="col" v-for="(restaurant, index) in cards.restaurants" :key="index">
              <div class="card">
                <img src="\storage\app\uploads\default.png" :alt="restaurant.banner_img">
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Axios from "axios";
export default {
    name: 'Home',
    data(){
      return {
        cards: {
                restaurants: null,
                next_page_url: null,
                prev_page_url: null,
                current_page: null,
            },
      }
    },
    created(){
      this.getRestaurants("http://127.0.0.1:8000/api/v1/users/random");
    },
    methods: {
        changePage(vs) {
            let url = this.cards[vs];
            if (url) {
                this.getRestaurants(url);
            }
        },
        getRestaurants(url) {
            Axios.get(url).then((result) => {
                this.cards.restaurants = result.data.results.data;
                this.cards.next_page_url = result.data.results.next_page_url;
                this.cards.prev_page_url = result.data.results.prev_page_url;
                this.cards.current_page = result.data.results.current_page;
            });
        },
    },
}
</script>

<style lang="scss" scoped>
  .jumbo{
    background-image: url(../../img/jumbo-img.jpg);
    width: 100%;
    height: 650px;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    h1,h2{
      color:white;
      font-weight: 800;
    }
    h1{
      font-size: 4.5em;
    }
  }
</style>