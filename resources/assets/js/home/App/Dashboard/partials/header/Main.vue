<template>
  <header>
    <menu-up></menu-up>
    <menu-left></menu-left>
  </header>
</template>

<script>
import MenuUp from './Up.vue'
import MenuLeft from './Left.vue'

  export default {
    components: { MenuLeft, MenuUp }
  }
</script>
