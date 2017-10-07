<template>
<div>
    <ul id="slide-out" class="side-nav">
        <router-link :to="{name: 'home'}" tag="li"><a>Inicial</a></router-link>        
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header">Notícias<i class="material-icons">arrow_drop_down</i></a>
                <div class="collapsible-body">
                <ul>
                    <li><a href="#!">Últimas notícias</a></li>
                    <li><a href="#!">Categorias</a></li>
                </ul>
                </div>
            </li>
            </ul>
        </li>
        <router-link :to="{name: 'programming'}" tag="li"><a>Programação</a></router-link>
        <router-link :to="{name: 'speakers'}" tag="li"><a>Locutores</a></router-link>
        <router-link :to="{name: 'about'}" tag="li"><a>Sobre</a></router-link>
    </ul>
</div>
</template>

<script>


export default {
  mounted() {
    this.setUpConfigs()
  },

  methods: {
    setUpConfigs() {
      $(".button-collapse").sideNav({
      menuWidth: 300,
      closeOnClick: true,
      draggable: true
    });
    }
  }
}
</script>

