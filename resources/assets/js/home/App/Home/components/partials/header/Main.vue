<template>
  <header>
    <menu-up :categories="categories"></menu-up>
    <menu-left :categories="categories"></menu-left>
  </header>
</template>

<script>
import MenuUp from './Up.vue'
import MenuLeft from './Left.vue'

import { http } from '../../../../../services'

  export default {
    components: { MenuUp, MenuLeft },

    data() {
      return {
        categories: []
      }
    },

    created() {
      this.getCategories()
    },

    methods: {
      getCategories() {
        http.get('categories')
        .then(( {data} ) => {
          this.categories = data
        })
      }
    }
  }
</script>

<style>
.navbar-fixed {
  z-index: 999;
}
</style>
