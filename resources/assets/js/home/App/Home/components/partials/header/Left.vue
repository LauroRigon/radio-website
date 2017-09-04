<template>
<div>
    <ul id="slide-out" class="side-nav">
        <li><a href="" class="bold">Inicial</a></li>        
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
        <li><a href="">Programação</a></li>
        <li><a href="">Locutores</a></li>
        <li><a href="">Sobre</a></li>
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
      $(".button-collapse").sideNav();
    }
  }
}
</script>

