<template>
    <div>
        <div class="my-container">
            <div class="row">
                <div class="col">
                    <h1 class="mt-5 mb-3">
                        Ricerca Avanzata
                    </h1>
                </div>
            </div>
            <div class="row search mb-3 p-3 bg-light">
                <div class="col-12">
                    <form>
                        <h2>Search</h2>
                        <div class="row">
                            <div class="mb-3 col-2">
                                Order By Column
                                <select class="form-select form-select" name="orderbycolumn" id="orderbycolumn"
                                    v-model="form.orderbycolumn">
                                    <option value="created_at">Created</option>
                                    <option value="updated_at">Updated</option>
                                </select>
                            </div>
                            <div class="mb-3 col-2">
                                Order By Versus
                                <select class="form-select form-select" name="orderbysort" id="orderbysort"
                                    v-model="form.orderbysort">
                                    <option value="asc">Asc</option>
                                    <option value="desc">Desc</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-6">
                                Categories
                                <div class="d-flex align-items-center justify-content-between">
                                    <div :key="'categories-' + index" v-for="(category, index) in categories">
                                        <input type="checkbox" name="categories[]" :value="category.name" v-model="form.categories">
                                        <label :for="category.name">{{ category.name }}</label>
                                    </div>

                                   
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <input class="btn btn-info" type="button" value="filtra" @click.prevent="searchRestaurants">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <Main :cards="cards" @changePage="changePage($event)"></Main>
    </div>
</template>

<script>
import Axios from "axios";
import Main from "../components/Main.vue";
export default {
    name: "Search",
    components: {
        Main,
    },
    data() {
      return {
        form: {
          orderbycolumn: 'name',
          orderbysort: 'desc',
          categories: [],
        },
        cards: {
          restaurants: null,
          next_page_url: null,
          prev_page_url: null,
          current_page: null
        },

        categories: null,
        test: null
      }
    },
    created() {
        this.getRestaurants("http://127.0.0.1:8000/api/search");
        this.getCategories();
        let value = {
            cacca: 'puzzolente',
            pipi: [
                1,
                2,
                3,
                'solillo',
                'explode',
                'burn'
            ],
            gatto: 'cinese',
            pc: 'explode'
        }
        localStorage.setItem('string', JSON.stringify(value));
        this.test = localStorage.getItem('string');
        console.log(this.test);
    },
    methods: {
        changePage(vs) {
            let url = this.cards[vs];
            if (url) {
                this.getRestaurants(url);
            }
        },
        getRestaurants(url) {
            Axios.get(url).then((result) => {
                this.cards.restaurants = result.data.results.data;
                this.cards.next_page_url =
                    result.data.results.next_page_url;
                this.cards.prev_page_url =
                    result.data.results.prev_page_url;
                    this.cards.current_page =
                    result.data.results.current_page;
            });
        },
        searchRestaurants() {
            const url = "http://127.0.0.1:8000/api/search";
            Axios.get(url, {
                params: this.form,
            }).then((result) => {
                    this.cards.restaurants = result.data.results.data;
                    this.cards.next_page_url =
                        result.data.results.next_page_url;
                    this.cards.prev_page_url =
                        result.data.results.prev_page_url;
                        this.cards.current_page =
                    result.data.results.current_page;
            });
        },
        getCategories(){
            const url = 'http://127.0.0.1:8000/api/v1/categories';
            Axios.get(url).then(
                    (result) => {
                        this.categories = result.data.results.data;
                    });
        }
    },
    
}
</script>

<style lang="scss" scoped>
.row {
    margin: 2em 0;
    h1 {
        text-transform: uppercase;
    }
}
</style>
