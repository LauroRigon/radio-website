<template>
<div class="navbar-fixed">
  <nav>
    <div class="nav-wrapper purple-radio">
      <div class="container">
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
        <a href="#" class="brand-logo">Logo</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="">Inicial</a></li>
          <li><a class="dropdown-button" href="#" data-activates="news-dropdown">Notícias <i class="material-icons right">arrow_drop_down</i></a></li>
            <ul id="news-dropdown" class="dropdown-content">
              <li><a href="#">Últimas notícias</a></li>
              <li><a href="#">Categorias</a></li>
            </ul>
          <li><a href="">Programação</a></li>
          <li><a href="">Locutores</a></li>
          <li><a href="">Sobre</a></li>
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
.purple-radio {
  background-color: #322C53;
}
</style>

