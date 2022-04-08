<template>
    <nav class="delive-nav">
        <div class="container">
            <div class="logo-box">
                <router-link class="nav-link" :to="{ name: 'home' }">
                    <img id="logo" class="w-5" :src="logo" alt="logo"/>
                </router-link>
            </div>
            
            <div class="navigation-option">
                <div  class="nav-menu d-none d-md-block">
                    <ul class="menu container"> 
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
                        <li class="nav-item">
                                <a class="nav-link" href="logout"> logout </a>
                        </li>
                    </ul>
                </div>


                <div class="cart-container">
                    <i  @click="clicked = !clicked" class="fa-solid fa-cart-shopping cart"></i>
                    <transition @before-enter="CartTailBE" @enter="CartTailEN" @leave="CartTailLE" :css="false">
                        <i v-if="clicked != false && list != '' && list != null" class="fa-solid fa-caret-up cart-tail"></i>
                    </transition>
                    <transition @before-enter="CartBE" @enter="CartEN" @leave="CartLE" :css="false">
                        <div v-if="clicked != false && list != '' && list != null" class="cart-box">
                            <div v-for="(item, index) in list" :key="index" class="cart-item">  
                                    <div class="cart-item-section">
                                        {{ item.name }} 
                                    </div>
                                    <div class="cart-item-section">
                                        <a @click="addCartItem(item)"><i class="fa-solid fa-plus"></i></a>
                                        {{ item.quantity }}
                                        <a @click="minusCartItem(item)"><i class="fa-solid fa-minus"></i></a>
                                    </div>
                                    <div class="cart-item-section">
                                        price: {{ item.price }}&euro;
                                    </div>
                                    <a @click="removeCartItem(item)"><i class="fa-solid fa-trash"></i></a>
                            </div>
                            <div class="row justify-content-between">
                                <a @click="clearCart">clear</a>
                                <a @click="checkout">checkout</a>
                            </div>
                        </div>
                    </transition>
                </div>
                


                <i @click="showNavbar = !showNavbar" class="fa-solid fa-bars d-md-none d-block bar"></i>
                <transition @before-enter="HamBE" @enter="HamEN" @leave="HamLE" :css="false">
                <div v-show="showNavbar" class="hamburger-nav-menu d-md-none">
                    <ul class="hamburger container pt-3"> 
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
                        <li class="nav-item">
                                <a class="nav-link" href="logout"> logout </a>
                        </li>
                    </ul>
                </div>
                </transition>


                

            </div>
        </div>
    </nav>
    <!-- <div class="container">
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
                    <li v-if="!log" class="nav-item">
                            <a class="nav-link" href="login">Accedi</a>
                    </li>
                    <li v-if="!log" class="nav-item">
                            <a class="nav-link" href="register"> Registrati </a>
                    </li>
                    <li v-if="log" class="nav-item">
                            <a class="nav-link" href="logout"> logout </a>
                    </li>
                    <li>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" @click="clicked = !clicked">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </button>
                            
                            
                        </div>
                    </li>
                </ul>
            </div>

            
        </div> -->
</template>

