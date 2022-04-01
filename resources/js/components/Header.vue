<template>
   <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
          <router-link class="nav-link" :to="{ name: 'home'}"> <img id="logo" class="w-5" :src="logo" alt="logo"></router-link>
             
          <button class="navbar-toggler" type="button" data-toggle="collapse"
                  data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                  aria-expanded="false">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav mr-auto">
               <li class="nav-item"  
                v-for="(item) in menuItems"
                :key="item.id"
                >
                  <router-link class="nav-link" :to="{ name: item.routeName}">{{ item.label }}</router-link>

               </li>
               <li>
                <div class="dropdown">
                  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-cart-shopping"></i>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li :cards="cards"></li>
                  </ul>
                </div>
               </li>
             </ul>
          </div>
      </div>
  </nav>
</template>

<script>
export default {
    name: 'Header',
    props: ['cards'],
    data(){
      return{
        list: null,
        logo: require('../../img/logo.png'),
        menuItems: [
          {
            label: 'Home',
            routeName: 'home'
          },
          {
            label: 'Search',
            routeName: 'search'
          }
        ],

      }
    },
    methods: {
      addPlates() {
        this.$emit('addPlates', list);
      }
    },
}
</script>

<style lang="scss" scoped>
  .w-5{
    width: 5%;
  }
</style>