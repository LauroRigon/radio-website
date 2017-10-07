<template>
<div class="navbar-fixed">
  <nav>
    <div class="nav-wrapper purple-radio">
      <div class="container">
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
        <a href="#" class="brand-logo">Logo</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <router-link :to="{name: 'home'}" tag="li"><a>Inicial</a></router-link>
          <li><a class="dropdown-button" href="#" data-activates="news-dropdown">Notícias <i class="material-icons right">arrow_drop_down</i></a></li>
            <ul id="news-dropdown" class="dropdown-content">
              <li><a href="#">Últimas notícias</a></li>
              <li><a href="#">Categorias</a></li>
            </ul>
          <router-link :to="{name: 'programming'}" tag="li"><a>Programação</a></router-link>
          <router-link :to="{name: 'speakers'}" tag="li"><a>Locutores</a></router-link>
          <router-link :to="{name: 'about'}" tag="li"><a>Sobre</a></router-link>
        </ul>
      </div>
    </div>
  </nav>
</div>
</template>

<script>


export default {
  mounted() {
    this.setUpConfigs()
  },

  methods: {
    setUpConfigs() {
      $('.dropdown-button').dropdown({
          constrainWidth: false, // Does not change width of dropdown to that of the activator
          hover: true, // Activate on hover
          gutter: 0, // Spacing from edge
          belowOrigin: true, // Displays dropdown below the button
          alignment: 'left', // Displays dropdown with edge aligned to the left of button
          stopPropagation: false // Stops event propagation
      });
    }
  }
}
</script>

<style>

</style>

