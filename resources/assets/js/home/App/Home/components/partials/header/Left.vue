<template>
<div>
    <ul id="slide-out" class="side-nav">
        <router-link exact :to="{name: 'home'}" tag="li"><a>Inicial</a></router-link>        
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header">Notícias<i class="material-icons">arrow_drop_down</i></a>
                <div class="collapsible-body">
                <ul>
                    <router-link exact :to="{name: 'posts'}" tag="li"><a>Últimas notícias</a></router-link>
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <a class="collapsible-header">Categorias<i class="material-icons">arrow_drop_down</i></a>
                            <div class="collapsible-body">
                                <!-- DROPDOWN CATEGORIES -->
                                <ul class="down-level">
                                    <router-link exact :to="{name: 'posts', query:{categoria: category.name}}" tag="li" v-for="category in categories" :key="category.id"><a>{{ category.name }}</a></router-link>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    
                </ul>
                </div>
            </li>
            </ul>
        </li>
        <router-link exact :to="{name: 'programming'}" tag="li"><a>Programação</a></router-link>
        <router-link exact :to="{name: 'speakers'}" tag="li"><a>Locutores</a></router-link>
        <router-link exact :to="{name: 'about'}" tag="li"><a>Sobre</a></router-link>
    </ul>
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
            $(".button-collapse").sideNav({
            menuWidth: 300,
            closeOnClick: true,
            draggable: true
            });
        }
    }
}
</script>

<style>
.side-nav .collapsible-body > ul:not(.collapsible) > li {
    padding-left: 30px;
}

.side-nav .collapsible-body > ul:not(.collapsible) > li.active, .side-nav.fixed .collapsible-body > ul:not(.collapsible) > li.active {
    background-color: rgb(218, 192, 45);
}

.side-nav li.active {
    background-color: rgba(50, 44, 83, 0.7);
}
</style>
