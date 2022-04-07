<template>
    <div>

        <div class="container-fluid position-relative overflow-hidden p-0 m-0 banner">
            <img class="w-100" :src="restaurant.banner_img" alt="">
        </div>

        <div class="container">


            <div class="row info">

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
    height: 280px;
    width: 100%;
    display: flex;
    align-items: center;
}

.food {
    padding: 120px 0;
}

.food>div {
    column-gap: 20px;
    row-gap: 20px;
    z-index: 300;
    padding: 20px 0;
    .food-card{
        position: relative;
        
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
