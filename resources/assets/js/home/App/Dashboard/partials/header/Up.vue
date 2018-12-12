<template>
  <nav class="top-nav blue darken-2">
      <div class="container">
        <a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only"><i class="material-icons">menu</i></a>
        <div class="nav-wrapper">
          <a class="page-title">Menu de cima</a>
          <ul class="right">
            <li><a class="" @click="logout">Sair</a></li>
          </ul>
        </div>
        
      </div>
    </nav>
</template>

<script>
import { mapActions } from 'vuex'

export default {
    methods: {
      ...mapActions([
        'attemptLogout'
      ]),

      logout() {
        this.attemptLogout()
        .then( () => {
          Materialize.toast("Logout efetuado com sucesso!")
          window.location.reload()
        })
      }

    }
}
</script>

