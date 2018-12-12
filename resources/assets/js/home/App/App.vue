<template>
<div>
    <page-loader></page-loader>
    <router-view></router-view>
    
    <vue-progress-bar></vue-progress-bar>

    <music-order></music-order>

    <player></player>
</div>
</template>

<script>
import MusicOrder from "./Home/components/Musicorder"
import Player from "./Home/components/Player"

    export default {
        components: { MusicOrder, Player }
    }
</script>


