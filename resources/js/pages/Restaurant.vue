<template>
    <div class="">

        <div class="container-fluid  overflow-hidden  p-0 m-0 banner position-relative">
            <img class="image-banner" :src="restaurant.banner_img" alt="">
            
        </div>
        <div class="w-75 ">
            <div class="logo shadow-lg ">
                <img  :src="restaurant.logo_img" alt="">
            </div>
        </div>
        

        <div class="container container-main">
            <div class="row">
                <div class="col mt-4">
                    <h1 class="fw-bold">{{restaurant.name}}</h1>
                    <h4 class="mt-3"><i class="fa-solid fa-location-dot"></i>&nbsp;{{restaurant.address}}</h4>

                </div>

            </div>
           
            
            <div class="food">
                <div v-for="(section, index) in plates" :key="index" class="row">
                    <h1> {{ getNameSection(index) }}</h1>
                    <div class="food-card col-12 col-md-4 col-lg-3 container" v-for="(plate, index) in section" :key="index">
                        <img
                            :src="plate.preview"
                            class="img-fluid image overlay "
                            :alt="plate.name"
                        />
                        <div class="food-info  ">
                            <h3 class="bold">{{ plate.name }}</h3>
                            
                            <div class="food-info ingredienti ">
                                <p class="ms-2">
                                    {{ plate.ingredients }}
                                </p>
                                <h6 class="ms-1">{{ plate.price }} &euro;</h6>
                                <a
                                    class="btn-add-cart"
                                    @click="addItemToCart(plate.id, plate.price, plate.name)"
                                    ><i class="fa-solid fa-plus"></i>
                                </a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
             <div class="maps">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2969.792869463778!2d12.480764051214418!3d41.897311472088276!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x132f604d442317b9%3A0x98e404577e346793!2sPalazzo%20Guglielmi%2C%2000187%20Roma%20RM%2C%20Italia!5e0!3m2!1sit!2sfr!4v1649344199687!5m2!1sit!2sfr" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            </div>


        </div>
    </div>
</template>

<script>
import Axios from "axios";
import EventBus from "../bus.js";
export default {
    name: "Restaurant",
    props: ["id"],
    data() {
        return {
            restaurant: null,
            plates: [],
            tags: [],
            cartItem: [],
            cart: null,
        };
    },
    created() {
        const url = "http://127.0.0.1:8000/api/restaurant/" + this.id;
        if (this.getCartItem() != null) {
            let localData = JSON.parse(this.getCartItem());
            localData.forEach((element) => {
                this.cartItem.push(element);
            });
        }
        this.getProduct(url);
        EventBus.$emit("refresh_cart", this.id);
        EventBus.$on("updated_cart", (data) => {
            this.cartItem = data;
        });
    },
    methods: {
        getProduct(url) {
            Axios.get(url)
                .then((result) => {
                    this.restaurant = result.data.results.restaurant;
                    this.plates = result.data.results.plates;
                    this.tags = result.data.results.tags;
                    console.log(this.tags);
                    this.filterPlates();
                })
                .catch((error) => console.log(error));
        },
        filterPlates() {
            this.plates = this.plates;
        },

        getCartItem() {
            return localStorage.getItem("cart");
        },

        addItemToCart(id, price, name) {
            if(this.cartItem.length != 0)
            {
                this.cartItem.forEach((element) => {
                    if (element.id == id) {
                        this.findItem = true;
                        element.quantity++;
                        element.price = parseFloat(element.quantity * price);
                    }
                });
            }

            if (this.findItem) {
                this.findItem = false;
            } else {
                let newItem = {
                    id: id,
                    name: name,
                    restaurant: parseInt(this.id),
                    quantity: 1,
                };
                newItem.price = parseFloat(newItem.quantity * price);
                this.cartItem.push(newItem);
                this.findItem = false;
            }
            
            localStorage.setItem("id", this.id);
            localStorage.setItem("cart", JSON.stringify(this.cartItem));
            EventBus.$emit("refresh_cart", this.id);
        },
        getNameSection(index) {
            let tagName
            this.tags.forEach(element => {
                if(element.id == index)
                {
                    tagName = element.name;
                }
            });

            return tagName
        }
    },
};
</script>

<style lang="scss" scoped>

.banner {
    height: 250px;
    
    display: flex;
    align-items: center;
    .image-banner{
        width: 100%;
        // height: 450px;
    }
    
}
.logo{
        position: absolute;
        top: 24%;
        left: 10%;
        width: 10%;
        border-radius: 50%;
        
        img{
            top: 0;
            border-radius: 50%;
            width: 100%;
            
            background-color: white;
        }

        
    }
.container-main{
    margin-top: 100px;
    border: 2px solid red;
    border-radius: 5%;
}

.food {
    padding: 120px 0;
    .row{
        margin-top: 10%;
    }
}

.food>div {
    column-gap: 20px;
    row-gap: 20px;
    z-index: 300;
    padding: 20px 0;
    .food-card{
        position: relative;
        margin-top: 0;
        border-radius: 25px;
        overflow: hidden;
        padding: 0;
        height: 250px;
        img {
            // object-fit: contain;
            display: block;
            margin: auto ;
            height: 20%;
            // width: 100%;
        }
        .food-info {
            position: absolute;
            z-index: 500;
            height: 100%;
            width: 100%;
            top: 0%;
            border-radius: 25px;
            padding: 10px;
            .ingredienti{
                color: black;
                font-size: 1.2em;
                
                margin-top: 25%;
                
            }
            .btn-add-cart{
                background-color: #ffc626;
                color: black;
                padding: 10px 15px;
                border-radius: 5px;
                text-decoration: none;
            }
            .bold{
                width: 100%;
                text-align: center;
                margin: 0 auto;
                font-weight: bold;
                background-color: rgba(233, 243, 252, 0.411);
                
            }
        }
       
    }




    .container {
        position: relative;
        width: 30%;
        margin-top: 0;
        
        .image {
        display: block;
        width: 100%;
        height: auto;
        }
    }



    .overlay {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    height: 100%;
    width: 100%;
    opacity: 1;
    transition: .5s ease;
    background-color: grey;
    }

    .container:hover .overlay {
    opacity: 0.3;
    border: 3px solid red;
    border-radius: 25px;

    }

    .ingredienti{
        display: none;
    }

    .container:hover .ingredienti{
        display: block;
    }
    
    

 
}

</style>
