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
                    <li>
                        <transition
                            v-on:before-enter="SCbeforeEnter"
                            v-on:enter="SCenter"
                            v-on:leave="SCleave"
                            v-bind:css="false"
                        >
                            <div class="dropdown">
                                <a
                                    class="btn btn-secondary dropdown-toggle"
                                    href="#"
                                    role="button"
                                    id="dropdownMenuLink"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                                <ul
                                    class="dropdown-menu"
                                    aria-labelledby="dropdownMenuLink"
                                >
                                    <li
                                        v-for="(item, index) in list"
                                        :key="index"
                                    >
                                        Item: {{ item.id }}, quantity:
                                        {{ item.quantity }}
                                    </li>
                                </ul>
                            </div>
                        </transition>
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
            el.style.top = "60%";
        },
        SCenter: function (el, done) {
            Velocity(
                el,
                { opacity: 1, top: "10%" },
                { duration: 300 },
                { complete: done }
            );
        },
        SCleave: function (el, done) {
            Velocity(el, { top: "5%", opacity: 1 }, { duration: 200 });
            Velocity(el, { top: "70%", opacity: 0 }, { duration: 200 });
            Velocity(el, { display: "none" }, { complete: done });
        },
    },
};
</script>

<style lang="scss" scoped>
.w-5 {
    width: 5%;
}
</style>
