<template>
    <div class="container">
        <div class="row">
            <div class="col" v-for="(plate, index) in plates" :key="index">
                <div class="card h-100">
                    <img
                        :src="plate.preview"
                        class="card-img-top"
                        :alt="plate.name"
                    />
                    <div class="card-body">
                        <h3 class="card-title">{{ plate.name }}</h3>
                        <h6>{{ plate.price }} &euro;</h6>
                        <p class="card-text">
                            <strong>Descrizione:</strong>
                            {{ plate.description }}
                        </p>
                        <p class="card-text">
                            <strong>Ingredienti:</strong>
                            {{ plate.ingredients }}
                        </p>
                        <a
                            class="btn btn-primary"
                            @click="
                                addItemToCart(plate.id, plate.price, plate.name)
                            "
                            >Add To Cart</a
                        >
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
    },
    methods: {
        getProduct(url) {
            Axios.get(url)
                .then((result) => {
                    this.restaurant = result.data.results.restaurant;
                    this.plates = result.data.results.plates;
                    this.filterPlates();
                })
                .catch((error) => console.log(error));
        },
        filterPlates() {
            this.plates = this.plates.filter((plate) => plate.visible == 1);
        },

        getCartItem() {
            return localStorage.getItem("cart");
        },

        addItemToCart(id, price, name) {
            this.cartItem.forEach((element) => {
                if (element.id == id) {
                    this.findItem = true;
                    element.quantity++;
                    element.price = parseFloat(element.quantity * price);
                }
            });

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

            localStorage.setItem("cart", JSON.stringify(this.cartItem));
            EventBus.$emit("refresh_cart", this.id);

            console.log(this.getCartItem());
        },
    },
};
</script>

<style></style>
