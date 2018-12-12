<template>
    <div class="row">
        <div class="col s12 m12">
            <div class="card horizontal">
                <div class="card-image col m4 valign-wrapper">
                    <router-link :to="{name:'post', params: {post_slug: post.slug}}">
                        <img :src="post.thumbnail">
                    </router-link>
                </div>
                <div class="card-stacked">
                    <router-link :to="{name:'post', params: {post_slug: post.slug}}">
                        <span class="card-title"><h4 class="post-title" style="color:black">{{ post.title }}</h4></span>
                    </router-link>
                    <div class="row">
                        <div class="col m12 center-align">
                            <p class="text-faded"><i class="tiny material-icons">dehaze</i>Categoria: {{ post.category_id }} | <i class="tiny material-icons">access_time</i>Publicado em: {{ post.published_at }}</p>
                        </div>
                    </div>
                    <div class="card-content">
                        <p> {{ post.subtitle }} </p>
                    </div>
                    <div class="card-action">
                        <router-link class="right" :to="{name:'post', params: {post_slug: post.slug}}">Ler mais</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { http } from '../../../../../services'

	export default {
		data() {
			return {
				post: this.postData,
				error: false
			}
		},

		props:{
			postData: {
				type: Object,
				required: true
			}
		}
	}
</script>

<style>

</style>
