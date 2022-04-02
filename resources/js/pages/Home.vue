<template>
  <div class="container-fluid">
    <div class="row">
      <div class="jumbo p-4 mb-2">
        <div class="row h-100">
          <div class="col d-flex flex-column align-items-center justify-content-center">
            <h1>Benvenuti su Deliveboo!</h1>
            <h2>Tutto il cibo di cui hai bisogno a portata di click</h2>
          </div>
        </div>
      </div>
      <div class="container-fluid bg-section">
        <div class="container mt-4">
          <div class="row p-4">
            <h3>Ultimi Ristoranti in tendenza <i class="fa-solid fa-arrow-trend-up"></i></h3>
            <div class="col" v-for="(restaurant, index) in cards.restaurants" :key="index">
              <!-- <div class="card">
                <img src="\storage\app\uploads\default.png" :alt="restaurant.banner_img">
                <div class="card-body">
                  <h5 class="card-title">{{ restaurant.name }}</h5>
                  <p class="card-text">{{ restaurant.description }}</p>
                  <router-link
                        class="btn btn-secondary"
                        :to="{
                            name: 'restaurant',
                            params: { id: restaurant.id },
                        }"
                  >View</router-link>
                </div>
              </div> -->


              <div class="profile-card-2"><img src="http://envato.jayasankarkr.in/code/profile/assets/img/profile-2.jpg" class="img img-responsive">
                    <div class="profile-name">JOHN DOE</div>
                    <div class="profile-username">@johndoesurname</div>
                    <div class="profile-icons"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-linkedin"></i></a></div>
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
  .bg-section{
    background-color: white;
    h3{
      font-weight: 800!important;
    }
  }

  .profile-card-2 {
    max-width: 300px;
    background-color: #FFF;
    box-shadow: 0px 0px 25px rgba(0, 0, 0, 0.1);
    background-position: center;
    overflow: hidden;
    position: relative;
    margin: 10px auto;
    cursor: pointer;
    border-radius: 10px;
}

.profile-card-2 img {
    transition: all linear 0.25s;
}

.profile-card-2 .profile-name {
    position: absolute;
    left: 30px;
    bottom: 70px;
    font-size: 30px;
    color: #FFF;
    text-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
    font-weight: bold;
    transition: all linear 0.25s;
}

.profile-card-2 .profile-icons {
    position: absolute;
    bottom: 30px;
    right: 30px;
    color: #FFF;
    transition: all linear 0.25s;
}

.profile-card-2 .profile-username {
    position: absolute;
    bottom: 50px;
    left: 30px;
    color: #FFF;
    font-size: 13px;
    transition: all linear 0.25s;
}

.profile-card-2 .profile-icons .fa {
    margin: 5px;
}

.profile-card-2:hover img {
    filter: grayscale(100%);
}

.profile-card-2:hover .profile-name {
    bottom: 80px;
}

.profile-card-2:hover .profile-username {
    bottom: 60px;
}

.profile-card-2:hover .profile-icons {
    right: 40px;
}
</style>