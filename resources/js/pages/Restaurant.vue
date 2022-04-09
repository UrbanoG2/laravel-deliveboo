<template>
    <div class="background-img">

        <!-- <div class="container-fluid  overflow-hidden  p-0 m-0 banner position-relative">
            <img class="image-banner" :src="restaurant.banner_img" alt="">
            
        </div>
        <div class="w-75 ">
            <div class="logo shadow-lg ">
                <img  :src="restaurant.logo_img" alt="">
            </div>
        </div> -->
        

        <div class="container container-main">
            <div class="row position-relative">
                <div class="col mt-4 text-center">
                    <div class="container-fluid  overflow-hidden  p-0 m-0 banner position-relative">
                        <img class="image-banner col-12" :src="restaurant.banner_img" alt="">
                        <div class="w-75 ">
                            <div class="logo shadow-lg ">
                                <img  :src="restaurant.logo_img" alt="">
                            </div>
                        </div>
                    </div>
                        
                    
                    
                    <h1 class="fw-bold pt-4">{{restaurant.name}}</h1>
                    <h4 class="mt-3"><i class="fa-solid fa-location-dot"></i>&nbsp;{{restaurant.address}}</h4>
                    
                    <h4>{{restaurant.descrizione}}</h4>
                </div>
                <a class="btn btn-primary position-absolute home">
                    <i class="fa-solid fa-arrow-right-to-bracket "></i>
                </a>

            </div>
           
            
            <div class="food p-4">
                <div v-for="(section, index) in plates" :key="index" class="row ">
                    <h1 class="text-center"> {{ getNameSection(index) }}</h1>

                    <div class="food-card col-10 col-md-3 col-lg-2 container " v-for="(plate, index) in section" :key="index">
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
            


        </div>
        <div class="maps text-center mb-4 mt-4">
                <iframe  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2969.792869463778!2d12.480764051214418!3d41.897311472088276!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x132f604d442317b9%3A0x98e404577e346793!2sPalazzo%20Guglielmi%2C%2000187%20Roma%20RM%2C%20Italia!5e0!3m2!1sit!2sfr!4v1649344199687!5m2!1sit!2sfr" width="600" height="450" style="border:0; height: 250px; width: 50%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            </div>
    </div>
</template>

<script>
import Axios from "axios";
import EventBus from "../bus.js";
export default {
    name: "Restaurant",
    props: ["id", "slug"],
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
        const url = "http://127.0.0.1:8000/api/restaurant/" + this.slug;
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
.background-img{
    // background-image: url('../../../public/images/background-2.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    //  background-color: white;
    //  background: #ffe259;
    // background: -webkit-linear-gradient(to right, #ffa751, #ffe259);  
    // background: linear-gradient(to right, #ffa751, #ffe259); 
    
}

.banner {
    height: 250px;
    background-size: cover;
    display: flex;
    align-items: center;
    border-radius: 30px;
    .image-banner{
        width: 100%;
        
        // height: 450px;
    }
    
}
.logo{
        position: absolute;
        top: 30%;
        left: 5%;
        width: 7%;
        border-radius: 50%;
        
        img{
            top: 0;
            border-radius: 50%;
            width: 100%;
            
            background-color: white;
        }

        
    }
.container-main{
    margin-top: 50px;
    border: 2px solid #ffc626;
    border-radius: 30px;
    // background-color: #ffc626;
    //  background-color: white;
    background: #ffe259;
    background: -webkit-linear-gradient(to bottom, #ffa751, #ffe259);  
    background: linear-gradient(to bottom, #ffa751, #ffe259); 

    .home{
        top: 108%;
        left: 85%;
        width: 11%;
        i{
            transform: rotate(180deg);
            font-size: 1.5em;
        }
    }
    
}

.food {
    padding: 90px 0; 
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
        width: 300px;
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
        // width: 25%;
        margin-top: 0;
        
        
        .image {
            display: block;
            width: 100%;
            height: 100%;
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