<script>
import EventBus from "../bus.js";
import Velocity from "velocity-animate";
export default {
    name: "Header",
    props: ["cards"],
    data() {
        return {
            showNavbar: false,
            clicked: false,
            countQuantity: false,
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
            if(localStorage.getItem("cart") != null)
            {
                this.list = JSON.parse(localStorage.getItem("cart"));
                this.restaurantID = data;
            }
            else
            {
                this.list = null;
            }
        });
        EventBus.$on("clear_cart", this.clearCart);
        EventBus.$on("check_log", (data) => {
            if(!data)
            {
                this.log = false;
            }
            else
            {
                this.log = true;
            }
        });
        EventBus.$on("close_cart", this.handleScroll);
        window.addEventListener('scroll', this.handleScroll);
        
    },
    methods: {
        clearCart() {
            localStorage.clear();
            this.list = null;
            EventBus.$emit("updated_cart", []);
        },
        removeCartItem(item) {
            this.list = this.list.filter((element) => element.id != item.id);
            if(this.list.length == 0)
            {
                this.clearCart();
            }
            else
            {
                EventBus.$emit("updated_cart", this.list);
                localStorage.setItem("cart", JSON.stringify(this.list));
            }
        },
        minusCartItem(item) {
            this.list.forEach(element => {
                if(item == element)
                {
                    let price = item.price/item.quantity;
                    item.quantity--;
                    item.price = item.price - price;
                    if(item.quantity == 0)
                    {
                        this.removeCartItem(element);
                        this.countQuantity = true
                    }
                }
            });
            if(this.countQuantity)
            {
                this.countQuantity = false
            }
            else
            {
                localStorage.setItem("cart", JSON.stringify(this.list));
                EventBus.$emit("updated_cart", this.list); 
            }
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
        },
        handleScroll() {
            this.clicked = false;
            this.showNavbar = false;
        },
        checkout() {
            this.$router.push({ name: 'checkout' });
        },

        CartBE: function (el) {
            el.style.opacity = 0;
            el.style.top = "25%";
        },
        CartEN: function (el, done) {
            Velocity(
                el,
                { opacity: 1, top: "150%" },
                { duration: 300 },
                { complete: done }
            );
        },
        CartLE: function (el, done) {
            Velocity(el, { top: "25%", opacity: 0 }, { duration: 200 });
            Velocity(el, { display: "none" }, { complete: done });
        },

        CartTailBE: function (el) {
            el.style.opacity = 0;
            el.style.top = "25%";
        },
        CartTailEN: function (el, done) {
            Velocity(
                el,
                { opacity: 1, top: "110.5%"},
                { duration: 300 },
                { complete: done }
            );
        },
        CartTailLE: function (el, done) {
            Velocity(el, { top: "25%", opacity: 0 }, { duration: 200 });
            Velocity(el, { display: "none" }, { complete: done });
        },

        HamBE: function (el) {
            el.style.opacity = 0;
            el.style.right = "-20%";
        },
        HamEN: function (el, done) {
            Velocity(
                el,
                { opacity: 1, right: "0%" },
                { duration: 200 },
                { complete: done }
            );
        },
        HamLE: function (el, done) {
            Velocity(el, { right: "-20%", opacity: 0 }, { duration: 100 });
            Velocity(el, { display: "none" }, { complete: done });
        },
    },
    watch: {
        restaurantID:
            function()
            {
                console.log(this.restaurantID);
            }
        
    }
};
</script>

<style lang="scss" scoped>
.delive-nav {
    position: fixed;
    top: 0%;
    width: 100%;
    z-index: 1000;
    height: 80px;
    background-color: white;
    &>.container{
        height: 100%;
        display: flex;
        justify-content: space-between;
        .logo-box {
            display: flex;
            align-items: center;
            img {
                width: 50px;
            }
        }
        .navigation-option {
            display: flex;
            align-items: center;
            column-gap: 15px;
            .cart, .bar {
                position: relative;
                font-size: 25px;
                cursor: pointer;
            }
            .nav-menu {
                display: flex;
                align-items: center;
                .menu {
                    margin: 0;
                    list-style: none;
                    .nav-item {
                        display: inline-block;
                        .nav-link {
                            &:link, &:visited, &:hover, &:active {
                                color: black;
                                text-transform: uppercase;
                            }
                        }
                    }
                }
            }
            .hamburger-nav-menu {
                position: absolute;
                top: 100%;
                right: 0;
                width: 40%;
                height: 400%;
                z-index: -100;
                background-color: #ff4d31;
                .hamburger{
                    display: flex;
                    flex-direction: column;
                    align-items: flex-end;
                    list-style: none;
                    .nav-link {
                        &:link, &:visited, &:hover, &:active {
                            color: white;
                            text-transform: uppercase;
                        }

                    }
                }
            }
        }
    }
}

.cart-container {
    position: relative;
}

.cart-box {
    font-size: 1em;
    position: absolute;
    top: 20%;
    right: 0;
    padding: 30px;
    width: 500px;
    opacity: 0;
    background-color:  #ffc626;
    border-radius: 20px 0px 20px 20px;
    .cart-item {
        margin: 1em 0;
        padding: 5px 16px;
        display: flex;
        justify-content: space-around;
        background-color: rgb(191, 191, 191);
        a {
            margin: 0 0.5em;
        }
    }
    .row>a {
        display: inline-block;
    }
}

.cart-tail {
    position: absolute;
    font-size: 23px;
    right: 0;
    color: #ffc626;
}


</style>
