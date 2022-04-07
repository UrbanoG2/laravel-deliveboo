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
                    <div class="food-card col-12 col-md-4 col-lg-3" v-for="(plate, index) in section" :key="index">
                        <img
                            :src="plate.preview"
                            class="img-fluid"
                            :alt="plate.name"
                        />
                        <div class="food-info">
                            <h3 class="">{{ plate.name }}</h3>
                            <p class="">
                                {{ plate.ingredients }}
                            </p>
                            <h6>{{ plate.price }} &euro;</h6>
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
        border: 1px solid red;
        border-radius: 25px;
        overflow: hidden;
        padding: 0;
        img {
            height: 100%;
            width: 100%;
        }
        .food-info {
            position: absolute;
            z-index: 500;
            height: 100%;
            width: 100%;
            top: 0%;
            border-radius: 25px;
            padding: 15px;
            .btn-add-cart{
                background-color: #ffc626;
                color: black;
                padding: 10px 15px;
                border-radius: 5px;
                text-decoration: none;
            }
        }
    }
}

</style>
