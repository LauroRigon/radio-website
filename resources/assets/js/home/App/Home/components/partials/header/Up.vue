<template>
<div class="navbar-fixed">
  <nav>
    <div class="nav-wrapper purple-radio">
      <div class="container">
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
        <a href="#" class="brand-logo">Logo</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <router-link exact :to="{name: 'home'}" tag="li"><a>Inicial</a></router-link>
          <router-link exact to="" tag="li" class="dropdown-button" data-activates="news-dropdown"><a>Programação <i class="material-icons right">arrow_drop_down</i></a></router-link>
  
          <router-link exact :to="{name: 'programming'}" tag="li"><a>Programação</a></router-link>
          <router-link exact :to="{name: 'speakers'}" tag="li"><a>Locutores</a></router-link>
          <router-link exact :to="{name: 'about'}" tag="li"><a>Sobre</a></router-link>
        </ul>
      </div>
    </div>

    <!-- DROPDOWN NEWS -->
    <ul id="news-dropdown" class="dropdown-content nested">
      <router-link exact :to="{name: 'posts'}" tag="li"><a>Últimas notícias</a></router-link>
      <li><a class="dropdown-button" href="#" data-activates="categories-dropdown">Categorias <i class="material-icons right">arrow_drop_down</i></a></li>
    </ul>

    <!-- DROPDOWN CATEGORIES -->
    <ul id="categories-dropdown" class="dropdown-content second-level">
      <router-link exact :to="{name: 'posts', query:{categoria: category.name}}" tag="li" v-for="category in categories" :key="category.id"><a>{{ category.name }}</a></router-link>
    </ul>
  </nav>
</div>
</template>

<script>


export default {
  props: ['categories'],

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
.dropdown-content.nested {
   overflow-y: visible;
}

.dropdown-content .dropdown-content {
   margin-left: 100%;
   top: 50px !important;
}
</style>

