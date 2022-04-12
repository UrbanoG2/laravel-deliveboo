<template>
    <div class="container">
        <div class="row g-4" v-if="cards != null">
            <div
                class="col-12 col-md-4"
                v-for="(restaurant, index) in cards.restaurants"
                :key="index"
            >
                <div class="card h-100">
                    <img
                        :src="restaurant.banner_img"
                        class="card-img-top"
                        :alt="restaurant.name"
                    />
                    <div class="card-body">
                        <h5 class="card-title">{{ restaurant.name }}</h5>
                        <h5
                            class="card-title"
                            v-for="(category, id) in restaurant.categories"
                            :key="id"
                        >
                            {{ category.name }}
                        </h5>
                        <p class="card-text">{{ restaurant.description }}</p>
                    </div>
                    <div 
                        class="btn btn-secondary"
                        @click="checkLastID(restaurant.id)"
                    >View</div>
                </div>
            </div>
        </div>
        <div v-show="cards.restaurants == ''" class="row text-center">
            <div class="col">
                <h1>Nessun risultato</h1>
            </div>
        </div>
        <div
            class="row bottom"
            v-if="cards != null"
        >
            <ul v-if="cards.prev_page_url || cards.next_page_url" class="list-inline d-flex justify-content-center align-items-center">
                <li
                    v-if="!cards.next_page_url && cards.prev_page_url"
                    class="list-inline-item"
                >
                    <h1>{{ cards.current_page }}</h1>
                </li>
                <li class="list-inline-item">
                    <button
                        v-if="cards.prev_page_url"
                        class="btn btn-primary"
                        @click="changePage('prev_page_url')"
                    >
                        Prev
                    </button>
                </li>
                <li
                    v-if="cards.prev_page_url && cards.next_page_url"
                    class="list-inline-item"
                >
                    <h1>{{ cards.current_page }}</h1>
                </li>
                <li class="list-inline-item">
                    <button
                        v-if="cards.next_page_url"
                        class="btn btn-primary"
                        @click="changePage('next_page_url')"
                    >
                        Next
                    </button>
                </li>
                <li v-if="!cards.prev_page_url" class="list-inline-item">
                    <h1>{{ cards.current_page }}</h1>
                </li>
            </ul>
        </div>

        <div class="delete-mes text-center" v-if="alertMessage">
            <div class="container">
                <div class="row">
                    <h1>Conferma cancellazione</h1>
                </div>
                <div class="row justify-content-around">
                    <button class="btn-primary" @click="alertMessage = false">Chiudi</button>
                    <button class="btn-primary" @click="removeCart()">Conferma</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import EventBus from "../bus.js";
export default {
    name: "Main",
    props: ["cards"],
    data() {
        return {
            lastIDRestaurant: null,
            alertMessage: false,
        }
    },
    created() {
        this.lastIDRestaurant = localStorage.getItem('id');
    },
    methods: {
        changePage(vs) {
            this.$emit("changePage", vs);
        },
        checkLastID(id) {
            if(this.lastIDRestaurant == id || localStorage.getItem('cart') == null)
            {
                let params = {
                            name: 'restaurant',
                            params: { id: id },
                        }
                this.newIDRestaurant = null;
                this.$router.push(params);
            }
            else
            {
                this.alertMessage = true;
                this.newIDRestaurant = id
            }
        },
        removeCart(){
            let params = {
                            name: 'restaurant',
                            params: { id: this.newIDRestaurant },
                        }
            this.alertMessage = false;
            EventBus.$emit("clear_cart");
            this.$router.push(params);
        }
    },
    watch: {
        cards: {
            handler() {},
            deep: true,
        },
    },
};
</script>

<style lang="scss" scoped>
.bottom {
    margin-top: 3em;
}

.card {
    z-index: 500;
}
.delete-mes{
    position: fixed;
    width: 450px;
    height: 300px;
    top: 10%;
    right: 30%;
    background-color: green;
}
</style>
