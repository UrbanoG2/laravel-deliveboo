<template>
    <div>
        <div class="my-container">
            <div class="row search  p-3 bg-light">
                <div class="col-12">
                    <form>
                        <h2>Search</h2>
                        <div class="row justify-content-center">
                            <div class="mb-3 col-2">
                                Order By Column
                                <select
                                    class="form-select form-select"
                                    name="orderbycolumn"
                                    id="orderbycolumn"
                                    v-model="form.orderbycolumn"
                                >
                                    <option value="created_at">Created</option>
                                    <option value="updated_at">Updated</option>
                                </select>
                            </div>
                            <div class="mb-3 col-2">
                                Order By Versus
                                <select
                                    class="form-select form-select"
                                    name="orderbysort"
                                    id="orderbysort"
                                    v-model="form.orderbysort"
                                >
                                    <option value="asc" selected>Asc</option>
                                    <option value="desc">Desc</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col">
                                <div
                                    class="d-flex align-items-center justify-content-center"
                                >
                                    <div
                                        :key="'categories-' + index"
                                        v-for="(category, index) in categories"
                                    >
                                        <input
                                            type="checkbox"
                                            name="categories[]"
                                            :value="category.id"
                                            v-model="form.categories"
                                        />
                                        <label :for="category.name">{{
                                            category.name
                                        }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <input
                                    class="btn btn-info"
                                    type="button"
                                    value="filtra"
                                    @click.prevent="searchRestaurants"
                                />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <Main class="mt-3" :cards="cards" @changePage="changePage($event)"></Main>
    </div>
</template>

<script>
import Axios from "axios";
import EventBus from "../bus.js";
import Main from "../components/Main.vue";
import Home from "../pages/Home.vue";
export default {
    name: "Search",
    components: {
        Main,
        Home,
    },
    data() {
        return {
            form: {
                orderbycolumn: "name",
                orderbysort: "desc",
                categories: [],
            },
            cards: {
                restaurants: null,
                next_page_url: null,
                prev_page_url: null,
                current_page: null,
            },

            categories: null,
        };
    },
    created() {
        this.getRestaurants("http://127.0.0.1:8000/api/search");
        this.getCategories();
        // localStorage.clear('cart');
        EventBus.$emit("clear_cart");
    },
    methods: {
        changePage(vs) {
            let url = this.cards[vs];
            if (url) {
                this.getRestaurants(url);
            }
        },
        getRestaurants(url) {
            Axios.get(url, {
                params: this.form,
            }).then((result) => {
                this.cards.restaurants = result.data.results.data;
                this.cards.next_page_url = result.data.results.next_page_url;
                this.cards.prev_page_url = result.data.results.prev_page_url;
                this.cards.current_page = result.data.results.current_page;
            });
        },
        searchRestaurants() {
            const url = "http://127.0.0.1:8000/api/search";
            Axios.get(url, {
                params: this.form,
            }).then((result) => {
                this.cards.restaurants = result.data.results.data;
                this.cards.next_page_url = result.data.results.next_page_url;
                this.cards.prev_page_url = result.data.results.prev_page_url;
                this.cards.current_page = result.data.results.current_page;
            });
        },
        getCategories() {
            const url = "http://127.0.0.1:8000/api/v1/categories";
            Axios.get(url).then((result) => {
                this.categories = result.data.results.data;
            });
        },
    },
    watch: {
        form: {
            handler() 
            {

            },
            deep: true,
        }
    }
};
</script>

<style lang="scss" scoped>
.row {
    padding: 2em 0;
    h1 {
        text-transform: uppercase;
    }
}
</style>
