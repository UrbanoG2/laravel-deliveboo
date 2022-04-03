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
                            <button class="btn btn-secondary dropdown-toggle" @click="clicked = !clicked">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </button>
                            
                            <transition @before-enter="SCbeforeEnter" @enter="SCenter" @leave="SCleave" :css="false">
                                <ul v-if="clicked != false && listShow != '' && list != null" class="cart-box">
                                    <li v-for="(item, index) in listShow" :key="index" class="cart-item">  
                                         {{ item.name }} 
                                         <a @click="addCartItem(item)"><i class="fa-solid fa-plus"></i></a>
                                         {{ item.quantity }}
                                         <a @click="minusCartItem(item)"><i class="fa-solid fa-minus"></i></a>
                                         price: {{ item.price }}
                                         <a @click="removeCartItem(item)"><i class="fa-solid fa-trash"></i></a>
                                    </li>
                                    <li><a @click="removeAllCartItem">clear</a></li>
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
            listShow: null,
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
            bodyScrollHeight: null,
        };
    },
    created() {
        EventBus.$on("refresh_cart", (data) => {
            this.list = JSON.parse(localStorage.getItem("cart"));
            this.restaurantID = data;
            this.getItemList(data);
        });
        EventBus.$on("clear_cart", this.clearCart);
        window.addEventListener('scroll', this.handleScroll);
    },
    methods: {
        removeAllCartItem() {
            this.list = this.list.filter((element) => element.restaurant != this.restaurantID);
            this.listShow = '';
            EventBus.$emit("updated_cart", this.list);
            localStorage.setItem("cart", JSON.stringify(this.list));
        },
        removeCartItem(item) {
            this.list = this.list.filter((element) => element.id != item.id);
            this.listShow = this.listShow.filter((element) => element != item);
            EventBus.$emit("updated_cart", this.list);
            localStorage.setItem("cart", JSON.stringify(this.list));
        },
        minusCartItem(item) {
            this.list.forEach((element, index, array) => {
                if(item == element)
                {
                    let price = item.price/item.quantity;
                    item.quantity--;
                    item.price = item.price - price;
                    if(item.quantity == 0)
                    {
                        this.removeCartItem(element);
                    }
                }
            });
            localStorage.setItem("cart", JSON.stringify(this.list));
            EventBus.$emit("updated_cart", this.list);
            this.getItemList(this.restaurantID);
        },
        addCartItem(item) {
            this.list.forEach(element => {
                if(item == element)
                {
                    let price = item.price/item.quantity;
                    item.quantity++;
                    item.price = item.price + price;
                }
            });
            localStorage.setItem("cart", JSON.stringify(this.list)); 
            EventBus.$emit("updated_cart", this.list);
            this.getItemList(this.restaurantID);
        },
        handleScroll() {
            this.clicked = false;
        },
        getItemList(data) {
            this.listShow = this.list.filter((item) => item.restaurant == data);
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
    watch: {
        listShow:
            function() 
            {
                
            }
    }
};
</script>

<style lang="scss" scoped>
nav{
    position: sticky;
    top: 0%;
    width: 100%;
    z-index: 1000000000000;
}

.w-5 {
    width: 5%;
}
.cart-box {
    position: fixed;
    top: 10%;
    right: 15.85%;
    padding: 30px;
    background-color: rgb(232, 232, 232);
    list-style-type: none;
    .cart-item {
        margin: 1em 0;
        padding: 5px 16px;
        background-color: rgb(191, 191, 191);
        a {
            margin-left: 1em;
        }
    }
}
</style>
