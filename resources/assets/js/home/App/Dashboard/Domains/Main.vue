<template>
<div class="row">  
    <menubar></menubar>
    <main>
        <div class="container">
        <div class="row">
            <div class="col s10">
                <router-view></router-view>
            </div>
        </div>
        </div>
    </main>
    
</div>
</template>

<script>
import Menubar from '../partials/header/Main.vue'

export default {
	components: { Menubar }
}
</script>

