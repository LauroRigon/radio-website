<template>
<div>
    <page-loader></page-loader>
    <router-view></router-view>
    
    <vue-progress-bar></vue-progress-bar>

    <music-order></music-order>
</div>
</template>

<script>
import MusicOrder from "./Home/components/Musicorder"
    export default {
        components: { MusicOrder }
    }
</script>


