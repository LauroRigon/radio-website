<template>
<div class="navbar-fixed">
  <nav class="purple-radio" :class="(getScrollOffSet >= 100)? 'menu-scrolled': ''">
    <div class="nav-wrapper" >
      <div class="container">
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
        <a href="#" class="brand-logo"> <img src="/storage/site/main-logo.png" alt="Banner da rádio" class="responsive-img" width="70px"> </a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <router-link exact :to="{name: 'home'}" tag="li"><a>Inicial</a></router-link>
          
          <li><a class="dropdown-button" href="#" data-activates="news-dropdown">Notícias <i class="material-icons right">arrow_drop_down</i></a></li>
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

  data() {
    return {
      pageOffset: 0
    }
  },

  mounted() {
    this.setUpConfigs()
  },

  computed: {
    getScrollOffSet() {
     return this.pageOffset
    }
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

      $( window ).scroll(() => {
        this.pageOffset = window.pageYOffset
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

.dropdown-content li > a, .dropdown-content li > span {
  color: #322C53;
}

.menu-scrolled {
  background-color: rgb(80, 103, 151) !important;
  padding-bottom: 10px;
  transition: 1s;
}
</style>

