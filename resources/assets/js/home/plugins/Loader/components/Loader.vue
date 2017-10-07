<template>
    <div class="overlay-screeen" v-if="isLoading">
        <div class="preloader-wrapper big active">
            <div class="spinner-layer spinner-blue-only">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    computed: {
        ...mapGetters([
            'isLoading'
        ])
    }
}
</script>

<style>
.overlay-screeen {
    padding: 50%;
	background-color: rgba(0,0,0,0.2);
    position: fixed;
    z-index: 900;
    height: 100%;
    width: 100%;
    overflow: show;
    margin: auto;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
}
</style>

