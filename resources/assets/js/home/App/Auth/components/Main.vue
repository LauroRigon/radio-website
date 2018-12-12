<template>
    <div class="container">
        <router-view></router-view>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  // ...
  computed: {
    ...mapGetters([
      'isLogged'
    ])
  }
}
</script>

