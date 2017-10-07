<template>
<div class="row">  
    <menubar></menubar>
    <main>
        <div class="container">
            <div class="row">
                <div class="col m12">
                    <img src="/storage/site/radio_banner.png" alt="Banner da rádio" class="responsive-img" width="100%">
                </div>
            </div>
            <div class="row">
                <div class="col m9">
                    <router-view></router-view>
                </div>

                <div class="col m3">
                    <polls></polls>
                    <social-medias></social-medias>
                    <supporters side="right"></supporters>
                </div>
            </div>
        </div>
    </main>
</div>
</template>

<script>
import Menubar from '../components/partials/header/Main.vue'
import Polls from '../components/Poll/Polls'
import Supporters from '../components/Supporter/Supporters'
import SocialMedias from '../components/SocialMedias'

export default {
	components: { Menubar, Polls, SocialMedias, Supporters }
}
</script>

