<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <router-link class="nav-link" :to="{ name: 'home' }">
                <img id="logo" class="w-5" :src="logo" alt="logo"
            /></router-link>

            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li
                        class="nav-item"
                        v-for="item in menuItems"
                        :key="item.id"
                    >
                        <router-link
                            class="nav-link"
                            :to="{ name: item.routeName }"
                            >{{ item.label }}</router-link
                        >
                    </li>
                    <li class="nav-item">
                            <a class="nav-link" href="login">Accedi</a>
                    </li>
                    <li class="nav-item">
                                <a class="nav-link" href="register"> Registrati </a>
                    </li>
                    <li>
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" @click="clicked = !clicked">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </a>
                            
                            <transition @before-enter="SCbeforeEnter" @enter="SCenter" @leave="SCleave" v-bind:css="false">
                                <ul v-if="clicked != false && list != null" class="cart-box">
                                    <li v-for="(item, index) in list" :key="index" class="cart-item">  
                                         {{ item.name }} X {{ item.quantity }}, price: {{ item.price }}
                                    </li>
                                </ul>
                            </transition>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import EventBus from "../bus.js";
import Velocity from "velocity-animate";
export default {
    name: "Header",
    props: ["cards"],
    data() {
        return {
            clicked: false,
            list: null,
            restaurantID: null,
            logo: require("../../img/logo.png"),
            menuItems: [
                {
                    label: "Home",
                    routeName: "home",
                },
                {
                    label: "Search",
                    routeName: "search",
                },
            ],
        };
    },
    created() {
        EventBus.$on("refresh_cart", (data) => {
            this.list = JSON.parse(localStorage.getItem("cart"));
            this.list = this.list.filter((item) => item.restaurant == data);
        });
        EventBus.$on("clear_cart", this.clearCart);
    },
    methods: {
        getCart(vs) {
            this.list = JSON.parse(localStorage.getItem("cart"));
            this.restaurantID = vs;
        },
        clearCart() {
            this.list = null;
            this.restaurantID = null;
        },
        SCbeforeEnter: function (el) {
            el.style.opacity = 0;
            el.style.top = "25%";
        },
        SCenter: function (el, done) {
            Velocity(
                el,
                { opacity: 1, top: "7%" },
                { duration: 300 },
                { complete: done }
            );
        },
        SCleave: function (el, done) {
            Velocity(el, { top: "25%", opacity: 0 }, { duration: 200 });
            Velocity(el, { display: "none" }, { complete: done });
        },
    },
};
</script>

<style lang="scss" scoped>
.w-5 {
    width: 5%;
}
.cart-box {
    position: fixed;
    top: 10%;
    right: 15.85%;
    z-index: 1000000000000;
    padding: 30px;
    background-color: rgb(232, 232, 232);
    list-style-type: none;
    .cart-item {
        margin: 1em 0;
        padding: 5px 16px;
        background-color: rgb(191, 191, 191);
    }
}
</style>
